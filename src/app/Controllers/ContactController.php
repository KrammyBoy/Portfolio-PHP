<?php 
declare(strict_types=1);

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Views\View;
use App\Helper\Toast;


class ContactController{
    public function index(){
        View::render('Contact');
    }
    //When dealing with POST
    //WE follow Post -> Redirect -> Get Pattern
    public function sendMessage(){

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $message = $_POST['message'] ?? '';

            try {
                $mail = new PHPMailer(true);
                //Message using PHPmailer using noreply
                $mail->isSMTP();
                $mail->Host       = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'd604043e409f72';
                $mail->Password   = '851d22fb393509';
                $mail->Port       = 2525;
                $mail->setFrom('noreply@yourdomain.com', 'Portfolio Mailer');
                $mail->addAddress('salabsabmarkdanielle@gmail.com', 'Mark Danielle');
                //Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = '<h4>From: ' . $name .'</h4> <br><p>'. $message .'</p>';
                
                //TODO Just Wait
                //$mail->send();
                Toast::setToast('success', 'Message sent successfully');
            }catch (Exception $e) {
                Toast::setToast('error', 'Something wrong happened');

            }

            header("Location: /");
            exit();
        }
        View::render('Contact');
        
    }
}

?>