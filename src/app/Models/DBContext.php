<?php 

declare(strict_types= 1);

namespace App\Models;
use PDO;
use PDOException;
use Dotenv;

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
                //Check if the service is running on railway
                if (getenv('RAILWAY_SERVICE_NAME')){
                    $host   = getenv('PGHOST');
                    $port   = getenv('PGPORT');
                    $dbName = getenv('PGDATABASE');
                    $dbUser = getenv('PGUSER');
                    $dbPass = getenv('PGPASSWORD');
                } else {
                    $host   = getenv('DB_HOST')     ?: 'localhost';
                    $port   = getenv('DB_PORT')     ?: '5432';
                    $dbName = getenv('DB_NAME')     ?: 'postgres';
                    $dbUser = getenv('DB_USER')     ?: 'postgres';
                    $dbPass = getenv('DB_PASSWORD') ?: '';
                }
                //Create the connection string
                $dsn = "pgsql:host=$host;port=$port;dbname=$dbName";

                //Replace the default options with the provided settings
                $settings = array_replace($this->options, $settings);

                //Create a new PDO instance
                $this->pdo = new PDO($dsn, $dbUser, $dbPass, $settings);

            } catch (PDOException $e) {
                throw new \RuntimeException(message: "Database connection failed: " . $e->getMessage());
            }
        }

        return $this->pdo;
    }
}

?>