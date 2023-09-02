<?php
include 'connect.php';

if (isset($_POST['displayData'])) {
    $table = '
    <table class="table datatable" id="allingredient">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit of Measurement</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
    ';

    $sql = "SELECT * FROM ingredient";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['ing_id'];
        $name = $row['ing_name'];
        $desc = $row['ing_desc'];
        $quantity = $row['ing_quantity'];
        $uom = $row['ing_uom'];
        $imagePath = $row['ing_imagepath'];

        $table .= '
        <tr>
            <td scope="row">' . $id . '</td>
            <td>' . $name . '</td>
            <td>' . $desc . '</td>
            <td>' . $quantity . '</td>
            <td>' . $uom . '</td>
            <td><img src="uploads/' . $imagePath . '" alt="Profile" class="rounded-circle img-fluid" style="height: 3vh; width: auto;"></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="getOneIngredient(' . $id . ')">Update</button>
                <button class="btn btn-outline-dark btn-sm" onclick="deleteIngredient(' . $id . ')">Delete</button>
            </td>
        </tr>
        ';
    }

    $table .= '
        </tbody>
    </table>';

    echo $table;
}
