
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
            <ul> 
                <li><a href="./index.php">Upload</a></li>
                <li><a href="./moderate.php">Moderate</a></li>
                <li><a href="./report.php">Report</a></li>
                <li><a href="./changepassword.php">Change Password</a></li>
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="heads">
            <h3>Moderate </h3>
        </div>
           <div class="view">
              <div class="tb">
                  <form method = 'post'>
                  <table  cellpadding="10"  >
                   <tr>
                        <th>S/NO</th>
                        <th>COURSE CODE</th>
                        <th>COURSE TITLE</th>
                   </tr>
              </div>
                                            <?php

                                $sno = 1;
                                $sql = "select * from task where LID = '$key'";
                                $query_run = mysqli_query($conn,$sql);
                                while($row = mysqli_fetch_assoc($query_run)){
                                    ?>
                                    <tr>
                                    <td><?php echo $sno; ?></td>
                                    <td><?php echo $row['C_CODE']; ?></td>
                                    <td><?php echo $row['C_TITLE']; ?></td>
                                    <td>
                                    <?php
                                $id = $row['ID'];

                                // Base64 encode the ID value
                                $encoded_id = base64_encode($id);

                                $link = "question.php?p=$encoded_id";
                                echo "<a href='$link'>View Question</a>"; ?> | <?php  $id = $row['ID'];

                                // Base64 encode the ID value
                                $encoded_id = base64_encode($id);
                                $link2 = "report.php?p=$encoded_id"; 
                                echo "<a href='$link2'>Fill Report</a>"; ?></td>
                                    
                                </tr>
                                <?php
                                $sno +=1;
                                }
                                ?>
                                </table>
           </div>
    </body>
</html>