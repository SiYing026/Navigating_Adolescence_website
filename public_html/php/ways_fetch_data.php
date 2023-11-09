<?php //

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

// Build an SQL query to fetch items based on the selected category
if ($selectedCategory == "*") {
    $query = 'SELECT ways.*, categories.categories_name, experts.experts_name 
              FROM ways 
              JOIN categories ON ways.categories_id = categories.categories_id
              JOIN experts ON ways.experts_id = experts.experts_id';
} else {
    $query = "SELECT ways.*, categories.categories_name, experts.experts_name 
              FROM ways 
              JOIN categories ON ways.categories_id = categories.categories_id
              JOIN experts ON ways.experts_id = experts.experts_id
              WHERE categories.categories_name = ?";
}

// Prepare and execute the query
$stmt = mysqli_prepare($dbc, $query);
if ($stmt === false) {
    echo 'Error preparing the query: ' . mysqli_error($dbc);
    exit();
}

// Bind parameters and execute the query
// Bind parameters and execute the query
if ($selectedCategory !== "*") {
    // You need to bind both category and expert name here
    mysqli_stmt_bind_param($stmt, 'ss', $selectedCategory, $selectedExpertName);
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
    $html .= '<section class="course-2">';
        $html .= '<div class="box">';
            $html .= '<div class="image">';
            $html .= '<img src="images/' . $row['ways_thumbnail'] . '" alt="">';
            $html .= '</div>';

        $html .= '<div class="content">';
            $html .= '<span>' . $row['categories_name'] . '</span>';
            $html .= '<h3>' . $row['ways_title'] . '</h3>';
            $html .= '<p>' . $row['ways_brief'] . '</p>';
            $html .= '<a href="waysViewDetails.php?ways_id=' . $row['ways_id'] . '" target="_blank" class="btn">read more</a>';
            $html .= '
            <div class="icons">
                <a> <i class="fas fa-address-book"></i> '. $row['experts_name'] . '</a>
                <a> <i class=""></i></a>
            </div>';
        $html .= '</div>';
        $html .= '</div>';
    $html .= '</section>';
    
        
}

// Send the generated HTML back to the JavaScript
echo $html;

// Close the database connection
mysqli_close($dbc);

?>
