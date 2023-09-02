<?php
include 'connect.php';
extract($_POST);

if (isset($pid)) {
    // Retrieve the product from the database
    $query = "SELECT * FROM product WHERE prod_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product found
        $product = $result->fetch_assoc();
        $response = array(
            'success' => true,
            'product' => array(
                'prod_id' => $product['prod_id'],
                'prod_name' => $product['prod_name'],
                'prod_desc' => $product['prod_desc'],
                'cat_id' => $product['cat_id'],
                'prod_price' => $product['prod_price'],
                'prod_imgpath' => $product['prod_imgpath']
            )
        );
        echo json_encode($response);
    } else {
        // Product not found
        $response = array('success' => false, 'message' => 'Product not found');
        echo json_encode($response);
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
