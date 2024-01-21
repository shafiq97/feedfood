<?php
// volunteer_history.php

include '../connect.php'; // Include your database connection script

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if accountNo is provided in the POST request
  if (isset($_POST['accountNo'])) {
    $accountNo = mysqli_real_escape_string($connection, $_POST['accountNo']);

    // Fetch the food post history from the database
    $query = "SELECT * FROM donation inner join food_posts on donation.foodPostId = food_posts.id inner join users on donation.userAccNo = users.accountNo";
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
          'CurrentTime' => $post['created_date'], // Assuming created_at is the relevant timestamp
          'Package' => $post['package'], // Assuming created_at is the relevant timestamp
          'DonorName' => $post['fname'] . " " .$post['lname'], // Assuming created_at is the relevant timestamp
          'ImgUrl' => $post['imgUrl'], // Assuming created_at is the relevant timestamp
          'DonationId' => $post['donationId'], // Assuming created_at is the relevant timestamp
          'DonorEmail' => $post['email'], 
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
