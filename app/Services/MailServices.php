<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

class MailServices
{
    public static function send($to, $subject, $body, $pdfContent = null)
    {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'amineelgaini1444@gmail.com';
        $mail->Password   = 'qytlxegxweeaoned';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        $mail->setFrom('amineelgaini1444@gmail.com', 'ByMatch');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        if ($pdfContent !== null) {
            $mail->addStringAttachment($pdfContent, 'ticket.pdf');
        }
        
        
        return $mail->send();
    }
}