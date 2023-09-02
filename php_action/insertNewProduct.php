<?php
include 'connect.php';
extract($_POST);

if (isset($prodName) && isset($prodDesc) && isset($prodCat) && isset($prodPrice)) {
    // File upload directory
    $uploadDir = 'uploads/';

    // Default image path
    $defaultImage = 'food_default.png';

    // Check if the category exists
    $checkCategoryQuery = "SELECT * FROM category WHERE cat_id = ?";
    $checkCategoryStmt = $conn->prepare($checkCategoryQuery);
    $checkCategoryStmt->bind_param('i', $prodCat);
    $checkCategoryStmt->execute();
    $checkCategoryResult = $checkCategoryStmt->get_result();

    if ($checkCategoryResult->num_rows > 0) {
        // Insert product into the database
        $query = "INSERT INTO product (prod_name, prod_imgpath, prod_desc, prod_price, cat_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $prodName, $defaultImage, $prodDesc, $prodPrice, $prodCat);

        if ($stmt->execute()) {
            // Insert successful
            $response = array('success' => true, 'message' => 'Product inserted successfully');
            echo json_encode($response);
        } else {
            // Error occurred while inserting product
            $response = array('success' => false, 'message' => 'Error inserting product: ' . $stmt->error);
            echo json_encode($response);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Category does not exist
        $response = array('success' => false, 'message' => 'Invalid category');
        echo json_encode($response);
    }

    // Close the category statement
    $checkCategoryStmt->close();

    // Close the database connection
    $conn->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
