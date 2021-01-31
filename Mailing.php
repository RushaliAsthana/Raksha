<?php
use PhpMailer\PhpMailer\PhpMailer;
require_once "PhpMailer/PhpMailer.php";
require_once "PhpMailer/SMTP.php";
require_once "PhpMailer/Exception.php";
class Mailing
{
  
    function sendMail(string $to_address,string $subject,string $body):bool
    {
     $mail;
     try{
         $mail = new PHPMailer();
         $mail->isSMTP();                                            // Send using SMTP
         $mail->Host='smtp.gmail.com';                    // Set the SMTP server to send through
         $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
         $mail->Username   = 'rushaliasthana@gmail.com';                     // SMTP username
         $mail->Password   = 'ru110599';                               // SMTP password
         $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
         $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
     
         //Recipients
         $mail->setFrom('rushaliasthana@gmail.com', 'Rushali Asthana');
         $mail->addAddress($to_address);     // Add a recipient
         $mail->isHTML(true);                                  // Set email format to HTML
         $mail->Subject = $subject;
         $mail->Body= $body;
         $mail->send();
        return true;
         echo 'Message has been sent';
     } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
         return false;
     }
    
    }


}
?>