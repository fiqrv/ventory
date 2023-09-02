<?php
include 'connect.php';

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="allcategory">
        <thead>
            <tr>
                <th scope="col">Category ID</th>
                <th scope="col">Category Name</th>
                <th scope="col">Products</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    $sql = "SELECT c.cat_id, c.cat_name, GROUP_CONCAT(p.prod_name SEPARATOR '<br>') AS products
            FROM category c
            LEFT JOIN product p ON c.cat_id = p.cat_id
            GROUP BY c.cat_id, c.cat_name";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['cat_id'];
        $name = $row['cat_name'];
        $products = $row['products'];

        $table .= '
        <tr>
            <td scope="row">' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $products . '</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneCategory(' . $id . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteCategory(' . $id . ')">Delete</button>
            </td>
        </tr>
        ';
    }

    $table .= '
        </tbody>
    </table>';

    echo $table;
}
