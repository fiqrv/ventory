<?php
include 'connect.php';
extract($_POST);

if (isset($catName)) {
    // Insert category into the database
    $query = "INSERT INTO category (cat_name) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $catName);

    if ($stmt->execute()) {
        // Insert successful
        $response = array('success' => true, 'message' => 'Category inserted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while inserting category
        $response = array('success' => false, 'message' => 'Error inserting category: ' . $stmt->error);
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();

    // Close the database connection
    $conn->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}
