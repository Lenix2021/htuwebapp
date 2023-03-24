
<?php
session_start();

$conn = mysqli_connect("localhost","root","","emoderation");


if (!isset($_SESSION['id'])) {
    header("Location:../");
    exit();
}
$key = $_SESSION['id'];

 // Retrieve the corresponding lecturer's name
 $sql = "SELECT LNAME FROM lecturer WHERE LID = '$key'";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 $lname = $row['LNAME'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/addmin.css">
</head>
    <body>
        <nav>
            <h1>EMODERATION<span> WEB APP</span></h1>
            <h4><?php echo "Welcome"." ".$lname      ?></h4>
            <ul> 
                <li><a href="./index.php">Upload</a></li>
                <li><a href="./moderate.php">Moderate</a></li>
                <li><a href="./report.php">Report</a></li>
    

                <li><a href="./changepassword.php">Change Password</a></li>
                
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="heads">
            <h3>Upload Question</h3>
        </div>
        <div class="view">
               <div class="tb">
                    <table  cellpadding="10" >
                        <tr class="view_table">
                        <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                
                    </tr>
                </div>
                                            <?php

                            $sno = 1;
                            $sql = "select id, C_CODE , C_TITLE from courses where LID = '$key'";
                            $query_run = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($query_run)){
                                ?>
                                <tr>
                                <td><?php echo $sno; ?></td>
                                <td><?php echo $row['C_CODE']; ?></td>
                                <td><?php echo $row['C_TITLE']; ?></td>
                                <td> <td>
                                <?php
                            $id = $row['id'];

                            // Base64 encode the ID value
                            $encoded_id = base64_encode($id);

                            $link = "file.php?p=$encoded_id";   
                            echo "<a href='$link'>Upload Question";?></td>
                            </tr>
                            <?php
                            $sno +=1;
                            }


                            ?>
          </div>
    </body>
</html>