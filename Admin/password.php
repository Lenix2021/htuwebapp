<?php
session_start();

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

$mail->addAddress($id);

$mail->isHTML(true);

$mail->Subject='Log in Credentials';

$mail->Body = 'Dear '.$t.' ' . $n . ',<br><br>' .
              'Your Username for acesssing the HTU E-MODERATION WEB APP is ' . $id . ' and Your Password is ' . $pwd . ' Please Endeavour to Change your password after sucessfully logging in.';


if($mail->send()){
    echo "<script>alert('Email sent successfully.');</script>";
} else{
  echo 'Message could not be sent. No internet Connection!!';
}
?>