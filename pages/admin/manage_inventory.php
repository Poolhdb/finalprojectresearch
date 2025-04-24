<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Inventory</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            position: fixed; /* Make the sidebar fixed */
            top: 0;
            left: 0;
            width: 180px; /* Fixed width */
            height: 100vh; /* Full height */
            background-color: #1e3a8a; /* Background color */
            text-align: left; /* Align text to the left */
            overflow-y: auto; /* Add scroll if content overflows */
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
        .small-table {
            font-size: 0.75rem; /* Further reduce font size */
            width: 100%; /* Reduce table width */
            margin: auto; /* Center the table */
            border: 1px solid #dee2e6; /* Add border to the table */
            border-radius: 5px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for better appearance */
            table-layout: auto; /* Allow columns to adjust based on content */
        }
        .small-table th {
            background-color: #1e3a8a; /* Add a header background color */
            color: white; /* White text for the header */
            text-align: center; /* Center-align header text */
        }
        .small-table th, .small-table td {
            padding: 6px; /* Reduce padding for compactness */
            vertical-align: middle; /* Vertically center text */
            word-wrap: break-word; /* Wrap long text */
        }
        .container.mt-5 {
            margin-left: 200px; /* Adjust margin to account for the fixed sidebar */
            background-color: #f8f9fa; /* Light background for the container */
            padding: 20px; /* Add padding inside the container */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for better appearance */
            opacity: 0; /* Initially hidden */
            transform: translateY(20px); /* Slightly move down */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Smooth fade-in and slide-up */
        }
        .container.mt-5.show {
            opacity: 1; /* Fully visible */
            transform: translateY(0); /* Reset position */
        }
        .container h2 {
            color: #1e3a8a; /* Match the sidebar color for consistency */
            font-weight: bold; /* Make the title bold */
        }
        .btn-primary {
            background-color: #1e3a8a; /* Match the sidebar color */
            border: none; /* Remove border */
        }
        .btn-primary:hover {
            background-color: #163a73; /* Darker shade on hover */
        }
        .search-bar {
            margin-bottom: 15px; /* Add spacing below the search bar */
            width: 100%; /* Full width */
        }
        .search-bar input {
            width: 100%; /* Full width for the input */
            padding: 8px; /* Add padding */
            border: 1px solid #dee2e6; /* Add border */
            border-radius: 5px; /* Rounded corners */
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
            <h2>🧰 Manage Inventory</h2>
            <button class="btn btn-primary mb-3" id="addItemBtn">Add New Item</button>
            <form id="addItemForm" class="mb-3" style="display: none;">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="materialName" placeholder="Material Name" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="category" placeholder="Category" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="quantityAvailable" placeholder="Quantity Available" required>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="condition" required>
                            <option value="" disabled selected>Condition</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Needs Repair">Needs Repair</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="location" placeholder="Location" required>
                    </div>
                    <div class="col-md-2 mt-2">
                        <select class="form-control" id="status" required>
                            <option value="" disabled selected>Status</option>
                            <option value="Available">Available</option>
                            <option value="In Use">In Use</option>
                            <option value="Under Maintenance">Under Maintenance</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-2">Save</button>
            </form>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search inventory..." onkeyup="filterTable()">
            </div>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Inventory rows will be dynamically populated here -->
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector(".container.mt-5");
            container.classList.add("show"); // Add the 'show' class to trigger the transition
        });

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
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn" data-id="${item.id}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="${item.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $("#inventoryTable tbody").html(rows);
                    }
                });
            }

            fetchInventory();

            $("#addItemBtn").on("click", function () {
                $("#addItemForm").toggle();
            });

            $("#addItemForm").on("submit", function (e) {
                e.preventDefault();
                const newItem = {
                    material_name: $("#materialName").val(),
                    category: $("#category").val(),
                    quantity_available: $("#quantityAvailable").val(),
                    condition: $("#condition").val(),
                    location: $("#location").val(),
                    status: $("#status").val(),
                    action: "add"
                };

                $.ajax({
                    url: "../../controller/manage_inventory.php",
                    method: "POST",
                    data: newItem,
                    success: function () {
                        fetchInventory();
                        $("#addItemForm").trigger("reset").hide();
                    }
                });
            });

            $(document).on("click", ".edit-btn", function () {
                const itemId = $(this).data("id");
                $.ajax({
                    url: "../../controller/manage_inventory.php",
                    method: "GET",
                    data: { id: itemId },
                    dataType: "json",
                    success: function (item) {
                        $("#materialName").val(item.material_name);
                        $("#category").val(item.category);
                        $("#quantityAvailable").val(item.quantity_available);
                        $("#condition").val(item.condition);
                        $("#location").val(item.location);
                        $("#status").val(item.status);
                        $("#addItemForm").show();
                        $("#addItemForm").off("submit").on("submit", function (e) {
                            e.preventDefault();
                            const updatedItem = {
                                id: itemId,
                                material_name: $("#materialName").val(),
                                category: $("#category").val(),
                                quantity_available: $("#quantityAvailable").val(),
                                condition: $("#condition").val(),
                                location: $("#location").val(),
                                status: $("#status").val(),
                                action: "edit"
                            };

                            $.ajax({
                                url: "../../controller/manage_inventory.php",
                                method: "POST",
                                data: updatedItem,
                                success: function () {
                                    fetchInventory();
                                    $("#addItemForm").trigger("reset").hide();
                                }
                            });
                        });
                    }
                });
            });

            $(document).on("click", ".delete-btn", function () {
                const itemId = $(this).data("id");
                if (confirm("Are you sure you want to delete this item?")) {
                    $.ajax({
                        url: "../../controller/manage_inventory.php",
                        method: "POST",
                        data: { action: "delete", id: itemId },
                        success: function () {
                            fetchInventory();
                        }
                    });
                }
            });
        });

        function filterTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("inventoryTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j] && cells[j].innerText.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? "" : "none";
            }
        }
    </script>
</body>
</html>

