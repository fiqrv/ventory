<?php
include 'includes/header.php';
$activeSection = 'dashboard';
include 'includes/sidebar.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Total Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Sales <span>| All time</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        include 'php_action/connect.php';
                                        // Calculate the total sales
                                        $sql = "SELECT SUM(total_price) AS totalSales FROM `order`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $totalSales = $row['totalSales'];

                                        // Display the total sales value
                                        echo '<h6> RM' . number_format($totalSales, 2) . '</h6>';
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Sales Card -->

                    <!-- Total Product Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Product <span>| All time</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        include 'php_action/connect.php';

                                        // Count the total number of products
                                        $sql = "SELECT COUNT(*) AS totalProducts FROM product";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $totalProducts = $row['totalProducts'];

                                        // Display the total number of products
                                        echo '<h6>' . $totalProducts . ' products</h6>';
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Product Card -->

                    <!-- Total Transaction Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Transaction <span>| All time</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <?php
                                        include 'php_action/connect.php';

                                        // Count the total number of orders
                                        $sql = "SELECT COUNT(*) AS totalOrders FROM `order`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $totalOrders = $row['totalOrders'];

                                        // Display the total number of orders
                                        echo '<h6>' . $totalOrders . ' orders</h6>';
                                        ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Total Transaction Card -->

                    <!-- Sales Graph -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sales Graph <span>| All time</span></h5>

                                <!-- Line Chart -->
                                <div id="lineChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        // Fetch the monthly sales data
                                        $.ajax({
                                            url: 'php_action/getMonthlySales.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(response) {
                                                const salesData = response.salesData;

                                                // Prepare the sales data for chart rendering
                                                const salesChartData = salesData.map(sale => {
                                                    const monthNames = [
                                                        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                                                        'September', 'October', 'November', 'December'
                                                    ];

                                                    return {
                                                        x: monthNames[sale.month - 1], // Subtract 1 to match array index
                                                        y: sale.totalSales
                                                    };
                                                });

                                                // Render the line chart using ApexCharts
                                                new ApexCharts(document.querySelector("#lineChart"), {
                                                    series: [{
                                                        name: "Sales",
                                                        data: salesChartData
                                                    }],
                                                    chart: {
                                                        height: 350,
                                                        type: 'line',
                                                        zoom: {
                                                            enabled: false
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    stroke: {
                                                        curve: 'straight'
                                                    },
                                                    grid: {
                                                        row: {
                                                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                                                            opacity: 0.5
                                                        },
                                                    },
                                                    xaxis: {
                                                        type: 'category',
                                                        categories: salesData.map(sale => sale.month),
                                                    }
                                                }).render();
                                            },
                                            error: function(xhr, status, error) {
                                                console.log('Error retrieving monthly sales:', error);
                                            }
                                        });
                                    });
                                </script>
                                <!-- End Line Chart -->
                            </div>
                        </div>
                    </div>
                    <!-- End Sales Graph -->



                    <!-- Most Selled Product -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Most Selled Product <span>| All time</span></h5>

                                <!-- Bar Chart -->
                                <div id="barChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        // Fetch the most sold products data
                                        $.ajax({
                                            url: 'php_action/getMostSoldProducts.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(response) {
                                                const mostSoldProductsData = response.mostSoldProductsData;

                                                // Prepare the data for chart rendering
                                                const chartData = mostSoldProductsData.map(product => {
                                                    return {
                                                        x: product.prod_name,
                                                        y: product.totalSales
                                                    };
                                                });

                                                // Render the bar chart using ApexCharts
                                                new ApexCharts(document.querySelector("#barChart"), {
                                                    series: [{
                                                        data: chartData
                                                    }],
                                                    chart: {
                                                        type: 'bar',
                                                        height: 350
                                                    },
                                                    plotOptions: {
                                                        bar: {
                                                            borderRadius: 4,
                                                            horizontal: true,
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    xaxis: {
                                                        categories: chartData.map(product => product.x),
                                                    }
                                                }).render();
                                            },
                                            error: function(xhr, status, error) {
                                                console.log('Error retrieving most sold products:', error);
                                            }
                                        });
                                    });
                                </script>
                                <!-- End Bar Chart -->

                            </div>
                        </div>
                    </div>
                    <!-- End Most Selled Product -->

                    <!-- Top Payment Method -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Top Payment Method <span>| All time</span></h5>

                                <!-- Bar Chart -->
                                <canvas id="columnChart"></canvas>

                                <div class="chart-export-buttons">
                                    <button class="btn btn-primary btn-sm" onclick="exportToCSV()">Export CSV</button>
                                    <!-- <button class="btn btn-primary btn-sm" onclick="exportToPNG()">Export PNG</button>
                                    <button class="btn btn-primary btn-sm" onclick="exportToSVG()">Export SVG</button> -->
                                </div>

                                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                <script>
                                    // Variables to store chart data
                                    let labels;
                                    let datasets;

                                    // Export functions
                                    function exportToCSV() {
                                        const data = [labels, ...datasets.map(dataset => dataset.data)];
                                        const csvContent = "data:text/csv;charset=utf-8," + data.map(row => row.join(",")).join("\n");
                                        const encodedUri = encodeURI(csvContent);
                                        const link = document.createElement("a");
                                        link.setAttribute("href", encodedUri);
                                        link.setAttribute("download", "chart_data.csv");
                                        document.body.appendChild(link);
                                        link.click();
                                        document.body.removeChild(link);
                                    }

                                    function exportToPNG() {
                                        const pngImage = columnChart.toBase64Image();
                                        const link = document.createElement("a");
                                        link.href = pngImage;
                                        link.download = "chart.png";
                                        link.click();
                                    }

                                    function exportToSVG() {
                                        const svgContext = document.createElement("canvas").getContext("2d");
                                        const svgData = columnChart.toCanvas();
                                        svgContext.canvas.width = svgData.width;
                                        svgContext.canvas.height = svgData.height;
                                        const link = document.createElement("a");
                                        link.href = URL.createObjectURL(
                                            new Blob([svgData.outerHTML], {
                                                type: "image/svg+xml"
                                            })
                                        );
                                        link.download = "chart.svg";
                                        link.click();
                                    }

                                    document.addEventListener("DOMContentLoaded", () => {
                                        // Fetch the payment method data
                                        $.ajax({
                                            url: 'php_action/getPaymentMethodData.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(response) {
                                                console.log(response);
                                                const paymentMethodData = response.paymentMethodData;

                                                // Prepare the data for chart rendering
                                                labels = response.months.map(monthToName); // Convert month numbers to month names
                                                datasets = paymentMethodData.map(method => {
                                                    return {
                                                        label: method.paymentMethod,
                                                        data: Object.values(method.monthlyCounts),
                                                        backgroundColor: getRandomColor() // Generate random color for each dataset
                                                    };
                                                });

                                                // Render the bar chart using Chart.js
                                                const columnChart = new Chart(document.getElementById("columnChart"), {
                                                    type: 'bar',
                                                    data: {
                                                        labels: labels,
                                                        datasets: datasets
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        legend: {
                                                            position: 'top',
                                                        },
                                                        scales: {
                                                            x: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Month'
                                                                }
                                                            },
                                                            y: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Number of transactions'
                                                                }
                                                            }
                                                        },
                                                        plugins: {
                                                            tooltip: {
                                                                callbacks: {
                                                                    label: function(context) {
                                                                        return context.dataset.label + ': ' + context.parsed.y + ' transactions';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                console.log('Error retrieving payment method data:', error);
                                            }
                                        });
                                    });

                                    // Function to convert month number to month name
                                    function monthToName(month) {
                                        const monthNames = [
                                            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                                            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                                        ];
                                        return monthNames[month - 1];
                                    }

                                    // Function to generate random color for chart datasets
                                    function getRandomColor() {
                                        const letters = '0123456789ABCDEF';
                                        let color = '#';
                                        for (let i = 0; i < 6; i++) {
                                            color += letters[Math.floor(Math.random() * 16)];
                                        }
                                        return color;
                                    }
                                </script>
                                <!-- End Bar Chart -->

                            </div>
                        </div>
                    </div>
                    <!-- End Top Payment Method -->






                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>

</main><!-- End #main -->

<?php include 'includes/footer.php'; ?>





</body>

</html>