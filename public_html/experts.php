<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
</head>
<body>
    
<?php include('header.php'); ?>
<!-- header section ends -->

<section class="heading">
    <h3>Our Experts </h3>
    <p> <a href="home.php">home >></a> Resources >> <a href="experts.php">Experts</a> </p>
</section>

<?php

	$dbc = mysqli_connect('localhost', 'root', 'Siyingdb*123');
	mysqli_select_db($dbc, 'navigating_adolescence');
        
        $query = 'SELECT * FROM experts ';

        
	if (!$r = mysqli_query($dbc, $query)) {
		echo '<p style="color:red;">Could not retrieve the data because: <br/>' . mysqli_error($dbc) . '</p><p>The query being run was: ' . $query . '</p>';
	}
        
        $count = 0;
        
	mysqli_close($dbc);

    ?>

<section class="teachers">

    <?php while ($row = mysqli_fetch_array($r)): ?>
    
    <div class="box">
        <div class="image">
            <img src="<?php echo "images/" . $row['experts_image']; ?>">
            <div class="share">
                <a href="mailto:<?php echo $row['experts_contact']; ?>" class="fa fa-envelope"></a>
            </div>
        </div>
        <div class="content">
            <h3><?php echo $row['experts_name']; ?></h3>
            <span><?php echo $row['experts_field']; ?></span>
        </div>
    </div>
    
    <?php endwhile; ?>

</section>

<!-- teachers section ends -->





<?php include('footer.php'); ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>