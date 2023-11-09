<?php
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($dbc, "SELECT * FROM user WHERE email = '{$email}' ");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $user_pass = $row['password'];

        // Use password_verify to check if the entered password matches the hashed password
        if (password_verify($password, $user_pass)) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['name'] = $row['name'];
            
            // Perform a database query to check if the user is an admin based on their email
            $adminCheckSql = mysqli_query($dbc, "SELECT is_admin FROM user WHERE email = '{$email}'");
            $adminCheckResult = mysqli_fetch_assoc($adminCheckSql);
            
            setcookie("user_email", $email); 
            setcookie("user_pass", $user_pass);
            
            if ($adminCheckResult && $adminCheckResult['is_admin'] == 1) {
                // The user is an admin, grant access to admin features
                header("Location: ../statistics.php");
            } else {
                // The user is not an admin, redirect to a regular user page
                header("Location: ../vr.php");
            }
            
        } else {
             echo '<script>
                    window.alert("Email or Password is Incorrect!");
                    window.location.href = "../login.php";
                </script>';
        }
    } else {echo '<script>
                    window.alert("This email does not exist!");
                    window.location.href = "../login.php";
                </script>';
    }
} else {
    echo '<script>
        window.alert("All input fields are required!");
        window.location.href = "../login.php";
    </script>';
}
?>










