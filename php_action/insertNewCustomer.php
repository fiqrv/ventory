<?php
include 'connect.php';
extract($_POST);

if (isset($cusName) && isset($cusEmail) && isset($cusPhone) && isset($cusAddress) && isset($cusDOB)) {
    // Insert customer into the database
    $query = "INSERT INTO customers (cus_name, cus_email, cus_phone, cus_address, cus_dob) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssss', $cusName, $cusEmail, $cusPhone, $cusAddress, $cusDOB);

    if ($stmt->execute()) {
        // Insert successful
        $response = array('success' => true, 'message' => 'Customer inserted successfully');
        echo json_encode($response);
    } else {
        // Error occurred while inserting customer
        $response = array('success' => false, 'message' => 'Error inserting customer: ' . $stmt->error);
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
