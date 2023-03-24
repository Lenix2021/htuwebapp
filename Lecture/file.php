<?php
session_start();
// Establish a database connection
$conn = mysqli_connect("localhost", "root","", "emoderation");

if (!isset($_SESSION['id'])) {
    header("Location:../");
    exit();
}
$key = $_SESSION['id'];

// Retrieve the course ID from the URL parameter
$encoded_id = $_GET['p'];

 // Decode the ID value
 $course_id = base64_decode($encoded_id);

     // Check if the form has been submitted
     if (isset($_POST['upload'])) {
        // Retrieve the form data
        $cid = $_POST['cid'];
        $n = $_POST['cname'];
    
        // Retrieve the corresponding lecturer's name and rank
        $sql = "SELECT LNAME,rank FROM lecturer WHERE LID = '$key'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lname = $row['LNAME'];
        $rank = $row['rank'];
    
        if (isset($_FILES['pdfFile'])) {
            $file = $_FILES['pdfFile'];
    
            // Check for errors
            if ($file['error'] !== UPLOAD_ERR_OK) {
                echo "Error uploading file.";
                exit();
            }
    
            // Get the file extension
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
            // Check if the file is a PDF
            if ($extension !== "pdf") {
                echo "Please upload a PDF file.";
                exit();
            }
    
            // Set the target directory and filename
            $target_dir = "C:/xampp/htdocs/htuwebapp/Files/";
            $target_file = $target_dir . basename($file['name']);
    
            //set file path
            $file_path = $target_file;
    
            // Check if the file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
            } else {
                // Move the file to the target directory
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    echo "File uploaded successfully.";
                    // Insert the file path into the database
                    $sql = "INSERT INTO scheme(C_TITLE,CID,LNAME,LID,rank,FILE) VALUES ('$n','$cid','$lname','$key','$rank','$target_file')";
                    if ($conn->query($sql) === TRUE) {
                        $query = "DELETE FROM courses where ID = '$course_id'";
                        $result = mysqli_query($conn, $query);


                         // Redirect the user back to the assign list page
                        header("Location: index.php");
                         exit();


                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error uploading file.";
                }
            }
        } else {
            echo "Please select a file to upload.";
        }
    }
    
    // Retrieve the course record from the database
    $query = "SELECT * FROM courses WHERE id = $course_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Close database connection
    $conn->close();
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
                <li><a href="./moderate.php">Moderator</a></li>
                <li><a href="#">Print</a></li>
                <li><a href="./changepassword.php">Change Password</a></li>
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="popups" id="popup">
                   <form action="" method="POST" enctype="multipart/form-data">
                          
                            <br>
                           <div class="ipt">
                           <input type="text" name="cid" value="<?php echo $row['C_CODE']; ?>" required><br>
                           </div>
                            <div class="ipt">
                            <input type="text" name="cname" value="<?php echo $row['C_TITLE']; ?>" required><br> 
                            </div>
                             <div class="ipt">
                             <input type="file" name="pdfFile" accept=".pdf">
                             </div>
                             <div class="save">
                             <input type="submit" value="UPLOAD" name="upload"> 
                             </div>
                   </form>
           </div> 
    </body>
</html>  