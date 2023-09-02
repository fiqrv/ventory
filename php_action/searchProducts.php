<?php
include 'connect.php';

if (isset($_POST['query'])) {
    $searchQuery = $_POST['query'];

    $sql = "SELECT * FROM product WHERE prod_name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li data-input-id="productName">' . $row['prod_name'] . '</li>';
            }
        } else {
            echo '<li>No products found</li>';
        }
    } else {
        echo '<li>Error: ' . mysqli_error($conn) . '</li>';
    }
}
