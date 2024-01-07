<?php
include '../connect.php'; // Include your database connection script

// Assuming POST request with 'AccountNo' and 'id' for food item
$accountNo = $_POST['AccountNo'] ?? '';
$foodId = $_POST['id'] ?? '';

$response = array();
if ($accountNo != '' && $foodId != '') {
    $sql = "SELECT * FROM food_posts inner join users on food_posts.sender_account_no = users.accountNo WHERE sender_account_no = '$accountNo' AND food_posts.id = '$foodId'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response = $row;
            $response['success'] = true;
        }
    } else {
        $response['success'] = false;
    }
} else {
    $response['success'] = false;
}

echo json_encode($response);
?>
