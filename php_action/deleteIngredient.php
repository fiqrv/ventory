<?php
include 'connect.php';
extract($_POST);

if (isset($iid)) {
    // Delete ingredient from the database
    $query = "DELETE FROM ingredient WHERE ing_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $iid);

    if ($stmt->execute()) {
        // Deletion successful
        $response = array('success' => true, 'message' => 'Ingredient deleted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while deleting ingredient
        $response = array('success' => false, 'message' => 'Error deleting ingredient: ' . $stmt->error);
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
