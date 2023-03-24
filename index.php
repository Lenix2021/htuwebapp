<?php
session_start();
// establish database connection
$conn = mysqli_connect("localhost","root","","emoderation");

// check if form is submitted
if (isset($_POST['login'])) {
  $id = $_POST['id'];
  $password = $_POST['password'];

  // check if user is an admin
  if ($id === "Admin" || $id === "admin"  ) {
    $_SESSION['admin'] = "Admin";
    $sql = "SELECT  PWD FROM admin WHERE PWD = '$password'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die("Query failed: " . mysqli_error($conn));
    }
    
    if ($result->num_rows === 1) {
        header("Location: Admin/index.php");
        exit();
    }
   
  }

  // check if user is a lecturer
  $sql = "SELECT LID , PWD FROM lecturer WHERE LID = '$id' AND PWD = '$password'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }
  
  if ($result->num_rows === 1) {
    $_SESSION['id'] = $id;
    header("Location: Lecture/index.php");
    exit();
  }
  else
  {
           echo "Invalid ID OR Password";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./img/ht.jpg" type="image/x-icon">
    
    <title>Document</title>
    <script>
    function showPassword() {
      var passwordField = document.getElementById("password");
      var checkbox = document.getElementById("show-password");
      if (checkbox.checked) {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
    }
  </script>
</head>
<body>
    <div class="title"><h1>HO TECHNICAL UNIVERSITY </h1></div>
    <div class="head"><p>Welcome please login</p></div>
    <div class="container">
        <div class="left">

        </div>
        <div class="right">
         <div class="formBox">
            <form method = 'post'>
                
                <p>Username</p>
                <input type="text" name="id" placeholder="Enter ID" required>
                
                <p>Password</p>
                <input type="password" name="password" placeholder="********" required>
                 <input type="submit" value="LOG IN" name="login">
                <a href="#">Forget Password</a>


            </form>

         </div>
        </div>
    </div>
</body>
</html>