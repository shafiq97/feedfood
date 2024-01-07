<?php
include 'connect.php'; // Include your database connection script

// Check connection first
if ($connection->connect_error) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit(); // Exit the script if connection is not established
}

$query = "SELECT * FROM food_posts"; // Replace with your table and column names
$result = $connection->query($query);

if (!$result) {
    echo "Error: " . $connection->error;
    exit(); // Exit the script in case of query error
}

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array( // Corrected line: added [] to add to array
            'foodId' => $row['id'], // Assuming 'id' is the column name for food ID
            'foodDetails' => $row['food_details'], // Assuming 'food_details' is the column name
            // Add more fields from the row as needed
        );
    }
}

// Close the connection
$connection->close();

// Output as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
