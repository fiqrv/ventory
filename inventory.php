<?php
$activeSection = 'inventory';
include './includes/header.php';
include './includes/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Inventory</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Inventory</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inventory list</h5>
                        <p>Admin/Manager/Cashier/Chef/Waiter may add/edit/remove ingredient from the inventory list</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#newIngModal">Add new ingredient</button>
                        <button type="button" class="mt-2 mb-3 btn btn-primary" id="ingredientExportExBtn" onclick="exportIngredientTableEx()">Export to excel</button>
                        <button type="button" class="mt-2 mb-3 btn btn-secondary" id="ingredientExportPdfBtn" onclick="exportIngredientTablePdf()">Export to PDF</button>
                        <div class="" id="ingredientTable"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- New Ingredient Modal -->
<div class="modal fade" id="newIngModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new ingredient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 justify-content-center">
                    <img src="uploads/food_default.png" alt="Profile" class="rounded-5 img-fluid" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Ingredient Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="ningimage">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ningname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ningdesc">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="ningquantity">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Unit of Measurement</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ninguom">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="addIngredient()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End Ingredient Modal -->


<!-- Edit Ingredient Modal -->
<div class="modal fade" id="editIngModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new ingredient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="eingid">
                <div class="row mb-3 justify-content-center">
                    <img id="eingimgpath" src="uploads/food_default.png" alt="Profile" class="rounded-5 img-fluid" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Product Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="eingfile">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eingname">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eingdesc">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="eingquantity">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Unit of Measurement</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="einguom">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateOneIngredient()">Confirm</button>
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
    // Get an ingredient
    function getOneIngredient(iid) {
        $.post("php_action/getOneIngredient.php", {
            iid: iid
        }, function(data, status) {
            var qdata = JSON.parse(data);
            $('#eingid').val(qdata.ing_id);
            $('#eingname').val(qdata.ing_name);
            $('#eingdesc').val(qdata.ing_desc);
            $('#eingquantity').val(qdata.ing_quantity);
            $('#einguom').val(qdata.ing_uom);
            $('#eingimgpath').attr('src', 'uploads/' + qdata.ing_imagepath);
            $('#editIngModal').modal('show');
        });
    }


    // Update an ingredient
    function updateOneIngredient() {
        if (!confirm('Are you sure you want to update the ingredient?')) {
            return;
        }
        var ingId = $('#eingid').val();
        var ingName = $('#eingname').val();
        var ingDesc = $('#eingdesc').val();
        var ingQuantity = $('#eingquantity').val();
        var ingUOM = $('#einguom').val();

        var fileInput = document.getElementById('eingfile');
        var file = fileInput.files[0];

        var formData = new FormData();
        // Append variables to formData
        formData.append('ingId', ingId);
        formData.append('ingName', ingName);
        formData.append('ingDesc', ingDesc);
        formData.append('ingQuantity', ingQuantity);
        formData.append('ingUOM', ingUOM);
        // Append file to formData if selected
        if (file) {
            formData.append('ingImagePath', file);
            console.log('ingImagePath:', file.name);
        }

        // // Log the form data to the console
        // console.log('ingImagePath:', file.name);
        // console.log([...formData.entries()]);

        $.ajax({
            url: "php_action/updateOneIngredient.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#editIngModal').modal('hide');

                // Clear input fields
                $('#eingid').val('');
                $('#eingname').val('');
                $('#eingdesc').val('');
                $('#eingquantity').val('');
                $('#einguom').val('');
                $('#eingfile').val('');

                //Function to display data
                displayIngredientTable();

                // Display alert after the operation is completed
                alert('Ingredient updated successfully');
            }
        });
    }


    // On ready
    $(document).ready(function() {
        displayIngredientTable();
    })
    // Display table
    function displayIngredientTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllIngredient.php",
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#ingredientTable').html(data);
                $('#allingredient').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        });
    }

    // Add Ingredient
    function addIngredient() {
        var ingImage = document.getElementById("ningimage").files[0];
        var ingName = document.getElementById("ningname").value;
        var ingDesc = document.getElementById("ningdesc").value;
        var ingQuantity = document.getElementById("ningquantity").value;
        var ingUOM = document.getElementById("ninguom").value;

        // Validate input values (you can add your own validation logic here)
        if (ingName === "" || ingQuantity === "" || ingUOM === "") {
            // Display an error message or perform appropriate actions
            alert("Please fill in all the required fields.");
            return;
        }

        var formData = new FormData();
        formData.append('ing_image', ingImage);
        formData.append('ing_name', ingName);
        formData.append('ing_desc', ingDesc);
        formData.append('ing_quantity', ingQuantity);
        formData.append('ing_uom', ingUOM);

        $.ajax({
            url: "php_action/insertNewIngredient.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {
                // Handle the server response (e.g., display success message, update ingredient list, etc.)
                console.log(data); // Log the response for debugging purposes

                // Reset the form fields or close the modal if necessary
                document.getElementById("ningimage").value = "";
                document.getElementById("ningname").value = "";
                document.getElementById("ningdesc").value = "";
                document.getElementById("ningquantity").value = "";
                document.getElementById("ninguom").value = "";
                $('#newIngModal').modal('hide'); // Hide the modal

                // Call a function to display updated ingredient table
                displayIngredientTable();

                // Display alert after the operation is completed
                alert('Ingredient added successfully');
            }
        });
    }

    // Delete Ingredient
    function deleteIngredient(iid) {
        if (!confirm('Are you sure you want to delete the ingredient?')) {
            return;
        }
        $.ajax({
            url: "php_action/deleteIngredient.php",
            type: "post",
            data: {
                iid: iid
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);
                displayIngredientTable();
                // Display alert after the operation is completed
                alert('Ingredient deleted successfully');
            }
        });
    }

    // Onclick Export to Excel
    function exportIngredientTableEx() {
        // Make an AJAX request to fetch ingredient data from the server
        $.ajax({
            url: 'php_action/fetchIngredientToExcel.php', // Update with your server-side script to fetch ingredient data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Data retrieval successful
                    var ingredientData = data.ingredients; // Assuming the response contains the ingredient data in an array called 'ingredients'

                    // Create a new workbook and worksheet
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.json_to_sheet(ingredientData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                    // Export the workbook to Excel
                    XLSX.writeFile(wb, 'ingredients.xlsx');
                    // Display alert after the operation is completed
                    alert('Ingredient table exported to Excel successfully');
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
    function exportIngredientTablePdf() {
        // Fetch ingredient data from the server
        $.ajax({
            url: 'php_action/fetchIngredientToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Ingredient data fetched successfully
                    const ingredientData = data.ingredients;

                    // Iterate over ingredient data and convert images to data URLs
                    ingredientData.forEach(ingredient => {
                        const img = new Image();
                        img.onload = function() {
                            const canvas = document.createElement('canvas');
                            canvas.width = this.width;
                            canvas.height = this.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(this, 0, 0);
                            ingredient.pictureDataURL = canvas.toDataURL('image/jpeg'); // Change 'image/jpeg' to the appropriate image format if needed

                            // Check if all images have been processed
                            const allImagesProcessed = ingredientData.every(ingredient => ingredient.hasOwnProperty('pictureDataURL'));
                            if (allImagesProcessed) {
                                // Define the document definition for PDF
                                const docDefinition = {
                                    content: [{
                                            text: 'Ingredient Report',
                                            style: 'header'
                                        },
                                        {
                                            text: '\n'
                                        },
                                        {
                                            table: {
                                                headerRows: 1,
                                                body: [
                                                    ['ID', 'Name', 'Image', 'Description', 'Quantity', 'Unit of Measure'],
                                                    ...ingredientData.map(ingredient => [
                                                        ingredient.ing_id,
                                                        ingredient.ing_name,
                                                        {
                                                            image: ingredient.pictureDataURL,
                                                            fit: [20, 20]
                                                        },
                                                        ingredient.ing_desc,
                                                        ingredient.ing_quantity,
                                                        ingredient.ing_uom
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
                                pdfMake.createPdf(docDefinition).download('ingredients.pdf');

                                // Display alert after the operation is completed
                                alert('Ingredient table exported to PDF successfully');
                            }
                        };
                        img.src = './uploads/' + ingredient.ing_imagepath;
                    });
                } else {
                    // Error fetching ingredient data
                    console.log('Failed to fetch ingredient data:', data.message);
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