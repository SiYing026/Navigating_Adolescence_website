<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
</head>
<body>
    
<?php include('header.php'); ?>
    
    <?php

	$dbc = mysqli_connect('localhost', 'root', 'Siyingdb*123');
	mysqli_select_db($dbc, 'navigating_adolescence');
        
        if (isset($_GET['challenges_id'])) {
            $challenges_id = $_GET['challenges_id'];
        }
        // Build a SQL query with a JOIN to fetch the categories_name
        $query = "SELECT challenges.*, categories.categories_name
              FROM challenges
              JOIN categories ON challenges.categories_id = categories.categories_id
              WHERE challenges.challenges_id = $challenges_id";
   
	if (!$r = mysqli_query($dbc, $query)) {
		echo '<p style="color:red;">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
	}
        
        $count = 0;
        
	mysqli_close($dbc);

    ?>
    
    
    
   <?php while ($row = mysqli_fetch_array($r)): ?>

    <section class="heading">
        <h3><?php echo $row['challenges_title']; ?></h3>
    </section>

    <section class="blog">
        <div class="box">
            <div class="image">
                <img src="<?php echo "images/" . $row['challenges_images']; ?>">
            </div>
            <div class="content">
                <h3><?php echo $row['categories_name']; ?></h3>
                <div class="icons">
                    <a> <i class="fas fa-clock"></i> <?php echo $row['challenges_date']; ?> </a>
                </div>
                
                
                <?php
                $description = $row['challenges_description'];
                $paragraphs = explode("\n", $description);
                
                echo '<div>';
                foreach ($paragraphs as $paragraph) {
                    echo '<p>' . trim($paragraph) . '</p>';
                }
                echo '</div>';
                ?>
            </div>
        </div>
    </section>

<?php endwhile; ?>
    
    <!-- vr section starts  -->

        <section class="vr" id="vr">

            <div class="image">
                <img src="images/vr.png" alt="">
            </div>

            <div class="content">
                <h4>Let try our virtual reality tour</h4><br>
                <h5>What can you learn :</h5>
                <dl>
                    
                    <dt><img src="images/vr1.png" alt="">Unique Perspective</dt>
                    <dd>Explore a unique viewpoint shaped by the experiences of others</dd>
                    
                    <dt><img src="images/vr2.png" alt="">Real-life Stories</dt>
                    <dd>Delve into personal narratives from those who've journeyed through adolescence</dd>
                    
                    <dt><img src="images/vr3.png" alt="">Find Inspiration</dt>
                    <dd>Encounter motivational words, including quotes and advice, to inspire and uplift you</dd>
                  
                </dl>
                <span class="br"></span> 
                <a href="login.php" class="btn">Navigating Adolescence Virtual Reality Explore</a>
            </div>

        </section>

        <!-- vr section ends -->

<?php include('footer.php'); ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>