<?php
include 'connect.php';

// Fetch customer data from the database
$query = "SELECT * FROM customers";
$result = $conn->query($query);

if ($result) {
    // Fetch successful
    $customerData = array();

    // Loop through the result and store customer data in an array
    while ($row = $result->fetch_assoc()) {
        $customerData[] = $row;
    }

    // Return the customer data as a JSON response
    $response = array('success' => true, 'customers' => $customerData);
    echo json_encode($response);
} else {
    // Fetch failed
    $response = array('success' => false, 'message' => 'Failed to fetch customer data');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
