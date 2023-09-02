<?php
include 'connect.php';

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="allproduct">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    $sql = "SELECT p.prod_id, p.prod_name, p.prod_desc, p.prod_price, c.cat_name, p.prod_imgpath 
            FROM product p 
            INNER JOIN category c ON p.cat_id = c.cat_id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['prod_id'];
        $name = $row['prod_name'];
        $desc = $row['prod_desc'];
        $price = $row['prod_price'];
        $category = $row['cat_name'];
        $imagePath = $row['prod_imgpath'];

        $table .= '
        <tr>
            <td scope="row">' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $desc . '</td>
            <td>' . $price . '</td>
            <td>' . $category . '</td>
            <td><img src="uploads/' . $imagePath . '" alt="Product Image" class="rounded-circle img-fluid" style="height: 3vh; width: auto;"></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneProduct(' . $id . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteProduct(' . $id . ')">Delete</button>
            </td>
        </tr>
        ';
    }

    $table .= '
        </tbody>
    </table>';

    echo $table;
}
