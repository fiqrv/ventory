<?php

include 'connect.php';
// Assuming you have already included the necessary files and established a database connection

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Replace with your own logic to fetch the product price from the database
    $sql = "SELECT prod_price FROM product WHERE prod_id = '$productId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $price = $row['prod_price'];

        // Return the price as JSON response
        echo json_encode(array('price' => $price));
    } else {
        // Handle the case when product price is not found
        echo json_encode(array('price' => 0));
    }
} else {
    // Handle the case when productId is not provided
    echo json_encode(array('price' => 0));
}
