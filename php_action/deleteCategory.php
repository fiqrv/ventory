<?php
include 'connect.php';
extract($_POST);

if (isset($_POST['catId'])) {
    $catId = $_POST['catId'];

    $sql = "DELETE FROM category WHERE cat_id = '$catId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Category with ID $catId deleted successfully.";
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Please provide a category ID.";
}
