<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
</head>
<body>

<?php include('header.php'); ?>
<section class="heading">
    <h3>Logout</h3>
</section>

<section class="login">

    <div class="row">

        <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <h3>Are you confirm to logout?</h3>
            
            <input type="submit" value="Logout" name="logoutButton" class="btn">
            <?php
            if (isset($_POST['logoutButton'])) {
                // Logout script
                // Set the expiration time for the 'user_email' and 'user_pass' cookies to the past to remove them
                setcookie("user_email", "", time() - 3600, "/");
                setcookie("user_pass", "", time() - 3600, "/");

                // Clear the session data.
                session_unset();
                session_destroy();
                header("Location: home.php"); // Redirect to the home page after logout.
                exit; // Ensure the script stops execution after the redirect
            }
            ?>

        </form>

    </div>

</section>
</body>
</html>
