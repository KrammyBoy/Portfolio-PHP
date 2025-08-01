<?php

declare(strict_types= 1);

namespace App\Models;

use App\Enums\StatusName;

/**
 * Class Status
 *
 * Represents the `Status` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - status_name (VARCHAR[255])
 * - status_description (VARCHAR[255])
 */

class Status {

    //Property
    private int $id;

    /**
     * @var string One of: "Completed >> 1", "In Progress >> 2", "Abandoned >> 3"
     */
    private StatusName $status_name;
    private String $status_description;
    
    public function __construct(){

    }

    //Insert methods
    public function insertStatus(String $status_name, String $status_description){
        if (strlen($status_name) > 255 || strlen($status_description) > 255) {
            throw new \InvalidArgumentException("Status name and description must be less than 255 characters.");
        }

    }
}

?>