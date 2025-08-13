<?php 

declare(strict_types= 1);

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Helper\Toast;
use App\Views\View;
use App\Models\Projects;

class ProjectsController extends AdminSession {
    private Projects $project;

    private Toast $toast;

    public function __construct(){
        $this->project = new Projects(); 
    }

    public function index(){

        if($this->getAdminLogged()){
            $projects = $this->project->getProjects();

            View::render("Admin/Projects", ['projects' => $projects]);
        } else {
            $statusID = isset($_GET['status_id']) ? (int)$_GET['status_id'] : 0;

            $projects = $this->project->getProjects($statusID);

            View::render("Project", ['projects' => $projects]);
        }
    }
    
    public function addProject(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST)){
            Toast::setToast('error', 'Something went wrong when inserting new project');
            header('Location: /projects');
            exit();
        }

        $fileName = null;
        //This is for checking size and type
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
            
            $fileSize = $_FILES['image']['size']; //10 MB 
            $fileType = $_FILES['image']['type'];

            $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            if (!in_array($fileType, $allowedTypes)){
                Toast::setToast('error', 'Invalid image type uploaded');
                header('Location: /projects');
                exit();
            }
            
            if($fileSize > 10 * 1024 * 1024){
                Toast::setToast('error', 'Image uploaded exceeded the maximum size (10MB)');
                header('Location: /projects');
                exit();
            }
        }
        $this->project->insertProject($_POST, $_FILES);
        // header('Location: /projects');
        // exit();
    }

    /**
     * Expected URI
     * /projects/id
     */
    public function deleteProject(){
        if (isset($_GET['id'])){
            $this->project->deleteProject((int) $_GET['id']);
        }
    }

    public function updateProject(){
        if (isset($_POST)){

            $this->project->updateProject($_POST);
        }
    }
}

?>