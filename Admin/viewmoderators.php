<?php
session_start();

$conn = mysqli_connect("localhost","root","","emoderation");



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
                <li><a href="./index.php">Lecturer</a></li>
                <li><a href="./courses.php">Courses</a></li>
                <li><a href="./moderator.php">Moderate</a></li>
                <li><a href="./viewmoderators.php">View Moderators</a></li>
                <li><a href="#">Print</a></li>
                <li><a href="./changepwd.php">Change Password</a></li>
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="heads">
            <h3>Assigned Moderators</h3>
        </div>
        <div class="view">
              <div class="tb">
                  <form method = 'post'>
                  <table  cellpadding="10"  >
                   <tr>
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>LECTURER NAME</th>
                    <th>LECTURER LID</th>
                   </tr>
              </div>
                                            
                                    <?php

                                    $sno = 1;
                                    $sql = "select * from task";
                                    $query_run = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($query_run)){
                                        ?>
                                        <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $row['C_CODE']; ?></td>
                                        <td><?php echo $row['C_TITLE']; ?></td>
                                        <td><?php echo $row['LNAME']; ?></td>
                                        <td><?php $li = $row['LID'];
                                        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$li'";
                                        $result = mysqli_query($conn, $sql);
                                        $Lrow = mysqli_fetch_assoc($result);
                                        echo $Lrow['LNAME']; ?></td>
                                        <td><?php echo $row['date']; ?></td>

                                        
                                    </tr>
                                    <?php
                                    $sno +=1;
                                    }
                                    ?>
        </div>
    </body>
</html>