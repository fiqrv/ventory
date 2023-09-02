<?php
$activeSection = 'users';
include './includes/header.php';
include './includes/sidebar.php'; ?>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Users list</h5>
                        <p>Admin/Manager may add/edit/remove users from the system</p>
                        <button type="button" class="mt-2 mb-3 btn btn-warning btn-secondary" data-bs-toggle="modal" data-bs-target="#newUserModal">Add new user</button>
                        <button type="button" class="mt-2 mb-3 btn btn-primary" id="userExportExBtn" onclick="exportUserTableEx()">Export to excel</button>
                        <button type="button" class="mt-2 mb-3 btn btn-secondary" id="userExportPdfBtn" onclick="exportUserTablePdf()">Export to PDF</button>


                        <!-- Table with stripped rows -->
                        <div class="" id="userTable"></div>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- New User Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 justify-content-center">
                    <img id="npicturepath" src="uploads/default.png" alt="Profile" class="img-thumbnail" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="nfileuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nemuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="npassuser">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary reveal-button" type="button">Reveal</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="nroleuser">
                            <option selected>Manager</option>
                            <option value="1">Cashier</option>
                            <option value="2">Waiter</option>
                            <option value="3">Chef</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nfnameuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="naddruser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Phone No.</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="npnumuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="ngenuser">
                            <option selected>Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Age</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nageuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="nbdateuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Joined Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="njdateuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="nstatuser">
                            <option selected>Active</option>
                            <option value="1">Deactivated</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="addUser()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End User Modal-->

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View/Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3 justify-content-center">
                    <img id="epicturepath" src="assets/img/profile-img.jpg" alt="Profile" class="img-thumbnail" style="height: 20vh; width: auto;">
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="efileuser">
                    </div>
                </div>
                <input type="hidden" id="eiduser">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eemuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="epassuser">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary reveal-button2" type="button">Reveal</button>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="eroleuser">
                            <option selected>Admin</option>
                            <option value="1">Manager</option>
                            <option value="2">Cashier</option>
                            <option value="3">Waiter</option>
                            <option value="4">Chef</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="efnameuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="eaddruser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Phone No.</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="epnumuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="egenuser">
                            <option selected>Male</option>
                            <option value="1">Female</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Age</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="eageuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="ebdateuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Joined Date</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="ejdateuser">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="estatuser">
                            <option selected>Active</option>
                            <option value="1">Deactivated</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-warning" onclick="updateOneUser()">Confirm</button>
            </div>
        </div>
    </div>
</div><!-- End User Modal-->

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
    //Get user
    function getOneUser(uid) {
        $('#uid').val(uid);
        $.post("php_action/getOneUser.php", {
            uid: uid
        }, function(data, status) {
            //console.log(data);
            var qdata = JSON.parse(data);
            // Convert the role value to a corresponding string
            if (qdata.role === 'Manager') {
                qdata.role = '1';
            } else if (qdata.role === 'Cashier') {
                qdata.role = '2';
            } else if (qdata.role === 'Chef') {
                qdata.role = '3';
            } else if (qdata.role === 'Waiter') {
                qdata.role = '4';
            } else {
                qdata.role = 'Admin'; // Default value if no matching option value is found
            }
            // Convert the gender value to a corresponding string
            if (qdata.gender === 'Female') {
                qdata.gender = '1';
            } else {
                qdata.gender = 'Male'; // Default value if no matching option value is found
            }
            // Convert the status value to a corresponding string
            if (qdata.status === 'Not Active') {
                qdata.status = '1';
            } else {
                qdata.status = 'Active'; // Default value if no matching option value is found
            }
            $('#eiduser').val(qdata.id);
            $('#eemuser').val(qdata.email);
            $('#epassuser').val(qdata.password);
            $('#eroleuser').val(qdata.role);
            $('#efnameuser').val(qdata.fullname);
            $('#eaddruser').val(qdata.address);
            $('#epnumuser').val(qdata.phone_num);
            $('#egenuser').val(qdata.gender);
            $('#eageuser').val(qdata.age);
            $('#ebdateuser').val(qdata.birth_date);
            $('#ejdateuser').val(qdata.joined_date);
            $('#estatuser').val(qdata.status);
            $('#epicturepath').attr('src', 'uploads/' + qdata.picture_path);
        });
        $('#editUserModal').modal('show');
    }
    //Update event function
    function updateOneUser() {
        // Confirm before proceeding
        if (!confirm('Are you sure you want to update this user?')) {
            return;
        }
        var id = $('#eiduser').val();
        var email = $('#eemuser').val();
        var pass = $('#epassuser').val();
        var role = $('#eroleuser').val();
        var fname = $('#efnameuser').val();
        var addr = $('#eaddruser').val();
        var pnum = $('#epnumuser').val();
        var gen = $('#egenuser').val();
        var age = $('#eageuser').val();
        var bdate = $('#ebdateuser').val();
        var jdate = $('#ejdateuser').val();
        var stat = $('#estatuser').val();

        var fileInput = document.getElementById('efileuser');
        var file = fileInput.files[0];

        var formData = new FormData();
        formData.append('id', id);
        formData.append('email', email);
        formData.append('pass', pass);
        formData.append('role', role);
        formData.append('fname', fname);
        formData.append('addr', addr);
        formData.append('pnum', pnum);
        formData.append('gen', gen);
        formData.append('age', age);
        formData.append('bdate', bdate);
        formData.append('jdate', jdate);
        formData.append('stat', stat);
        // formData.append('ppath', file);

        if (file) {
            formData.append('ppath', file);
        }

        // Log the form data to the console
        console.log('ppath:', file ? file.name : '');

        console.log([...formData.entries()]);

        $.ajax({
            url: "php_action/updateOneUser.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {

                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#editUserModal').modal('hide');

                // Clear input fields
                $('#efileuser').val('');
                // $('#email').val('');
                // $('#mobile').val('');
                // $('#place').val('');

                //Function to display data
                displayUserTable();
                // Display alert after the operation is completed
                alert('User updated successfully');
            }
        });
    }

    //On ready
    $(document).ready(function() {
        displayUserTable();
    });
    //Display table
    function displayUserTable() {
        var displayData = "true";
        $.ajax({
            url: "php_action/getAllUser.php",
            type: "post",
            data: {
                displayData: displayData
            },
            success: function(data, status) {
                $('#userTable').html(data);
                $('#alluser').DataTable({
                    "paging": true, // Enable pagination
                    "ordering": true, // Enable column sorting
                    "searching": true, // Enable search functionality
                    "responsive": true // Enable responsive design
                    // You can customize DataTables options based on your requirements
                }); // Apply Bootstrap DataTables to the updated table
            }
        })
    }
    //Add user
    function addUser() {
        var email = $('#nemuser').val();
        var pass = $('#npassuser').val();
        var role = $('#nroleuser').val();
        var fname = $('#nfnameuser').val();
        var addr = $('#naddruser').val();
        var pnum = $('#npnumuser').val();
        var gen = $('#ngenuser').val();
        var age = $('#nageuser').val();
        var bdate = $('#nbdateuser').val();
        var jdate = $('#njdateuser').val();
        var stat = $('#nstatuser').val();

        var fileInput = document.getElementById('nfileuser');
        var file = fileInput.files[0];

        var formData = new FormData();
        // Append variables to formData
        formData.append('email', email);
        formData.append('pass', pass);
        formData.append('role', role);
        formData.append('fname', fname);
        formData.append('addr', addr);
        formData.append('pnum', pnum);
        formData.append('gen', gen);
        formData.append('age', age);
        formData.append('bdate', bdate);
        formData.append('jdate', jdate);
        formData.append('stat', stat);
        formData.append('ppath', file);

        // Append file to formData if selected
        if (file) {
            formData.append('ppath', file);
            console.log('ppath:', file.name);
        }

        // Log the form data to the console
        // console.log('ppath:', file.name);
        // console.log([...formData.entries()]);

        $.ajax({
            url: "php_action/insertNewUser.php",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);

                // Close the modal
                $('#newUserModal').modal('hide');

                // Clear input fields
                $('#nemuser').val('');
                $('#npassuser').val('');
                $('#nroleuser').val('');
                $('#nfnameuser').val('');
                $('#naddruser').val('');
                $('#npnumuser').val('');
                $('#ngenuser').val('');
                $('#nageuser').val('');
                $('#nbdateuser').val('');
                $('#njdateuser').val('');
                $('#nstatuser').val('');
                $('#nfileuser').val('');

                //Function to display data
                displayUserTable();
                // Display alert after the operation is completed
                alert('User added successfully');
            }
        })
    }
    //Delete user
    function deleteUser(id) {
        // Confirm before proceeding
        if (!confirm('Are you sure you want to delete this user?')) {
            return;
        }
        $.ajax({
            url: "php_action/deleteUser.php",
            type: "post",
            data: {
                id: id
            },
            success: function(data, status) {
                // Log the response in the console
                console.log('Response:', data);
                // Display alert after the operation is completed
                alert('User deleted successfully');
                displayUserTable();
            }
        })
    }
    //Reveal hidden
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('epassuser');
        const revealButton = document.querySelector('.reveal-button2');

        revealButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                revealButton.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                revealButton.textContent = 'Reveal';
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('npassuser');
        const revealButton = document.querySelector('.reveal-button');

        revealButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                revealButton.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                revealButton.textContent = 'Reveal';
            }
        });
    });


    //Onclick Export to Excel
    function exportUserTableEx() {
        // Make an AJAX request to fetch staff data from the server
        $.ajax({
            url: 'php_action/fetchStaffToExcel.php', // Update with your server-side script to fetch staff data
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Data retrieval successful
                    var staffData = data.staff; // Assuming the response contains the staff data in an array called 'staff'

                    // Create a new workbook and worksheet
                    var wb = XLSX.utils.book_new();
                    var ws = XLSX.utils.json_to_sheet(staffData);

                    // Add the worksheet to the workbook
                    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

                    // Export the workbook to Excel
                    XLSX.writeFile(wb, 'staff.xlsx');
                    // Display alert after the operation is completed
                    alert('User table exported to Excel successfully');
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

    //Onclick Export to PDF
    function exportUserTablePdf() {
        // Fetch staff data from the server
        $.ajax({
            url: 'php_action/fetchStaffToPdf.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.success) {
                    // Staff data fetched successfully
                    const staffData = data.staff;

                    // Iterate over staff data and convert images to data URLs
                    staffData.forEach(staff => {
                        const img = new Image();
                        img.onload = function() {
                            const canvas = document.createElement('canvas');
                            canvas.width = this.width;
                            canvas.height = this.height;
                            const ctx = canvas.getContext('2d');
                            ctx.drawImage(this, 0, 0);
                            staff.pictureDataURL = canvas.toDataURL('image/jpeg'); // Change 'image/jpeg' to the appropriate image format if needed

                            // Check if all images have been processed
                            const allImagesProcessed = staffData.every(staff => staff.hasOwnProperty('pictureDataURL'));
                            if (allImagesProcessed) {
                                // Define the document definition for PDF
                                const docDefinition = {
                                    content: [{
                                            text: 'Staff Report',
                                            style: 'header'
                                        },
                                        {
                                            text: '\n'
                                        },
                                        {
                                            table: {
                                                headerRows: 1,
                                                body: [
                                                    ['ID', 'Email', 'Password', 'Role', 'Fullname', 'Address', 'Phone Number', 'Gender', 'Age', 'Birth Date', 'Joined Date', 'Status', 'Picture'],
                                                    ...staffData.map(staff => [
                                                        staff.id,
                                                        staff.email,
                                                        staff.password,
                                                        staff.role,
                                                        staff.fullname,
                                                        staff.address,
                                                        staff.phone_num,
                                                        staff.gender,
                                                        staff.age,
                                                        formatDate(staff.birth_date),
                                                        formatDate(staff.joined_date),
                                                        staff.status,
                                                        {
                                                            image: staff.pictureDataURL,
                                                            fit: [20, 20]
                                                        }
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
                                pdfMake.createPdf(docDefinition).download('staff.pdf');
                            }
                        };
                        img.src = './uploads/' + staff.picture_path;
                    });
                } else {
                    // Error fetching staff data
                    console.log('Failed to fetch staff data:', data.message);
                }
                // Display alert after the operation is completed
                alert('User table exported to PDF successfully');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    }

    // Helper function to format the date as YYYY-MM-DD
    function formatDate(date) {
        const d = new Date(date);
        const year = d.getFullYear();
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const day = String(d.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
</script>
</body>

</html>