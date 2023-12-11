<?php
// register.php
header('Content-Type: application/json');

include '../connect.php'; // Include your database connection script

// Function to validate if a string is empty or null
function isNullOrEmptyString($str)
{
  return (!isset($str) || trim($str) === '');
}

// Check if the request is for a volunteer or an NGO
if (isset($_POST['volunteer'])) {
  // Volunteer registration
  $username = $_POST['username'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $password = $_POST['password'] ?? ''; // This should be hashed before storing

  // Additional validation and checks can be added here

  // Insert into database
  $query = "INSERT INTO users (username, email, phone, password, type) VALUES ('$username', '$email', '$phone', '$password', 'volunteer')";
  if (mysqli_query($connection, $query)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
  }
} elseif (isset($_POST['ngo'])) {
  // NGO registration
  $ngoName = $_POST['ngoName'] ?? '';
  $ngoId = $_POST['ngoId'] ?? '';
  $ngoType = $_POST['ngoType'] ?? '';
  $email = $_POST['email'] ?? '';
  $phone = $_POST['phone'] ?? '';
  $address = $_POST['address'] ?? '';
  $pincode = $_POST['pincode'] ?? '';
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? ''; // This should be hashed before storing

  // Additional validation and checks can be added here

  // Insert into database
  $query = "INSERT INTO users (ngoName, ngoId, ngoType, email, phone, address, pincode, username, password, type) VALUES ('$ngoName', '$ngoId', '$ngoType', '$email', '$phone', '$address', '$pincode', '$username', '$password', 'ngo')";
  if (mysqli_query($connection, $query)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false, 'error' => mysqli_error($connection)]);
  }
} else {
  echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
