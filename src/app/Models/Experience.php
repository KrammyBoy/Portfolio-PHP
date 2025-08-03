<?php 
declare (strict_types= 1);

namespace App\Models;
use PDO;
use DateTime;
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
        $query = "SELECT * FROM Experiences ORDER BY end_date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentExperience(int $max): array {
        $array = $this->getExperience();
        $arrayExperience = array_splice($array, 0, $max);
        return $arrayExperience;
    }

    public function isValidExperience($experience_description): bool {
        $experience_description = ucfirst(trim($experience_description));

        return ($experience_description === "Education" || $experience_description === "Work") ? true:false;

    }
    // Insert methods

    public function insertExperience(
        string $experience_type,
        string $experience_description,
        DateTime $start_date,
        DateTime $end_date,
        string $school,
        string $experience_degree
    ): void {
        if (strlen($experience_type) > 64 || strlen($experience_description) > 1024
            || strlen($school) > 64 || strlen($experience_degree) > 64) {
            throw new \InvalidArgumentException("Experience type must be less than 64 characters.");
        }
        else if ($this->isValidExperience($experience_type) === false) {
            throw new \InvalidArgumentException("Invalid experience type. Must be either 'Education' or 'Work'.");
        }
    }
}

?>