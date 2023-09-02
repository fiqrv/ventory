<?php
// Assuming you have a database connection established
include 'connect.php';
// Check if the productId is provided in the POST request
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Fetch the product details from the database based on the productId
    $sql = "SELECT prod_name, prod_price FROM product WHERE prod_id = '$productId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the product details
        $row = mysqli_fetch_assoc($result);
        $name = $row['prod_name'];
        $price = $row['prod_price'];

        // Prepare the response as JSON
        $response = array(
            'name' => $name,
            'price' => $price
        );

        // Send the response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // No product found with the given productId
        // You can handle this case accordingly
        $response = array(
            'error' => 'Product not found'
        );

        // Send the error response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // No productId provided in the request
    // You can handle this case accordingly
    $response = array(
        'error' => 'Invalid request'
    );

    // Send the error response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
