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
            <ul> 
                <li><a href="./index.php">Upload</a></li>
                <li><a href="./moderate.php">Moderate</a></li>
                <li><a href="./report.php">Report</a></li>
    

                <li><a href="./changepassword.php">Change Password</a></li>
                
            </ul>
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
    </body>
</html>