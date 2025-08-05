<?php 

declare(strict_types=1);

namespace App\Helper;

class LoginAlert{

    public static function setLoginAlert(string $alert){
        $_SESSION["LoginAlert"] = [
            "alert" => $alert 
        ];
    }

    public static function getLoginAlert():? array {
        if(!isset($_SESSION["LoginAlert"])){
            return null;
        }
        $alert = $_SESSION["LoginAlert"];
        unset($_SESSION["LoginAlert"]);
        return $alert;
        
    }
}
?>