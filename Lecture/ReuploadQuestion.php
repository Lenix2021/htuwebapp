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
        $ccode = $_POST['ccode'];
        $ctitle = $_POST['ctitle'];
        $lec = $_POST['lname'];
        $mod = $_POST['mod'];
        $_SESSION['modid'] = $mod;
        $_SESSION['ccode'] = $ccode;
        $_SESSION['lname'] = $lec;
        $_SESSION['ctitle'] = $ctitle;

         // Retrieve the details from the database
 $query = "SELECT LTITLE FROM lecturer WHERE LID = '$mod'";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
 $_SESSION['modtitle'] = $row['LTITLE'];
 
    
        if (isset($_FILES['pdfQuestion'])) {
            $file1 = $_FILES['pdfQuestion'];
           
            // Check for errors
            if ($file1['error'] !== UPLOAD_ERR_OK) {
                echo "Error uploading file.";
                exit();
            }
    
            // Get the file extension
            $extension1 = strtolower(pathinfo($file1['name'], PATHINFO_EXTENSION));
          
            // Check if the file is a PDF
            if ($extension1 !== "pdf") {
                echo "Please upload a PDF file.";
                exit();
            }
    
            // Set the target directory and filename
            $target_dir1 = "C:/xampp/htdocs/htuwebapp/Files/Question/";
            $target_file1 = $target_dir1 . basename($file1['name']);

            //set file path
            $file_path1 = $target_file1;

    
            // Check if the file already exists
            if (file_exists($target_file1)) {
                echo "Sorry, file already exists.";
            } else {
                // Move the file to the target directory
                if (move_uploaded_file($file1['tmp_name'], $target_file1)) {
                    echo "File uploaded successfully.";
                    // Insert the file path into the database
                    $sql = "INSERT INTO approve (C_CODE, questionpath, Modid) VALUES (?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $ccode, $target_file1, $mod);
                        
                        if (mysqli_stmt_execute($stmt)) {
                            include 'reuploadquestionmail.php';
                            $sql_update = "UPDATE disaprove SET progress = 'Done' WHERE C_CODE = ?";
                            $stmt_update = mysqli_prepare($conn, $sql_update);
                            
                            if ($stmt_update) {
                                mysqli_stmt_bind_param($stmt_update, "s", $ccode);
                                
                                if (mysqli_stmt_execute($stmt_update)) {
                                    echo "Record updated successfully.";
                                    header("Location: Reupload.php");
                                    exit();
                                } else {
                                    echo "Error updating record: " . mysqli_error($conn);
                                }
                                
                                mysqli_stmt_close($stmt_update);
                            } else {
                                echo "Error preparing statement: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Error inserting record: " . mysqli_error($conn);
                        }
                        
                        mysqli_stmt_close($stmt);
                    } else {
                        echo "Error preparing statement: " . mysqli_error($conn);
                    }
                } else {
                    echo "Error uploading file.";
                }
            }
        }
            
    }
    
    // Retrieve the course record from the database
    $query = "SELECT d.*,c.C_TITLE, l.LNAME
    FROM disaprove d
    JOIN courses c ON d.C_CODE = c.C_CODE
    JOIN lecturer l ON c.LID = l.LID WHERE d.id = $course_id";
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
    <link rel="stylesheet" href="../css/edit.css?12345678">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,200&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../img/ff.png" type="image/x-icon">
</head>
    <body>
        <nav>
        <div class="ic">
                <img src="../img/d.png" alt="" srcset="">
            </div>
            <h1>E-MODERATION</h1>
            <ul> 
            <div class="icon_upload">
                    <img src="../img/upp.png" alt="" srcset="" onclick="location.href='./index.php'">
                    <li><a href="./index.php">Upload</a></li>
                </div>
                <div class="icon_upload">
                    <img src="../img/graduationcap.png" alt="" srcset="" onclick="location.href='./moderate.php'">
                    <li><a href="./moderate.php">Moderate</a></li>
                </div>
                <div class="icon_approve">
                    <img src="../img/APROVE.png" alt="" srcset="" onclick="location.href='./Accept.php'">
                    <li><a href="./Accept.php">Approve/Disapprove</a></li>
                </div>
                <div class="icon_upload">
                    <img src="../img/upp.png" alt="" srcset="" onclick="location.href='./Reupload.php'">
                    <li><a href="./Reupload.php">Reupload</a></li>
                </div>
                <div class="icon_clip">
                    <img src="../img/clip.png" alt="" srcset="" onclick="location.href='./changepassword.php'">
                    <li><a href="./changepassword.php">Change Password</a></li>
                </div>
                <div class="pad">
                    <img src="../img/padlock.png" alt="" srcset=""onclick="location.href='../logout.php'">
                    <li><a href="../logout.php">Logout</a></li>
                </div>
            </ul>
        </nav>
        <div class="popups" id="popup">
                   <form action="" method="POST" enctype="multipart/form-data">
                          
                            <br>
                            <div class="para">
                            <p>Course Code</p>
                            </div>
                           <div class="ipt">
                           <input type="text" name="ccode" value="<?php echo $row['C_CODE']; ?>" readonly required><br>
                           </div>
                           <div class="para">
                            <p>Course Title</p>
                            </div>
                            <div class="ipt">
                            <input type="text" name="ctitle" value="<?php echo $row['C_TITLE']; ?>"  readonly  required><br> 
                            </div>
                            <input type="hidden" name="lname" value="<?php echo $row['LNAME']; ?>" readonly required> 
                            <input type="hidden" name="mod" value="<?php echo $row['Modid']; ?>" readonly required>
                             <div class="ipt">
                             <input type="file" name="pdfQuestion" accept=".pdf" required>
                             </div>
                             <div class="save">
                             <input type="submit" value="UPLOAD" name="upload"> 
                             </div>
                             
                   </form>
           </div> 
    </body>
</html>  