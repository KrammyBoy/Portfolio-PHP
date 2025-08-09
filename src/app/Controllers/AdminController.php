<?php 
declare(strict_types= 1);

namespace App\Controllers;
use App\Views\View\Login;
use App\Views\View;
use App\Models\Admin;
use App\Helper\Toast;
use App\Helper\LoginAlert;
use DateTime;

class AdminController {
    public const MAX_LOGIN_ATTEMPTS = 5;
    //We need to manually password-type this to ender the admin
    private Admin $admin;
    public function __construct(){
        $this->admin = new Admin();
    }
    public function index(){
        //Set Session for login to hide navigation

        //Check if the params is correct
        if (!isset($_GET['password']) || $_GET['password'] !== $_ENV['ADMIN_PASSWORD']){
            header('Location: /');
            exit();
        } else {
           View::render('/Admin/Login');
        }
    }

    public function logout(){
        //Destroy session
        session_start();
        $_SESSION = [];
        session_destroy();
        //TODO Delete session cookies

        //
        header('Location: /');
        exit;

    }
    public function checkAuthentication(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                //Fetch user by username
                $account = $this->admin->fetchPasswordAndLockedByUsername($username);
                var_dump($account);
                //If user not found
                if($account === null){
                    LoginAlert::setLoginAlert($username . ' does not exist');
                    header('Location: /admin?password=qemithAmixUPRl9onl2o');
                    exit();
                }
                //If user is locked
                if($account['locked_until'] < new DateTime() && $account['locked_until'] !== null){
                    LoginAlert::setLoginAlert($username . ' is locked until ' . (new DateTime($account['locked_until']))->format('d, M Y H:i'));
                    header('Location: /admin?password=qemithAmixUPRl9onl2o');
                    exit();
                }
                //Check if password is correct argon2id
                if (password_verify($_POST['password'], $account['password_hash'])){
                    //Update the user last_login_at
                    $this->admin->updateLastLoginByUsername($username);
                    
                    //Setting session
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $this->admin->fetchIdByUsername($username);
                    header('Location: /dashboard');
                    exit();                    
                }

                $this->setLoginErrorFunc('Invalid password try again!', $_POST['username']);
            }
        }
        // If it is GET

        header('Location: /');
        exit();
    }

    public function setLoginErrorFunc(string $alert , string $username){
        LoginAlert::setLoginAlert($alert);

        //SESSION limited_attempts
        $_SESSION['login_attempts'] += 1;

        //If attempts of the same account is 5. Update the user to locked for 12 hours
        if ($_SESSION['login_attempts'] >= AdminController::MAX_LOGIN_ATTEMPTS){
            (new Admin())->updateUserLockByUsername($username);
            unset($_SESSION['login_attempts']);
        }

        header('Location: /admin?password=qemithAmixUPRl9onl2o');
        exit();
    }

    public function addUserThroughQuery()
    {
        // Check if required query parameters are present
        if (!isset($_GET['username'], $_GET['password'])) {
            Toast::setToast('error', message: 'Something wrong happened');
            header('Location: /');
            exit(); // Important to stop execution
        }

        $username = $_GET['username'];
        $password = $_GET['password'];
        // Call the method to add user
        $add = (new Admin())->addUser($username, $password);

        if (!$add){
            Toast::setToast('error', 'Something wrong happened');
            header('Location: /');
            exit(); // Important to stop execution
        }
        // Optional: redirect or output success message
        Toast::setToast('success', $username . ' was successfully added!');        
        header('Location: /');
    }
}
?>