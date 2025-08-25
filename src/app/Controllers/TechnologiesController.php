<?php 

declare(strict_types= 1);

namespace App\Controllers;
 
use App\Helper\AdminSession;
use App\Models\ProjectTechnologies;
use App\Views\View;
use App\Helper\Toast;
use App\Models\Technologies;
class TechnologiesController extends AdminSession {
    private Technologies $technologies;
    private ProjectTechnologies $projectTechnologies;
    public function __construct(){
        $this->technologies = new Technologies();
        $this->projectTechnologies = new ProjectTechnologies();
    }
    public function index(){
        
        if($this->getAdminLogged()){
            $allTechnologies = $this->technologies->getAllTechnologies();
            $projectTechnologies = $this->projectTechnologies->getTableWithProjectsAndTechnology();

            if(empty($allTechnologies) || empty($projectTechnologies)){
                Toast::setToast('error', 'Something went wrong to the database');
            }

            View::render('Admin/Technologies', [
                'allTechnologies' => $allTechnologies,
                'projectTechnologies' => $projectTechnologies]);
        }else {
            //Bundles Technologies Together into one
            $arrayTech = $this->technologies->bundleTechnologies($this->technologies->getAllTechnologies());

            View::render('Technologies', ['arrayTech' => $arrayTech]);
        }
    }
}

?>