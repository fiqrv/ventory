<?php
include 'connect.php';
extract($_POST);
if (isset($ing_name) && isset($ing_desc) && isset($ing_quantity) && isset($ing_uom)) {
    // File upload directory
    $uploadDir = '../uploads/';

    // Allowed picture file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');

    // Check if a file was uploaded
    if (isset($_FILES['ing_image']) && $_FILES['ing_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['ing_image']['name'];
        $fileTmp = $_FILES['ing_image']['tmp_name'];

        // Get the file extension
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if the file format is allowed
        if (in_array($fileExt, $allowedFormats)) {

            // Generate a unique file name based on the ingredient ID and file extension
            $newFileName = uniqid() . '.' . $fileExt;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);

            // Insert ingredient into the database
            $query = "INSERT INTO ingredient (ing_name, ing_imagepath, ing_desc, ing_quantity, ing_uom) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssis', $ing_name, $newFileName, $ing_desc, $ing_quantity, $ing_uom);

            if ($stmt->execute()) {
                // Insert successful
                $response = array('success' => true, 'message' => 'Ingredient inserted successfully');
                echo json_encode($response);
            } else {
                // Error occurred while inserting ingredient
                $response = array('success' => false, 'message' => 'Error inserting ingredient: ' . $stmt->error);
                echo json_encode($response);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Invalid file format
            $response = array('success' => false, 'message' => 'Only picture file formats (jpg, jpeg, png, gif) are allowed');
            echo json_encode($response);
        }
    } else {
        // No file was uploaded or an error occurred
        // Insert ingredient into the database without the image path

        // Insert ingredient into the database
        $query = "INSERT INTO ingredient (ing_name, ing_desc, ing_quantity, ing_uom) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssis', $ing_name, $ing_desc, $ing_quantity, $ing_uom);

        if ($stmt->execute()) {
            // Insert successful
            $response = array('success' => true, 'message' => 'Ingredient inserted successfully');
            echo json_encode($response);
        } else {
            // Error occurred while inserting ingredient
            $response = array('success' => false, 'message' => 'Error inserting ingredient: ' . $stmt->error);
            echo json_encode($response);
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
