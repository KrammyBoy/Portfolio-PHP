<?php
declare(strict_types=1);

namespace App\Controllers;
use App\Helper\ModalHelper;

class ModalController {

    public function setModalType(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Read json body
            $input = json_decode(file_get_contents('php://input'), true);

            if (isset($input['type'])){
                ModalHelper::setModal($_POST['type']);
            }
        }
        exit();
    }
}

?>