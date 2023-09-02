<?php
include 'connect.php';

// Update Query
if (isset($_POST['pid'])) {
    // File upload directory
    $uploadDir = '../uploads/';

    // Allowed picture file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    extract($_POST);

    $productId = $pid;

    // Check if a file was uploaded
    if (isset($_FILES['prodimg']) && $_FILES['prodimg']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['prodimg']['name'];
        $fileTmp = $_FILES['prodimg']['tmp_name'];

        // Get the file extension
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if the file format is allowed
        if (in_array($fileExt, $allowedFormats)) {

            // Generate a unique file name based on the product ID and file extension
            $newFileName = $productId . '_' . uniqid() . '.' . $fileExt;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);

            // Update the prod_imgpath in the database for the product

            // Update product table
            $query = "UPDATE product SET prod_name=?, prod_desc=?, cat_id=?, prod_price=?, prod_imgpath=? WHERE prod_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssisi', $prodname, $proddesc, $prodcat, $prodprice, $newFileName, $productId);

            if ($stmt->execute()) {
                // Update successful
                $response = array('success' => true, 'message' => 'Product updated successfully');
                echo json_encode($response);
            } else {
                // Error occurred while updating product
                $response = array('success' => false, 'message' => 'Error updating product: ' . $stmt->error);
                echo json_encode($response);
            }

            // Close the statement and database connection
            $stmt->close();
            $conn->close();
        } else {
            // Invalid file format
            $response = array('success' => false, 'message' => 'Only picture file formats (jpg, jpeg, png, gif) are allowed');
            echo json_encode($response);
        }
    } else {
        // No file was uploaded or an error occurred
        // Update product table without updating the prod_imgpath

        // Update product table
        $query = "UPDATE product SET prod_name=?, prod_desc=?, cat_id=?, prod_price=? WHERE prod_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssii', $prodname, $proddesc, $prodcat, $prodprice, $productId);

        if ($stmt->execute()) {
            // Update successful
            $response = array('success' => true, 'message' => 'Product updated successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating product
            $response = array('success' => false, 'message' => 'Error updating product: ' . $stmt->error);
            echo json_encode($response);
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    }
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
