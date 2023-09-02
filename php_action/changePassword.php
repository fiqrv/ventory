<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    include 'connect.php';

    // Check if the current password is correct
    $checkQuery = "SELECT * FROM staff WHERE id=? AND password=?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param('is', $id, $currentPassword);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows === 0) {
        // Current password is incorrect, handle the error
        $response = array('success' => false, 'message' => 'Current password is incorrect');
        echo json_encode($response);
    } else {
        // Current password is correct, update the password
        $updateQuery = "UPDATE staff SET password=? WHERE id=?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('si', $newPassword, $id);

        if ($updateStmt->execute()) {
            // Password updated successfully
            $response = array('success' => true, 'message' => 'Password changed successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating password
            $response = array('success' => false, 'message' => 'Error changing password: ' . $updateStmt->error);
            echo json_encode($response);
        }

        $updateStmt->close();
    }

    $checkStmt->close();
    $conn->close();
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}
