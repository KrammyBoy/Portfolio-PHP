<?php 

declare(strict_types= 1);

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Views\View;
use App\Models\Projects;

class ProjectsController extends AdminSession {
    public function index(){

        if($this->getAdminLogged()){
            View::render("Admin/Projects");
        } else {
            $statusID = isset($_GET['status_id']) ? (int)$_GET['status_id'] : 0;

            $projects = (new Projects())->getProjects($statusID);

            View::render("Project", ['projects' => $projects]);
        }
    }
}

?>