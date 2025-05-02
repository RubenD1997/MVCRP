<?php 

namespace App\Utils\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    public function send($to, $subject, $body): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_username';
            $mail->Password   = 'your_password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@yourdomain.com', 'Mi App');
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            return $mail->send();
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            return false;
        }
    }
}
