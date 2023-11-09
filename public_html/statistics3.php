<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
   <link rel="icon" type="image/x-icon" href="images/favicon.png" sizes="32x32">
</head>
<body>
<?php include('admin_header.php'); ?>

<section class="heading">
    <h3>Statistics ： Dealing With Stress</h3>
    <p> <a href="home.php">home >></a> Admin >> Statistics </p>
</section>    

<?php
include_once "php/config.php";

$test = array();
$ratingCounts = array(1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0);

$res = mysqli_query($dbc, "SELECT topic FROM survey");

while ($row = mysqli_fetch_array($res)) {
    $topic = $row["topic"];
    if (!isset($test[$topic])) {
        $test[$topic] = 1;
    } else {
        $test[$topic]++;
    }
}

?>

<script>
  window.onload = function () {
    var dataPoints = <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>;
    
    var barColors = ["#f0d9d1", "#e1bcb1", "#ca8e95", "#bb918E", "#bc8575"];
    
    var chart = new CanvasJS.Chart("chartContainer", {
      theme: "light1",
      animationEnabled: true,
      exportEnabled: true,
      title: {
        text: "Question 3 :  Are there specific topics related to adolescent stress you would like to see covered in the future?",
        fontFamily: 'Poppins, sans-serif',
        fontSize: 21,
      },
      axisX: {
        margin: 10,
        labelPlacement: "inside",
        tickPlacement: "inside",
        interval: 1 // Display all labels
      },
      axisY2: {
        title: "Number of Users",
        titleFontSize: 14,
        includeZero: true,
      },
      data: [{
        type: "bar",
        axisYType: "secondary",
        indexLabel: "{y}",
        dataPoints: Object.entries(dataPoints).map(([label, y], index) => ({
          label,
          y,
          color: barColors[index % barColors.length] // Assign a color from the array
        }))
      }]
    });
    chart.render();
  }
</script>


</head>
<body>
    <style>
    .container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  position: relative;
  margin-top: -4%;
}
.btnback2, .btnnext2 {
  position: absolute;
  bottom: 0;
  z-index: 1; 
}

    </style>
<div class="container">
  <div id="chartContainer" style="height: 500px; width: 75%;"></div>
  <a href="statistics2.php" class="btnback2">Back</a>
  <a href="statistics4.php" class="btnnext2">Next</a>
  <span class="spacer"></span>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>

