<?php 

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Views\View;
use App\Models\Certificates;
use App\Helper\Toast;
class CertificationController extends AdminSession {

    private Certificates $certificates;

    public function __construct(){
        $this->certificates = new Certificates();
    }
    public function index(){
        $certificates = $this->certificates->getAllCertificates();

        if ($this->getAdminLogged()){
            View::render('Admin/Certificates', ['certificates' => $certificates]);  
        } else {
            View::render('Certificates', ['certificates' => $certificates]);
        }
    }

    public function addCertificate(){
        $this->checkAdminLoggedIn();

        if (!empty($_POST) && $this->certificates->insertCertificate($_POST)){
            Toast::setToast('success', 'Successfully added certificate#' . $_POST['id']);
        }else { 
            Toast::setToast('error', 'Something went wrong when inserting new certificate');
        }
        header("Location: /certifications");
        exit();
    }

    public function updateCertificate(){
        $this->checkAdminLoggedIn();

        if (!empty($_POST) && $this->certificates->updateCertificate($_POST)){
            Toast::setToast('success', 'Successfully updated certificate#' . $_POST['id']);
        }else { 
            Toast::setToast('error', 'Something went wrong when updating new certificate');
        }
        header("Location: /certifications");
        exit();
    }

    public function deleteCertificate(): void {
        $this->checkAdminLoggedIn();

        if(isset($_GET['id']) && $this->certificates->deleteCertificate((int) $_GET['id'])){
            Toast::setToast('success', 'Successfully deleted certificate #' . $_GET['id']);
        }else {
            Toast::setToast('error', 'Something went wrong when deleting the certificate');            
        }

        header('Location: /certifications');
        exit();
    }
}

?>