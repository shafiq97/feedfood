<?php
include '../connect.php'; // Include your database connection script


// Assuming POST request with 'completeFoodRequest' as the account number and 'id' as the food item
$completeFoodRequest = $_POST['completeFoodRequest'] ?? '';
$donationId = $_POST['donationId'] ?? '';

$response = array();
if ($completeFoodRequest != '' && $donationId != '') {
    $sql = "UPDATE donation SET status = 'completed' WHERE donationId = '$donationId'";
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
