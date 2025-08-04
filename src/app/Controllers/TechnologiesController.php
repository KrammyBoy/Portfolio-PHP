<?php 

declare(strict_types= 1);

namespace App\Controllers;
 
use App\Views\View;
use App\Models\Technologies;
class TechnologiesController {
    public function index(){

        $technologies = new Technologies();
        $arrayTech = $technologies->bundleTechnologies($technologies->getAllTechnologies());

        View::render('Technologies', ['arrayTech' => $arrayTech]);
    }
}

?>