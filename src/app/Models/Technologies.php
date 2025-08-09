<?php 

declare(strict_types= 1);

namespace App\Models;

/**
 * Class Technologies
 *
 * Represents the `Technologies` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - technology_name (VARCHAR[255]) NOT NULL
 * - boxicon (VARCHAR[255]) NOT NULL
 * - category (VARCHAR[255]) NOT NULL
 */
use PDO;
class Technologies {

    private PDO $pdo;

    private int $id;

    private string $technology_name;

    /**
     * @var string CSS class for the technology icon (e.g., "bx bxl-github")
     */
    private string $boxicon;

    /**
     * @var string Category type (e.g., "Frontend", "Backend", "Database", etc.)
     * Suggested values:
     * - Frontend
     * - Backend
     * - Fullstack
     * - Database
     * - DevOps
     * - API
     * - Testing
     * - Tools
     * - Other
     */    
    private string $category;

    public function __construct() {
        $this->pdo = DBContext::getInstance()->getConnection();
    }
    //Get Methods
    public function getAllTechnologies(): array {
        $query = "SELECT * FROM Technologies";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function bundleTechnologies(array $technologies): array {
        $bundled = [];
        foreach ($technologies as $tech) {
            $category = $tech['category'];
            if (!isset($bundled[$category])) {
                $bundled[$category] = [];
            }
            $bundled[$category][] = $tech;
        }
        return $bundled;
    }

    //Count Methods
    public function getTotalTechnologies(): int {
        return $this->pdo->query('SELECT COUNT(*) FROM Technologies')->fetchColumn();
    }

    //Insert Methods 
    public function insertTechnology(
        string $technology_name,
        string $boxicon,
        string $category
    ){
        
    }

    
}   

?>