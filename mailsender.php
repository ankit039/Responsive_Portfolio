<?php

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pno = $_POST['pno'];
    $msg = $_POST['msg'];
}
$message="<p>name:$name<br>email:$email<br>pno:$pno<br>message:$msg</p>";
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';
require 'settings.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                       // Enable verbose debug output
    $mail->isSMTP();                           // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                // Enable SMTP authentication
    $mail->Username   = "$username_mail";   // SMTP username
    $mail->Password   = "$username_pwd";   // SMTP password
    $mail->SMTPSecure = 'tls';            // Enable TLS encryption;`PHPMailer::ENCRYPTION_SMTPS`also accepted
    $mail->Port       = 587;             // TCP port to connect to

    //Recipients
    session_start();
    $getmail = $_SESSION["email"];
    $mail->setFrom('abc@gmail.com', 'Contact Form of '.$name);
    $mail->addAddress("ryder.raj.ankit@gmail.com");     // Add a recipient

    $mail->isHTML(true);                              // Set email format to HTML
    $mail->Subject = 'Contact Form of '.$name;
    $mail->Body    = "$message";

    $mail->send();
    header('location: ./index.html');
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}