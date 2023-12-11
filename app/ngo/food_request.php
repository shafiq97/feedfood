<?php
// food_request.php

include '../connect.php'; // Include your database connection script

// Check if it's a POST request and if the accountNo is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Fetch food requests from the 'food_posts' table for the specified accountNo
    $query = "SELECT * FROM food_posts";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $foodRequests = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode(['request' => $foodRequests]);
    } else {
        echo json_encode(['error' => 'Failed to fetch food requests.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method or missing account number']);
}
?>
