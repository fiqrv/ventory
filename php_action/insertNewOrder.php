<?php
include 'connect.php';
extract($_POST);

if (isset($paymentMethod) && isset($orderDetails) && isset($orderDate) && isset($orderStatus) && isset($customerName) && isset($productSelection) && isset($totalPrice)) {
    // Retrieve the customer ID based on the customer name
    $selectCustomerQuery = "SELECT cus_id FROM customers WHERE cus_name = ?";
    $stmtCustomer = $conn->prepare($selectCustomerQuery);
    $stmtCustomer->bind_param('s', $customerName);
    $stmtCustomer->execute();
    $stmtCustomer->store_result();

    if ($stmtCustomer->num_rows > 0) {
        $stmtCustomer->bind_result($customerId);
        $stmtCustomer->fetch();
    } else {
        // Handle customer not found
        $response = array('success' => false, 'message' => 'Customer not found');
        echo json_encode($response);
        exit;
    }

    $stmtCustomer->close();

    // Insert the order into the `order` table
    $insertOrderQuery = "INSERT INTO `order` (order_paymentmethod, order_details, order_date, order_status, total_price, cus_id) 
                         VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertOrderQuery);
    $stmt->bind_param('ssssdi', $paymentMethod, $orderDetails, $orderDate, $orderStatus, $totalPrice, $customerId);

    if ($stmt->execute()) {
        // Order inserted successfully
        $orderId = $stmt->insert_id;

        // Retrieve the product names based on the product IDs
        $productNames = array();
        $productSelection = array_map('intval', $productSelection); // Ensure product IDs are integers

        $productIdList = implode(',', $productSelection);
        $selectProductsQuery = "SELECT prod_name FROM product WHERE prod_id IN ($productIdList)";
        $result = mysqli_query($conn, $selectProductsQuery);

        while ($row = mysqli_fetch_assoc($result)) {
            $productNames[] = $row['prod_name'];
        }

        // Insert the selected products into the `order_product` table
        $insertOrderProductQuery = "INSERT INTO order_product (order_id, prod_name) VALUES (?, ?)";
        $stmtProduct = $conn->prepare($insertOrderProductQuery);

        foreach ($productNames as $productName) {
            $stmtProduct->bind_param('is', $orderId, $productName);
            $stmtProduct->execute();
        }

        $stmtProduct->close();

        // Return success response
        $response = array('success' => true, 'message' => 'Order added successfully');
        echo json_encode($response);
    } else {
        // Error occurred while inserting order
        $response = array('success' => false, 'message' => 'Error adding order: ' . $stmt->error);
        echo json_encode($response);
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid request or missing parameters
    $response = array('success' => false, 'message' => 'Invalid request or missing parameters');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
