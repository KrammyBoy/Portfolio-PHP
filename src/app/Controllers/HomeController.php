<?php 

declare(strict_types= 1);

namespace App\Controllers;

use App\Views\View;
use App\Models\Projects;

class HomeController {

    public function index(){

        // Getting the projects from the database
        $projects = (new Projects())->getProjects();
        

        View::render("Home");
    }

}

?>