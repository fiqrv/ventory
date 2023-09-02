    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'dashboard') echo '';
                                    else echo 'collapsed' ?>" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item" id="usersNavItem" style="display: none;">
                <a class="nav-link <?php if ($activeSection === 'users') echo '';
                                    else echo 'collapsed' ?>" href="users.php">
                    <i class="bi bi-person-badge"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'categories') echo '';
                                    else echo 'collapsed' ?>" href="categories.php">
                    <i class="bi bi-menu-button-wide"></i>
                    <span>Categories</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'products') echo '';
                                    else echo 'collapsed' ?>" href="products.php">
                    <i class="bi bi-journal-text"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'inventory') echo '';
                                    else echo 'collapsed' ?>" href="inventory.php">
                    <i class="bi bi-shop"></i>
                    <span>Inventory</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'customers') echo '';
                                    else echo 'collapsed' ?>" href="customers.php">
                    <i class="bi bi-people"></i>
                    <span>Customers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'sales') echo '';
                                    else echo 'collapsed' ?>" href="sales.php">
                    <i class="bi bi-cash"></i>
                    <span>Sales</span>
                </a>
            </li>

            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'profile') echo '';
                                    else echo 'collapsed' ?>" href="profile.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?php if ($activeSection === 'logout') echo '';
                                    else echo 'collapsed' ?>" href="./php_action/logout.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Login Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->
    <script>

    </script>