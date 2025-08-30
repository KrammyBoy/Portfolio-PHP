<?php 
declare(strict_types=1);

namespace App\Helper\Handler;
use App\Enums\FileType;
use App\Models\Certificates;
use Dotenv\Exception\InvalidFileException;

class FileHandler {
    public const CERTIFICATE = 'cert_file_';
    public const PATH_TO_CERTIFICATE = __DIR__ . '/../../../public/images/';

   public static function uploadCertificateFile(array $data){
    //Upload file
    //Check if it exists for $_FILES
    if (isset($_FILES['credential_url']) && $_FILES['credential_url']['error'] !== UPLOAD_ERR_NO_FILE){
        $fileType = $_FILES['credential_url']['type'];
        $fileTmp = $_FILES['credential_url']['tmp_name'];

        $id = (!isset($data['id']))? (new Certificates())->getCertificateLastID():$data['id'] ;

        $filename = self::CERTIFICATE . $id . FileType::getFileType($fileType);

        //Validate if something already exists in the folder
        $fullPath = self::PATH_TO_CERTIFICATE . $filename;
        if(file_exists($fullPath)){
            unlink($fullPath);
        }
        self::deleteAllFilesByName(self::PATH_TO_CERTIFICATE, self::CERTIFICATE . $id);
        

        if (move_uploaded_file($fileTmp, $fullPath)){
            return $filename;
        }else {
            //error
            throw new InvalidFileException("File Handler: Failed to move uploaded file.");
        }
    }
   }

   public static function deleteAllFilesByName(string $path, string $filename){
    $files = array_merge(
        glob($path . $filename),
        glob($path.$filename.'.*')
    );

    foreach($files as $file){
        unlink($file);
    }
    
   }

}

?>