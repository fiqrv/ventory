<?php
$activeSection = 'customers';
include './includes/header.php';
include './includes/sidebar.php'; ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer list</h5>
                        <p>Admin/Manager/Cashier/Chef/Waiter may add/edit/remove customer from the system</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#newCusModal">Add new customer</button>
                        <button type="button" class="mt-2 mb-3 btn btn-primary" id="customerExportExBtn" onclick="exportCustomerTableEx()">Export to excel</button>
                        <button type="button" class="mt-2 mb-3 btn btn-secondary" id="customerExportPdfBtn" onclick="exportCustomerTablePdf()">Export to PDF</button>
                        <div class="" id="customerTable"></div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- New Customer Modal -->
<div class="modal fade" id="newCusModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="ncustomer" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ncustomer">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="nemail">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nphone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nphone">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="naddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="naddress">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ndob" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="ndob">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="addCustomer()">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- End New Customer Modal -->


<!-- Edit Customer Modal -->
<div class="modal fade" id="editCusModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="ecusid">
                <div class="row mb-3">
                    <label for="ecustomer" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ecustomer">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="eemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="eemail">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ephone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ephone">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="eaddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eaddress">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="edob" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="edob">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateOneCustomer()">Save changes</button>
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
    // Get a customer
    function getOneCustomer(cuid) {
        $('#cuid').val(cuid);
        $.post("php_action/getOneCustomer.php", {
            cuid: cuid
        }, function(data, status) {
            console.log(data);
            var qdata = JSON.parse(data);
            $('#ecusid').val(qdata.cus_id);
            $('#ecustomer').val(qdata.cus_name);
            $('#eemail').val(qdata.cus_email);
            $('#ephone').val(qdata.cus_phone);
            $('#eaddress').val(qdata.cus_address);
            $('#edob').val(qdata.cus_dob);
        });
        $('#editCusModal').modal('show');
    }

    // Update a customer
    function updateOneCustomer() {
        if (!confirm('Are you sure you want to update this customer?')) {
            return;
        }
        var customerId = $('#ecusid').val();
        var customerName = $('#ecustomer').val();
        var customerEmail = $('#eemail').val();
        var customerPhone = $('#ephone').val();
        var customerAddress = $('#eaddress').val();
        var customerDOB = $('#edob').val();

        $.ajax({
            url: "php_action/updateOneCustomer.php",
            type: "post",
            data: {
                customerId: customerId,
                customerName: customerName,
                customerEmail: customerEmail,
                customerPhone: customerPhone,
                customerAddress: customerAddress,
                customerDOB: customerDOB
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#editCusModal').modal('hide');

                // Refresh customer table
                displayCustomerTable();

                // Show alert after the operation is completed
                alert('Customer updated successfully');
            }
        });
    }

    // On ready
    $(document).ready(function() {
        displayCustomerTable();
    })
    //Display table
    function displayCustomerTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllCustomer.php", // Modify the URL to point to the correct PHP file or endpoint
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#customerTable').html(data);
                $('#allcustomers').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        });
    }

    //Add Customer
    function addCustomer() {
        var cusName = $('#ncustomer').val();
        var cusEmail = $('#nemail').val();
        var cusPhone = $('#nphone').val();
        var cusAddress = $('#naddress').val();
        var cusDOB = $('#ndob').val();

        var formData = new FormData();
        formData.append('cusName', cusName);
        formData.append('cusEmail', cusEmail);
        formData.append('cusPhone', cusPhone);
        formData.append('cusAddress', cusAddress);
        formData.append('cusDOB', cusDOB);

        $.ajax({
            url: 'php_action/insertNewCustomer.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#newCusModal').modal('hide');

                // Clear input fields
                $('#ncustomer').val('');
                $('#nemail').val('');
                $('#nphone').val('');
                $('#naddress').val('');
                $('#ndob').val('');

                // Refresh customer table
                displayCustomerTable();

                // Show alert after the operation is completed
                alert('Customer added successfully');
            }
        });
    }

    // Delete customer
    function deleteCustomer(cuid) {
        if (!confirm('Are you sure you want to delete this customer?')) {
            return;
        }
        $.ajax({
            url: "php_action/deleteCustomer.php",
            type: "post",
            data: {
                cuid: cuid
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);
                displayCustomerTable();
                // Show alert after the operation is completed
                alert('Customer deleted successfully');
            }
        });
    }

    // Onclick Export Customer Table to Excel
    function exportCustomerTableEx() {
        // Make an AJAX request to fetch customer data from the server
        $.ajax({
            url: 'php_action/fetchCustomerToExcel.php', // Update with your server-side script to fetch customer data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Data retrieval successful
                    var customerData = data.customers; // Assuming the response contains the customer data in an array called 'customers'

                    // Create a new workbook and worksheet
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.json_to_sheet(customerData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                    // Export the workbook to Excel
                    XLSX.writeFile(wb, 'customers.xlsx');
                    // Show alert after the operation is completed
                    alert('Customer table exported to Excel successfully');
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

    // Onclick Export Customer Table to PDF
    function exportCustomerTablePdf() {
        // Fetch customer data from the server
        $.ajax({
            url: 'php_action/fetchCustomerToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Customer data fetched successfully
                    const customerData = data.customers;

                    // Define the document definition for PDF
                    const docDefinition = {
                        content: [{
                                text: 'Customer Report',
                                style: 'header'
                            },
                            {
                                text: '\n'
                            },
                            {
                                table: {
                                    headerRows: 1,
                                    body: [
                                        ['ID', 'Name', 'Email', 'Phone', 'Address', 'Date of Birth'],
                                        ...customerData.map(customer => [
                                            customer.cus_id,
                                            customer.cus_name,
                                            customer.cus_email,
                                            customer.cus_phone,
                                            customer.cus_address,
                                            customer.cus_dob
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
                    pdfMake.createPdf(docDefinition).download('customers.pdf');
                    // Show alert after the operation is completed
                    alert('Customer table exported to PDF successfully');
                } else {
                    // Error fetching customer data
                    console.log('Failed to fetch customer data:', data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }
</script>
</body>

</html>