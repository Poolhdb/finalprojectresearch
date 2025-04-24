<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Browse Materials</title>
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
            background: linear-gradient(135deg, #f8f9fa, #e9ecef); /* Gradient background */
            padding: 30px; /* Increased padding */
            border-radius: 15px; /* More rounded corners */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Enhanced shadow */
        }
        @media (max-width: 768px) {
            .container.mt-5 {
                margin-left: 0; /* Remove left margin on smaller screens */
                margin-top: 20px; /* Add top margin for spacing */
            }
            .sidebar {
                width: 100%; /* Sidebar takes full width on smaller screens */
                height: auto; /* Adjust height */
                position: relative; /* Make it flow with the content */
            }
            .sidebar img {
                width: 30%; /* Adjust logo size for smaller screens */
            }
        }
        .search-bar {
            margin-bottom: 15px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .small-table th, .small-table td {
            font-size: 0.9rem;
        }
        .small-table thead th {
            background-color: #1e3a8a; /* Added background color */
            color: white; /* Ensure text is visible */
        }
    </style>
</head>
<body>
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
                    <a href="my_request.php" class="nav-link">
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
            <h2>🔍 Browse Materials</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search materials..." onkeyup="filterTable()">
            </div>
            <div class="table-responsive"> <!-- Added responsive table wrapper -->
                <table class="table table-bordered small-table" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Material Name</th>
                            <th>Category</th>
                            <th>Quantity Available</th>
                            <th>Condition</th>
                            <th>Location</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Inventory rows will be dynamically populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchInventory() {
                $.ajax({
                    url: "../../controller/manage_inventory.php",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = "";
                        data.forEach((item, index) => {
                            rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.material_name}</td>
                                    <td>${item.category}</td>
                                    <td>${item.quantity_available}</td>
                                    <td>${item.condition}</td>
                                    <td>${item.location}</td>
                                    <td>${item.status}</td>
                                </tr>
                            `;
                        });
                        $("#inventoryTable tbody").html(rows);
                    }
                });
            }

            fetchInventory();

            $("#searchInput").on("input", function () {
                const filter = $(this).val().toLowerCase();
                $("#inventoryTable tbody tr").each(function () {
                    const rowText = $(this).text().toLowerCase();
                    $(this).toggle(rowText.includes(filter));
                });
            });
        });
    </script>
</body>
</html>

