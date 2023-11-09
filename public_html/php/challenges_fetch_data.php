<?php
// Establish a database connection (replace with your database credentials)
$hostname = "localhost";
$username = "root";
$dbpassword = "Siyingdb*123";
$dbname = "navigating_adolescence";

$dbc = new mysqli($hostname, $username, $dbpassword, $dbname);

if ($dbc->connect_error) {
    echo 'Failed to connect to the database: ' . $dbc->connect_error;
    exit();
}

// Retrieve the selected category from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$selectedCategory = $data['category'];

// Build an SQL query to fetch items based on the selected category, using a JOIN with the "categories" table
if ($selectedCategory == "*") {
    $query = 'SELECT challenges.*, categories.categories_name FROM challenges 
              JOIN categories ON challenges.categories_id = categories.categories_id';
} else {
    $query = "SELECT challenges.*, categories.categories_name FROM challenges 
              JOIN categories ON challenges.categories_id = categories.categories_id
              WHERE categories.categories_name = ?";
}

// Prepare and execute the query
$stmt = mysqli_prepare($dbc, $query);
if ($stmt === false) {
    echo 'Error preparing the query: ' . mysqli_error($dbc);
    exit();
}

// Bind parameters and execute the query
if ($selectedCategory !== "*") {
    mysqli_stmt_bind_param($stmt, 's', $selectedCategory);
}
if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    // Rest of your code to generate HTML here...
} else {
    echo 'Error executing the query: ' . mysqli_error($dbc);
}

// Generate HTML for the retrieved items
$html = '';
while ($row = mysqli_fetch_array($result)) {
    $html .= '<section class="course-1">';
    $html .= '<div class="box">';
    $html .= '<img src="images/' . $row['challenges_thumbnail'] . '" alt="">';
    $html .= '<h5 style="text-align: justify;"><span style="background-color: #ffeaf4;">' . $row['categories_name'] . '</span>'
            . '<span style="float: right; font-weight: normal; font-size: 1rem;">' . $row['challenges_date'] . '</span></h5>';

    $html .= '<h3>' . $row['challenges_title'] . '</h3>';
    $html .= '<p>' . $row['challenges_brief'] . '</p>';
    $html .= '<a href="challengesViewDetails.php?challenges_id=' . $row['challenges_id'] . '" target="_blank" class="btn">read more</a>';
    $html .= '</div>';
    $html .= '</section';
}

// Send the generated HTML back to the JavaScript
echo $html;

// Close the database connection
mysqli_close($dbc);
