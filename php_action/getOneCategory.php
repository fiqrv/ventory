<?php
include 'connect.php';

if (isset($_POST['cid'])) {
    $id = $_POST['cid'];

    $sql = "SELECT * FROM category WHERE cat_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $response = $row;
    }
    echo json_encode($response);
} else {
    $response['status'] = 200;
    $response['message'] = "Data not found";
    echo json_encode($response);
}
