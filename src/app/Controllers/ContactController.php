<?php 
declare(strict_types=1);

namespace App\Controllers;

use App\Views\View;

class ContactController{
    public function index(){
        View::render('Contact');
    }
}

?>