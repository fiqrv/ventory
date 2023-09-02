<?php
include 'connect.php';

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="allorder">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Details</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Products</th>
                <th scope="col">Total Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    $sql = "SELECT o.order_id, o.order_paymentmethod, o.order_details, o.order_date, o.order_status, o.total_price, o.cus_id, 
            GROUP_CONCAT(op.prod_name SEPARATOR ', ') AS product_names
            FROM `order` o
            LEFT JOIN `order_product` op ON o.order_id = op.order_id
            GROUP BY o.order_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $orderId = $row['order_id'];
        $paymentMethod = $row['order_paymentmethod'];
        $orderDetails = $row['order_details'];
        $orderDate = $row['order_date'];
        $orderStatus = $row['order_status'];
        $productNames = $row['product_names'];
        $totalPrice = $row['total_price'];

        $table .= '
        <tr>
            <td scope="row">' . $orderId . '</td>
            <td>' . $paymentMethod . '</td>
            <td>' . $orderDetails . '</td>
            <td>' . $orderDate . '</td>
            <td>' . $orderStatus . '</td>
            <td>' . $productNames . '</td>
            <td>' . $totalPrice . '</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneOrder(' . $orderId . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteOrder(' . $orderId . ')">Delete</button>
            </td>
        </tr>
        ';
    }

    $table .= '
        </tbody>
    </table>';

    echo $table;
}
