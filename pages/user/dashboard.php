<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
        .dashboard-title {
            color: #1e3a8a; /* Match admin dashboard title color */
            font-size: 1.5rem; /* Match admin dashboard title font size */
            font-weight: bold; /* Match admin dashboard title font weight */
            margin-bottom: 20px; /* Match admin dashboard title margin */
        }
        .container.mt-5 {
            margin-left: 200px; /* Adjusted margin to avoid overlap with sidebar */
            padding: 30px; /* Added padding for better spacing */
            background: linear-gradient(135deg, #e3f2fd, #ffffff); /* Gradient background */
            border-radius: 15px; /* Rounded corners for a modern look */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Enhanced shadow for depth */
        }
        .greeting {
            font-size: 2rem; /* Larger font size for emphasis */
            font-weight: bold; /* Bold text for greeting */
            color: #0d47a1; /* Darker blue for contrast */
            margin-bottom: 20px; /* Spacing below greeting */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Subtle text shadow */
        }
        .card {
            border-radius: 15px; /* Rounded corners for cards */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Enhanced shadow for depth */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
            width: 100%; /* Ensure cards take full width of column */
            height: 200px; /* Increased height for larger cards */
        }
        .card:hover {
            transform: translateY(-5px); /* Slightly lift on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
        }
        .card-title {
            font-size: 1.5rem; /* Larger font size for better readability */
            font-weight: bold; /* Bold text for titles */
        }
        .card-text {
            font-size: 2rem; /* Larger font size for emphasis */
            font-weight: bold; /* Bold text for numbers */
            color: #ffffff; /* Ensure text is visible on colored backgrounds */
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar text-white p-3">
            <img src="../../assets/image/Smcc_logo.jpeg" alt="SMCC Logo" class="mb-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <span>🏠</span> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="browse_materials.php" class="nav-link">
                        <span>🔍</span> Browse Materials
                    </a>
                </li>
                <li class="nav-item">
                    <a href="request_repair.php" class="nav-link">
                        <span>🧾</span> Request Repair Service
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reserve_materials.php" class="nav-link">
                        <span>🧰</span> Reserve Materials
                    </a>
                </li>
                <li class="nav-item">
                    <a href="my_request.php" class="nav-link">
                        <span>📋</span> My Requests 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="my_reservations.php" class="nav-link">
                        <span>🎫</span> My Reservations
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../../clients.php" class="nav-link">
                        <span>🚪</span> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <div class="container mt-5">
        <div class="dashboard-title">🏠 Dashboard Overview</div>
            <div class="greeting">✨ Hello, User! Welcome to your Dashboard.</div> <!-- Updated greeting -->
            <div class="row mb-4">
                <div class="col-md-4"> <!-- Adjusted column size for three cards -->
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">🧾 Total Repair Requests</h5>
                            <p class="card-text" id="totalJobOrders">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"> <!-- Adjusted column size for three cards -->
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">✅ Total Reservations</h5>
                            <p class="card-text" id="totalReservations">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"> <!-- Adjusted column size for three cards -->
                    <div class="card text-white bg-warning"> <!-- Changed to yellow -->
                        <div class="card-body">
                            <h5 class="card-title">📦 Total Materials Available</h5>
                            <p class="card-text" id="totalInventoryItems">0</p>
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
                url: "../../controller/user_dashboard_summary.php",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    $("#totalJobOrders").text(data.totalRepairRequests); // Fixed ID
                    $("#totalReservations").text(data.totalReservations);
                    $("#totalInventoryItems").text(data.totalInventoryItems);
                },
                error: function () {
                    alert("Failed to fetch summary data.");
                }
            });
        }

        $(document).ready(function () {
            fetchSummaryData();
        });
    </script>
</body>
</html>

