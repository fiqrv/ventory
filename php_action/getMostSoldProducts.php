<?php
include 'connect.php';

$sql = "SELECT prod_name, COUNT(*) AS totalSales FROM order_product GROUP BY prod_name ORDER BY totalSales DESC";
$result = mysqli_query($conn, $sql);

$mostSoldProductsData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $prodName = $row['prod_name'];
    $totalSales = $row['totalSales'];

    $mostSoldProductsData[] = array(
        'prod_name' => $prodName,
        'totalSales' => $totalSales
    );
}

$response = array(
    'mostSoldProductsData' => $mostSoldProductsData
);

header('Content-Type: application/json');
echo json_encode($response);
