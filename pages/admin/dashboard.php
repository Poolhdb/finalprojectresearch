<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 180px;
            height: 100vh;
            background-color: #1e3a8a;
            text-align: left;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-180px); /* Hide sidebar off-screen */
            }
            .sidebar.active {
                transform: translateX(0); /* Show sidebar */
            }
            .container.mt-5 {
                margin-left: 50px; /* Adjust main content margin */
                transition: margin-left 0.3s ease;
            }
            .sidebar.active ~ .container.mt-5 {
                margin-left: 180px; /* Adjust when sidebar is visible */
            }
        }
        .sidebar img {
            width: 50%; /* Adjusted logo size */
            margin: 15px auto; /* Center logo with spacing */
            display: block;
        }
        .sidebar .nav-link {
            display: flex; /* Use flexbox for icon and text alignment */
            align-items: center; /* Vertically center items */
            font-size: 0.9rem; /* Adjusted font size */
            padding: 8px 10px; /* Adjusted padding for better spacing */
            color: white; /* Ensure text color is white */
            text-decoration: none; /* Remove underline */
        }
        .sidebar .nav-link span {
            margin-right: 10px; /* Add spacing between icon and text */
            font-size: 1.2rem; /* Adjust icon size */
            font-style: normal; /* Ensure icons are not italicized */
        }
        .sidebar .nav-link:hover {
            background-color: #163a73; /* Add hover effect */
            border-radius: 5px; /* Rounded corners on hover */
        }
        .container.mt-5 {
            margin-left: 200px;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 1400px) {
            .container.mt-5 {
                margin-left: 180px;
                padding: 18px;
            }
            .dashboard-title {
                font-size: 1.4rem;
            }
            .card {
                height: 100px;
            }
        }
        @media (max-width: 1200px) {
            .container.mt-5 {
                margin-left: 100px;
                padding: 50px;
            }
            .dashboard-title {
                font-size: 1.3rem;
            }
            .card {
                margin-left: 50px;
                height: 130px;
            }
        }
        @media (max-width: 990px) {
            .container.mt-5 {
                margin-left: 120px;
                padding: 12px;
            }
            .dashboard-title {
                font-size: 1.2rem;
            }
            .card {
                height: 120px;
            }
        }
        @media (max-width: 787px) {
            .container.mt-5 {
                margin-left: 0;
                padding: 10px;
            }
            .dashboard-title {
                font-size: 1.1rem;
                text-align: center;
            }
            .card {
                height: 110px;
                margin-bottom: 10px;
            }
        }
        @media (max-width: 567px) {
            .dashboard-title {
                font-size: 1rem;
            }
            .card {
                height: 80px;
            }
        }
        @media (max-width: 390px) {
            .dashboard-title {
                font-size: 0.9rem;
            }
            .card {
                height: 90px;
            }
        }
        .dashboard-title {
            color: #1e3a8a;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 1.2rem;
                text-align: center;
            }
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%; /* Adjusted width to make cards larger */
            height: 150px; /* Adjusted height to make cards larger */
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        @media (max-width: 768px) {
            .card {
                margin-bottom: 15px;
            }
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            align-items: center; /* Center content horizontally */
            text-align: center; /* Ensure text is centered */
        }
        .card-title {
            font-size: 1.2rem; /* Slightly larger font size for titles */
            margin-bottom: 10px;
        }
        .card-text {
            font-size: 1.5rem; /* Larger font size for totals */
            font-weight: bold;
        }
        .sidebar-toggle {
            display: none;
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <button class="sidebar-toggle">☰</button>
    <div class="d-flex flex-column flex-md-row">
        <nav class="sidebar text-white p-3">
            <img src="../../assets/image/Smcc_logo.jpeg" alt="SMCC Logo" class="mb-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_job_orders.php" class="nav-link">
                        <span>🛠️</span> Manage Job Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_materials.php" class="nav-link">
                        <span>📦</span> Reservations
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_inventory.php" class="nav-link">
                        <span>🧰</span> Inventory
                    </a>
                </li>
                <li class="nav-item">
                    <a href="manage_users.php" class="nav-link">
                        <span>👥</span> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reports.php" class="nav-link">
                        <span>📊</span> Reports
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../index.php" class="nav-link">
                        <span>🚪</span> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container mt-5">
            <div class="dashboard-title">🏠 Dashboard</div>
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">✅ Total Job Orders</h5>
                            <p class="card-text" id="totalJobOrders">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">🏨 Total Reservations</h5>
                            <p class="card-text" id="totalReservations">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">📦 Inventory Items</h5>
                            <p class="card-text" id="totalInventoryItems">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">👥 Total Users</h5>
                            <p class="card-text" id="totalUsers">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchSummaryData() {
            $.ajax({
                url: "../../controller/dashboard_summary.php",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    $("#totalJobOrders").text(data.totalJobOrders);
                    $("#totalReservations").text(data.totalReservations);
                    $("#totalInventoryItems").text(data.totalInventoryItems);
                    $("#totalUsers").text(data.totalUsers);
                },
                error: function () {
                    alert("Failed to fetch summary data.");
                }
            });
        }

        $(document).ready(function () {
            fetchSummaryData();

            // Toggle sidebar visibility
            $(".sidebar-toggle").on("click", function () {
                $(".sidebar").toggleClass("active");
            });
        });
    </script>
</body>
</html>

