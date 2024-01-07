<?php
include '../connect.php'; // Include your database connection script


// Assuming POST request with 'completeFoodRequest' as the account number and 'id' as the food item
$newImageUrl = $_POST['newImageUrl'] ?? '';
$donationId = $_POST['donationId'] ?? '';

$response = array(); // Initialize response array

try {
    // Check if the new image URL and donation ID are not empty
    if ($newImageUrl != '' && $donationId != '') {
        $sql = "UPDATE donation SET imgUrl = '$newImageUrl' WHERE donationId = '$donationId'";
        
        // Attempt to execute the query
        if ($connection->query($sql) === TRUE) {
            $response['success'] = true;
        } else {
            throw new Exception($connection->error); // Throw an exception if query failed
        }
    } else {
        throw new Exception("Image URL or Donation ID is empty"); // Throw exception if inputs are empty
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage(); // Store the error message in response
}

// Return or print the response here
// For example:
echo json_encode($response);
?>
