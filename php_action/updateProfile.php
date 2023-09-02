<?php
include 'connect.php';

// Update Query
if (isset($_POST['id'])) {
    // File upload directory
    $uploadDir = '../uploads/';

    // Allowed picture file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
    extract($_POST);

    $id = $id;

    // Convert the role value to a corresponding string
    if ($role === '1') {
        $role = 'Manager';
    } else if ($role === '2') {
        $role = 'Cashier';
    } else if ($role === '3') {
        $role = 'Chef';
    } else if ($role === '4') {
        $role = 'Waiter';
    } else {
        $role = 'Admin'; // Default value if no matching option value is found
    }

    // Convert the gender value to a corresponding string
    if ($gender === '1') {
        $gender = 'Female';
    } else {
        $gender = 'Male'; // Default value if no matching option value is found
    }

    // Convert the status value to a corresponding string
    if ($status === '1') {
        $status = 'Not active';
    } else {
        $status = 'Active'; // Default value if no matching option value is found
    }

    // Check if a file was uploaded
    if (isset($_FILES['ppath']) && $_FILES['ppath']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['ppath']['name'];
        $fileTmp = $_FILES['ppath']['tmp_name'];

        // Get the file extension
        $fileExt = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        // Check if the file format is allowed
        if (in_array($fileExt, $allowedFormats)) {

            // Generate a unique file name based on the user ID and file extension
            $newFileName = $id . '_' . uniqid() . '.' . $fileExt;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);

            // Update the picture_path in the database for the user

            // Update user table
            $query = "UPDATE staff SET email=?, role=?, fullname=?, address=?, phone_num=?, gender=?, age=?, birth_date=?, joined_date=?, status=?, picture_path=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssssssssi', $email, $role, $fullname, $address, $phone, $gender, $age, $birthdate, $joineddate, $status, $newFileName, $id);

            if ($stmt->execute()) {
                // Update successful
                $response = array('success' => true, 'message' => 'User updated successfully');
                echo json_encode($response);
            } else {
                // Error occurred while updating user
                $response = array('success' => false, 'message' => 'Error updating user: ' . $stmt->error);
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
        // Update user table without updating the picture_path

        // Update user table
        $query = "UPDATE staff SET email=?, role=?, fullname=?, address=?, phone_num=?, gender=?, age=?, birth_date=?, joined_date=?, status=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssisssi', $email, $role, $fullname, $address, $phone, $gender, $age, $birthdate, $joineddate, $status, $id);

        if ($stmt->execute()) {
            // Update successful
            $response = array('success' => true, 'message' => 'User updated successfully');
            echo json_encode($response);
        } else {
            // Error occurred while updating user
            $response = array('success' => false, 'message' => 'Error updating user: ' . $stmt->error);
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
