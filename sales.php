<?php
$activeSection = 'sales';
include './includes/header.php';
include './includes/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Sales</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Sales</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sales list</h5>
                        <p>Admin/Manager/Cashier/Chef/Waiter may add/edit/remove order from the system</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#addOrderModal">Add new sale</button>
                        <button type="button" class="mt-2 mb-3 btn btn-primary" id="orderExportExBtn" onclick="exportOrderTableEx()">Export to excel</button>
                        <button type="button" class="mt-2 mb-3 btn btn-secondary" id="orderExportPdfBtn" onclick="exportOrderTablePdf()">Export to PDF</button>
                        <div class="" id="orderTable"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- Add New Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="paymentMethod">Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="eWallet">eWallet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="orderDetails">Order Details</label>
                    <select class="form-control" id="orderDetails" name="orderDetails" required>
                        <option value="Dine in">Dine in</option>
                        <option value="Takeaway">Takeaway</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="orderDate">Order Date</label>
                    <input type="date" class="form-control" id="orderDate" name="orderDate" required>
                </div>
                <div class="form-group">
                    <label for="orderStatus">Order Status</label>
                    <select class="form-control" id="orderStatus" name="orderStatus" required>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" placeholder="Enter customer name" autocomplete="off" required>
                    <ul id="customerList" data-input-id="customerName"></ul>
                </div>
                <div class="form-group">
                    <label for="productSelection">Product Selection</label><br>
                    <?php
                    include './php_action/connect.php';

                    $sqlCategories = "SELECT * FROM category";
                    $resultCategories = mysqli_query($conn, $sqlCategories);

                    if ($resultCategories && mysqli_num_rows($resultCategories) > 0) {
                        while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
                            echo '<div class="row">';
                            echo '<div class="col-12"><h4>' . $rowCategory['cat_name'] . '</h4></div>';

                            $categoryId = $rowCategory['cat_id'];
                            $sqlProducts = "SELECT * FROM product WHERE cat_id = '$categoryId'";
                            $resultProducts = mysqli_query($conn, $sqlProducts);

                            if ($resultProducts && mysqli_num_rows($resultProducts) > 0) {
                                while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
                                    echo '<div class="col-3">';
                                    echo '<input type="checkbox" name="productSelection[]" value="' . $rowProduct['prod_id'] . '"> ' . $rowProduct['prod_name'] . '<br>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="col-12">No products found</div>';
                            }

                            echo '</div>';
                            echo '<hr>';
                        }
                    } else {
                        echo 'No categories found';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="ProductDetails">Product Details</label>
                    <textarea class="form-control" id="ProductDetails" name="ProductDetails" readonly></textarea>
                </div>



                <div class="form-group">
                    <label for="totalPrice">Total Price</label>
                    <input type="text" class="form-control" id="totalPrice" name="totalPrice" readonly>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="addOrder()">Add Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOrderModalLabel">Edit Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="oid">
                <div class="form-group">
                    <label for="editPaymentMethod">Payment Method</label>
                    <select class="form-control" id="editPaymentMethod" name="editPaymentMethod" required>
                        <option value="Cash">Cash</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="eWallet">eWallet</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editOrderDetails">Order Details</label>
                    <select class="form-control" id="editOrderDetails" name="editOrderDetails" required>
                        <option value="Dine in">Dine in</option>
                        <option value="Takeaway">Takeaway</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editOrderDate">Order Date</label>
                    <input type="date" class="form-control" id="editOrderDate" name="editOrderDate" required>
                </div>
                <div class="form-group">
                    <label for="editOrderStatus">Order Status</label>
                    <select class="form-control" id="editOrderStatus" name="editOrderStatus" required>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editCustomerName">Customer Name</label>
                    <input type="text" class="form-control" id="editCustomerName" name="editCustomerName" readonly>
                </div>
                <div class="form-group">
                    <label for="editProductDetails">Product Details</label>
                    <textarea class="form-control" id="editProductDetails" name="editProductDetails" readonly></textarea>
                </div>

                <div class="form-group">
                    <label for="editTotalPrice">Total Price</label>
                    <input type="text" class="form-control" id="editTotalPrice" name="editTotalPrice" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="exportOneToPdf()">Export to PDF</button>
                <button type="button" class="btn btn-primary" onclick="updateOneOrder()">Update Order</button>
            </div>
        </div>
    </div>
</div>

<!-- Include js-xlsx library -->
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<!-- Include jsPDF library -->
<script src="assets/js/js-PDF/dist/jspdf.umd.min.js"></script>

<script src="http://localhost/ventory2/assets/js/pdfmake.min.js"></script>
<script src="http://localhost/ventory2/assets/js/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<?php include './includes/footer.php'; ?>

<script>
    // Get an order
    function getOneOrder(oid) {
        // Perform an AJAX request to fetch the order details
        $.ajax({
            url: 'php_action/getOneOrder.php',
            type: 'POST',
            data: {
                orderId: oid
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Populate the form fields with the order details
                $('#oid').val(response.orderId);
                $('#editPaymentMethod').val(response.paymentMethod);
                $('#editOrderDetails').val(response.orderDetails);
                $('#editOrderDate').val(response.orderDate);
                $('#editOrderStatus').val(response.orderStatus);
                $('#editCustomerName').val(response.customerName);

                // Display the product selection in the textarea
                var productSelection = response.productSelection;
                var productDetails = '';

                if (productSelection.length > 0) {
                    productDetails = formatProductSelection(productSelection);
                } else {
                    productDetails = 'No products found';
                }

                $('#editProductDetails').val(productDetails);
                updateTextareaRows(productSelection.length);

                // Display the total price
                $('#editTotalPrice').val(response.totalPrice);

                // Show the "Edit Order" modal
                $('#editOrderModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.log('Error retrieving order:', error);
            }
        });
    }

    // Update the number of rows in the textarea based on product count
    function updateTextareaRows(productCount) {
        var textarea = $('#editProductDetails');
        var rows = productCount > 0 ? productCount : 1; // Minimum 1 row

        textarea.attr('rows', rows);
    }

    // Format the product selection as a string with name and price
    function formatProductSelection(productSelection) {
        var formattedSelection = '';

        for (var i = 0; i < productSelection.length; i++) {
            var product = productSelection[i];
            var line = product.prod_name + ' - RM' + product.prod_price;
            formattedSelection += line + '\n';
        }

        return formattedSelection.trim();
    }

    // Update an order
    function updateOneOrder() {
        // Display a confirmation dialog
        if (!confirm('Are you sure you want to update this order?')) {
            return;
        }
        // Get the updated values from the form fields
        var orderId = $('#oid').val();
        var orderStatus = $('#editOrderStatus').val();
        var orderDate = $('#editOrderDate').val();
        var orderDetails = $('#editOrderDetails').val();
        var paymentMethod = $('#editPaymentMethod').val();

        // Perform an AJAX request to update the order details
        $.ajax({
            url: 'php_action/updateOneOrder.php',
            type: 'POST',
            data: {
                orderId: orderId,
                orderStatus: orderStatus,
                orderDate: orderDate,
                orderDetails: orderDetails,
                paymentMethod: paymentMethod
            },
            dataType: 'json',
            success: function(response) {
                // Handle the response after successful update
                if (response.success) {
                    // Order update was successful
                    console.log(response.message);
                    // Reload or update the order listing as needed
                    // ...
                } else {
                    // Order update failed
                    console.log(response.message);
                    // Display an error message or handle the failure appropriately
                    // ...
                }
                // Close the modal after update
                $('#editOrderModal').modal('hide');
                displayOrderTable();
                // Display alert after the operation is completed
                alert('Order updated successfully');
            },
            error: function(xhr, status, error) {
                console.log('Error updating order:', error);
                // Display an error message or handle the error appropriately
                // ...
            }
        });
    }


    $(document).ready(function() {
        $('input[name="productSelection[]"]').change(function() {
            calculateTotalPrice();
        });

        function calculateTotalPrice() {
            var totalPrice = 0;
            var productDetails = "";

            $('input[name="productSelection[]"]:checked').each(function() {
                var productId = $(this).val();
                getProductDetails(productId)
                    .then(function(details) {
                        console.log('Product ID:', productId);
                        console.log('Product Details:', details);
                        productDetails += details + "\n";
                        $('#ProductDetails').val(productDetails);
                        updateTextareaRows();
                    })
                    .catch(function(error) {
                        console.log('Error:', error);
                    });

                getProductPrice(productId)
                    .then(function(productPrice) {
                        console.log('Product ID:', productId);
                        console.log('Product Price:', productPrice);
                        if (productPrice) {
                            totalPrice += parseFloat(productPrice);
                        }
                        console.log('Total Price:', totalPrice);
                        $('#totalPrice').val(totalPrice.toFixed(2));
                    })
                    .catch(function(error) {
                        console.log('Error:', error);
                    });
            });
        }

        function getProductPrice(productId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: 'php_action/getProductPrice.php',
                    type: 'POST',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        console.log(response); // Log the response object
                        const parsedResponse = JSON.parse(response);
                        const price = parseFloat(parsedResponse.price);
                        console.log(price); // Log the parsed price
                        resolve(price);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        }

        function getProductDetails(productId) {
            return new Promise((resolve, reject) => {
                // Make an AJAX request to fetch the product details based on the product ID
                $.ajax({
                    url: 'php_action/getProductDetails.php',
                    type: 'POST',
                    data: {
                        productId: productId
                    },
                    success: function(response) {
                        //console.log(response);
                        // Assuming the response is in JSON format with a "name" and "price" property
                        const name = response.name;
                        const price = response.price;
                        const details = name + ": $" + price;
                        resolve(details);
                    },
                    error: function(xhr, status, error) {
                        reject(error);
                    }
                });
            });
        }

        function updateTextareaRows() {
            var textarea = document.getElementById('ProductDetails');
            textarea.rows = textarea.value.split('\n').length;
        }



        // Set default order date
        var currentDate = new Date().toISOString().slice(0, 10);
        $('#orderDate').val(currentDate);

        // Set default order status
        $('#orderStatus').val('pending');

        // Search for customers
        $('#customerName').keyup(function() {
            var query = $(this).val();

            if (query !== '') {
                $.ajax({
                    url: 'php_action/searchCustomers.php',
                    method: 'POST',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#customerList').fadeIn();
                        $('#customerList').html(data);
                    }
                });
            } else {
                $('#customerList').fadeOut(function() {
                    $(this).html('');
                });
            }
        });

        // Select customer from the list
        $(document).on('click', '#customerList li', function() {
            var selectedText = $(this).text();
            var inputId = $(this).parent().data('input-id');

            $('#' + inputId).val(selectedText);
            $('#customerList').fadeOut(function() {
                $(this).html('');
            });
        });

        displayOrderTable();
    });

    // Display table
    function displayOrderTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllOrder.php",
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#orderTable').html(data);
                $('#allorder').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        });
    }

    function addOrder() {
        // Retrieve the values from the form
        var paymentMethod = $('#paymentMethod').val();
        var orderDetails = $('#orderDetails').val();
        var orderDate = $('#orderDate').val();
        var orderStatus = $('#orderStatus').val();
        var customerName = $('#customerName').val();
        var productSelection = [];

        // Get the selected products
        $('input[name="productSelection[]"]:checked').each(function() {
            var productId = $(this).val();
            productSelection.push(productId);
        });

        // Retrieve the total price from the #totalPrice input field
        var totalPrice = $('#totalPrice').val();

        // Create an object with the order details
        var orderData = {
            paymentMethod: paymentMethod,
            orderDetails: orderDetails,
            orderDate: orderDate,
            orderStatus: orderStatus,
            customerName: customerName,
            productSelection: productSelection,
            totalPrice: totalPrice
        };

        // Perform an AJAX request to add the order
        $.ajax({
            url: 'php_action/insertNewOrder.php',
            type: 'POST',
            data: orderData,
            success: function(response) {
                console.log(response);
                // Handle the success response
                console.log('Order added successfully');

                // Close the addOrderModal and reload the page
                $('#addOrderModal').modal('hide');
                // Display alert after the operation is completed
                alert('Order added successfully');
                location.reload(); // Reload the page

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log('Error adding order:', error);
            }
        });
    }

    // Function to calculate the total price based on the selected products
    function calculateTotalPrice2() {
        console.log('invoked');
        var totalPrice = 0;
        $('input[name="productSelection[]"]:checked').each(function() {
            var productId = $(this).val();
            var productPrice = parseFloat($('#productPrice_' + productId).val());
            totalPrice += productPrice;
        });
        return totalPrice.toFixed(2);
    }

    // Delete Order
    function deleteOrder(oid) {
        // Display a confirmation dialog
        if (!confirm('Are you sure you want to delete this order?')) {
            return;
        }

        $.ajax({
            url: "php_action/deleteOrder.php",
            type: "post",
            data: {
                orderId: oid
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);
                displayOrderTable();
                // Display alert after the operation is completed
                alert('Order deleted successfully');
            }
        });

    }

    // Onclick Export to Excel
    function exportOrderTableEx() {
        // Make an AJAX request to fetch order data from the server
        $.ajax({
            url: 'php_action/fetchOrderToExcel.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Data retrieval successful
                    var orderData = data.orders; // Assuming the response contains the order data in an array called 'orders'

                    // Create a new workbook and worksheet
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.json_to_sheet(orderData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                    // Export the workbook to Excel
                    XLSX.writeFile(wb, 'orders.xlsx');
                    // Show alert after the operation is completed
                    alert('Order table exported to Excel successfully');
                } else {
                    // Data retrieval failed
                    console.log(data.message); // Handle the error or display an error message
                }
            },
            error: function(xhr, status, error) {
                console.log(error); // Handle the error or display an error message
            }
        });
    }

    // Onclick Export to PDF
    function exportOrderTablePdf() {
        // Fetch order data from the server
        $.ajax({
            url: 'php_action/fetchOrderToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Order data fetched successfully
                    const orderData = data.orders;

                    // Iterate over order data and fetch corresponding product names
                    orderData.forEach(order => {
                        $.ajax({
                            url: 'php_action/fetchOrderProducts.php',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                orderId: order.order_id
                            },
                            success: function(data) {
                                if (data.success) {
                                    // Product data fetched successfully
                                    order.products = data.products;

                                    // Check if all order data have been processed
                                    const allOrdersProcessed = orderData.every(order => order.hasOwnProperty('products'));
                                    if (allOrdersProcessed) {
                                        // Define the document definition for PDF
                                        const docDefinition = {
                                            content: [{
                                                    text: 'Order Report',
                                                    style: 'header'
                                                },
                                                {
                                                    text: '\n'
                                                },
                                                {
                                                    table: {
                                                        headerRows: 1,
                                                        body: [
                                                            ['Order ID', 'Payment Method', 'Order Details', 'Order Date', 'Order Status', 'Total Price', 'Customer ID', 'Product Names'],
                                                            ...orderData.map(order => [
                                                                order.order_id,
                                                                order.order_paymentmethod,
                                                                order.order_details,
                                                                order.order_date,
                                                                order.order_status,
                                                                order.total_price,
                                                                order.cus_id,
                                                                order.products.map(product => product.prod_name).join(', ')
                                                            ])
                                                        ]
                                                    },
                                                    layout: {
                                                        defaultBorder: false,
                                                        defaultFill: false,
                                                        hLineWidth: function(i) {
                                                            return i === 0 || i === 1 ? 2 : 0;
                                                        },
                                                        vLineWidth: function(i) {
                                                            return 0;
                                                        },
                                                        hLineColor: function(i) {
                                                            return i === 0 || i === 1 ? '#000000' : '#ffffff';
                                                        }
                                                    },
                                                    style: 'tableStyle'
                                                }
                                            ],
                                            defaultStyle: {
                                                fontSize: 10,
                                                color: '#333333'
                                            },
                                            styles: {
                                                header: {
                                                    fontSize: 18,
                                                    bold: true,
                                                    alignment: 'center'
                                                },
                                                tableStyle: {
                                                    margin: [0, 5, 0, 15]
                                                }
                                            },
                                            pageSize: 'A4',
                                            pageOrientation: 'landscape'
                                        };

                                        // Generate the PDF using pdfmake
                                        pdfMake.createPdf(docDefinition).download('orders.pdf');
                                        // Show alert after the operation is completed
                                        alert('Order table exported to PDF successfully');
                                    }
                                } else {
                                    // Error fetching product data
                                    console.log('Failed to fetch product data:', data.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    });
                } else {
                    // Error fetching order data
                    console.log('Failed to fetch order data:', data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    // Function to export modal content to PDF
    function exportOneToPdf() {
        // Create an array to store the content of each element in the modal
        var content = [];

        // Get the HTML content of each element in the modal and add it to the content array
        $('#editOrderModal .modal-body').find('input, select, textarea').each(function() {
            var elementContent = $(this).val();
            var elementLabel = $(this).closest('.form-group').find('label').text();
            content.push([{
                    text: elementLabel + ':',
                    bold: true
                },
                elementContent
            ]);
        });

        // Create the document definition for pdfmake
        var docDefinition = {
            content: [{
                    text: 'Order Receipt',
                    style: 'header'
                },
                {
                    table: {
                        widths: ['auto', '*'], // Set column widths
                        body: content
                    },
                    layout: 'noBorders' // Remove table borders
                }
            ],
            styles: {
                header: {
                    fontSize: 18,
                    bold: true,
                    margin: [0, 0, 0, 10] // Add margin after header
                }
            }
        };
        // Show alert after the operation is completed
        alert('Order exported to PDF successfully');
        // Generate the PDF document
        pdfMake.createPdf(docDefinition).open();

    }
</script>
</body>

</html>