<?php

// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class MyEmailServer implements EmailServerInterface {
    public function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer(true);
        try{
            // Configure the PHPMailer object
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify SMTP server
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'trantan1804@gmail.com'; // SMTP username
            $mail->Password = 'sswtvfqanuulfpbl'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption
            $mail->Port = 587; // TCP port to connect to
            $mail->CharSet = 'UTF-8';
    
            // Set email parameters
            $mail->setFrom('trantan1804@gmail.com', 'Trần Trọng Tấn');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
            return 'Email sent successfully!';
        } catch (Exception $e) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
