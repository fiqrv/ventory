<?php
include 'connect.php';

if (isset($_POST['query'])) {
    $search = $_POST['query'];

    $sql = "SELECT cus_id, cus_name FROM customers WHERE cus_name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customerId = $row['cus_id'];
            $customerName = $row['cus_name'];

            echo '<li data-id="' . $customerId . '">' . $customerName . '</li>';
        }
    } else {
        echo '<li>No customer found</li>';
    }
}
