<?php
require_once '../../controller/conn.php'; // Include database connection

// Fetch counts for the overview section
$totalJobOrders = $conn->query("SELECT COUNT(*) AS count FROM repair_requests")->fetch_assoc()['count'];
$totalInventoryItems = $conn->query("SELECT COUNT(*) AS count FROM inventory")->fetch_assoc()['count'];
$totalReservations = $conn->query("SELECT COUNT(*) AS count FROM reservations")->fetch_assoc()['count'];
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM clients")->fetch_assoc()['count'];

// Fetch recent job orders
$recentJobOrders = $conn->query("SELECT id, requester_name, department, created_at, status FROM repair_requests ORDER BY created_at DESC LIMIT 5");

// Fetch recent reservations
$recentReservations = $conn->query("SELECT id, requester_name, material_name, date_needed, status FROM reservations ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
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
        .container.mt-5 {
            margin-left: 200px;
            background: linear-gradient(135deg, #ffffff, #e3f2fd);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        h2, h3 {
            color: #1e3a8a;
            font-weight: bold;
        }
        .row.text-center div {
            background-color: #e3f2fd;
            border: 1px solid #1e3a8a;
            border-radius: 10px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table.table-bordered {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table.table-bordered th {
            background-color: #1e3a8a;
            color: white;
            text-align: center;
        }
        table.table-bordered td {
            text-align: center;
        }
        table.table-bordered tr:hover {
            background-color: #f1f1f1;
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
            <h2 class="text-center">📊 Reports Overview</h2>
            <div class="text-end mb-3">
                <button class="btn btn-primary" onclick="printTables()">🖨️ Print Reports</button>
            </div>
            <div id="printable-tables">
                <div class="row text-center mb-4">
                    <div class="col-md-3">
                        <h5>🛠️ Total Job Orders: <?php echo $totalJobOrders; ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>📦 Total Inventory Items: <?php echo $totalInventoryItems; ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>📅 Total Reservations: <?php echo $totalReservations; ?></h5>
                    </div>
                    <div class="col-md-3">
                        <h5>👥 Total Users: <?php echo $totalUsers; ?></h5>
                    </div>
                </div>

                <h3>🛠️ Recent Job Orders</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Requester</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $recentJobOrders->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['requester_name']; ?></td>
                                <td><?php echo $row['department']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <h3>📅 Recent Reservations</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Reserved By</th>
                            <th>Item</th>
                            <th>Date Needed</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $recentReservations->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['requester_name']; ?></td>
                                <td><?php echo $row['material_name']; ?></td>
                                <td><?php echo date('Y-m-d', strtotime($row['date_needed'])); ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function printTables() {
            const printContent = document.getElementById('printable-tables').innerHTML;
            const originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

