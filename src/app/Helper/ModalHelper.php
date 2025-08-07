<?php 
declare(strict_types=1);

namespace App\Helper;

class ModalHelper {

    public function getModal(string $type):? string {
        //Check if modal exists

        if (!isset($_SESSION['modal'])){
            return null;
        }

        if ($_SESSION['modal']['type'] !== $type){
            return null;
        }

        $modal = $_SESSION['modal'];
        unset($_SESSION['modal']);
        return $modal['type'];
    }
    public static function setModal(string $type){
        $_SESSION['modal'] = [
            'type' => $type,
        ];
    }
}

?>