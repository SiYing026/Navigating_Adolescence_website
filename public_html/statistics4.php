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
    <h3>Statistics: Dealing With Stress</h3>
    <p> <a href="home.php">home >></a> Admin >> Statistics </p>
</section>

<style>
    .title p {
        text-align: center;
        font-size: 21px;
        text-transform: none;
        margin-top: 62px;
    }

    .table-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        font-family: 'Poppins', sans-serif;
    }

    /* Style the table */
    table {
        border-collapse: collapse;
        width: 75%;
        margin-top: 52px;
    }

    th {
        background-color: #1F4987; /* Add background color to th elements */
        color: #fff;
        padding: 11px 8px;
        text-align: center;
        text-transform: none;
        font-size: 1.8rem;
    }

    td {
        text-align: left;
        padding: 15px 8px;
        border: none; /* Remove border from td elements */
        font-size: 1.5rem;
        text-transform: none;
    }

    /* Add hover effect */
    tr:hover {
        background-color: #def1fa;
    }
    
    .btn-show-next{
        text-align: center;
        font-size: 1.5rem;
        text-align: center;
    font-size: 1.5rem;
    position: absolute;
    bottom: -150px; /* Adjust the vertical position as needed */
    right: 250px;
    }
    
    
</style>

<div class="title">
    <p>Question 4: Have you applied any stress management techniques learned from the website in your daily life?</p>
</div>
<div class="table-container">
    <table>
        <tr>
            <th>Survey ID</th>
            <th>Topic covered</th>
            <th>Stress management techniques</th>
        </tr>
        <?php


        include_once "php/config.php";
        $query = "SELECT * FROM survey";
        $query_run = mysqli_query($dbc, $query);

        $data = mysqli_fetch_all($query_run, MYSQLI_ASSOC); // Fetch all data

        $showCount = 7; // Number of rows to display on each page
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($currentPage - 1) * $showCount;
        $end = $start + $showCount;

        if (count($data) > 0) {
            for ($i = $start; $i < min($end, count($data)); $i++) {
                echo '<tr>';
                echo '<td>' . $data[$i]['survey_id'] . '</td>';
                echo '<td>' . $data[$i]['topic'] . '</td>';
                echo '<td>' . $data[$i]['techniques'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo "<h5>No Record Found</h5>";
        }
        ?>

    </table>
    <?php
    // Calculate the total number of pages
    $totalPages = ceil(count($data) / $showCount);

    if ($currentPage < $totalPages) {
        $nextPage = $currentPage + 1;
        echo "<a href='?page=$nextPage' class='btn-show-next'>Show Next >></a>";
    } elseif ($currentPage > 1) {
        $previousPage = $currentPage - 1;
        echo "<a href='?page=$previousPage' class='btn-show-next'> << Show Less</a>";
    }
?>

</div>

<style>

.btnback2, .btnnext2 {
  margin-bottom: 52px;
  position: absolute;
  bottom: 0;
  z-index: 1;
}
</style>

<div class="container">
  <a href="statistics3.php" class="btnback2">Back</a>
  <a href="statistics5.php" class="btnnext2">Next</a>
  <span class="spacer"></span>
</div>

</body>
</html>
