<?php
// login.php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// Database connection settings
$host = 'localhost'; // or your database host
$dbname = 'fooddonation';
$dbuser = 'root';
$dbpass = '';

// Connect to the database
$connection = mysqli_connect($host, $dbuser, $dbpass, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


?>
