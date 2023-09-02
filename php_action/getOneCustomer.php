<?php
include 'connect.php';

if (isset($_POST['cuid'])) {
    $cuid = $_POST['cuid'];

    $query = "SELECT * FROM customers WHERE cus_id = '$cuid'";
    $result = mysqli_query($conn, $query);
    $response = array();

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response = $row;
        echo json_encode($response);
    } else {
        $response['status'] = 200;
        $response['message'] = "Data not found";
        echo json_encode($response);
    }
} else {
    $response['status'] = 400;
    $response['message'] = "Invalid request or missing parameters";
    echo json_encode($response);
}

mysqli_close($conn);
