<?php 
declare(strict_types= 1);

/**
 * A Model for all the dashboard information
 */
namespace App\Models;
use PDO;
use DateTime;
use App\Helper\Toast;

class Dashboard {
    private PDO $pdo;
    private Projects $projects;
    private Certificates $certificates;
    private Experience $experience;
    private Technologies $technologies;
    private Admin $admin;
    private ContactInformation $contactInformation;

    public function __construct(){
        $this->pdo = DBContext::getInstance()->getConnection();
        $this->projects = new Projects();
        $this->certificates = new Certificates();
        $this->experience = new Experience();
        $this->technologies = new Technologies();
        $this->admin = new Admin();
        $this->contactInformation = new ContactInformation();
    }

    public function getAllInformationForDashboard(): array {
        return [
            "projectCount" => $this->projects->getProjectsCount(),
            "certificateCount" => $this->certificates->getCertificatesCount(),
            "experienceCount" => $this->experience->getTotalExperienceByType('Work'),
            "technologiesCount" => $this->technologies->getTotalTechnologies(),
            "recentExperience" => $this->experience->getRecentExperience(1), //This will return an array
            "getAdminInfo" => $this->admin->fetchUserByID($_SESSION['admin_id']), //Will return an array
            "contactInformation" => $this->contactInformation->getContactInformation() //This return an array
        ];
    }

    public function updateContactInformation(array $data): void{
        $this->pdo->beginTransaction();
        
        try{
            $query = "UPDATE ContactInformation SET email = :email, phone = :phone, location = :location, 
            response_time = :response_time, updated_at = :updated_at WHERE id = 1";

            $update_at = (new DateTime())->format("Y-m-d H:i:s");
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ":email" => $data['email'],
                ":phone" => $data['phone'],
                ":location" => $data['location'],
                ":response_time" => $data['response'],
                ':updated_at' => $update_at
            ]);

            $this->pdo->commit();
            
            Toast::setToast('success', 'Contact Information has been updated');

        }catch(\PDOException $e){
            $this->pdo->rollBack();
            Toast::setToast('error','Something went wrong when updating the information');

        }
        header('Location: /dashboard');
        exit();

    }
}

?>