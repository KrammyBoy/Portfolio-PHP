<?php 
declare(strict_types=1);

namespace App\Controllers;
use App\Helper\AdminSession;
use App\Models\Dashboard;
use App\Views\View;

class AdminDashboardController extends AdminSession {

    private Dashboard $dashboard;


    public function __construct(){
        $this->dashboard = new Dashboard();

    }
    public function index(){
        $this->checkAdminLoggedIn();
        $information = $this->dashboard->getAllInformationForDashboard();
        //If wala
        View::render('/Admin/Dashboard', ['dashboard' => $information]);
    }

    public function updateContactInformation(): void {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)){
            $this->dashboard->updateContactInformation($_POST);
            
        }
    }

}

?>