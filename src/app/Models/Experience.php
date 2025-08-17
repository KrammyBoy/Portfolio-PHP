<?php 
declare (strict_types= 1);

namespace App\Models;
use PDO;
use DateTime;
use App\Helper\Validator\ExperienceValidator;
/**
 * Class Experience
 *
 * Represents the `Experiences` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - experience_type (VARCHAR[64]) NOT NULL
 * - experience_description (VARCHAR[1024]) NOT NULL
 * - start_date (DATE) NOT NULL
 * - end_date (DATE) NOT NULL
 * - school (VARCHAR[64]) NOT NULL
 * - experience_degree (VARCHAR[64]) NOT NULL
 */

class Experience {

    private PDO $pdo;

    private int $id;

    /**
     * 
     * @var string
     * 
     * Values should be either "Education" or "Work"
     */
    private string $experience_type;

    private string $experience_description;

    private DateTime $start_date;

    private DateTime $end_date;

    private string $school;

    private string $experience_degree;
    

    public function __construct() {
        $this->pdo = DBContext::getInstance()->getConnection();
    }

    public function getExperience(): array {
        $query = "SELECT * FROM Experiences WHERE deleted_at IS NULL ORDER BY end_date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //TODO Probably more effecient if we query the specific like the longest date?
    public function getRecentExperience(int $max): array {
        $array = $this->getExperience();
        $arrayExperience = array_splice($array, 0, $max);
        return $arrayExperience;
    }

    //Count methods
    public function getTotalExperienceByType(string $experience_type): float {
        $query = "SELECT ROUND(SUM(EXTRACT(EPOCH FROM end_date - start_date))/(365.25 * 24 * 60 * 60), 2) AS total_years
        FROM Experiences WHERE experience_type = :experience_type AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([":experience_type" => $experience_type]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
        return (float) $result['total_years'] ?? 0;

    }

    // Insert methods
    public function addExperience(array $data): bool {
        if (ExperienceValidator::validate($data)) {
            return false;
        }

        $this->pdo->beginTransaction();

        try {
            $query = 'INSERT INTO Experiences(experience_type, experience_description, start_date, end_date, school, experience_degree)
            VALUES(:experience_type, :experience_description, :start_date, :end_date, :school, :experience_degree)';
            $this->pdo->prepare($query)->execute([
                ':experience_type' => $data['type'],
                ':experience_description' => $data['description'],
                ':start_date' => (new DateTime($data['start_date']))->format('Y-m-d H:i:s'),
                ':end_date' => (new DateTime($data['end_date']))->format('Y-m-d H:i:s'),
                ':school' => $data['school'],
                ':experience_degree' => $data['degree']
            ]);

            $this->pdo->commit();
            return true;
        }catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    //Update methods
    public function updateExperience(array $data): bool {
        if (ExperienceValidator::validate($data) === false) {
            return false;
        }

        $this->pdo->beginTransaction();
        try {
            $query = 'UPDATE Experiences SET experience_type = :experience_type, experience_description = :experience_description,
            start_date = :start_date, end_date = :end_date, school = :school, experience_degree = :experience_degree WHERE id = :id';

            $this->pdo->prepare($query)->execute([
                ':experience_type' => $data['type'],
                ':experience_description' => $data['description'],
                ':start_date' => (new DateTime($data['start_date']))->format('Y-m-d H:i:s'),
                ':end_date' => (new DateTime($data['end_date']))->format('Y-m-d H:i:s'),
                ':school' => $data['school'],
                ':experience_degree' => $data['degree'],
                ':id' => $data['id']
            ]);
            $this->pdo->commit();
            return true;
        }catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    //Delete Methods
    public function deleteExperience(int $id): bool {
        $this->pdo->beginTransaction();

        try{
            $query = 'UPDATE Experiences SET deleted_at = :deleted_at WHERE id = :id ';
            $this->pdo->prepare($query)->execute([
                ':deleted_at' => (new DateTime())->format('Y-m-d H:i:s'),
                ':id'=> $id
            ]);
            $this->pdo->commit();
            return true;
        }catch (\PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}

?>