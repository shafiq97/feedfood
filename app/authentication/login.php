<?php
// Assuming you have an include file 'connect.php' that sets up the database connection
include '../connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);

        if ($user && $password == $user['password']) { // Assuming password is stored in plain text
            echo json_encode([
                'success' => true, 
                'message' => 'Login successful.',
                'type' => $user['type'],
                'accountNo' => $user['accountNo'],
                'username' => $user['username']
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid username or password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Query failed.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username and password required.']);
}
?>
