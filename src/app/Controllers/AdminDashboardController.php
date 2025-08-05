<?php 
declare(strict_types=1);

namespace App\Controllers;
use App\Helper\AdminSession;
use App\Views\View;

class AdminDashboardController extends AdminSession {
    public function index(){
        $this->checkAdminLoggedIn();
        //If wala
        View::render('/Admin/Dashboard');
    }

}

?>