<?php
include './includes/header.php';
$activeSection = 'profile';
include './includes/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img id="piccardleft" src="assets/img/profile-img.jpg" alt="Profile" class="img-thumbnail">
                        <h2 id="fullnamecardleft"></h2>
                        <h3 id="rolecardleft"></h3>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8" id="ovvfullname"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Email</div>
                                    <div class="col-lg-9 col-md-8" id="ovvemail"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Role</div>
                                    <div class="col-lg-9 col-md-8" id="ovvrole"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Phone Number</div>
                                    <div class="col-lg-9 col-md-8" id="ovvpnum"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Gender</div>
                                    <div class="col-lg-9 col-md-8" id="ovvgender"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Age</div>
                                    <div class="col-lg-9 col-md-8" id="ovvage"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Birth date</div>
                                    <div class="col-lg-9 col-md-8" id="ovvbdate"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Joined Date</div>
                                    <div class="col-lg-9 col-md-8" id="ovvjdate"></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Status</div>
                                    <div class="col-lg-9 col-md-8" id="ovvstat"></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form id="profileupdate">
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <img id="pepic" src="assets/img/profile-img.jpg" class="img-thumbnail" alt="Profile">
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" id="pefileuser">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="peemail">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Role</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="perole">
                                                <option selected>Admin</option>
                                                <option value="1">Manager</option>
                                                <option value="2">Cashier</option>
                                                <option value="3">Chef</option>
                                                <option value="4">Waiter</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="pefullname">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="peaddr">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputText" class="col-sm-2 col-form-label">Phone No.</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="text" class="form-control" id="pepnum">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Gender</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="pegender">
                                                <option selected>Male</option>
                                                <option value="1">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Age</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="number" class="form-control" id="peage">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-2 col-form-label">Birth Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="date" class="form-control" id="pebdate">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-2 col-form-label">Joined Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="date" class="form-control" id="pejdate">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Status</label>
                                        <div class="col-md-8 col-lg-9">
                                            <select class="form-select" id="pestat">
                                                <option selected>Active</option>
                                                <option value="1">Not active</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning">Save Changes</button>
                                    </div>
                                    <input type="hidden" id="peid">
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form id="passwordupdate">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control" id="curpass">
                                            <!-- <div class="input-group-append">
                                                <button class="btn btn-outline-secondary reveal-button3" type="button">Reveal</button>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control" id="newPassword">
                                            <!-- <div class="input-group-append">
                                                <button class="btn btn-outline-secondary reveal-button4" type="button">Reveal</button>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                            New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                            <!-- <div class="input-group-append">
                                                <button class="btn btn-outline-secondary reveal-button5" type="button">Reveal</button>
                                            </div> -->
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning">Change Password</button>
                                    </div>
                                    <input type="hidden" id="pseid">
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include './includes/footer.php'; ?>
</body>

</html>