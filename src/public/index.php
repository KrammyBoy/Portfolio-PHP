<?php 
declare(strict_types= 1);


use App\Controllers\HomeController;
use App\Controllers\ProjectsController;
use App\Controllers\CertificationController;
use App\Controllers\ExperienceController;
use App\Controllers\TechnologiesController;
use App\Controllers\ContactController;
use App\Controllers\Router;


//PSR Autolaoading
require __DIR__ . '/../vendor/autoload.php';

$router = new Router();

$router->get('/', [HomeController::class, 'index'])
        ->get('/projects', [ProjectsController::class, 'index'])
        ->get('/certifications', [CertificationController::class, 'index'])
        ->get('/experiences', [ExperienceController::class, 'index'])
        ->get('/technologies', [TechnologiesController::class, 'index'])
        ->get('/contact', [ContactController::class, 'index']);

ob_start();
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
$pageContent = ob_get_clean();


?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Mark Salabsab</title>  
                <link rel="stylesheet" href="./styles/style.css?v=<?= filemtime(__DIR__. '/styles/style.css')?>" >
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
                <!--Icons-->
                <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
                <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>

        </head>
        <body>
                <header class="header">
                        <?php include '../app/Views/Components/Navigation.php'?>
                </header>
                <main>
                        <?= $pageContent ?>
                </main>

                <?php include '../app/Views/Components/Footer.php'?>
        </body>
        <script src="./script/script.js">

        </script>
</html>