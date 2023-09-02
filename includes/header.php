<?php
session_start(); // Start the session
// check if user is not logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - Ventory</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/logo.png" rel="icon">
    <link href="assets/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


    <!-- Include jsPDF library -->
    <script src="assets/js/js-PDF/dist/jspdf.umd.min.js"></script>

    <script src="http://localhost/ventory2/assets/js/pdfmake.min.js"></script>
    <script src="http://localhost/ventory2/assets/js/vfs_fonts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="assets/img/title.png" class="img-fluid" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn text-warning"></i>
        </div><!-- End Logo -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <input type="hidden" id="refrole">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img id="fetchpath" src="" alt="pic" class="img-thumbnail rounded">
                        <span class="d-none d-md-block dropdown-toggle ps-2" id="fetchfullnamespan"></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 id="fetchfullnameh6"></h6>
                            <span id="fetchrolespan"></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="./php_action/logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
    <!-- JQuery -->

    <script>
        $(document).ready(function() {
            // AJAX POST request
            $.ajax({
                type: "POST",
                url: "php_action/fetchUserData.php", // Replace with the actual PHP file name or endpoint
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    // Access and display the retrieved data
                    var id = response.id;
                    var email = response.email;
                    var password = response.password;
                    var role = response.role;
                    var fullname = response.fullname;
                    var address = response.address;
                    var phone_num = response.phone_num;
                    var gender = response.gender;
                    var age = response.age;
                    var birthdate = response.birth_date;
                    var joineddate = response.joined_date;
                    var status = response.status;
                    var picpath = 'uploads/' + response.picture_path;

                    // Split the birthdate and reformat it
                    var birthdateParts = birthdate.split("-");
                    var formattedBirthdate = birthdateParts[2] + "-" + birthdateParts[1] + "-" + birthdateParts[0];

                    // Split the joineddate and reformat it
                    var joineddateParts = joineddate.split("-");
                    var formattedJoineddate = joineddateParts[2] + "-" + joineddateParts[1] + "-" + joineddateParts[0];

                    // Find the option with the matching text and get its value
                    var roleSelectedValue = $('#perole option').filter(function() {
                        return $(this).text() === role;
                    }).val();

                    // Find the option with the matching text and get its value
                    var genSelectedValue = $('#pegender option').filter(function() {
                        return $(this).text() === gender;
                    }).val();

                    // Find the option with the matching text and get its value
                    var statSelectedValue = $('#pestat option').filter(function() {
                        return $(this).text() === status;
                    }).val();

                    // Perform further actions with the data (e.g., updating HTML elements)
                    $("#peid").val(id);
                    $("#pseid").val(id);

                    $("#fetchfullnamespan").text(fullname);
                    $("#fetchfullnameh6").text(fullname);
                    $("#fullnamecardleft").text(fullname);
                    $("#ovvfullname").text(fullname);
                    $("#pefullname").val(fullname);

                    $("#peaddr").val(address);

                    $("#refrole").val(role);
                    $("#fetchrolespan").text(role);
                    $("#rolecardleft").text(role);
                    $("#ovvrole").text(role);
                    $("#perole").val(roleSelectedValue);

                    $("#ovvemail").text(email);
                    $("#peemail").val(email);

                    $("#curpass").val(password);

                    $("#ovvpnum").text(phone_num);
                    $("#pepnum").val(phone_num);

                    $("#ovvgender").text(gender);
                    $("#pegender").val(genSelectedValue);

                    $("#ovvage").text(age);
                    $("#peage").val(age);

                    $("#ovvbdate").text(formattedBirthdate);
                    $("#pebdate").val(birthdate);

                    $("#ovvjdate").text(formattedJoineddate);
                    $("#pejdate").val(joineddate);

                    $("#ovvstat").text(status);
                    $("#pestat").val(statSelectedValue);

                    $("#fetchpath").attr('src', picpath);
                    $("#piccardleft").attr('src', picpath);
                    $("#pepic").attr('src', picpath);

                    // Check the value and show/hide the Users nav item accordingly
                    if (role === "Admin" || role === "Manager") {
                        document.getElementById("usersNavItem").style.display = "block";
                    } else {
                        document.getElementById("usersNavItem").style.display = "none";
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX request error:');
                    console.log(xhr.responseText);
                    console.log('Status:', status);
                    console.log('Error:', error);
                }
            });






            // Profile Edit Form
            $('#profileupdate').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Display a confirmation dialog
                if (!confirm('Are you sure you want to update your profile?')) {
                    return;
                }

                // Get the form values
                var id = $('#peid').val();
                var email = $('#peemail').val();
                var role = $('#perole').val();
                var fullname = $('#pefullname').val();
                var address = $('#peaddr').val();
                var phone = $('#pepnum').val();
                var gender = $('#pegender').val();
                var age = $('#peage').val();
                var birthdate = $('#pebdate').val();
                var joineddate = $('#pejdate').val();
                var status = $('#pestat').val();

                var fileInput = document.getElementById('pefileuser');
                var file = fileInput.files[0];

                var formData = new FormData();
                formData.append('id', id);
                formData.append('email', email);
                formData.append('role', role);
                formData.append('fullname', fullname);
                formData.append('address', address);
                formData.append('phone', phone);
                formData.append('gender', gender);
                formData.append('age', age);
                formData.append('birthdate', birthdate);
                formData.append('joineddate', joineddate);
                formData.append('status', status);
                // formData.append('profileImage', file);

                if (file) {
                    formData.append('ppath', file);
                }

                // Log the form data to the console
                console.log('ppath:', file ? file.name : '');
                console.log([...formData.entries()]);

                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'php_action/updateProfile.php', // Replace with the actual PHP file or endpoint
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        // Handle the success response (e.g., update UI)
                        // Display alert after the operation is completed
                        alert('Profile updated successfully');
                        location.reload();
                        console.log('Update successful');
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response (e.g., show error message)
                        console.log('Update failed');
                    }
                });
            });

            // Password Change
            $('#passwordupdate').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting
                // Display a confirmation dialog
                if (!confirm('Are you sure you want to update your password?')) {
                    return;
                }

                // Get form input values
                var currentPassword = $('#curpass').val();
                var newPassword = $('#newPassword').val();
                var confirmPassword = $('#renewPassword').val();

                // Perform match check
                if (newPassword !== confirmPassword) {
                    // Passwords don't match, handle the error (e.g., display an error message)
                    console.log('Passwords do not match');
                    return; // Exit the function
                }

                // Passwords match, proceed with the AJAX request
                var formData = {
                    id: $('#pseid').val(),
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmPassword: confirmPassword
                };

                // Send the AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'php_action/changePassword.php', // Replace with the actual PHP file or endpoint
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response (e.g., update UI)
                        // Display alert after the operation is completed
                        alert('Password updated successfully');
                        console.log('Password changed successfully');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response (e.g., show error message)
                        console.log('Password change failed');
                        console.log(xhr.responseText);
                    }
                });
            });

            //Reveal hidden
            document.addEventListener('DOMContentLoaded', function() {
                const passwordInput = document.getElementById('curpass');
                const revealButton = document.querySelector('.reveal-button3');

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
                const passwordInput = document.getElementById('newPassword');
                const revealButton = document.querySelector('.reveal-button4');

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
                const passwordInput = document.getElementById('renewPassword');
                const revealButton = document.querySelector('.reveal-button5');

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
        });
    </script>