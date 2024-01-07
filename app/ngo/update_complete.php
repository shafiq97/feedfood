<?php
include '../connect.php'; // Include your database connection script


// Assuming POST request with 'completeFoodRequest' as the account number and 'id' as the food item
$completeFoodRequest = $_POST['completeFoodRequest'] ?? '';
$foodId = $_POST['id'] ?? '';

$response = array();
if ($completeFoodRequest != '' && $foodId != '') {
    $sql = "UPDATE food_posts SET status = 'completed' WHERE id = '$foodId'";
    if ($connection->query($sql) === TRUE) {
        $response['success'] = true;
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
