<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Materials</title>
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
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar .nav-link {
                justify-content: center; /* Center items in smaller screens */
            }
            .container.mt-5 {
                margin-left: 0;
                padding: 15px;
            }
            table {
                font-size: 0.9rem; /* Adjust table font size for smaller screens */
            }
            table th, table td {
                white-space: nowrap; /* Prevent text wrapping in table cells */
            }
            .table-responsive {
                overflow-x: auto; /* Enable horizontal scrolling for tables */
            }
        }
        @media (max-width: 576px) {
            .container.mt-5 {
                padding: 10px;
            }
            table {
                font-size: 0.8rem; /* Further reduce font size for very small screens */
            }
            .sidebar img {
                width: 40%; /* Adjust logo size for smaller screens */
            }
            .sidebar .nav-link span {
                font-size: 1rem; /* Adjust icon size for smaller screens */
            }
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
        <div class="container mt-5 table-responsive" style="max-width: 900px; background: linear-gradient(135deg, #ffffff, #e3f2fd); padding: 30px; border-radius: 20px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);">
            <h2 class="text-center mb-4" style="color: #1e3a8a; font-weight: bold;">📦 Manage Material Reservations</h2>
            <table class="table table-bordered table-hover" style="border: 1px solid #1e3a8a;">
                <thead style="background-color: #e3f2fd; color:  #1e3a8a;">
                    <tr>
                        <th>ID</th>
                        <th>Requester Name</th>
                        <th>Department</th>
                        <th>Material</th>
                        <th>Quantity</th>
                        <th>Purpose</th>
                        <th>Date Needed</th>
                        <th>Return Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../controller/conn.php'; // Include database connection

                    $sql = "SELECT * FROM reservations ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $status = isset($row['status']) ? $row['status'] : 'Pending';

                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['requester_name']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['material_name']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['purpose']}</td>
                                <td>{$row['date_needed']}</td>
                                <td>{$row['return_date']}</td>
                                <td>{$status}</td>
                                <td>
                                    <form class='update-status-form d-inline'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <select name='status' class='form-select mb-2'>
                                            <option value='Pending' " . ($status === 'Pending' ? 'selected' : '') . ">Pending</option>
                                            <option value='Approved' " . ($status === 'Approved' ? 'selected' : '') . ">Approved</option>
                                            <option value='Rejected' " . ($status === 'Rejected' ? 'selected' : '') . ">Rejected</option>
                                            <option value='Returned' " . ($status === 'Returned' ? 'selected' : '') . ">Returned</option>
                                        </select>
                                        <button type='button' class='btn btn-primary btn-sm update-status-btn'>Update</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center'>No reservations found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.update-status-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.update-status-form');
                const formData = new FormData(form);

                fetch('../../controller/manage_materials.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully.');
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('An error occurred: ' + error.message);
                });
            });
        });
    </script>
</body>
</html>

