<?php 

declare(strict_types= 1);

namespace App\Controllers;

use App\Views\View;
use App\Models\Projects;
use App\Models\Experience;

class HomeController {

    public function index(){

        // Getting the projects from the database
        //$projects = (new Projects())->getProjects();
        $projects = (new Projects())->getProjectsRandom(3);
        
        $experience = (new Experience())->getRecentExperience(1);
        

        View::render("Home", ['projects' => $projects, 'experience' => $experience[0] ?? null]);
    }

}

?>