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
                <li><a href="./moderator.php">Moderator</a></li>
                <li><a href="./viewmoderators.php">View Moderator</a></li>
                <li><a href="#">Print</a></li>
                <li><a href="./changepwd.php">Change Password</a></li>
            </ul>
            <input type="submit" value="Logout">
        </nav>
            <input type="submit" value="Add" class="primary_button" onclick="openpopup()">
        </div>
        <div class="heads">
            <h3>Courses Records</h3>
        </div>
          <div class="view">
               <div class="tb">
                    <table  cellpadding="10" >
                        <tr class="view_table">
                        <th>S/NO</th>
                        <th>COURSE CODE</th>
                        <th>COURSE TITLE</th>
                        <th>LECTURER ID</th>
                        <th>LECTURE NAME</th>
                        <th>RANK</th>
                
                    </tr>
                </div>
          </div>
          <div
          <?php
               $conn=$conn = mysqli_connect("localhost","root","","emoderation");
                $sno =1;
                $sql = "select * from courses";
                $query_run = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($query_run)){
                    ?>
                    <tr  style="color:black">
                    <td><?php echo $sno ?></td>
                    <td><?php echo $row['C_CODE']; ?></td>
                    <td><?php echo $row['C_TITLE']; ?></td>
                    <td><?php echo $row['LID']; ?></td>
                    <td><?php echo $row['LNAME']; ?></td>
                <td><a href="editcourse.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color:navy">Edit</a></td>
                </tr>
                <?php
                $sno +=1;
                }


                ?>
                </table>
           </div> 
           <div class="popup" id="popup">
                   <form action="" method="POST">
                           <div  class="close" >
                              <input type="button" value="X" onclick="closepopup()">
                            </div>
                            <br>
                           <div class="ipt">
                             <input type="text" name="cid"   placeholder="Course Id">
                           </div>
                            <div class="ipt">
                              <input type="text" name="cname" placeholder="Course Name">
                            </div>
                            
                           <div class="ipt">
                           <select name = "id">
                         <option>Select Examiner</option>
                                                                <?php
                                                                $conn = mysqli_connect("localhost","root","","emoderation");
                                                            // Prepare a select statement
                                                            $sql = "SELECT LID,LNAME FROM lecturer";

                                                            $query_run = mysqli_query($conn,$sql);
                                                            if(mysqli_num_rows($query_run)){
                                        while($row = mysqli_fetch_assoc($query_run)){
                                            ?>

                                            <option value = "<?php echo $row['LID']; ?>"
                                            ><?php echo $row['LNAME']; ?></option>
                                            
                                            <?php

                                        }                    }
                                                                ?>
                           </select>  
                           </div>                                  
                            <div class="save">
                               <input type="submit" value="SAVE" name="send">
                            </div>
                   </form>
           </div>   
                                        <!-- php code for saving -->
                                        <?php

                                $conn = mysqli_connect("localhost","root","","emoderation");
                                if(isset($_POST['send'])) {
                                    $cid = $_POST['cid'];
                                    $n = $_POST['cname'];
                                    $id = $_POST['id'];
                                    
                                    // Check if course already exists in the database
                                    $query = "SELECT C_CODE, C_TITLE FROM courses WHERE C_CODE = '$cid'";
                                    $result = mysqli_query($conn, $query);
                                    $count = mysqli_num_rows($result);

                                    if($count > 0) {
                                        // If course already exists, output an error message
                                        echo "Error: Course already exists in the database";
                                    } else {
                                        // Retrieve the corresponding lecturer's name
                                        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$id'";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $lname = $row['LNAME'];


                                $sq = "INSERT INTO courses (C_CODE, C_TITLE, LID, LNAME) VALUES ('$cid', '$n', '$id', '$lname')";
                                if (mysqli_query($conn, $sq)) {
                                            echo "New record created successfully";
                                        } else {
                                            echo "Error: " . $sq . "<br>" . mysqli_error($conn);
                                        }
                                    }

                                    mysqli_close($conn);
                                }

                                ?>

    </body>
    <script src="../js/javascript.js" type="text/javascript"></script>
</html>