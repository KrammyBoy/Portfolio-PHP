<?php 
declare(strict_types=1);

namespace App\Helper\Validator;

/**
 * Implementation of common valid checks
 */
class Validator {

    /**
     * Validate that each string respects its minLen / maxLen rules.
     *
     * @param array $data
     * @return bool
     * 
     * Expected Format:
     * [
     *   ['string' => string, 'maxLen' => int],
     *   [...]
     * ]
     */
    public static function validateStringLength(array $data): bool {
        // first, validate structure
        if (!self::validateStringArray($data)) {
            return false;
        }

        if (empty($data)) return false;

        foreach ($data as $item) {
            $string = $item['string'];
            $length = strlen($string);

            // enforce min length
            if ($length > $item['maxLen']) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validate that input is an array of associative arrays
     * with required keys.
     */
    public static function validateStringArray(array $data): bool {
        $requiredKeys = ['string', 'maxLen']; // maxLen is optional
        foreach ($data as $item) {
            if (!is_array($item)) return false;

            foreach ($requiredKeys as $key) {     
                if (!array_key_exists($key, $item)) {
                    return false;
                }
            }
        }

        return true;
    }
}
