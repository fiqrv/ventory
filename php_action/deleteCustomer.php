<?php
include 'connect.php';
extract($_POST);

if (isset($cuid)) {
    // Delete customer from the database
    $query = "DELETE FROM customers WHERE cus_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $cuid);

    if ($stmt->execute()) {
        // Deletion successful
        $response = array('success' => true, 'message' => 'Customer deleted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while deleting customer
        $response = array('success' => false, 'message' => 'Error deleting customer: ' . $stmt->error);
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
