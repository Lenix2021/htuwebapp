<?php

$ccode = $_SESSION['ccode'];
$ctitle = $_SESSION['ctitle'];
$lid = $_SESSION['email'];
$deadline = $_SESSION['deadline'];
$lec = $_SESSION['lec'];
$lname = $_SESSION['lname'];
$questionpath = $_SESSION['path1'];
$schemepath = $_SESSION['path2'];
$outlinepath =$_SESSION['path3'];
$d = $_SESSION['date'];
$format_deadline = date("F jS, Y", strtotime($deadline));



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

$mail->addAddress($lid);

$mail->isHTML(true);

$mail->Subject='Course Moderation Assignment';

$mail->Body = 'Dear ' . $lname . ',<br><br>' .
              'You have been assigned to moderate ' . $ccode . ' ' . $ctitle . ' and the deadline for the moderation is ' . $format_deadline . '.';


if($mail->send()){
    echo "<script>alert('Email sent successfully.');</script>";

     // Insert into the database
     $query = "INSERT INTO task (C_CODE, Modid, questionpath, schemepath, outlinepath, date, deadline) VALUES (?, ?, ?, ?, ?, ?, ?)";
     $stmt = mysqli_prepare($conn, $query);
     mysqli_stmt_bind_param($stmt, "sssssss", $ccode, $lid, $questionpath, $schemepath, $outlinepath, $d, $deadline);
     $result = mysqli_stmt_execute($stmt);
     
} else{
  echo 'Message could not be sent.';
  echo 'Mailer Error: ' . $mail->ErrorInfo;

}
?>