<?php
include 'connect.php';

// Check if the orderId parameter is set
if (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];

    // Fetch product names for the specified order from the order_product table
    $query = "SELECT prod_name FROM order_product WHERE order_id = '$orderId'";
    $result = $conn->query($query);

    if ($result) {
        // Fetch successful
        $productData = array();

        // Loop through the result and store product names in an array
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
} else {
    // orderId parameter is not set
    $response = array('success' => false, 'message' => 'Invalid request');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
