<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['orderId'])) {
    $orderId = $_POST['orderId'];

    // Perform any necessary validation or sanitization of the input data

    // Fetch the order details from the database based on the order ID
    $sql = "SELECT `order`.*, `customers`.`cus_name`
            FROM `order`
            INNER JOIN `customers` ON `order`.`cus_id` = `customers`.`cus_id`
            WHERE `order`.`order_id` = $orderId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Construct the order details array
        $orderDetails = array(
            'orderId' => $row['order_id'],
            'paymentMethod' => $row['order_paymentmethod'],
            'orderDetails' => $row['order_details'],
            'orderDate' => $row['order_date'],
            'orderStatus' => $row['order_status'],
            'totalPrice' => $row['total_price'],
            'customerName' => $row['cus_name']
        );

        // Fetch the product selections for the order
        $sql = "SELECT product.prod_name, product.prod_price
                FROM order_product
                INNER JOIN product ON order_product.prod_name = product.prod_name
                WHERE order_product.order_id = $orderId";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $productSelection = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $productSelection[] = array(
                    'prod_name' => $row['prod_name'],
                    'prod_price' => $row['prod_price']
                );
            }
            $orderDetails['productSelection'] = $productSelection;
        } else {
            $orderDetails['productSelection'] = array();
        }

        // Return the order details as JSON response
        header('Content-Type: application/json');
        echo json_encode($orderDetails);
    } else {
        // Handle order not found
        echo 'Order not found';
    }
} else {
    // Handle invalid or missing request parameters
    echo 'Invalid request';
}
