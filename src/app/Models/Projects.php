<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;
use App\Helper\Toast;
use App\Enums\FileType;

/**
 * Class Projects
 *
 * Represents the `Projects` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - title (VARCHAR[48]) NOT NULL
 * - description (VARCHAR[255]) NOT NULL
 * - image TEXT
 * - live_url TEXT
 * - repo_url TEXT
 * - status_id (INT) NOT NULL - Foreign key referencing `Status` table 
 * - deleted_at (TIMESTAMP) - Nullable, used for soft deletion
 */

class Projects {

    private $pdo;
    private int $id;
    private String $title;
    private string $description;

    /**
     * @var string Relative path to the project image stored in /public/assets/images
     */
    private string $image;
    private string $live_url;
    private string $repo_url;
    private int $status_id;
    private \DateTime|null $deleted_at;

    private string $project_prefix = 'proj_img_';
    private const IMAGE_DIRECTORY = __DIR__ . '../../public/assets/upload/images/';


    public function __construct() {
        // Initialize the DBContext instance
        $this->pdo = DBContext::getInstance()->getConnection();

    }
    // Get DB;
    public function getProjects(?int $status_id = 0): array {
        $query = "SELECT * FROM Projects WHERE deleted_at IS NULL";
        $params = [];
        if ($status_id > 0){
            $query .= " AND status_id = :status_id";
            $params[':status_id'] = $status_id;
        }

        $stmt = $this->pdo->prepare($query);
        
        $stmt->execute($params);
        return $stmt->fetchAll();

    }

    public function getProjectsRandom(int $max = 3): array {
        $array = $this->getProjects();
        shuffle($array);
        return array_slice($array,0, $max);
    }

    // Count methods
    public function getGroupedStatusCount(): array {
        $query = "SELECT status_id, COUNT(*) as total FROM Projects WHERE deleted_at IS NULL GROUP BY status_id"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $counts = [
            1 => 0, // Completed
            2 => 0, // In Progress
            3 => 0, // Abandoned
        ];

        foreach ($results as $row) {
            $counts[(int)$row['status_id']] = (int)$row['total'];
        }

        return [
            'Completed' => $counts[1],
            'In Progress' => $counts[2],
            'Abandoned' => $counts[3],
            'Total' => array_sum($counts),
        ];
    }
    // Count All Projects
    public function getProjectsCount(): int {
        return $this->pdo->query('SELECT COUNT(*) FROM Projects')->fetchColumn();
    }

    public function getLastId(): int {
        return $this->pdo->query('SELECT last_value FROM projects_id_seq')->fetchColumn() + 1;
    }

    // Insert methods
    public function insertProject(array $data, array $file = []): void {
        if (strlen($data['title']) > 64 || strlen($data['description']) > 512) {
            Toast::setToast('error', 'Title and Description passed is longer than the maximum limit');
            header('Location: /projects');
            exit();
        } 
        $filePath = null;

        //Check file if it has no error
        if ($file['image']['error'] !== UPLOAD_ERR_NO_FILE){
            $filePath = $this->project_prefix . $this->getLastId() . FileType::getFileType($file['image']['type']);
        }

        //Don't mind this just needed to for uploadImage
        $this->title = $data['title'];

        $this->pdo->beginTransaction();

        try {
            $query = 'INSERT INTO Projects(title, description, image, live_url, repo_url, status_id) VALUES (
            :title, :description, :image, :live_url, :repo_url, :status_id)';

            var_dump($data);

            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':image' => $filePath, 
                ':live_url' => (!empty($data['live_url']))? $data['live_url'] : null,
                ':repo_url' => (!empty($data['repo_url']))? $data['repo_url'] : null,
                ':status_id' => (int) $data['status_id']
            ]);

            $this->pdo->commit();
            //upload image to the server if a file is present
            if ($file['image']['error'] !== UPLOAD_ERR_NO_FILE)  $this->uploadImage($file, $filePath);
            Toast::setToast('success', 'Added ' . $data['title'] . ' project to the database');
            header('Location: /projects');
            
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            Toast::setToast('error', 'Something went wrong when inserting project to the database');
            header('Location: /projects');
            exit();      
        }
    }
    public function uploadImage(array $file, string $fileName){
        //Get all file information
        $fileTemp = $file['image']['tmp_name'];

        //Move upload
        $finalName = self::IMAGE_DIRECTORY . $fileName;
        if(move_uploaded_file($fileTemp, $finalName)){
            Toast::setToast('success','Added ' . $this->title . ' project to the database');
        }else {
            Toast::setToast('error', 'Something went wrong when uploading the image');
        }
        header('Location: /projects');
        exit();
    }

    //Delete methods
    /**
     * This will only soft delete the record
     */
    public function deleteProject(int $id): void{
        $this->pdo->beginTransaction();

        try{
            $query = 'UPDATE Projects SET deleted_at = NOW() WHERE id = :id';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(
                [
                    ':id' => $id
                ]);     
            $this->pdo->commit();
            //Commit
            Toast::setToast('success','[' . $id . '] is successfully deleted');
        }catch (\PDOException $e) {
            $this->pdo->rollBack();
            Toast::setToast('error', 'Something went wrong when deleting the record');
        }

        header('Location: /projects');
        exit();
    }
    public function updateProject(array $data){
        $this->pdo->beginTransaction();
        try {
            $query = 'UPDATE Projects SET title = :title, description = :description, 
            live_url = :live_url, repo_url = :repo_url, status_id = :status_id  WHERE id = :id';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':title' => $data['title'],
                ':description' => $data['description'],
                ':live_url' => (!empty($data['live_url']))? $data['live_url'] : null,
                ':repo_url' => (!empty($data['repo_url']))? $data['repo_url'] : null,
                ':status_id' => (int) $data['status_id'],
                ':id' => $data['id']
            ]);

            $this->pdo->commit();
            //This is for updating files
            //Just add it 
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $this->updateImage($data);
            }
            Toast::setToast('success','Successfully update the project id ' . $data['id']);
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            Toast::setToast('error', 'Something went wrong with updating the project');
        }

        header('Location: /projects');
        exit();
    }
    public function updateImage(array $data){
            if(FileType::checkValidType($_FILES['image']['type'])){
                $filename = $this->project_prefix . $data['id'] . FileType::getFileType($_FILES['image']['type']);

                $this->pdo->beginTransaction();

                try {
                    $this->pdo->prepare('UPDATE Projects SET image = :image WHERE id = :id')->execute(
                    [
                        ':image' => $filename,
                        ':id' => $data['id'],
                    ]);
                    //Check the image if it already exist
                    $filePath = self::IMAGE_DIRECTORY . $filename;
                    if (file_exists($filePath)){
                        //Delete the image
                        unlink(realpath($filePath));
                    }
                    //Move the new image
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $filePath)){
                        $this->pdo->commit();                            
                        Toast::setToast('success', 'Updated the image successfully');
                        header('Location: /projects');
                        exit();
                    } else {
                        throw new \PDOException();
                    }
                } catch (\PDOException $e) {
                    $this->pdo->rollBack();
                    Toast::setToast('error', 'Something went wrong');
                    header('Location: /projects');
                    exit();

                }
            }
            Toast::setToast('error','Something went wrong when updating the image');
            header('Location: /projects');
            exit();
    }

}

?>