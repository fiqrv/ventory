<?php
include 'connect.php';
extract($_POST);

if (isset($orderId)) {
    // Delete the order from the `order_product` table
    $deleteOrderProductQuery = "DELETE FROM order_product WHERE order_id = ?";
    $stmtOrderProduct = $conn->prepare($deleteOrderProductQuery);
    $stmtOrderProduct->bind_param('i', $orderId);

    if ($stmtOrderProduct->execute()) {
        // Order products deleted successfully

        // Delete the order from the `order` table
        $deleteOrderQuery = "DELETE FROM `order` WHERE order_id = ?";
        $stmtOrder = $conn->prepare($deleteOrderQuery);
        $stmtOrder->bind_param('i', $orderId);
        $stmtOrder->execute();

        $stmtOrder->close();

        // Return success response
        $response = array('success' => true, 'message' => 'Order deleted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while deleting order products
        $response = array('success' => false, 'message' => 'Error deleting order products: ' . $stmtOrderProduct->error);
        echo json_encode($response);
    }

    // Close the statement
    $stmtOrderProduct->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
