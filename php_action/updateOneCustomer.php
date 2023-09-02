<?php
include 'connect.php';

if (isset($_POST['customerId'])) {
    $customerId = $_POST['customerId'];
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $customerAddress = $_POST['customerAddress'];
    $customerDOB = $_POST['customerDOB'];

    $sql = "UPDATE customers SET 
                cus_name = '$customerName',
                cus_email = '$customerEmail',
                cus_phone = '$customerPhone',
                cus_address = '$customerAddress',
                cus_dob = '$customerDOB'
            WHERE cus_id = '$customerId'";

    if (mysqli_query($conn, $sql)) {
        echo "Customer updated successfully.";
    } else {
        echo "Error updating customer: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Please provide a customer ID.";
}
