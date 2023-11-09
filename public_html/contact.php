<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- header section starts  -->

<?php include('header.php'); ?>

<!-- header section ends -->

<section class="heading">
    <h3>contact us</h3>
    <p> <a href="home.html">home >></a> contact </p>
</section>

<section class="contact">

    <div class="icons-container">

        <div class="icons">
            <i class="fas fa-phone"></i>
            <h3>our number</h3>
            <p>+04-1234567</p>
            <p>+012-1234567</p>
        </div>

        <div class="icons">
            <i class="fas fa-envelope"></i>
            <h3>our email</h3>
            <p>nav_adolescence@gmail.com</p>
            <p>nav_adolescence_enquire@gmail.com</p>
        </div>

        <div class="icons">
            <i class="fas fa-map-marker-alt"></i>
            <h3>our address</h3>
            <p>Malaysia - Penang </p>
        </div>

    </div>

    <div class="row">

        <form action="contact.php" method="POST">
            <h3>get in touch</h3>
            <input type="text" placeholder="your name" name="name" class="box">
            <input type="email" placeholder="your email" name="email" class="box">
            <textarea name="message" placeholder="your message" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="submit" class="btn">
            
            <?php
                    use PHPMailer\PHPMailer\PHPMailer;
                    use PHPMailer\PHPMailer\Exception;

                    require 'PHPMailer/src/Exception.php';
                    require 'PHPMailer/src/PHPMailer.php';
                    require 'PHPMailer/src/SMTP.php';

                    if(isset($_POST['submit'])) {
                        
                        $mail = new PHPMailer(true);
                        
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $message = $_POST['message'];
                        
                        if (!empty($_POST['name']) && !empty($_POST['email']) & !empty($_POST['message'])){
                           
                            try {
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'siying060202@gmail.com'; // Gmail address which you want to use as SMTP server
                                $mail->Password = 'hrwskfxffzwsafcm'; // Gmail address Password
                                $mail->SMTPSecure = 'ssl';
                                $mail->Port = '465';

                                $mail->setFrom('siying060202@gmail.com'); // Gmail address which you used as SMTP server
                                $mail->addAddress('siying060202@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
    
                                $mail->isHTML(true);
                                $mail->Subject = "Navigating Adolescence : Enquiry";
                                $mail->Body = "Name: $name <br>Email: $email <br><p>Message : $message</p>";
                                
                                $mail->send();
                                
                                echo '<script>
                                        window.alert("Sent Successfully");
                                        window.location.href = "contact.php";
                                    </script>';
        
                            }catch (Exception $e){
                                error_log("Exception: " . $e->getMessage());
                                echo '<script>
                                    window.alert("Message could not be sent. Mailer Error: {'.$mail->ErrorInfo.'}");
                                </script>';
                            }
                        } 
                        
                        else {
                                echo '<script>
                                        window.alert("All input fields are required!");
                                        window.location.href = "contact.php";
                                    </script>';
                            }
                    }
            ?> 
        </form>

        <iframe class="map" src="https://maps.google.com/maps?q=penang%20island&amp;ie=UTF8&amp;iwloc=&amp;output=embed" allowfullscreen="" loading="lazy"></iframe>

    </div>

</section>



<!-- footer section ends -->

    <?php include('footer.php'); ?>
        
    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>