<?php 

declare(strict_types= 1);

namespace App\Models;

use PDO;

/**
 * Class ProjectTechnologies
 *
 * Represents the `Project_Technologies` table in the database.
 *
 * Table Columns:
 * - project_id (INT) - Foreign key referencing `Projects` table
 * - technology_id (INT) - Foreign key referencing `Technologies` table
 * - composite Key (project_id, technology_id) - Unique constraint to prevent duplicate entries
 */

class ProjectTechnologies {

    private PDO $pdo;
    public int $project_id;
    public int $technology_id;

    public function __construct(){
        $this->pdo = DBContext::getInstance()->getConnection();
    }
    // Get values
    // Let us use transaction to ensure data integrity
    public function getById(int $id): array {
        try {
            $query = "SELECT t.technology_name, t.boxicon
                      FROM Technologies t
                      JOIN Project_Technologies pt ON pt.technology_id = t.id
                      JOIN Projects p ON pt.project_id = p.id
                      WHERE pt.project_id = :project_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['project_id' => $id]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\PDOException $e) {
            throw new \RuntimeException("Failed to get project technologies: " . $e->getMessage());
        }

    }
    //Insert Methods
    public function insertProjectTechnology(int $project_id, int $technology_id): void {
        // Validate that project_id and technology_id are positive integers
        if ($project_id <= 0 || $technology_id <= 0) {
            throw new \InvalidArgumentException("Project ID and Technology ID must be positive integers.");
        }

        // Additional logic to insert the project-technology relationship into the database
    }
}
?>