<?php
$conn = mysqli_connect("localhost","root","","emoderation");
$_SESSION['row2'] = $_POST['row2'];
$_SESSION['row4'] = $_POST['row4'];
$_SESSION['row5'] = $_POST['row5'];
$_SESSION['row6'] = $_POST['row6'];
$_SESSION['row7']= $_POST['row7'];
$_SESSION['row9'] = $_POST['row9'];
$_SESSION['row10'] = $_POST['row10'];
$_SESSION['row11'] = $_POST['row11'];
$_SESSION['row15'] = $_POST['row15'];
$_SESSION['row16'] = $_POST['row16'];
$_SESSION['row17'] = $_POST['row17'];
$_SESSION['general_observation']= $_POST['general_observation'];
$qpath =  $_SESSION['qp'];
$key = $_SESSION['code'];
 // update database
 $sql_queupdate = "UPDATE final SET questionpath = '$qpath' WHERE C_CODE = '$key'";
 $result_queupdate = mysqli_query($conn, $sql_queupdate); 

     // Redirect the user to last page
     header("Location:scheme.php");
     exit();
?>