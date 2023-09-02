<?php
include 'connect.php';

// Fetch staff data from the database
$query = "SELECT * FROM staff";
$result = $conn->query($query);

if ($result) {
    // Staff data fetched successfully
    $staffData = array();

    while ($row = $result->fetch_assoc()) {
        $staffData[] = $row;
    }

    $response = array('success' => true, 'staff' => $staffData);
} else {
    // Error fetching staff data
    $response = array('success' => false, 'message' => 'Failed to fetch staff data: ' . $conn->error);
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
