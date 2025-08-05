<?php

declare(strict_types=1);

namespace App\Models;
use PDO;
use DateTime;

/**
 * Class Admin
 *
 * Represents the `Admin` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - username (VARCHAR[255]) NOT NULL UNIQUE
 * - password_hash (VARCHAR[255]) NOT NULL
 * - created_at datetime NOT NULL
 * - updated_at datetime
 * - deleted_at datetime
 * - last_login_at datetime
 * - locked_until datetime
 */
class Admin{

    private PDO $pdo;


    public function __construct(){
        $this->pdo = DBContext::getInstance()->getConnection();
    }

    //Fetch

    public function fetchPasswordAndLockedByUsername(string $username): ?array {
        $query = "SELECT password_hash, locked_until FROM adminuser WHERE username = :username AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":username" => $username
        ]);
        //If it does not return an array then it is false
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result[0] ?? null;
    }
    //Update
    public function updateUserLockByUsername(string $username){
        $this->pdo->beginTransaction();

        try{
            $locked_until = (new DateTime())->modify("+12 hour");

            $query = 'UPDATE adminuser SET locked_until = :locked_until WHERE username = :username';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':locked_until' => $locked_until,
                ':username' => $username
            ]);
            $this->pdo->commit();

        }catch (\PDOException $e){
            $this->pdo->rollBack();
        }
    }
    public function updateLastLoginByUsername(string $username){
        $this->pdo->beginTransaction();
        try{
            $last_login = new DateTime();
            $query = 'UPDATE adminuser SET last_login_at = :last_login_at WHERE username = :username';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':last_login_at' => $last_login->format('Y-m-d H:i:s'),
                ':username'=> $username
            ]);
            $this->pdo->commit();
        }catch (\PDOException $e){
            $this->pdo->rollBack();
        }
    }
    //Insert
    public function addUser(
        string $username,
        string $password
    ): bool{
        $this->pdo->beginTransaction();

        try{
        $hash = password_hash($password, PASSWORD_ARGON2ID);
        $query = "INSERT INTO adminuser (username, password_hash, created_at)
        VALUES (:username, :password_hash, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':username' => $username,
            ':password_hash' => $hash
        ]);
        $this->pdo->commit();
        return true;
        } catch(\PDOException $e){
            $this->pdo->rollBack();
            return false;
        }
    }

}

?>