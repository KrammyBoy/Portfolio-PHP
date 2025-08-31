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
    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactInfo = $this->contactInformation->getContactInformation();

            $name = $_POST['name'] ?? '';
            $subject = $_POST['subject'] ?? '';
            $message = $_POST['message'] ?? '';

            $address = $contactInfo[0]['email']; // your Gmail

            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = $address; 
                $mail->Password   = getenv('PHPMAILER'); // Gmail app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // From + To
                $mail->setFrom($address, 'Portfolio Mail');
                $mail->addAddress($address, 'Mark Danielle');

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Portfolio | ' . $subject;
                $mail->Body    = '<h4>From: ' . htmlspecialchars($name) . '</h4><br><p>' 
                                . nl2br(htmlspecialchars($message)) . '</p>';

                $mail->send();
                $mail->smtpClose();

                Toast::setToast('success', 'Message sent successfully');
            } catch (Exception $e) {
                Toast::setToast('error', 'Mailer Error: ' . $mail->ErrorInfo);
            }

            header("Location: /");
            exit();
        }
    }

}

?>