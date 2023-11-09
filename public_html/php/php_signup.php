<?php
session_start();
include_once "config.php";

// Sanitize user input
$name = filter_var($dbc->real_escape_string($_POST['name']), FILTER_SANITIZE_STRING);
$email = filter_var($dbc->real_escape_string($_POST['email']), FILTER_SANITIZE_EMAIL);
$password = filter_var($dbc->real_escape_string($_POST['password']), FILTER_SANITIZE_STRING);

// Check if the user has previously accepted cookies
$cookiesAccepted = $_COOKIE['cookiesAccepted'] ?? 'false';

// Set cookies if necessary
if ($cookiesAccepted === 'true') {
    setcookie("user_email", $email); 
    setcookie("user_pass", $password);
}


if (isset($_POST['signup'])) {
    try {
        if (!empty($name) && !empty($email) && !empty($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // Check if the email already exists in the database
                $check_email_query = mysqli_prepare($dbc, "SELECT * FROM user WHERE email = ?");
                mysqli_stmt_bind_param($check_email_query, "s", $email);
                mysqli_stmt_execute($check_email_query);
                mysqli_stmt_store_result($check_email_query);

                if (mysqli_stmt_num_rows($check_email_query) > 0) {
                    echo '<script>';
                    echo 'window.alert("' . $email . ' - This email already exists!");';
                    echo 'window.location.href = "../signup.php"';
                    echo '</script>';
                } else {
                    // Use password_hash to securely hash the password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the user's data into the database
                    $insert_query = mysqli_prepare($dbc, "INSERT INTO user (user_id, name, email, password)
                        VALUES (0, ?, ?, ?)");

                    mysqli_stmt_bind_param($insert_query, "sss", $name, $email, $hashed_password);
                    mysqli_stmt_execute($insert_query);
                    
                    if (mysqli_stmt_affected_rows($insert_query) > 0) {
                        
                            if ($cookiesAccepted !== 'true') {
                                echo '
                                    <style>
                                    .cookies {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
    background: #f0f0f0;
    font-family: \'Poppins\', sans-serif;
}

.cookies .wrapper{
  position: absolute;
  max-width: 365px;
  background: #fff;
  padding: 25px 25px 30px 25px;
  border-radius: 15px;
  box-shadow: 1px 7px 14px -5px rgba(0,0,0,0.15);
  text-align: center;
}

.cookies ::selection{
  color: #fff;
  background: #FCBA7F;
}
.cookies .wrapper img{
  max-width: 90px;
}
.cookies .content header{
  font-size: 25px;
  font-weight: 600;
}
.cookies .content{
  margin-top: 10px;
}
.cookies .content p{
  color: #858585;
  margin: 5px 0 20px 0;
}
.cookies .content .buttons{
  display: flex;
  align-items: center;
  justify-content: center;
}
.cookies .buttons button{
  padding: 10px 20px;
  border: none;
  outline: none;
  color: #fff;
  font-size: 16px;
  font-weight: 500;
  border-radius: 5px;
  background: #FCBA7F;
  cursor: pointer;
  transition: all 0.3s ease;
}
.cookies .buttons button:hover{
  transform: scale(0.97);
}
.cookies .buttons .item{
  margin: 0 10px;
}
.cookies .buttons a{
  color: #FCBA7F;
}
                                    </style>
                                    <section class="cookies">
                                        <div class="wrapper" id="cookie-consent-banner">
                                            <img src="../images/cookie.png" alt="">
                                            <div class="content">
                                              <header>Cookies Consent</header>
                                              <p>This website use cookies to ensure you get the best experience on our website. Accept cookies?</p>
                                              <div class="buttons">
                                                <button class="item" id="accept-cookies-btn">Accept</button>
                                                <button class="item" id="deny-cookies-btn">Deny</button>
                                              </div>
                                            </div>
                                        </div>
                                    </section>
                                ';
                                
                            }
                    } else {
                        throw new Exception("Something went wrong with the INSERT query. Please try again!");
                    }
                }
            } else {
                echo '<script>
                    window.alert("Email is not a valid email!!");
                    window.location.href = "../signup.php";
                </script>';
            }
        } else {
            echo '<script>
                    window.alert("All input fields are required!");
                    window.location.href = "../signup.php";
                </script>';
        }
        
        
        
    } catch (Exception $e) {
        // Handle the exception and log the error message
        error_log("Exception: " . $e->getMessage());
        echo '<script>
            window.alert("Something went wrong. Please try again!");
        </script>';
    }
}
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookieConsentBanner = document.getElementById("cookie-consent-banner");
        const acceptCookiesButton = document.getElementById("accept-cookies-btn");
        const denyCookiesButton = document.getElementById("deny-cookies-btn");

        // Function to set cookies as accepted
        const acceptCookies = () => {
            document.cookie = "cookiesAccepted=true; " + "; path=/";
            console.log("Cookies accepted.");
            cookieConsentBanner.style.display = "none";
            window.location.href = "../login.php";
        };


        // Function to set cookies as denied
        const denyCookies = () => {

            document.cookie = "cookiesAccepted=false; " + "; path=/";
            console.log("Cookies denied.");
            cookieConsentBanner.style.display = "none";
            window.location.href = "../login.php";
        };


        acceptCookiesButton.addEventListener("click", acceptCookies);
        denyCookiesButton.addEventListener("click", denyCookies);

        // Check if the user has previously accepted cookies
        const cookiesAccepted = getCookie("cookiesAccepted");
        if (cookiesAccepted === 'true') {
            // User accepted cookies, set necessary cookies here
            
        } else if (cookiesAccepted === 'false') {
            // User denied cookies, take appropriate actions here
        }
    });

    // Function to retrieve a specific cookie by name
    function getCookie(cookieName) {
        const cookies = document.cookie.split('; ');
        for (const cookie of cookies) {
            const [name, value] = cookie.split('=');
            if (name === cookieName) {
                return decodeURIComponent(value);
            }
        }
        return '';
    }

    </script>