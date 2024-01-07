<?php
include '../connect.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['volunteerId'], $_POST['foodId'])) {
    $volunteerId = $_POST['volunteerId'];
    $foodId = $_POST['foodId'];

    // Prepare SQL query to insert the donation record
    $stmt = $connection->prepare("INSERT INTO donation (userAccNo, foodPostId) VALUES (?, ?)");
    $stmt->bind_param("si", $volunteerId, $foodId); // Assuming both IDs are integers

    if ($stmt->execute()) {
        $response = ['success' => true, 'message' => 'Donation recorded successfully.'];
    } else {
        $response = ['success' => false, 'message' => 'Failed to record the donation.', 'error' => $stmt->error];
    }
    $stmt->close();
} else {
    $response = ['success' => false, 'message' => 'Required fields are missing.'];
}

$connection->close();
header('Content-Type: application/json');
echo json_encode($response);
?>
