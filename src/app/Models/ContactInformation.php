<?php 

declare (strict_types= 1);

namespace App\Models;
use PDO;

/**
 * Class ContactInformation
 *
 * Represents the `ContactInformation` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - email (VARCHAR[255]) NOT NULL
 * - phone (VARCHAR[255]) NOT NULL
 * - location (VARCHAR[255]) NOT NULL
 * - response_time (INTEGER) NOT NULL
 * - updated_at datetime
 */
class ContactInformation {
    private PDO $pdo;

    public function __construct(){
        $this->pdo = DBContext::getInstance()->getConnection();
    }

    //Get Methods

    public function getContactInformation(): array {
        return $this->pdo->query('SELECT * FROM contactinformation')->fetchAll(PDO::FETCH_ASSOC);
    }


}

?>