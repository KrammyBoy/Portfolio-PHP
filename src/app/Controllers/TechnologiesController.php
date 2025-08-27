<?php 

declare(strict_types= 1);

namespace App\Controllers;
 
use App\Helper\AdminSession;
use App\Models\Projects;
use App\Models\ProjectTechnologies;
use App\Views\View;
use App\Helper\Toast;
use App\Models\Technologies;
class TechnologiesController extends AdminSession {
    private Technologies $technologies;
    private ProjectTechnologies $projectTechnologies;
    private Projects $projects;
    public function __construct(){
        $this->technologies = new Technologies();
        $this->projectTechnologies = new ProjectTechnologies();
        $this->projects = new Projects();
    }
    public function index(){
        
        if($this->getAdminLogged()){
            $allTechnologies = $this->technologies->getAllTechnologies();
            $projectTechnologies = $this->projectTechnologies->getTableWithProjectsAndTechnology();
            $projects = $this->projects->getProjects();

            if(empty($allTechnologies) || empty($projectTechnologies)){
                Toast::setToast('error', 'Something went wrong to the database');
                header('Location: /technologies');
                exit();
            }

            View::render('Admin/Technologies', [
                'allTechnologies' => $allTechnologies,
                'projectTechnologies' => $projectTechnologies,
                'projects' => $projects],
                );
        }else {
            //Bundles Technologies Together into one
            $arrayTech = $this->technologies->bundleTechnologies($this->technologies->getAllTechnologies());

            View::render('Technologies', ['arrayTech' => $arrayTech]);
        }
    }

    public function addTechnology(): void {
        $this->checkAdminLoggedIn();

        if(!empty($_POST) && $this->technologies->insertTechnology($_POST)){
            Toast::setToast('success', 'Successfully inserting new technology');
        } else {
            Toast::setToast('error', 'Something went when inserting technology in the database');
        }

        header('Location: /technologies');
        exit();
    }

    public function updateTechnology(): void {
        $this->checkAdminLoggedIn();

        if(!empty($_POST) && $this->technologies->updateTechnology($_POST)){
            Toast::setToast('success', 'Successfully updated #' . $_POST['id'] );
        } else {
            Toast::setToast('error', 'Something went wrong updating technology in the database');
        }

        header('Location: /technologies');
        exit();
    }

    public function deleteTechnology(): void {
        $this->checkAdminLoggedIn();

        if(isset($_GET['id']) && $this->technologies->deleteTechnology((int) $_GET['id'])){
            Toast::setToast('success', 'Successfully deleted technology #' . $_GET['id']);
        } else {
            Toast::setToast('error', 'Something went wrong when deleting technology in the database');
        }

        header('Location: /technologies');
        exit();
    }
    //TODO Project Technologies need get the Projects 
}

?>