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
                <li><a href="#">Change Password</a></li>
            </ul>
            <input type="submit"  onclick="location.href='../logout.php'" value="Logout">
        </nav>
        <div class="popups">
            <form action="" method="post">
                <div class="lab">
                Old Password
                </div>
                <div class="ipt">
                <input type="password" name="oldpwd" placeholder="********" required>
                </div>
                <div class="lab">
                New Password
                </div>
                <div class="ipt">
                <input type="password" name="newpwd" placeholder="********" required>
               </div>
               <div class="lab">
                Confirm Password
                </div>
               <div class="ipt">
               <input type="password" name="conpwd" placeholder="********" required> 
               </div>
               <div class="save">
               <input type="submit" value="SAVE" name="change">   
               </div>
            </form>

        </div>
                            <?php
                    session_start();
                    // Establish a database connection
                    $conn = mysqli_connect("localhost", "root", "", "emoderation");

                    // Check if the user is logged in
                    if (!isset($_SESSION['admin'])) {
                        header("Location:../");
                        exit();
                    }

                    // Retrieve the current user's ID from the session
                    $user_id = $_SESSION['admin'];
                    // Retrieve the current user's information from the database
                    $query = "SELECT PWD FROM admin WHERE ANAME = '$user_id'";
                    $result = mysqli_query($conn, $query);
                    $user = mysqli_fetch_assoc($result);

                    // Check if the form has been submitted
                    if (isset($_POST['change'])) {
                        // Retrieve the form data
                        $old_password = $_POST['oldpwd'];
                        $new_password = $_POST['newpwd'];
                        $confirm_password = $_POST['conpwd'];

                        // Verify the old password
                        if ($old_password === $user['PWD']) {
                            // Verify the new password and confirm password match
                            if ($new_password === $confirm_password) {
                                // Update the user's password in the database
                                $sql = "UPDATE admin SET PWD = '$new_password' WHERE ANAME = '$user_id'";
                                $result = mysqli_query($conn, $sql);

                                if ($result) {
                                    // Password updated successfully
                                    echo "Password has been updated successfully";
                                    // Redirect the user to the home page
                                    header("Location: index.php");
                                    exit();
                                } else {
                                    // Display an error message
                                    echo "Unable to update password. Please try again later.";
                                }
                            } else {
                                // Display an error message
                                echo "New password and confirm password do not match.";
                            }
                        } else {
                            // Display an error message
                            echo "Incorrect old password.";
                        }

                        
                    }

                    ?>
    </body>
</html>