<?php
// profile.php

include '../connect.php'; // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['accountNo'], $_POST['update']) && $_POST['update'] === 'true') {
    // Handle profile update
    $accountNo = mysqli_real_escape_string($connection, $_POST['accountNo']);
    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $pincode = mysqli_real_escape_string($connection, $_POST['pincode']);

    $query = "UPDATE users SET fname = '$fname', lname = '$lname', address = '$address', pincode = '$pincode' WHERE accountNo = '$accountNo'";
    if (mysqli_query($connection, $query)) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
    }
  } elseif (isset($_POST['accountNo'])) {
    // Handle profile retrieval
    $accountNo = mysqli_real_escape_string($connection, $_POST['accountNo']);
    $query = "SELECT fname, lname, address, pincode, email, phone FROM users WHERE accountNo = '$accountNo'";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $user = mysqli_fetch_assoc($result);

      if ($user) {
        $response = [
          'fname' => $user['fname'] ?? '',
          'lname' => $user['lname'] ?? '',
          'address' => $user['address'] ?? '',
          'pincode' => $user['pincode'] ?? '',
          'email' => $user['email'] ?? '',
          'phone' => $user['phone'] ?? '',
        ];
        echo json_encode($response);
      } else {
        echo json_encode(['error' => 'User not found.']);
      }
    } else {
      echo json_encode(['error' => 'Query failed.']);
    }
  } else {
    echo json_encode(['error' => 'Required fields missing.']);
  }
} else {
  echo json_encode(['error' => 'Invalid request method.']);
}
