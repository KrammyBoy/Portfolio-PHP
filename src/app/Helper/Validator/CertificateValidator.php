<?php 

declare(strict_types=1);
namespace App\Helper\Validator;
class CertificateValidator {
    public static function validate(array $data): bool{

        $isValidString = Validator::validateStringArray([
            ['string'=> $data['name'], 'maxLen' => 64],
            ['string'=> $data['issuer'], 'maxLen' => 256]
            
        ]);

        $isValidType = self::isValidType($data['type']);

        return $isValidString && $isValidType;
        
    }

    public static function isValidType(string $type): bool{
        $type = ucfirst(strtolower(trim($type)));

        if ($type !== "Url" || $type !== "File"){
            return false;
        }
        return true;
    }
}
?>