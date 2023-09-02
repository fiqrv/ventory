<?php
include 'connect.php';
extract($_POST);
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM staff WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Record with ID $id deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Please provide an ID.";
}
