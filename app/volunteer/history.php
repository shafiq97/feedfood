<?php
// volunteer_history.php

include '../connect.php'; // Include your database connection script

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if accountNo is provided in the POST request
  if (isset($_POST['accountNo'])) {
    $accountNo = mysqli_real_escape_string($connection, $_POST['accountNo']);

    // Fetch the food post history from the database
    $query = "SELECT * FROM food_posts WHERE sender_account_no = '$accountNo'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $foodPosts = mysqli_fetch_all($result, MYSQLI_ASSOC);

      // Convert the result to the format expected by the Flutter app
      $formattedPosts = array_map(function ($post) {
        return [
          'FoodDetails' => $post['food_details'],
          'FoodQuantity' => $post['food_quantity'],
          'CookingTime' => $post['cooking_time'],
          'Address' => $post['address'],
          'ZipCode' => $post['zip_code'],
          'Status' => $post['status'],
          'CurrentTime' => $post['created_at'], // Assuming created_at is the relevant timestamp
        ];
      }, $foodPosts);

      // Return the JSON encoded data
      echo json_encode(['request' => $formattedPosts]);
    } else {
      echo json_encode(['error' => 'Failed to fetch food post history.']);
    }
  } else {
    echo json_encode(['error' => 'Missing required fields']);
  }
} else {
  echo json_encode(['error' => 'Invalid request method']);
}
