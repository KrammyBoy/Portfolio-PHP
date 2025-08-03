<?php

declare(strict_types= 1);

namespace App\Controllers;

use App\Views\View;

class ExperienceController {
    public function index(){
        $experiences = (new \App\Models\Experience())->getExperience();
        View::render('Experience', ['experiences' => $experiences]);
    }
}
?>