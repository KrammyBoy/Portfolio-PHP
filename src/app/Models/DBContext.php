<?php 

declare(strict_types= 1);

namespace App\Models;
use PDO;
use PDOException;

// Singleton Implementation
class DBContext {
    private static ?DBContext $instance = null;
    private ?PDO $pdo = null;

    //Default options for PDO
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    private function __construct(){

    }

    private function __clone(){}
    public function __wakeup(){}

    public static function getInstance(): static{
        if (self::$instance === null){
            self::$instance = new DBContext();
        }

        return self::$instance;
    }

    public function getConnection(array $settings = []): PDO {

        if ($this->pdo === null){
            try {
                $host = $_ENV['DB_HOST'] ?? 'localhost';
                $port = $_ENV['DB_PORT'] ?? '';
                $dbName = $_ENV['DB_NAME'] ?? 'postgres';
                $dbUser = $_ENV['DB_USER'] ?? '';
                $dbPass = $_ENV['DB_PASSWORD'] ?? '';

                //Create the connection string
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";

                //Replace the default options with the provided settings
                $settings = array_replace($this->options, $settings);

                //Create a new PDO instance
                $this->pdo = new PDO($dsn, $dbUser, $dbPass, $settings);

            } catch (PDOException $e) {
                throw new \RuntimeException("Database connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}

?>