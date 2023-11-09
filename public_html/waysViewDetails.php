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
        
        if (isset($_GET['ways_id'])){
            $ways_id = $_GET['ways_id'];
        }
        
        // Build a SQL query with a JOIN to fetch the categories_name
        $query = "SELECT ways.*, categories.categories_name, experts.experts_name
              FROM ways
              JOIN categories ON ways.categories_id = categories.categories_id
              JOIN experts ON ways.experts_id = experts.experts_id
              WHERE ways.ways_id = $ways_id";
        
	if (!$r = mysqli_query($dbc, $query)) {
		echo '<p style="color:red;">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
	}
        
        $count = 0;
        
	mysqli_close($dbc);

    ?>
    
    
   <?php while ($row = mysqli_fetch_array($r)): ?>

    <section class="heading">
        <h3><?php echo $row['ways_title']; ?></h3>
    </section>

    <section class="blog">
        <div class="box">
            <div class="image">
                <img src="<?php echo "images/" . $row['ways_images']; ?>">
            </div>
            <div class="content">
                <h3><?php echo $row['categories_name']; ?></h3>
                <div class="icons">
                    <a> <i class="fas fa-clock"></i> <?php echo $row['ways_date']; ?> </a>
                    <a> <i class="fas fa-user"></i> by <?php echo $row['experts_name']; ?> </a>
                </div>
                
                <?php
                $description = $row['ways_description'];
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