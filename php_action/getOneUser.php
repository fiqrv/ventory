<?php
include 'connect.php';

if (isset($_POST['uid'])) {
    $id = $_POST['uid'];

    $sql = "SELECT * FROM staff WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;
    }
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Data not found";
}
