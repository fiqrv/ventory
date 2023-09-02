<?php
include 'connect.php';

$sql = "SELECT order_paymentmethod AS paymentMethod, 
               MONTHNAME(order_date) AS month,
               COUNT(*) AS transactionCounts
        FROM `order`
        GROUP BY paymentMethod, month
        ORDER BY transactionCounts DESC";
$result = mysqli_query($conn, $sql);

$paymentMethodData = array();
$months = array();

while ($row = mysqli_fetch_assoc($result)) {
    $paymentMethod = $row['paymentMethod'];
    $month = $row['month'];
    $transactionCounts = $row['transactionCounts'];

    if (!in_array($month, $months)) {
        $months[] = $month;
    }

    // Find the payment method in the data array
    $methodIndex = array_search($paymentMethod, array_column($paymentMethodData, 'paymentMethod'));
    if ($methodIndex !== false) {
        // Add the transaction count for the month to the existing payment method
        $paymentMethodData[$methodIndex]['transactionCounts'][] = $transactionCounts;
    } else {
        // Add a new payment method with the transaction count for the month
        $paymentMethodData[] = array(
            'paymentMethod' => $paymentMethod,
            'transactionCounts' => array($transactionCounts)
        );
    }
}

$response = array(
    'paymentMethodData' => $paymentMethodData,
    'months' => $months
);

header('Content-Type: application/json');
echo json_encode($response);
