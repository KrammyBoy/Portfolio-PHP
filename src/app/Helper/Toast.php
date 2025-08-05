<?php 

declare(strict_types=1);

namespace App\Helper;

class Toast {

    // SetToast success, message
    public static function setToast(string $type, string $message){
        $_SESSION["toast"] = [
            "type"=> $type,
            "message" => $message,
        ];
    }

    // GetToast
    public static function getToast():? array {

        // Check if toast is unset
        if (!isset($_SESSION["toast"])){
            return null;
        }
        // If set
        // return the value of session
        $toast = $_SESSION['toast'];
        unset($_SESSION['toast']);
        return $toast;
    }    
}

?>