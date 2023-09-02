<?php
include 'connect.php';

$sql = "SELECT MONTH(order_date) AS month, SUM(total_price) AS totalSales
        FROM `order`
        GROUP BY MONTH(order_date)";
$result = mysqli_query($conn, $sql);

$salesData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $salesData[] = $row;
}

$response = array(
    'salesData' => $salesData
);

header('Content-Type: application/json');
echo json_encode($response);
