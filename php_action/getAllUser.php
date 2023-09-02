<?php
include 'connect.php';

extract($_POST);

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="alluser">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Joined Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        ';
    $sql = "SELECT * FROM staff";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        // Access individual fields using $row['fieldname']
        $id = $row['id'];
        $email = $row['email'];
        $role = $row['role'];
        $joined_date = $row['joined_date'];
        $status = $row['status'];

        $table .= '
        <tr>
            <td scope="row">' . $id . '</td>
            <td>' . $email . '</td>
            <td>' . $role . '</td>
            <td>' . $joined_date . '</td>
            <td>' . $status . '</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneUser(' . $id . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteUser(' . $id . ')">Delete</button>
            </td>
        </tr>
        ';
    }
    $table .= '
        </tbody>
    </table>';
    echo $table;
}
