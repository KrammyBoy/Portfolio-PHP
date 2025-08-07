<?php 
declare(strict_types= 1);


use App\Controllers\AdminController;
use App\Controllers\AdminDashboardController;
use App\Controllers\HomeController;
use App\Controllers\ProjectsController;
use App\Controllers\CertificationController;
use App\Controllers\ExperienceController;
use App\Controllers\TechnologiesController;
use App\Controllers\ContactController;
use App\Controllers\ModalController;
use App\Controllers\Router;
use Dotenv\Dotenv;


//PSR Autolaoading
require __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Session
session_start();

$router = new Router();
$router->get('/', [HomeController::class, 'index'])
        ->get('/projects', [ProjectsController::class, 'index'])
        ->get('/certifications', [CertificationController::class, 'index'])
        ->get('/experiences', [ExperienceController::class, 'index'])
        ->get('/technologies', [TechnologiesController::class, 'index'])
        ->get('/contact', [ContactController::class, 'index'])
        ->get('/admin', handler: [AdminController::class, 'index'])
        ->get('/dashboard', [AdminDashboardController::class, 'index'])
        ->get('/logout', [AdminController::class, 'logout'])
        ->post('/contact', [ContactController::class, 'sendMessage'])
        ->post('/modal', [ModalController::class, 'setModalType'])
        ->post('/login/checkAuthentication', [AdminController::class, 'checkAuthentication']);

ob_start();
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
$pageContent = ob_get_clean();

$title = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$title = ucfirst(str_replace('/', '', $title));
if ($title === ''){
        $title = 'Mark Salabsab';
}
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?= htmlspecialchars($title)?></title>  
                <link rel="stylesheet" href="/styles/style.css?v=<?= filemtime($_SERVER['DOCUMENT_ROOT']. '/styles/style.css')?>" >
                <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
                
                <!--Icons-->
                <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
                <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>

        </head>
        <body>
                <header class="header">
                        <?php $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                        if($path !== "/admin"): ?>
                                <?php include '../app/Views/Components/Navigation.php'?>
                        <?php endif; ?>
                </header>
                <main>
                        <?= $pageContent ?>
                </main>

                <?php include '../app/Views/Components/Footer.php'?>
                <?php include '../app/Views/Components/Toast.php'?>
        </body>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script src="/script/script.js"></script>
        <script src="/script/helper.js"></script>
</html>