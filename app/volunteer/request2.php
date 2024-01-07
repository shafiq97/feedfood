<?php
// Assuming 'volunteer_post.php' is the endpoint

include '../connect.php'; // Include your database connection script

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['FoodRequest'], $_POST['SenderAccountNo'], $_POST['FoodDetails'], $_POST['FoodQuantity'], $_POST['CookingTime'], $_POST['Address'], $_POST['ZipCode'], $_POST['longitude'], $_POST['latitude'], $_POST['Status'])) {
    // Retrieve POST data
    $senderAccountNo = mysqli_real_escape_string($connection, $_POST['SenderAccountNo']);
    $foodDetails = mysqli_real_escape_string($connection, $_POST['FoodDetails']);
    $foodQuantity = mysqli_real_escape_string($connection, $_POST['FoodQuantity']);
    $cookingTime = mysqli_real_escape_string($connection, $_POST['CookingTime']);
    $address = mysqli_real_escape_string($connection, $_POST['Address']);
    $zipCode = mysqli_real_escape_string($connection, $_POST['ZipCode']);
    $longitude = mysqli_real_escape_string($connection, $_POST['longitude']);
    $latitude = mysqli_real_escape_string($connection, $_POST['latitude']);
    $status = mysqli_real_escape_string($connection, $_POST['Status']);

    // Insert data into your database
    $query = "INSERT INTO food_posts (sender_account_no, food_details, food_quantity, cooking_time, address, zip_code, longitude, latitude, status) VALUES ('$senderAccountNo', '$foodDetails', '$foodQuantity', '$cookingTime', '$address', '$zipCode', '$longitude', '$latitude', '$status')";

    if (mysqli_query($connection, $query)) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
    }
  } else {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
  }
} else {
  echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
