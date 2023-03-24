<?php

session_start();

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "emoderation");

// Retrieve the course ID from the URL parameter
$tk_id = $_GET['id'];

// Check if the form has been submitted
if (isset($_POST['assign'])) {
    // Retrieve the form data
    $cid = $_POST['cid'];
    $n = $_POST['cname'];
    $lid = $_POST['id'];
    $lname = $_POST['lname'];
    $d = $_POST['date'];

    

    // Retrieve the corresponding file and rank
    $sql = "SELECT LID, FILE, rank FROM scheme WHERE ID = '$tk_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $filepath = $row['FILE'];
    $sid = $row['LID'];
    $srank = $row['rank'];

    

    // Retrieve the rank of the assigning lecturer
    $sql = "SELECT rank FROM lecturer WHERE LID = '$lid'";
    $result = mysqli_query($conn, $sql);
    $ro = mysqli_fetch_assoc($result);
    $lrank = $ro['rank'];
    

    // Assign numerical values to the ranks
    $ranks = array(
        "Full Professor" => 5,
        "Associate Professor" => 4,
        "Senior Lecturer" => 3,
        "Lecturer" => 2,
        "Assistant Lecturer" => 1
    );

    $lecrank = $ranks[$lrank];
    $asrank = $ranks[$srank];
    
    // Validate the lecturer ID and rank
    if ($lid === $sid) {
        echo "Error!!!..Cannot assign a lecturer his/her own course";
    } elseif ($lid === 'Select Lecturer') {
        echo "Error!!!!!..Lecturer not Selected,Please select lecturer ";
    } elseif ($lecrank < $asrank) {
        echo "Error!!!..Cannot assign to a lecturer with a lower rank";
    } else {
        // Insert into the database
        $query = "INSERT INTO task (C_CODE, C_TITLE,LNAME, LID,file,date) VALUES ('$cid', '$n','$lname', '$lid','$filepath','$d')";
        $result = mysqli_query($conn, $query);        
    }
}

// Retrieve the record from the database
$query = "SELECT * FROM scheme WHERE ID = $tk_id";
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
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="popups">
            <form method = 'post'>
                    <div class="ipt">
                    <input type="text" name="cid" value="<?php echo $row['CID']; ?>" required readonly>
                    </div>
                    <div class="ipt">
                    <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required readonly>
                    </div>
                    <div class="ipt">
                    <input type="text" name="lname" value="<?php echo $row['LNAME']; ?>" required readonly>
                    </div>
                    <div class="ipt">
                            <select  class="opt" name = "id" required>
                                                        <option>Select Lecturer</option>
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
                    <div class="ipt">
                        <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
                    </div>
                    <div class="ipt">  
                    <input type="submit" value="ASSIGN" name="assign"> 
                    </div>
            </form>
        </div>
    </body>
</html>
