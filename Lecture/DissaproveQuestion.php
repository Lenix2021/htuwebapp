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
 $_SESSION['head_of_department'] = $_POST['head_of_department'];
 $_SESSION['date'] = $_POST['date'];
 $qpath =  $_SESSION['qp'];
 $comment =  $_POST['general_observation'];
 $examiner = $_SESSION['examiner'];
 $status = "Dissaproved";
 $_SESSION['status']= $status;
 $modid = $_SESSION['id'];
 $key = $_SESSION['code'];
 $q = "Null";

// update database
$sql_update = "UPDATE final SET questionpath = '$q' WHERE C_CODE = '$key'";
$result_update = mysqli_query($conn, $sql_update);


  // Check if course already exists in the database
  $query = "SELECT C_CODE FROM disaprove WHERE C_CODE = '$key'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count > 0) {
     // If course already exists, output an error message
     echo "Error: Can't Perform this Operation";
 }

 else
 {
    include 'reviewquestionmail.php';

    if ($sentemail == 'true') {
        $sqlresult = "INSERT INTO disaprove(C_CODE, Status, COMMENT, Modid) VALUES ('$key', '$status', '$comment', '$modid')";
        $output = mysqli_query($conn, $sqlresult);
    
        if (file_exists($qpath)) {
            if (unlink($qpath)) {
                echo "File deleted successfully.";
                // Redirect the user back to the moderation page
                header("Location:scheme.php");
                exit();
            } else {
                echo "Unable to delete the file.";
            }
        } else {
            echo "File not found.";
        }
    } else {
        echo "<div id='ms' > Email not sent. Check your internet connection. </div>";
    }
}  
     
?>