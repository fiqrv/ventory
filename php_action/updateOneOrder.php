<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];
    $orderStatus = $_POST['orderStatus'];
    $orderDate = $_POST['orderDate'];
    $orderDetails = $_POST['orderDetails'];
    $paymentMethod = $_POST['paymentMethod'];

    // Perform any necessary validation or sanitization of the input data

    // Update the order details in the database
    $sql = "UPDATE `order` SET
                `order_status` = '$orderStatus',
                `order_date` = '$orderDate',
                `order_details` = '$orderDetails',
                `order_paymentmethod` = '$paymentMethod'
            WHERE `order_id` = $orderId";

    if (mysqli_query($conn, $sql)) {
        // Order update was successful
        $response = array(
            'success' => true,
            'message' => 'Order updated successfully'
        );
    } else {
        // Order update failed
        $response = array(
            'success' => false,
            'message' => 'Failed to update order'
        );
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Handle invalid or missing request parameters
    $response = array(
        'success' => false,
        'message' => 'Invalid request'
    );

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
