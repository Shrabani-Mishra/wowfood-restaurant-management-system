<?php
//start session
    session_start();
    //create constants
define('SITEURL','http://localhost/resturant/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');     // use underscore instead of dash
define('DB_PASSWORD', '');
define('DB_NAME', 'resturant');    // make sure DB name is correct in phpMyAdmin

// Create connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>