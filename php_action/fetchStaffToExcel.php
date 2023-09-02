<?php
include 'connect.php';

// Fetch staff data from the database
$query = "SELECT * FROM staff";
$result = $conn->query($query);

if ($result) {
    // Fetch successful
    $staffData = array();

    // Loop through the result and store staff data in an array
    while ($row = $result->fetch_assoc()) {
        $staffData[] = $row;
    }

    // Return the staff data as a JSON response
    $response = array('success' => true, 'staff' => $staffData);
    echo json_encode($response);
} else {
    // Fetch failed
    $response = array('success' => false, 'message' => 'Failed to fetch staff data');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
