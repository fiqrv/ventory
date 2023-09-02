<?php
include 'connect.php';

// Fetch order data from the database
$query = "SELECT * FROM `order`";
$result = $conn->query($query);

if ($result) {
    // Fetch successful
    $orderData = array();

    // Loop through the result and store order data in an array
    while ($row = $result->fetch_assoc()) {
        $orderData[] = $row;
    }

    // Return the order data as a JSON response
    $response = array('success' => true, 'orders' => $orderData);
    echo json_encode($response);
} else {
    // Fetch failed
    $response = array('success' => false, 'message' => 'Failed to fetch order data');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
