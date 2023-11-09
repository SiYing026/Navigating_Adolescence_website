<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
</head>
<body>

  <?php 
  session_start();
  if(isset($_SESSION['user_id'])){
    header("location: vr.php");
  }
?>
  
<?php include('header.php'); ?>
<section class="heading">
    <h3>Login</h3>
</section>

<section class="login">

    <div class="row">

        <form action="php/php_login.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <h3>Navigating Adolescence</h3>
            
            <div class="field input">
                <input type="email" placeholder="Enter your email" class="box" name ="email" >
            </div>
            <div class="field input">
                <input type="password" placeholder="Enter your password" class="box" name ="password" >
            </div>
            
            <input type="submit" value="Login" name="login" class="btn">
            
            <h4>Not yet signed up? <a href="signup.php">Sign up now</a></h4>
        </form>
       

    </div>
    

</section>
</body>
</html>
