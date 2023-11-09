<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigating Adolescence</title>
    
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <style>
        .header.hidden {
            top: -100px; /* Adjust the value to hide the navbar completely */
        </style>
    <!-- header section starts  -->
    <header class="header">
        <a href="home.php" class="logo"> <img src="images/favicon.png" alt="" style="width: 37px; height: 37px; margin-right: 20px">navigating adolescence </a>
        <div id="menu-btn" class="fas fa-bars"></div>
        <nav class="navbar">
            <ul>
                <li><a href="home.php">home</a></li>
                <li><a href="about.php">about</a></li>
                <li><a href="#">information</a>
                    <ul>
                        <li><a href="challenges.php">challenges will be faced during adolescence </a></li>
                        <li><a href="factors.php">factors caused challenges </a></li>
                        <li><a href="ways.php">ways to overcome challenges</a></li>
                    </ul>
                </li>
                <li><a href="#">resources</a>
                    <ul>
                        <li><a href="experts.php">experts</a></li>
                    </ul>
                </li>
                <li><a href="statistics.php">Statistics</a></li>
                <li><a><img src="images/profile.png" onclick="toggleMenu()" style="width:20px;height:20px;" alt="Profile"></a></li>
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <?php
                            include_once "php/config.php";
                            session_start();

                            if (isset($_SESSION['user_id'])) {
                                $query = "SELECT * FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
                                if ($r = mysqli_query($dbc, $query)) {
                                    $row = mysqli_fetch_array($r);
                                    if ($row) {
                                        $_SESSION['user_id'] = $row['user_id'];
                                        $_SESSION['name'] = $row['name']; // Set the user's name in the session
                                        echo '<div class="user-info">';
                                        echo '<img src="images/profileblack.png" style="width:50px;height:50px;">';
                                        echo '<h2>' . $_SESSION['name'] . '</h2>';
                                        echo '</div>';
                                    }
                                } 
                            } else {
                                // Handle the case where the user is not logged in
                                echo '<div class="user-info">';
                                echo '<img src="images/profileblack.png" style="width:50px;height:50px;">';
                                echo '<h2>-</h2>';
                                echo '</div>';
                            }
                            if (isset($_SESSION['user_id'])) {
                                echo'<hr>';
                                echo '<a class="sub-menu-link">';
                                echo '<p>Administrator</p>';
                                echo '</a>';
                                
                                echo '<a href="logout.php" class="sub-menu-link">';
                                echo '<img src="images/logout.png">';
                                echo '<p>Logout</p>';
                                echo '<span>></span>';
                                echo '</a>';
                            }
                            ?>

                    </div>
                </div>
            </ul>
        </nav>
    </header>
    <!-- header section ends -->
    <script src="js/script.js"></script>
    <script>
        let subMenu = document.getElementById("subMenu");
        function toggleMenu() {
            subMenu.classList.toggle("open-menu");
        }
    </script>
</body>
</html>
