<?php

$modid = $_SESSION['modid'];
$ccode = $_SESSION['ccode'];
$ctitle = $_SESSION['ctitle'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require ('../phpmailer/src/Exception.php');
require ('../phpmailer/src/PHPMailer.php');
require ('../phpmailer/src/SMTP.php');

$mail = new PHPMailer(true);

$mail ->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username='htuemoderationapp@gmail.com';
$mail->Password='fqcuuxdsvakdcfpl';
$mail->SMTPSecure='ssl';
$mail->Port=465;


$mail->setFrom('htuemoderationapp@gmail.com');

$mail->addAddress($modid);

$mail->isHTML(true);

$mail->Subject='Reuploaded Question for review';

$mail->Body = '' . $ccode." ".$ctitle . ' Exam Questions has been re-uploaded, Please Log into the system for further review.Thank You.';


if($mail->send()){
    echo "<script>alert('Email sent successfully.');</script>";  
} else{
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>