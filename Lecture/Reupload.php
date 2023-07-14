<?php
session_start();

$conn = mysqli_connect("localhost","root","","emoderation");

if (!isset($_SESSION['id'])) {
    header("Location:../");
    exit();
}
$key = $_SESSION['id'];

// Retrieve the corresponding lecturer's name
$sql = "SELECT LNAME, LTITLE FROM lecturer WHERE LID = '$key'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$lname = $row['LNAME'];
$ltitle = $row['LTITLE'];

function countMessages() {
    $key = $_SESSION['id'];
    $stat="pending";
    $conn = mysqli_connect("localhost","root","","emoderation");
    // Replace 'your_table_name' with the actual name of your table
    $query = "SELECT COUNT(*) as total_messages FROM courses
    where LID = '$key' AND Status ='$stat' ";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalMessages = $row['total_messages'];
    
    return $totalMessages;
}

// Call the function to get the count of messages
$messageCount = countMessages();

// Function to count the messages in the database
 function countmoderation() {
    $key = $_SESSION['id'];
    $stat="pending";
    $conn = mysqli_connect("localhost","root","","emoderation");
    // Replace 'your_table_name' with the actual name of your table
    $query = "SELECT COUNT(*) as total_messages FROM task
    where Modid = '$key' AND Status='$stat'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalMessages = $row['total_messages'];
    
    return $totalMessages;
}

// Call the function to get the count of messages
$messageModerate = countmoderation();

function lecturername() {
    $key = $_SESSION['id'];
    $conn = mysqli_connect("localhost", "root", "", "emoderation");
    $query = "SELECT LNAME FROM lecturer WHERE LID = '$key'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['LNAME'];
    }
    
    return null; // Return a default value or handle the case where no row is found
}


$lnm=  lecturername();

function countreupload() {
    $lnm = lecturername();
    $stat="pending";
    $conn = mysqli_connect("localhost", "root", "", "emoderation");
    $query = "SELECT COUNT(*) AS total_messages, l.LNAME
    FROM disaprove d
    JOIN courses c ON d.C_CODE = c.C_CODE
    JOIN lecturer l ON c.LID = l.LID
    WHERE l.LNAME = '$lnm'
    AND progress='$stat'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalMessages = $row['total_messages'];
    
    return $totalMessages;
}

// Call function to get the count of messages
$messagereupload = countreupload();

function countscheme() {
    $stat="pending";
    $lnm = lecturername();
    $conn = mysqli_connect("localhost", "root", "", "emoderation");
    $query = "SELECT COUNT(*) AS total_messages, l.LNAME
    FROM dissaprovescheme s
    JOIN courses c ON s.C_CODE = c.C_CODE
    JOIN lecturer l ON c.LID = l.LID
    WHERE l.LNAME = '$lnm'
    AND progress = '$stat'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $totalMessages = $row['total_messages'];
    
    return $totalMessages;
}

// Call the function to get the count of messages
$messagescheme = countscheme();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-MODERATION</title>
    <link rel="stylesheet" href="../css/addmin.css?008765">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/ff.png" type="image/x-icon">
</head>
<body>
<nav>
        <div class="ic_edit">
                <img src="../img/d.png" alt="" srcset="">
            </div>
            <h1>HTU E-MODERATION</h1>
            <ul> 
            <div class="icon_upload">
                    <img src="../img/upp.png" alt="" srcset="" onclick="location.href='./index.php'">
                <li> <a href="./index.php">Upload</a>
                <?php if ($messageCount ==0) {
                        echo "";
                    } else
                    echo "<h1>". $messageCount. "</h1>";
                        # code...
                     ?>
                </li>
                </div>
                <div class="icon_upload">
                    <img src="../img/graduationcap.png" alt="" srcset="" onclick="location.href='./moderate.php'">
                    <li><a href="./moderate.php">Moderate</a>
                    <?php if ($messageModerate ==0) {
                        echo "";
                    } else
                    echo "<h1>". $messageModerate. "</h1>";
                        # code...
                     ?>
                </li>
                </div>
                <div class="icon_approve">
                    <img src="../img/APROVE.png" alt="" srcset="" onclick="location.href='./Accept.php'">
                    <li><a href="./Accept.php">Approve/Disapprove</a></li>
                </div>
                <div class="icon_upload">
                    <img src="../img/upp.png" alt="" srcset="" onclick="location.href='./Reupload.php'">
                    <li><a href="./Reupload.php">Reupload</a>
                     
                    <?php if ($messagereupload ==0 and $messagescheme==0) {
                        echo "";
                    } elseif ($messagereupload > 0 || $messagescheme > 0) {
                        $total=$messagereupload + $messagescheme;
                        echo "<h1>".$total."</h1>";
                    }
                     ?>

                </li>
                </div>
                <div class="icon_clip">
                    <img src="../img/clip.png" alt="" srcset="" onclick="location.href='./changepassword.php'">
                    <li><a href="./changepassword.php">Change Password</a></li>
                </div>
                <div class="pads">
                    <img src="../img/padlock.png" alt="" srcset=""onclick="location.href='../logout.php'">
                    <li><a href="../logout.php">Logout</a></li>
                </div>
            </ul>
</nav>
       
    <div class="name">
       <h4><?php echo "Welcome"." ".$ltitle." ".$lname      ?></h4>
       </div>
    <div class="heads">
        <h3>Re-Upload Question</h3>
    </div>
    <div class="view">
        <div class="tb">
            <table cellpadding="5">
                <tr class="view_table">
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>STATUS</th>
                    <th>COMMENT</th>
                </tr>
                <?php
                $sno = 1;
                $sql = "SELECT d.*,c.C_TITLE, l.LNAME
                FROM disaprove d
                JOIN courses c ON d.C_CODE = c.C_CODE
                JOIN lecturer l ON c.LID = l.LID
              WHERE LNAME = '$lname'";
                $query_run = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['C_CODE']; ?></td>
                    <td><?php echo $row['C_TITLE']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td><textarea  name="comment" id="" cols="6" rows="2" readonly>
                    <?php echo $row['COMMENT']; ?> 
                    </textarea></td>
                    <td>
                        <?php
                        $id = $row['ID'];
                        // Base64 encode the ID value
                        $encoded_id = base64_encode($id);
                        if ($row['progress'] == "Done") {
                            echo "Uploaded";
                        }
                        else {
                        $link = "ReuploadQuestion.php?p=$encoded_id";
                        echo "<div class='editl'><a href='$link'>ReUpload</a></div>";
                        }?>
                    </td>
                </tr>
                <?php
                $sno += 1;
                }
                ?>
            </table>
        </div>
    </div>
    <br><br>
    <div class="heads">
        <h3>Re-Upload Marking-Scheme</h3>
    </div>
    <div class="view">
        <div class="tb">
            <table cellpadding="5">
                <tr class="view_table">
                    <th>S/NO</th>
                    <th>COURSE CODE</th>
                    <th>COURSE TITLE</th>
                    <th>STATUS</th>
                    <th>COMMENT</th>
                </tr>
                <?php
                $sno = 1;
                $sql = "SELECT s.*,c.C_TITLE, l.LNAME
                FROM dissaprovescheme s
                JOIN courses c ON s.C_CODE = c.C_CODE
                JOIN lecturer l ON c.LID = l.LID
              WHERE LNAME = '$lname'";
                $query_run = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['C_CODE']; ?></td>
                    <td><?php echo $row['C_TITLE']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td><textarea name="comment" id="" cols="8" rows="3" readonly>
                    <?php echo $row['COMMENT']; ?>
                    </textarea></td>
                    <td>
                        <?php
                        $id = $row['ID'];
                        // Base64 encode the ID value
                        $encoded_id = base64_encode($id);
                        if ($row['progress'] == "Done") {
                            echo "Uploaded";
                        }
                        else {
                        $link = "Reuploadscheme.php?p=$encoded_id";
                        echo "<div class='editl'><a href='$link'>ReUpload</a></div>";
                        }?>
                    </td>
                </tr>
                <?php
                $sno += 1;
                }
                ?>
            </table>
        </div>
    </div>
    <div style="margin-bottom: 300px;">

    </div>
</body>
</html>
