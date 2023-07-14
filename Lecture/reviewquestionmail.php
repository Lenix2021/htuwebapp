<?php

$lecid = $_SESSION['lecid'];
$ccode =$_SESSION['code'];
$ctitle = $_SESSION['ctitle'];
$status = $_SESSION['status'];
$sentemail = 'false'; 

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

$mail->addAddress($lecid);

$mail->isHTML(true);

$mail->Subject='Exam Question Review';


$mail->Body ='Review of Your Exam Questions for ' . $ccode." ".$ctitle . ' has been completed, status of moderation: '.$status.', Please Log into the system to view necessary comments.Thank You.';


if($mail->send()){
    echo "<script>alert('Email sent successfully.');</script>"; 
    $sentemail = 'true'; 
} else{
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;
}
?>