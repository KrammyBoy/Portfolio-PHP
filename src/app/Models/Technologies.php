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
class Technologies {

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