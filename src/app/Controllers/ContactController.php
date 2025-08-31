<?php 
declare(strict_types=1);

namespace App\Controllers;

use App\Models\ContactInformation;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Views\View;
use App\Helper\Toast;


class ContactController{

    private ContactInformation $contactInformation;

    public function __construct(){
        $this->contactInformation = new ContactInformation();
    }
    public function index(){
        $contactInfo = $this->contactInformation->getContactInformation();

        View::render('Contact', ['contact' => $contactInfo]);
    }
    //When dealing with POST
    //WE follow Post -> Redirect -> Get Pattern
    public function sendMessage(){

        // Check if the request method is POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactInfo = $this->contactInformation->getContactInformation();

            $name = $_POST['name'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $message = $_POST['message'] ?? '';

            $address = $contactInfo[0]['email'];

            try {
                $mail = new PHPMailer(true);
                //Message using PHPmailer using noreply
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                //Gmail account
                $mail->Username   = $address; //gmail
                $mail->Password   = getenv('PHPMAILER');
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('noreply@yourdomain.com', 'Portfolio Mail');
                $mail->addAddress($address, 'Mark Danielle');
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Portfolio | ' . $subject;
                $mail->Body    = '<h4>From: ' . $name .'</h4> <br><p>'. $message .'</p>';
                
                //TODO Just Wait
                $mail->send();
                Toast::setToast('success', 'Message sent successfully');
            }catch (Exception $e) {
                Toast::setToast('error', 'Something wrong happened');
            }
            $mail->smtpClose();

            header("Location: /");
            exit();
        }        
    }
}

?>