<?php
include 'connect.php';

if (isset($_GET['productName'])) {
    $productName = $_GET['productName'];

    $sql = "SELECT * FROM product WHERE prod_name LIKE '%$productName%'";
    $result = mysqli_query($conn, $sql);

    $products = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product = array(
            'prod_id' => $row['prod_id'],
            'prod_name' => $row['prod_name']
        );
        $products[] = $product;
    }

    echo json_encode($products);
} else {
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);

    $products = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $product = array(
            'prod_id' => $row['prod_id'],
            'prod_name' => $row['prod_name']
        );
        $products[] = $product;
    }

    echo json_encode($products);
}
