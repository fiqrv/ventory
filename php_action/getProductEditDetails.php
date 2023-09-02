<?php

include 'connect.php';

$orderId = $_POST['orderId'];

// Query the order_product table to fetch the product names
$sql = "SELECT prod_name FROM order_product
        INNER JOIN product ON order_product.prod_id = product.prod_id
        WHERE order_product.order_id = '$orderId'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $productNames = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $productNames[] = $row['prod_name'];
    }

    $response = array('productNames' => $productNames);
} else {
    $response = array('productNames' => array());
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($response);
