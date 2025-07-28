<?php 

declare(strict_types= 1);

namespace App\Models;
use PDO;

// Singleton Implementation
class DBContext {
    private static $instance = null;
    private $pdo;

    private function __construct(){

    }

    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance(): static{
        if (self::$instance === null){
            self::$instance = new DBContext();
        }

        return self::$instance;
    }
}

?>