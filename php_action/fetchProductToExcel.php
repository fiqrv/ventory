<?php
include 'connect.php';

// Fetch product data from the database
$query = "SELECT * FROM product";
$result = $conn->query($query);

if ($result) {
    // Fetch successful
    $productData = array();

    // Loop through the result and store product data in an array
    while ($row = $result->fetch_assoc()) {
        $productData[] = $row;
    }

    // Return the product data as a JSON response
    $response = array('success' => true, 'products' => $productData);
    echo json_encode($response);
} else {
    // Fetch failed
    $response = array('success' => false, 'message' => 'Failed to fetch product data');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
