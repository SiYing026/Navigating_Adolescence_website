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

$res = mysqli_query($dbc, "SELECT rating5 FROM survey");

while ($row = mysqli_fetch_array($res)) {
    $rating = $row["rating5"];
    $ratingCounts[$rating]++;
}

$totalUsers = mysqli_num_rows($res);

foreach ($ratingCounts as $rating => $count) {
    if ($count > 0) {
        $percentage = ($count / $totalUsers) * 100;
        $test[] = array("label" => "$rating Stars", "y" => $percentage);
    }
}

$colors = ["#9e4a5f", "#ca90aa", "#7a4d61", "#bb767d", "#494564"];
?>

<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Question 4 : Did you feel a sense of connection with other participants who may be dealing with similar challenges?",
                fontFamily: 'Poppins, sans-serif',
                fontSize: 21,
            },
            subtitles: [{
                text: ""
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "#percent%",
                yValueFormatString: "#,##0",
                dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>,
                indexLabelFontColor: "black", // Customize the font color for the index label
                indexLabelLineColor: "black", // Customize the line color for the index label
                indexLabelLineThickness: 2, // Customize the line thickness for the index label
                indexLabelMaxWidth: 150, // Customize the maximum width of the index label
                indexLabelWrap: true, // Allow text wrapping for the index label
                dataPoints: [
                    <?php
                    for ($i = 0; $i < count($test); $i++) {
                        echo '{ label: "' . $test[$i]['label'] . '", y: ' . $test[$i]['y'] . ', color: "' . $colors[$i] . '" },';
                    }
                    ?>
                ]
            }]
        });
        chart.render();
    };
</script>
<div class="container">
  <div id="chartContainer" style="height: 500px; width: 95%; margin-top: 5%"></div>
  <a href="statistics7.php" class="btnback2">Back</a>
  <a href="statistics.php" class="btnnext2">Next</a>
  <span class="spacer"></span>
</div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>

