<?php
include 'connect.php';

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="allcustomers">
        <thead>
            <tr>
                <th scope="col">Customer ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    $sql = "SELECT * FROM customers";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['cus_id'];
        $name = $row['cus_name'];
        $email = $row['cus_email'];
        $phone = $row['cus_phone'];
        $dob = $row['cus_dob'];

        $table .= '
        <tr>
            <td scope="row">' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $phone . '</td>
            <td>' . $dob . '</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneCustomer(' . $id . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteCustomer(' . $id . ')">Delete</button>
            </td>
        </tr>
        ';
    }

    $table .= '
        </tbody>
    </table>';

    echo $table;
}
