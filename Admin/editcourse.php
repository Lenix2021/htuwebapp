
<?php

session_start();


// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$course_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the form data
    $cid = $_POST['cid'];
    $n = $_POST['cname'];
    $lid = $_POST['id'];

        // Retrieve the corresponding lecturer's name
        $sql = "SELECT LNAME FROM lecturer WHERE LID = '$lid'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lname = $row['LNAME'];

        if($lid == 0)
        {
         
            echo"ERROR!!!!!..Lecturer not Selected ";
        
        }
    
    else
    {    
        // Update the course record in the database
    $query = "UPDATE courses SET C_CODE = '$cid', C_TITLE = '$n', LID = '$lid', LNAME = '$lname' WHERE id = $course_id";
    $result = mysqli_query($conn, $query);
    

    // Redirect the user back to the courses list page
    header("Location: courses.php");
    exit();
    }
}


// Retrieve the course record from the database
$query = "SELECT * FROM courses WHERE id = $course_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/edit.css">
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
            <input type="submit"  onclick="location.href='../logout.php'"value="Logout">
        </nav>
        <div class="popups" id="popup">
                   <form action="" method="POST">
                          
                            <br>
                           <div class="ipt">
                           <input type="text" name="cid" value="<?php echo $row['C_CODE']; ?>" required><br>
                           </div>
                            <div class="ipt">
                            <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required><br> 
                            </div>
                           
                           <div class="ipt">
                           <select  class="opt" name = "id" required>
                         <option value = 0>Select Lecturer</option>
                                                            <?php
                                                            $conn = mysqli_connect("localhost","root","","emoderation");
                                                        // Prepare a select statement
                                                        $sql = "SELECT LID,LNAME FROM lecturer";

                                                        $query_run = mysqli_query($conn,$sql);
                                                        if(mysqli_num_rows($query_run)){
                                    while($ro = mysqli_fetch_assoc($query_run)){
                                        ?>

                                        <option value = "<?php echo $ro['LID']; ?>"
                                        ><?php echo $ro['LNAME']; ?></option>
                                        
                                        <?php

                                    }                    }
                                                        ?>
                           </select>
                           </div>
                           <div class="save">
                           <input type="submit" value="UPDATE" name="update"> 
                            </div>
                   </form>
           </div>   
    </body>
</html>