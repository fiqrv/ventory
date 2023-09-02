<?php
include 'connect.php';

// Retrieve categories from the database
$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);

$options = '';

// Iterate through the categories and generate option elements
while ($row = mysqli_fetch_assoc($result)) {
    $cat_id = $row['cat_id'];
    $cat_name = $row['cat_name'];

    // Check if the category is selected
    $selected = ($cat_id == $product['cat_id']) ? 'selected' : '';

    // Append the option element to the options string
    $options .= '<option value="' . $cat_id . '" ' . $selected . '>' . $cat_name . '</option>';
}

// Close the database connection
mysqli_close($conn);

// Echo the options
echo $options;
