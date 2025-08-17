<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Models\Experience;
use App\Helper\Toast;
use App\Views\View;

class ExperienceController extends AdminSession {
    private Experience $experience;

    public function __construct(){
        $this->experience = new Experience();
    }
    public function index(){
        $experiences = $this->experience->getExperience();
        if ($this->getAdminLogged()){
            View::render("Admin/Experience", ['experiences' => $experiences]);
        }else {
            View::render('Experience', ['experiences' => $experiences]);
        }
    }

    public function addExperience(){
        $this->checkAdminLoggedIn();

        if (isset($_POST)){
            if($this->experience->addExperience($_POST)){
                Toast::setToast('success', 'Successfully added ' . $_POST['degree'] . ' experience');
            }
            else {
                Toast::setToast('error', 'Something went wrong when insert the project');
            }
            header('Location: /experiences');
            exit();
        }
    }

    public function updateExperience(){
        $this->checkAdminLoggedIn();

        if (isset($_POST)){
            if($this->experience->updateExperience($_POST)){
                Toast::setToast('success',''. 'Successfully updated '. $_POST['id'] . ' experience');
            }
            else {
                Toast::setToast('error', 'Something went wrong when updating the project');
            }
            header('Location: /experiences');
            exit();
        }
    }

    public function deleteExperience(){
        $this->checkAdminLoggedIn();

        if (!empty($_GET)){
            if($this->experience->deleteExperience((int) $_GET['id'])){
                Toast::setToast('success','Successfully deleted id#'. $_GET['id']);
            } else {
                Toast::setToast('error', 'Something went wrong when updating the project');
            }
        }

        header('Location: /experiences');
        exit();
    }
}
?>