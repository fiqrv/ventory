<?php
include 'connect.php';
extract($_POST);

if (isset($iid)) {
    // Retrieve the ingredient from the database
    $query = "SELECT * FROM ingredient WHERE ing_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $iid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Ingredient found
        $ingredient = $result->fetch_assoc();
        $response = array('success' => true, 'ing_id' => $ingredient['ing_id'], 'ing_name' => $ingredient['ing_name'], 'ing_desc' => $ingredient['ing_desc'], 'ing_quantity' => $ingredient['ing_quantity'], 'ing_uom' => $ingredient['ing_uom'], 'ing_imagepath' => $ingredient['ing_imagepath']);
        echo json_encode($response);
    } else {
        // Ingredient not found
        $response = array('success' => false, 'message' => 'Ingredient not found');
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
