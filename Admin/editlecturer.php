
<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$lec_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // Retrieve the form data
    $lid = $_POST['id'];
    $n = $_POST['user'];
    $dep = $_POST['dep'];
$g = $_POST['gender'];
$r = $_POST['rank'];

if($lid == 0)
{
 
    echo"ERROR!!!!!..Lecturer ID cannot be 0";

}
else{

    // Update the lecturers record in the database
    $query = "UPDATE lecturer SET LID = '$lid', LNAME = '$n', dep = '$dep',gender = '$g',rank = '$r'  WHERE id = $lec_id";
    $result = mysqli_query($conn, $query);


    // Redirect the user back to the lecturer list page
    header("Location: index.php");
    exit();
}
}


// Retrieve the lecturers record from the database
$query = "SELECT * FROM lecturer WHERE id = $lec_id";
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
                           <input type="text" name="id"  value = "<?php echo $row['LID']; ?>"  required>
                           </div>
                            <div class="ipt">
                            <input type="text" name="user" value = "<?php echo $row['LNAME']; ?>" required>
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
                           <select  class="opt" name = "rank">
                        <option value=" ">Select Rank</option>
                         <option value="Full Professor">Full Professor</option>
                         <option value="Associate Professor">Associate Professor</option>
                         <option value="Senior Lecturer">Senior Lecturer</option>
                         <option value="Lecturer">Lecturer</option>
                         <option value="Assistant Lecturer">Assistant Lecturer</option>
                        </select>
                           </div>
                           <div class="save">
                            <input type="submit" value="UPDATE" name="update">
                            </div>
                   </form>
           </div>   
    </body>
</html>