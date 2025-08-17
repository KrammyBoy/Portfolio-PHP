<?php

declare(strict_types= 1);
namespace App\Helper\Validator;
class ExperienceValidator {

    public static function validate(array $data): bool {
        $isValidString = Validator::validateStringLength([
        ['string' => $data['type'], 'maxLen' => 64],
        ['string' => $data['description'], 'maxLen' => 1024],
        ['string' => $data['school'], 'maxLen' => 64],
        ['string' => $data['degree'], 'maxLen' => 64]
        ]);

        $isValidExperience = self::isValidExperience($data['type']);

        return $isValidExperience && $isValidString;
    }
    public static function isValidExperience($experience_description): bool {
        $experience_description = ucfirst(trim($experience_description));

        return ($experience_description === "Education" || $experience_description === "Work") ? true:false;

    }
}
?>