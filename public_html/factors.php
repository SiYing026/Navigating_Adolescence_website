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
        <style>
            .header.hidden {
                top: -100px; /* Adjust the value to hide the navbar completely */
            }
        </style>
        <!-- header section starts  -->

        <header class="header">

            <a href="home.php" class="logo"> <i class="fas fa-graduation-cap"></i> navigating adolescence </a>

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
                            <li><a href="experts.php">expert</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">contact</a></li>
                    <li><a><img src="images/profile.png" onclick="toggleMenu()" style="width:20px;height:20px;" alt="Profile"></a></li>
                </ul>
            </nav>

        </header>

<!-- header section ends -->

<!-- header section ends -->

<section class="heading">
    <h3>factors caused challenges </h3>
    <p> <a href="home.php">home >></a> information >> <a href="factors.php">Factors</a> </p>
</section>
    
<!-- Category buttons -->
<div class="button-container">
    <a href="factors.php"><button class="category-button" data-category="*">All</button></a>
    <a href="factors.php?category=Identity Formation"><button class="category-button" data-category="Identity Formation">Identity Formation</button></a>
    <a href="factors.php?category=Peer Pressure"><button class="category-button" data-category="Peer Pressure">Peer Pressure</button></a>
    <a href="factors.php?category=Academic Expectations"><button class="category-button" data-category="Academic Expectations">Academic Expectations</button></a>
    <a href="factors.php?category=Future Concerns"><button class="category-button" data-category="Future Concerns">Future Concerns</button></a>
</div>

<!-- course-3 section starts  -->

<!-- Display filtered items here -->
    <style>
        #filteredItems {
            display: -ms-grid;
            display: grid;
            -ms-grid-columns: (minmax(31rem, 1fr))[auto-fit];
                grid-template-columns: repeat(auto-fit, minmax(31rem, 1fr));
            gap: 1.5rem;
        }
    </style>
    
    <section class="course-3">
        <div id="filteredItems">

        </div>
    </section>

<!--<section class="course-3">

    <div class="box">
        <div class="video">
            <i class="fas fa-play"></i>
            <video src="images/course-vid-1.mp4"></video>
        </div>
        <div class="content">
            <h3>introduction to design</h3>
            <p>by john deo</p>
        </div>
    </div>



</section>-->

<!-- course-3 section ends -->

<div class="main-video">
    <div id="close-vid" class="fas fa-times"></div>
    <video src="" autoplay controls></video>
</div>

    <?php
        $hostname = "localhost";
        $username = "root";
        $dbpassword = "Siyingdb*123";
        $dbname = "navigating_adolescence";

        $dbc = new mysqli($hostname, $username, $dbpassword, $dbname);

        if ($dbc->connect_error) {
            echo 'Failed to connect to the database: ' . $dbc->connect_error;
            exit();
        }
        
        if(empty($_GET['category'])){
            $query = "SELECT * FROM factors";
        }
        else if(!empty($_GET['category'])){
            $selectedCategory = $_GET['category'];
            $query = "SELECT factors.* FROM factors JOIN categories ON factors.categories_id = categories.categories_id
              WHERE categories.categories_name = ?";
        }
        
        $stmt = mysqli_prepare($dbc, $query);

        if ($stmt === false) {
            echo 'Error preparing the query: ' . mysqli_error($dbc);
            exit();
        }

        if (!empty($_GET['category'])) {
            mysqli_stmt_bind_param($stmt, 's', $selectedCategory);
        }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
       
        while ($row = mysqli_fetch_assoc($result)) {
            $video = $row['factors_video'];
            $thumbnail = $row['factors_thumbnail'];
            echo '<section class="course-3">
                    <div class="box">
                        <div class="video">
                            <i class="fas fa-play"></i>
                            <video src="videos/' . $video . '" poster="images/' . $thumbnail . '"></video>
                        </div>
                        <div class="content">
                            <h3>' . $row['factors_title'] . '</h3>
                            <p>By ' . $row['factors_author'] . '</p>
                        </div>
                    </div>
                </section>';
        }        
    ?>

<?php include('footer.php'); ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>



</body>
</html>