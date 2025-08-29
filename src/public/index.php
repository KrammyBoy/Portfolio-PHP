<?php 
declare(strict_types= 1);


use App\Controllers\AdminController;
use App\Controllers\AdminDashboardController;
use App\Controllers\HomeController;
use App\Controllers\ProjectsController;
use App\Controllers\CertificationController;
use App\Controllers\ExperienceController;
use App\Controllers\TechnologiesController;
use App\Controllers\ProjectTechnologiesController;
use App\Controllers\ContactController;
use App\Controllers\ModalController;
use App\Controllers\Router;
use App\Models\ProjectTechnologies;
use App\Models\Technologies;
use Dotenv\Dotenv;


//PSR Autolaoading
require __DIR__ . '/../vendor/autoload.php';


if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

//Modify ini values
ini_set('upload_max_filesize', '50M');
ini_set('post_max_size', '50M');

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
        ->post('/login/checkAuthentication', [AdminController::class, 'checkAuthentication'])
        ->post('/updateContactInformation', [AdminDashboardController::class, 'updateContactInformation'])
        ->post('/addProject', [ProjectsController::class, 'addProject'])
        ->get('/projects/delete', [ProjectsController::class, 'deleteProject'])
        ->post('/projects/update', [ProjectsController::class, 'updateProject'])
        ->post('/experiences/add', [ExperienceController::class, 'addExperience'])
        ->post('/experiences/update', [ExperienceController::class, 'updateExperience'])
        ->get('/experiences/delete', [ExperienceController::class, 'deleteExperience'])
        ->post( '/certificates/add' ,[CertificationController::class, 'addCertificate'])
        ->post('/certificates/update', [CertificationController::class, 'updateCertificate'])
        ->get('/certificates/delete', [CertificationController::class, 'deleteCertificate'])
        ->post('/technologies/add', [TechnologiesController::class, 'addTechnology'])
        ->post('/technologies/update', [TechnologiesController::class, 'updateTechnology'])
        ->get('/technologies/delete', [TechnologiesController::class, 'deleteTechnology'])
        ->post('/project-technologies/add', [ProjectTechnologiesController::class, 'addProjectTechnology'])
        ->get('/project-technologies/delete', [ProjectTechnologiesController::class, 'deleteProjectTechnology']);

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
        <script src="/script/api_calls.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script src="/script/script.js"></script>
        <script src="/script/helper.js"></script>
        <script src="/script/sessionstorage.js"></script>
        <script src="/script/filter.js"></script>
</html>