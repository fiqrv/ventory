<?php
include 'connect.php';

// Update Query
if (isset($_POST['ingId'])) {
    // File upload directory
    $uploadDir = '../uploads/';

    // Allowed picture file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    extract($_POST);

    $ingId = $ingId;

    // Check if a file was uploaded
    if (isset($_FILES['ingImagePath']) && $_FILES['ingImagePath']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['ingImagePath']['name'];
        $fileTmp = $_FILES['ingImagePath']['tmp_name'];

        // Get the file extension
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if the file format is allowed
        if (in_array($fileExt, $allowedFormats)) {

            // Generate a unique file name based on the ingredient ID and file extension
            $newFileName = $ingId . '_' . uniqid() . '.' . $fileExt;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);

            // Update the ing_imagepath in the database for the ingredient

            // Update ingredient table
            $query = "UPDATE ingredient SET ing_name=?, ing_desc=?, ing_quantity=?, ing_uom=?, ing_imagepath=? WHERE ing_id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssi', $ingName, $ingDesc, $ingQuantity, $ingUOM, $newFileName, $ingId);

            if ($stmt->execute()) {
                // Update successful
                $response = array('success' => true, 'message' => 'Ingredient updated successfully');
                echo json_encode($response);
            } else {
                // Error occurred while updating ingredient
                $response = array('success' => false, 'message' => 'Error updating ingredient: ' . $stmt->error);
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
        // Update ingredient table without updating the ing_imagepath

        // Update ingredient table
        $query = "UPDATE ingredient SET ing_name=?, ing_desc=?, ing_quantity=?, ing_uom=? WHERE ing_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $ingName, $ingDesc, $ingQuantity, $ingUOM, $ingId);

        if ($stmt->execute()) {
            // Update successful
            $response = array('success' => true, 'message' => 'Ingredient updated successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating ingredient
            $response = array('success' => false, 'message' => 'Error updating ingredient: ' . $stmt->error);
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
