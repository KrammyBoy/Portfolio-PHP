<?php 
declare(strict_types= 1);

namespace App\Views;

class View {

    public static function render(string $view, array $data = []) {
        $viewPath = __DIR__. DIRECTORY_SEPARATOR . $view. '.php';
        if (!file_exists($viewPath)){
            //TODO  Create a custom Exception
            http_response_code(500);
            throw new \Exception("500 Page not found");
        }

        extract($data);
        require $viewPath;
    } 
}

?>