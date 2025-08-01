<?php 

declare(strict_types= 1);

namespace App\Controllers;

use App\Views\View;

class ProjectsController {
    public function index(){
        View::render("Project");
    }
}

?>