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
  include_once "php/config.php";
  if(isset($_SESSION['user_id'])){
    header("location: login.php");
  }
?>
    
    
<?php include('header.php'); ?>
    
    
    <section class="heading">
        <h3>Sign Up</h3>
    </section>
    
<section class="login">

    <div class="row">
        
        <form action="php/php_signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <h3>Navigating Adolescence</h3>
            
            <div class="field input">
                <input type="name" name="name" placeholder="Enter your name" class="box">
            </div>
            <div class="field input">
                <input type="email" name="email" placeholder="Enter your email" class="box">
            </div>
            <div class="field input">
                <input type="password" name="password" placeholder="Enter your password" class="box">
            </div>
            
            <input type="submit" value="Sign Up" name="signup" class="btn">
            
            <h4>Already signed up? <a href="login.php">Login now</a></h4>
            
        </form>
        
    </div>
    

</section>
    
    <section class="footer">

            <div class="box-container">

                <div class="box">
                    <h3>explore</h3>
                    <a href="home.html"> <i class="fas fa-arrow-right"></i> home </a>
                    <a href="about.html"> <i class="fas fa-arrow-right"></i> about </a>
                    <a href="course-1.html"> <i class="fas fa-arrow-right"></i> course-1 </a>
                    <a href="course-2.html"> <i class="fas fa-arrow-right"></i>course-2 </a>
                    <a href="course-3.html"> <i class="fas fa-arrow-right"></i> course-3 </a>
                    <a href="teachers.html"> <i class="fas fa-arrow-right"></i> teachers </a>
                    <a href="blog.html"> <i class="fas fa-arrow-right"></i> blog </a>
                    <a href="contact.html"> <i class="fas fa-arrow-right"></i> contact </a>
                </div>


            </div>

        </section>

    
</body>
</html>
