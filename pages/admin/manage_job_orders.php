<?php
require_once '../../controller/conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $conn->real_escape_string($_POST['id']);
    $status = $conn->real_escape_string($_POST['status']);

    // Update the status of the repair request
    $sql = "UPDATE repair_requests SET status = '$status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Fetch the user ID associated with the repair request
        $user_query = "SELECT user_id FROM repair_requests WHERE id = $id";
        $user_result = $conn->query($user_query);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_id = $user_row['user_id'];
        }

        // Redirect with success message
        header("Location: manage_job_orders.php?success=1");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Job Orders</title>
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
            margin-left: 170px;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table.table-bordered {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Center the table */
            max-width: 600px; /* Further reduce the table width */
        }
        table.table-bordered th, table.table-bordered td {
            padding: 10px 12px; /* Reduce padding for compactness */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table.table-bordered th {
            background-color: #1e3a8a;
            color: white;
            font-weight: bold;
            text-transform: uppercase; /* Add text transformation for headers */
        }
        table.table-bordered tr:hover {
            background-color: #f9f9f9; /* Subtle hover effect */
        }
        table.table-bordered tr:last-child td {
            border-bottom: none; /* Remove border for the last row */
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
            <h2 class="text-center mb-4" style="color: #1e3a8a; font-weight: bold;">🛠️ Manage Job Orders</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Requester Name</th>
                        <th>Department</th>
                        <th>Location</th>
                        <th>Service Type</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM repair_requests ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Ensure 'status' has a default value if undefined
                            $status = isset($row['status']) ? $row['status'] : 'Pending';

                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['requester_name']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['location']}</td>
                                <td>{$row['service_type']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['priority']}</td>
                                <td>{$status}</td>
                                <td>
                                    <form action='manage_job_orders.php' method='POST' class='d-inline'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <select name='status' class='form-select mb-2'>
                                            <option value='Pending' " . ($status === 'Pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='Approved' " . ($status === 'Approved' ? 'selected' : '') . ">Approved</option>
                                            <option value='Assigned' " . ($status === 'Assigned' ? 'selected' : '') . ">Assigned</option>
                                            <option value='Completed' " . ($status === 'Completed' ? 'selected' : '') . ">Completed</option>
                                            <option value='Rejected' " . ($status === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                                        </select>
                                        <button type='submit' class='btn btn-primary btn-sm'>Update</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>No repair requests found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

