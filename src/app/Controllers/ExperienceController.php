<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\Helper\AdminSession;
use App\Models\Experience;
use App\Views\View;

class ExperienceController extends AdminSession {
    private Experience $experience;

    public function __construct(){
        $this->experience = new Experience();
    }
    public function index(){
        $experiences = $this->experience->getExperience();
        if ($this->getAdminLogged()){
            View::render("Admin/Experience", ['projects' => $experiences]);
        }else {
            View::render('Experience', ['experiences' => $experiences]);
        }
    }
}
?>