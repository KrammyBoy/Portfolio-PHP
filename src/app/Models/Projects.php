<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;

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
        // $query = 'SELECT COUNT(*) FROM Projects';
        // $stmt = $this->pdo->prepare($query);
        // $stmt->execute();
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        // return $result;
        return $this->pdo->query('SELECT COUNT(*) FROM Projects')->fetchColumn();
    }

    // Insert methods
    public function insertProject(
        String $title, 
        String $description, 
        int $status_id,
        String $image = null, 
        String $live_url = null, 
        String $repo_url = null, 
    ): void {
        if (strlen($title) > 48 || strlen($description) > 255) {
            throw new \InvalidArgumentException("Title must be less than 48 characters and description must be less than 255 characters.");
        }
        

        // Additional validation for URLs and image path can be added here
    }
}

?>