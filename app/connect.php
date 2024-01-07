<?php
// login.php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Content-type:application/json;charset=utf-8"); 
header("Access-Control-Allow-Methods: GET");
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
