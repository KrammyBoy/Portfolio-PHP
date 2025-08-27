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
            return [];
        }

    }
    public function getTableWithProjectsAndTechnology(): array{
        try {
            $query = 'SELECT p.title, p.id, t.technology_name, pt.technology_id FROM Project_Technologies as pt JOIN Projects p ON
            pt.project_id = p.id JOIN Technologies t ON pt.technology_id = t.id';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch (\PDOException){
            return [];
        }
    }

    //Insert Methods
    public function addProjectTechnology(array $data): bool {
        // Validate that project_id and technology_id are positive integers
        // array(2) { ["projects"]=> string(1) "1" ["technologies"]=> string(1) "5" } 
        $this->pdo->beginTransaction();

        try{
            $query = 
            'INSERT INTO Project_Technologies(project_id, technology_id)
             VALUES(:project_id, :technology_id)';
            
            $this->pdo->prepare($query)->execute(
                [
                    ':project_id' => $data['projects'],
                    ':technology_id' => $data['technologies']
                ]
            );
            $this->pdo->commit();
            return true;
        }catch(\PDOException){
            $this->pdo->rollBack();
            return false;
        }
    }

    //Deletion

    public function deleteProjectTechnology(array $data): bool {
        $this->pdo->beginTransaction();

 
        try{
            $query = 'DELETE FROM Project_Technologies WHERE project_id = :id AND technology_id = :technology_id';
            $this->pdo->prepare($query)->execute([
                ':id' => (int) $data['id'],
                ':technology_id' => (int) $data['technology_id']
            ]);
            $this->pdo->commit();
            return true;
        }catch(\PDOException){
            $this->pdo->rollBack();
            return false;
        }
    }
}
?>