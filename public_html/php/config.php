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
?>
