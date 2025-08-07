<?php 

declare(strict_types= 1);

namespace App\Helper;

class AdminSession {

    //If session['admin_logged_in'] is not set
    public function checkAdminLoggedIn(){
        if(!isset($_SESSION["admin_logged_in"])){
            header('Location: /');
            exit();
        }
    }

    // return getAdminLogged
    public function getAdminLogged(): bool {
        return isset($_SESSION['admin_logged_in']) ? true : false;
    }
}

?>