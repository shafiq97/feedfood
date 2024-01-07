<?php
// food_pending.php

include '../connect.php'; // Include your database connection script

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // The POST request should provide an account number to filter the pending requests.
  $accountNo = isset($_POST['SenderAccountNo']) ? $_POST['SenderAccountNo'] : false;

  // Fetch pending food requests from the 'food_posts' table where the status is 'new'
  $query = "SELECT * FROM donation inner join users on users.accountNo = donation.userAccNo inner join food_posts on food_posts.id = donation.foodPostId WHERE donation.status='pending'";

  // Prepare the statement to avoid SQL injection
  if ($stmt = mysqli_prepare($connection, $query)) {

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
      // Fetch the results into an associative array
      $foodRequests = mysqli_fetch_all($result, MYSQLI_ASSOC);
      echo json_encode(['request' => $foodRequests]);
    } else {
      echo json_encode(['error' => 'Failed to fetch food requests.']);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
  } else {
    echo json_encode(['error' => 'Failed to prepare the query.']);
  }
} else {
  echo json_encode(['error' => 'Invalid request method. Only POST is allowed.']);
}
