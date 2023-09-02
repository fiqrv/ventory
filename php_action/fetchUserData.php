<?php
// Assuming you have established a mysqli connection and stored it in the $conn variable.
session_start(); // Start the session
// check if user is not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'connect.php';
    // Check if the $_SESSION['id'] is set
    if (isset($_SESSION['id'])) {
        // Prepare and execute the query
        $query = "SELECT * FROM staff WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the row as an associative array
            $row = $result->fetch_assoc();

            // Create an associative array with the column values
            $data = array(
                'id' => $row['id'],
                'email' => $row['email'],
                'password' => $row['password'],
                'role' => $row['role'],
                'fullname' => $row['fullname'],
                'address' => $row['address'],
                'phone_num' => $row['phone_num'],
                'gender' => $row['gender'],
                'age' => $row['age'],
                'birth_date' => $row['birth_date'],
                'joined_date' => $row['joined_date'],
                'status' => $row['status'],
                'picture_path' => $row['picture_path'],
            );

            // Send the response as JSON
            echo json_encode($data);
        } else {
            echo "No data found.";
        }

        $stmt->close();
    } else {
        echo "Session ID not set.";
    }
} else {
    echo "Invalid request method.";
}
