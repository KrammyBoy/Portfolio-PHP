<?php 

declare(strict_types=1);

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Helper\Toast;
use App\Models\ProjectTechnologies;
use App\Views\View;
class ProjectTechnologiesController extends AdminSession {
    private ProjectTechnologies $pt;
    public function __construct(){
        $this->pt = new ProjectTechnologies();
    }
    public function addProjectTechnology(): void{
        $this->checkAdminLoggedIn();

        if(!empty($_POST['projects']) && !empty($_POST['technologies']) && $this->pt->addProjectTechnology($_POST)){
            Toast::setToast('success', 'Successfully added a new association');
        }else {
            Toast::setToast('error', 'Something went wrong when adding a new association');
        }

        header('Location: /technologies');
        exit();
    }
    public function deleteProjectTechnology(): void {
        $this->checkAdminLoggedIn();


        if(isset($_GET['id']) && !empty($_GET['id'] && isset($_GET['technology_id'])) && !empty($_GET['technology_id']
            && $this->pt->deleteProjectTechnology($_GET))){
            Toast::setToast('success', 'Successfully deleted an association table');
        }else{
            Toast::setToast('error', 'Something went wrong with the database');
        }
        header('Location: /technologies');
        exit();
    }
}
?>