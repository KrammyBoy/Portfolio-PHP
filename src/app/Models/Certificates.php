<?php 

declare(strict_types= 1);


namespace App\Models;
use PDO;
use DateTime;
use App\Helper\Validator\CertificateValidator;
use App\Helper\Handler\FileHandler;
/**
 * Class Certificates
 *
 * Represents the `Certificates` table in the database.
 *
 * Table Columns:
 * - id (INT) - Primary key
 * - name (VARCHAR[64]) NOT NULL
 * - issuer (VARCHAR[256]) NOT NULL
 * - date_earned (DATE) NOT NULL
 * - credential_url (TEXT) NOT NULL
 * - type (TEXT) NOT NULL
 * - description (VARCHAR[512]) NOT NULL
 */


class Certificates {
    
    private PDO $pdo;

    private string $name;
    private string $issuer;
    private DateTime  $date_earned;

    /**
     * @var string
     * URL to the certificate or file path
     * file path: public/assets/certificates/{filename}.pdf
     */
    private string $credential_url;

    /**
     * @var string
     * Must only be Url or File
     * If it is File, it will be downloaded instead
     */
    private string $type;

    public function __construct(){
        $this->pdo = DBContext::getInstance()->getConnection();

    }

    //get
    public function getAllCertificates(): array {
        $query = "SELECT * FROM Certifications WHERE deleted_at IS NULL";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Count methods
    public function getCertificatesCount(): int {
        return $this->pdo->query('SELECT COUNT(*) FROM Certifications WHERE deleted_at IS NULL')->fetchColumn();
    }

    public function getCertificateLastID(){
        return $this->pdo->query('SELECT last_value FROM certifications_id_seq')->fetchColumn() + 1;
    }

    //Insert
    public function insertCertificate( array $data
    ): bool {
        $this->pdo->beginTransaction();

        try {
            $query = 'INSERT INTO Certifications(name, issuer, date_earned, credential_url, type, description)
            VALUES(:name, :issuer, :date_earned, :credential_url, :type, :description)';

            $this->pdo->prepare($query)->execute(
                [
                    ':name' => $data['name'],
                    ':issuer' => $data['issuer'],
                    ':date_earned' => $data['date_earned'],
                    ':credential_url' => ($data['type'] === 'Url')? $data['credential_url'] : FileHandler::uploadCertificateFile($data),
                    ':type' => $data['type'],
                    ':description' => $data['description']
                ]
            );
            $this->pdo->commit();
            return true;
        }catch (\PDOException){
            $this->pdo->rollBack();
            return false;
        }
    }
    //Delete
    public function deleteCertificate(int $id): bool {
        $this->pdo->beginTransaction();

        try{
            $query = 'UPDATE Certifications SET deleted_at = NOW() WHERE id = :id';

            $this->pdo->prepare($query)->execute([
                ':id' => $id
            ]);

            $this->pdo->commit();
            return true;
        }catch(\PDOException){
            $this->pdo->rollBack();
            return false;
        }
    }

    //Update
    public function updateCertificate(array $data): bool{
        $this->pdo->beginTransaction();
        try{
            //If $_FILE is empty or with error that means that it is updated but updated without the file needed
            //so no need to update those things            
            if ($data['type'] === 'Url'){
                self::updateCertificateUrl($data);
            }
            else if ($_FILES['credential_url']['error'] === UPLOAD_ERR_NO_FILE){
                self::updateCertificateWithoutFile($data);
            } else {
                //File is there
                self::updateCertificateWithFile($data);
            }

            $this->pdo->commit();
            return true;
        }catch (\PDOException){
            $this->pdo->rollBack();
            return false;
        }
    }

    //For Type Work
    public function updateCertificateWithoutFile(array $data){
        $query = 'UPDATE Certifications SET name = :name, issuer = :issuer, date_earned = :date_earned, type = :type, description = :description WHERE id = :id';
        $this->pdo->prepare($query)->execute([
            ':name' => $data['name'],
            ':issuer' => $data['issuer'],
            ':date_earned' => $data['date_earned'],
            ':type' => $data['type'],
            ':description' => $data['description'],
            ':id' => $data['id']
        ]);
    }

    public function updateCertificateWithFile(array $data){
        $query = 'UPDATE Certifications SET name = :name, issuer = :issuer, date_earned = :date_earned, credential_url = :credential_url, type = :type, description = :description WHERE id = :id';
        $this->pdo->prepare($query)->execute([
            ':name' => $data['name'],
            ':issuer' => $data['issuer'],
            ':date_earned' => $data['date_earned'],
            ':credential_url' => FileHandler::uploadCertificateFile($data),
            ':type' => $data['type'],
            ':description' => $data['description'],
            ':id' => $data['id']
        ]);
    }

    //Url
    public function updateCertificateUrl(array $data){
        $query = 'UPDATE Certifications SET name = :name, issuer = :issuer, date_earned = :date_earned, credential_url = :credential_url, type = :type, description = :description WHERE id = :id';
        $this->pdo->prepare($query)->execute([
            ':name' => $data['name'],
            ':issuer' => $data['issuer'],
            ':date_earned' => $data['date_earned'],
            ':credential_url' => $data['credential_url'],
            ':type' => $data['type'],
            ':description' => $data['description'],
            ':id' => $data['id']
        ]);
    }

    
}

?>