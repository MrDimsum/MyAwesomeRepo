<?php
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Notes</title>
    <link rel="icon" href="../img/note.png">
    <link rel="stylesheet" type="text/css" href="../css/app.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    
        
        <div class="login-content">
            <form id="loginform" class="form-horizontal" role="form" action="../php/login.php" method="POST">
                <img src="../img/avatar.png">
                <h2 class="title">Sign in to your Account</h2>
              <?php
                //if true,can fetch the string stored in the empty var in the /php/login.php file
                if(@$_GET['Empty']==true)
                {
              ?>
              <p class="txt_error"> <?php echo $_GET['Empty'] ?>  </p>
                                                                 
              <?php
                }
              ?>
              <?php 
                //if true,can fetch the string stored in the invalid var in the /php/login.php file
                if(@$_GET['Invalid']==true)
                {
              ?>
              <p class="txt_error"> <?php echo $_GET['Invalid'] ?>  </p>
            
                                              
              <?php
                }
              ?>
              
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        
                        <input type="text" class="input" name="username" autocomplete="off" placeholder="Username">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">      
                        <input type="password" class="input" name="password"autocomplete="off" placeholder="Password">
                   </div>
                </div>
                <a href="#">Forgot Password?</a>
                <input type="submit" class="btn" value="Login" name="Login">
                <p class="txt_signup"> New User? <a class="txt_signup" href="signup.php">Sign up here.</a> </p>
                
            </form>
        </div>
    
    
</body>
</html>
