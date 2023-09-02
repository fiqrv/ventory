<?php
include 'connect.php';

// Fetch ingredient data from the database
$query = "SELECT * FROM ingredient";
$result = $conn->query($query);

if ($result) {
    // Fetch successful
    $ingredientData = array();

    // Loop through the result and store ingredient data in an array
    while ($row = $result->fetch_assoc()) {
        $ingredientData[] = $row;
    }

    // Return the ingredient data as a JSON response
    $response = array('success' => true, 'ingredients' => $ingredientData);
    echo json_encode($response);
} else {
    // Fetch failed
    $response = array('success' => false, 'message' => 'Failed to fetch ingredient data');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
