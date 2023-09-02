<?php
include 'connect.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "UPDATE category SET cat_name = '$name' WHERE cat_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Category updated successfully.";
    } else {
        echo "Error updating category: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Please provide a category ID.";
}
