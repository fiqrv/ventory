<?php
$activeSection = 'categories';
include './includes/header.php';
include './includes/sidebar.php'; ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories list</h5>
                        <p>Admin/Manager/Cashier/Chef/Waiter may add/edit/remove categories from the system if there is no product attached to it</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#newCatModal">Add new categories</button>
                        <div class="" id="categoryTable"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- New Category Modal -->
<div class="modal fade" id="newCatModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ncategory">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="addCategory()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End User Modal-->

<!-- Edit Category Modal -->
<div class="modal fade" id="editCatModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- General Form Elements -->
                <input type="hidden" id="ecatid">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="ecatname">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateOneCategory()">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- End User Modal-->

<?php include './includes/footer.php'; ?>
<script>
    //Get a category
    function getOneCategory(cid) {
        $('#cid').val(cid);
        $.post("php_action/getOneCategory.php", {
            cid: cid
        }, function(data, status) {
            console.log(data);
            var qdata = JSON.parse(data);
            $('#ecatid').val(qdata.cat_id);
            $('#ecatname').val(qdata.cat_name);
        });
        $('#editCatModal').modal('show');
    }
    // Update category function
    function updateOneCategory() {
        if (confirm("Are you sure you want to update this category?")) {
            var id = $('#ecatid').val();
            var name = $('#ecatname').val();

            $.ajax({
                url: "php_action/updateOneCategory.php",
                type: "post",
                data: {
                    id: id,
                    name: name,
                },
                success: function(data, status) {
                    // Log the response in the console
                    console.log('Response:', data);

                    // Close the modal
                    $('#editCatModal').modal('hide');

                    // Function to display data
                    displayCategoryTable();

                    alert("Category updated successfully.");
                }
            });
        }
    }

    //On ready
    $(document).ready(function() {
        displayCategoryTable();
    })
    // Display table
    function displayCategoryTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllCat.php", // Modify the URL to point to the correct PHP file or endpoint
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#categoryTable').html(data);
                $('#allcategory').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        });
    }

    // Add category
    function addCategory() {
        var catName = $('#ncategory').val();

        var formData = new FormData();
        formData.append('catName', catName);

        $.ajax({
            url: 'php_action/insertNewCat.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#newCatModal').modal('hide');

                // Clear input field
                $('#ncategory').val('');

                // Refresh category table
                displayCategoryTable();
                alert("Category added successfully.");
            }
        });
    }

    // Delete category
    function deleteCategory(catId) {
        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: "php_action/deleteCategory.php",
                type: "post",
                data: {
                    catId: catId
                },
                success: function(data, status) {
                    // Log the response in the console
                    console.log('Response:', data);
                    displayCategoryTable();
                    alert("Category deleted successfully.");
                }
            });
        }
    }
</script>
</body>

</html>