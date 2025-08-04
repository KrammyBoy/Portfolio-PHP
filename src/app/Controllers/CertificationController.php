<?php 

namespace App\Controllers;

use App\Views\View;
use App\Models\Certificates;
class CertificationController {
    public function index(){
        $certificates = (new Certificates())->getAllCertificates();

        View::render('Certificates', ['certificates' => $certificates]);
    }
}

?>