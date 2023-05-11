<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './phpmailer/src/Exception.php';
require './phpmailer/src/PHPMailer.php';
require './phpmailer/src/SMTP.php';


include 'functions.php';

$mail = new PHPMailer(true);
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

try {
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'allandra1029384756@gmail.com';                 // Наш логин
    $mail->Password = 'ofybnfbuhdrkpuie';                           // Наш пароль от ящика
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    
    $mail->setFrom('allandra1029384756@gmail.com', 'Pulse');   // От кого письмо 
    $mail->addAddress('tosaso4923@pixiil.com');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Данные';
    $mail->Body    = '
		Пользователь оставил данные <br> 
	Имя: ' . $name . ' <br>
	Номер телефона: ' . $phone . '<br>
	E-mail: ' . $email . '';
    $mail->AltBody = $plainBody;
    $mail->CharSet = 'UTF-8';

    $mail->send();

    $data['success'] = true;
    echo json_encode($data);
} catch (Exception $e) {
    $data['success'] = false;
    $data['error'] = $mail->ErrorInfo;
    echo json_encode($data);
}
