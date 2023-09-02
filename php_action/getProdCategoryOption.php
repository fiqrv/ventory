<?php
include 'connect.php';
$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $cat_id = $row['cat_id'];
    $cat_name = $row['cat_name'];
    echo '<option value="' . $cat_id . '">' . $cat_name . '</option>';
}

mysqli_close($conn);
