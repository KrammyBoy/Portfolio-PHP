<?php 

declare(strict_types= 1);

namespace App\Models;
use PDO;
use DateTime;

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
        $query = "SELECT * FROM Certifications";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Count methods
    public function getCertificatesCount(): int {
        return $this->pdo->query('SELECT COUNT(*) FROM Certifications')->fetchColumn();
    }

    //Insert
    public function insertCertificate(
        string $issuer,
        string $name,
        DateTime $date_earned,
        string $credential_url,
        string $type
    ) {
        if (strlen($name) > 64 || strlen($issuer) > 256) {
            throw new \InvalidArgumentException("Input exceeds maximum length.");
        }
        $type = ucfirst(strtolower(trim($type)));
        if ($type !== "Url" && $type !== "File") {
            throw new \InvalidArgumentException("Type must be either 'Url' or 'File'.");
        }
    }
}

?>