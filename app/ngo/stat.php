<?php
// stat.php

include '../connect.php'; // Include your database connection script

if (isset($_POST['getStat'])) {
    $accountNo = mysqli_real_escape_string($connection, $_POST['getStat']);

    // Adjust these queries to match the 'food_posts' table and your application logic
    $newQuery = "SELECT COUNT(*) AS newCount FROM food_posts WHERE status = 'new'";
    $pendingQuery = "SELECT COUNT(*) AS pendingCount FROM food_posts WHERE status = 'pending'";
    $completedQuery = "SELECT COUNT(*) AS completedCount FROM food_posts WHERE status = 'completed'";

    $newResult = mysqli_query($connection, $newQuery);
    $pendingResult = mysqli_query($connection, $pendingQuery);
    $completedResult = mysqli_query($connection, $completedQuery);

    if ($newResult && $pendingResult && $completedResult) {
        $newCount = mysqli_fetch_assoc($newResult)['newCount'];
        $pendingCount = mysqli_fetch_assoc($pendingResult)['pendingCount'];
        $completedCount = mysqli_fetch_assoc($completedResult)['completedCount'];

        echo json_encode(['new' => $newCount, 'pending' => $pendingCount, 'completed' => $completedCount]);
    } else {
        echo json_encode(['error' => 'Failed to fetch statistics.']);
    }
} else {
    echo json_encode(['error' => 'Missing required fields']);
}
?>
