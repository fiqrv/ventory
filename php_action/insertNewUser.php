<?php
include 'connect.php';
extract($_POST);
if (isset($email) && isset($pass) && isset($role) && isset($fname) && isset($addr) && isset($pnum) && isset($gen) && isset($age) && isset($bdate) && isset($jdate) && isset($stat)) {
    // File upload directory
    $uploadDir = '../uploads/';

    // Allowed picture file formats
    $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');


    // Convert role value to enum string
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

    // Convert gender value to enum string
    if ($gen === '1') {
        $gen = 'Female';
    } else {
        $gen = 'Male'; // Default value if no matching option value is found
    }

    // Convert status value to enum string
    if ($stat === '1') {
        $stat = 'Not active';
    } else {
        $stat = 'Active'; // Default value if no matching option value is found
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
            $newFileName = uniqid() . '.' . $fileExt;

            // Move the uploaded file to the desired location
            move_uploaded_file($fileTmp, $uploadDir . $newFileName);

            // Insert user into the database
            $query = "INSERT INTO staff (email, password, role, fullname, address, phone_num, gender, age, birth_date, joined_date, status, picture_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssssssssssss', $email, $pass, $role, $fname, $addr, $pnum, $gen, $age, $bdate, $jdate, $stat, $newFileName);

            if ($stmt->execute()) {
                // Insert successful
                $response = array('success' => true, 'message' => 'User inserted successfully');
                echo json_encode($response);
            } else {
                // Error occurred while inserting user
                $response = array('success' => false, 'message' => 'Error inserting user: ' . $stmt->error);
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
        // Insert user into the database without the picture_path

        // Insert user into the database
        $query = "INSERT INTO staff (email, password, role, fullname, address, phone_num, gender, age, birth_date, joined_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssssissss', $email, $pass, $role, $fname, $addr, $pnum, $gen, $age, $bdate, $jdate, $stat);

        if ($stmt->execute()) {
            // Insert successful
            $response = array('success' => true, 'message' => 'User inserted successfully');
            echo json_encode($response);
        } else {
            // Error occurred while inserting user
            $response = array('success' => false, 'message' => 'Error inserting user: ' . $stmt->error);
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
