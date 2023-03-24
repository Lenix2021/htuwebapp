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
            <input type="submit" onclick="location.href='../logout.php'" value="Logout">
        </nav>
            <input type="button" value="Add" class="primary_button" onclick="openpopup()">
        </div>
        <div class="heads">
            <h3>Lectures Records</h3>
        </div>
          <div class="view">
               <div class="tb">
                    <table  cellpadding="10" >
                        <tr class="view_table">
                        <th>S/NO</th>
                        <th>LECTURER ID</th>
                        <th>LECTURER NAME</th>
                        <th>GENDER</th>
                        <th>DEPARTMENT</th>
                        <th>RANK</th>
                
                    </tr>
                </div>
          </div>
          <div
                <?php
                $conn = mysqli_connect("localhost","root","","emoderation");
                $sql = "select * from lecturer";
                $query_run = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_assoc($query_run)){
                    ?>
                   
                    <tr style="color:black">
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['LID']; ?></td>
                      <td><?php echo $row['LNAME']; ?></td>
                      <td><?php echo $row['gender'] ?></td>
                      <td><?php echo $row['dep'] ?></td>
                      <td><?php echo $row['rank'] ?></td>
                      <td><a href="editlecturer.php?id=<?php echo $row['id']; ?>" style="text-decoration: none; color:navy">Edit</a></td>
                      </tr>
                  
                <?php
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
                             <input type="text" name="id"   placeholder="Lectures Id">
                           </div>
                            <div class="ipt">
                              <input type="text" name="user" placeholder="Lectures Name">
                            </div>
                            <div class="ipt">
                              <input type="password" name="password" id="" placeholder="Password">
                            </div>
                            <div class="ipt">    
                                <select name = "dep">
                                    <option>Select Department</option>
                                    <option value="Computer Science">Computer Science</option>
                                </select>
                            </div>
                           <div class="ipts">
                                <ul>
                                    <li>
                                        Male
                                    </li>
                                    <li>
                                    <input type="radio" name="gender" value="male">
                                    </li>
                                    <br>
                                    <li>
                                    Female
                                    </li>
                                    <li>
                                    <input type="radio" name="gender" value="female">
                                    </li>
                                    </ul>
                           </div>
                           <div class="ipt">
                           <select name = "rank">
                                <option>Select Rank</option>
                                <option value="Junior Lecturer">Junior Lecturer</option>
                                <option value="Senior Lecturer">Senior Lecturer</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Computer Science">Computer Science</option>
                           </select>
                           </div>
                           <div class="save">
                            <input type="submit" value="SUBMIT" name="submit">
                            </div>
                   </form>
           </div>   
                                        <?php

                                $conn = mysqli_connect("localhost","root","","emoderation");
                                if(isset($_POST['submit'])){

                                $id = $_POST['id'];
                                $n = $_POST['user'];
                                $pwd = $_POST['password'];
                                $dep = $_POST['dep'];
                                $g = $_POST['gender'];
                                $r = $_POST['rank'];

                                // Check if Lecturer already exists in the database
                                $query = "SELECT LID, LNAME FROM lecturer WHERE LID = '$id' OR LNAME = '$n'";
                                $result = mysqli_query($conn, $query);
                                $count = mysqli_num_rows($result);

                                if($count > 0) {
                                    // If course already exists, output an error message
                                    echo "Error: Lecturer already exists in the database";
                                }

                                else {

                                $sql = "INSERT INTO lecturer (LID, LNAME, PWD,dep,gender,rank)
                                VALUES ('$id', '$n', '$pwd', '$dep', '$g', '$r')";

                                if (mysqli_query($conn, $sql)) {
                                echo "New record created successfully";
                                } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                                }

                                }

                                ?>
                                
                                       

    </body>
    <script src="../js/javascript.js" type="text/javascript"></script>
</html>