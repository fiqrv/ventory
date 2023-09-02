<?php
$activeSection = 'products';
include './includes/header.php';
include './includes/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Products</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Product list</h5>
                        <p>Admin/Manager/Cashier/Chef/Waiter may add/edit/remove product from the system</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#newProdModal">Add new product</button>
                        <button type="button" class="mt-2 mb-3 btn btn-primary" id="productExportExBtn" onclick="exportProductTableEx()">Export to excel</button>
                        <button type="button" class="mt-2 mb-3 btn btn-secondary" id="productExportPdfBtn" onclick="exportProductTablePdf()">Export to PDF</button>
                        <div class="" id="productTable"></div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- New Prod Modal -->
<div class="modal fade" id="newProdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 justify-content-center">
                    <img src="uploads/food_default.png" alt="Profile" class="rounded-5 img-fluid" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Product Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="nprodimg">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nprodname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nproddesc">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="nprodcat">
                            <?php
                            include './php_action/getProdCategoryOption.php';
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nprodprice">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="addProduct()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End Prod Modal-->

<!-- Edit Prod Modal -->
<div class="modal fade" id="editProdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="eprodid">
                <div class="row mb-3 justify-content-center">
                    <img id="eprodimgpath" src="uploads/food_default.png" alt="Profile" class="rounded-5 img-fluid" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Product Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="eprodimg">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eprodname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eproddesc">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="eprodcat"></select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="eprodprice">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateOneProduct()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End Prod Modal-->

<?php include './includes/footer.php'; ?>

<!-- Include js-xlsx library -->
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>



<!-- Include jsPDF library -->
<script src="assets/js/js-PDF/dist/jspdf.umd.min.js"></script>

<script src="http://localhost/ventory2/assets/js/pdfmake.min.js"></script>
<script src="http://localhost/ventory2/assets/js/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<script>
    // Get a product

    function getOneProduct(pid) {
        $.ajax({
            url: "php_action/getOneProduct.php",
            type: "post",
            data: {
                pid: pid
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Parse the JSON response
                var response = JSON.parse(data);

                if (response.success) {
                    // Extract the product details from the response
                    var product = response.product;

                    // Set the product details in the edit product modal
                    $("#eprodid").val(product.prod_id);
                    $("#eprodimgpath").attr("src", "uploads/" + product.prod_imgpath);
                    $("#eprodname").val(product.prod_name);
                    $("#eproddesc").val(product.prod_desc);
                    $("#eprodprice").val(product.prod_price);

                    // Fetch and populate category options
                    $.ajax({
                        url: "php_action/getProdEditCategoryOption.php",
                        success: function(data) {
                            // Set the category options in the select element
                            $("#eprodcat").html(data);

                            // Set the selected category
                            $("#eprodcat").val(product.cat_id);
                        },
                        error: function(xhr, status, error) {
                            console.log("Error fetching category options: " + error);
                        }
                    });

                    // Show the edit product modal
                    $("#editProdModal").modal("show");
                } else {
                    // Display an error message
                    alert("Error: " + response.message);
                }
            }
        });
    }


    // Update a product
    function updateOneProduct() {
        if (confirm("Are you sure you want to update this product?")) {
            // Get the input values
            var productId = $("#eprodid").val();
            var productImage = $("#eprodimg").prop("files")[0];
            var productName = $("#eprodname").val();
            var productDesc = $("#eproddesc").val();
            var productCategory = $("#eprodcat").val();
            var productPrice = $("#eprodprice").val();

            // Create a FormData object to send the data
            var formData = new FormData();
            formData.append("pid", productId);
            formData.append("prodimg", productImage);
            formData.append("prodname", productName);
            formData.append("proddesc", productDesc);
            formData.append("prodcat", productCategory);
            formData.append("prodprice", productPrice);

            // Send the AJAX request
            $.ajax({
                url: "php_action/updateOneProduct.php",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data, status) {
                    // Log the response in the console
                    console.log('Response:', data);

                    // Parse the JSON response
                    var response = JSON.parse(data);

                    if (response.success) {
                        // Product updated successfully
                        // Refresh the product table or perform any other actions
                        displayProductTable();
                        // Close the edit product modal
                        $("#editProdModal").modal("hide");
                        // Display alert after the operation is completed
                        alert("Product updated successfully");
                    } else {
                        // Error occurred while updating the product
                        alert("Error: " + response.message);
                    }
                },
            });
        }
    }



    // On ready
    $(document).ready(function() {
        displayProductTable();
    })
    // Display table
    function displayProductTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllProduct.php",
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#productTable').html(data);
                $('#allproduct').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        });
    }


    // Add Product
    function addProduct() {
        if (confirm("Are you sure you want to add this product?")) {
            // Rest of the code
            // Get the input values
            var prodImg = $('#nprodimg').prop('files')[0];
            var prodName = $('#nprodname').val();
            var prodDesc = $('#nproddesc').val();
            var prodCat = $('#nprodcat').val();
            var prodPrice = $('#nprodprice').val();

            // Create a FormData object to store the form data
            var formData = new FormData();
            formData.append('prodImg', prodImg);
            formData.append('prodName', prodName);
            formData.append('prodDesc', prodDesc);
            formData.append('prodCat', prodCat);
            formData.append('prodPrice', prodPrice);

            // Send the AJAX request to the server
            $.ajax({
                url: 'php_action/insertNewProduct.php',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Handle the response from the server
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Clear the form inputs
                        $('#nprodimg').val('');
                        $('#nprodname').val('');
                        $('#nproddesc').val('');
                        $('#nprodcat').val('');
                        $('#nprodprice').val('');
                        // Close the modal
                        $('#newProdModal').modal('hide');
                        // Refresh the product table
                        displayProductTable();
                        // Display alert after the operation is completed
                        alert("Product added successfully");
                    } else {
                        // Error occurred while adding the product
                        alert('Error adding product: ' + result.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Error occurred in the AJAX request
                    alert('AJAX Error: ' + status + ' - ' + error);
                }
            });
        }

    }

    // Delete Product
    function deleteProduct(pid) {
        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: "php_action/deleteProduct.php",
                type: "post",
                data: {
                    pid: pid
                },
                success: function(data, status) {
                    // Log the response in the console
                    console.log('Response:', data);
                    // Display alert after the operation is completed
                    alert("Product deleted successfully");
                    displayProductTable();
                }
            });
        }
    }

    // Onclick Export to Excel
    function exportProductTableEx() {
        // Make an AJAX request to fetch product data from the server
        $.ajax({
            url: 'php_action/fetchProductToExcel.php', // Update with your server-side script to fetch product data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Data retrieval successful
                    var productData = data.products; // Assuming the response contains the product data in an array called 'products'

                    // Create a new workbook and worksheet
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.json_to_sheet(productData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                    // Export the workbook to Excel
                    XLSX.writeFile(wb, 'products.xlsx');
                    // Display alert after the operation is completed
                    alert("Product table exported to Excel successfully");
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
    function exportProductTablePdf() {
        // Fetch product data from the server
        $.ajax({
            url: 'php_action/fetchProductToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Product data fetched successfully
                    const productData = data.products;

                    // Iterate over product data and convert images to data URLs
                    productData.forEach(product => {
                        const img = new Image();
                        img.onload = function() {
                            const canvas = document.createElement('canvas');
                            canvas.width = this.width;
                            canvas.height = this.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(this, 0, 0);
                            product.pictureDataURL = canvas.toDataURL('image/jpeg'); // Change 'image/jpeg' to the appropriate image format if needed

                            // Check if all images have been processed
                            const allImagesProcessed = productData.every(product => product.hasOwnProperty('pictureDataURL'));
                            if (allImagesProcessed) {
                                // Define the document definition for PDF
                                const docDefinition = {
                                    content: [{
                                            text: 'Product Report',
                                            style: 'header'
                                        },
                                        {
                                            text: '\n'
                                        },
                                        {
                                            table: {
                                                headerRows: 1,
                                                body: [
                                                    ['ID', 'Name', 'Image', 'Description', 'Price', 'Category'],
                                                    ...productData.map(product => [
                                                        product.prod_id,
                                                        product.prod_name,
                                                        {
                                                            image: product.pictureDataURL,
                                                            fit: [20, 20]
                                                        },
                                                        product.prod_desc,
                                                        product.prod_price,
                                                        product.cat_id
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
                                pdfMake.createPdf(docDefinition).download('products.pdf');
                            }
                        };
                        img.src = './uploads/' + product.prod_imgpath;
                    });
                } else {
                    // Error fetching product data
                    console.log('Failed to fetch product data:', data.message);
                }
                // Display alert after the operation is completed
                alert("Product table exported to PDF successfully");
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }
</script>
</body>

</html>