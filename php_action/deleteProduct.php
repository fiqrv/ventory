<?php
include 'connect.php';
extract($_POST);

if (isset($pid)) {
    // Delete product from the database
    $query = "DELETE FROM product WHERE prod_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $pid);

    if ($stmt->execute()) {
        // Deletion successful
        $response = array('success' => true, 'message' => 'Product deleted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while deleting product
        $response = array('success' => false, 'message' => 'Error deleting product: ' . $stmt->error);
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
