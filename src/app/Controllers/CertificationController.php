<?php 

namespace App\Controllers;

use App\Views\View;
class CertificationController {
    public function index(){
        View::render('Certificates');
    }
}

?>