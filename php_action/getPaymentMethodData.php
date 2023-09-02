<?php
// Assuming you have a database connection established
include 'connect.php';

// Query to retrieve payment method data
$query = "SELECT order_paymentmethod AS paymentMethod, MONTH(order_date) AS orderMonth, COUNT(*) AS count
          FROM `order`
          GROUP BY paymentMethod, orderMonth
          ORDER BY orderMonth";

$result = mysqli_query($conn, $query);

// Array to store the payment method data
$paymentMethodData = array();

// Array to store the months
$months = array();

// Loop through the query results
while ($row = mysqli_fetch_assoc($result)) {
    $paymentMethod = $row['paymentMethod'];
    $orderMonth = $row['orderMonth'];
    $count = $row['count'];

    // Check if the payment method exists in the array
    if (!isset($paymentMethodData[$paymentMethod])) {
        // If not, initialize the payment method entry
        $paymentMethodData[$paymentMethod] = array(
            'paymentMethod' => $paymentMethod,
            'monthlyCounts' => array()
        );
    }

    // Add the monthly count for the payment method
    $paymentMethodData[$paymentMethod]['monthlyCounts'][$orderMonth] = $count;

    // Add the month to the months array if it doesn't exist already
    if (!in_array($orderMonth, $months)) {
        $months[] = $orderMonth;
    }
}

// Prepare the final response array
$response = array(
    'paymentMethodData' => array_values($paymentMethodData), // Convert associative array to indexed array
    'months' => $months
);

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
