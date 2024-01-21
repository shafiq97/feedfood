<?php
// send_email.php
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header("Access-Control-Allow-Origin: *");
header("Content-type:application/json;charset=utf-8"); 

$mail = new PHPMailer(true);

try {
    // Retrieve data from the request
    $recipient = $_POST['recipient'];
    $imageUrl = $_POST['imageUrl'];

    // You can add database operations here if needed

    // Mail setup
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;
    $mail->Username = 'muhammadshafiq457@gmail.com'; // SMTP username
    $mail->Password = 'puifnqqapiotbegt'; // SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('admin@givem.com', 'admin@givem.com');
    $mail->addAddress($recipient); // Add a recipient

    // Content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = 'Image Update Notification';
    $mail->Body    = 'The image has been updated successfully. New image URL: ' . $imageUrl;
    $mail->AltBody = 'The image has been updated successfully. New image URL: ' . $imageUrl;

    $mail->send();
    echo json_encode(['message' => 'Message has been sent']);
} catch (Exception $e) {
    echo json_encode(['message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
}
?>
