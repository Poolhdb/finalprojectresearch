<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Users</title>
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
            <h2>👥 Manage Users</h2>
            <button class="btn btn-primary mb-3" id="addUserBtn">Add New User</button>
            <div class="search-bar">
                <input type="text" id="searchInput" placeholder="Search users..." onkeyup="filterTable()">
            </div>
            <form id="addUserForm" class="mb-3" style="display: none;">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="newName" placeholder="Full Name" required>
                    </div>
                    <div class="col-md-3">
                        <input type="email" class="form-control" id="newEmail" placeholder="Email" required>
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" id="newRole" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="Faculty">Faculty</option>
                            <option value="Student">Student</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="newCourse" placeholder="Course" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="newYear" placeholder="Year" required>
                    </div>
                    <div class="col-md-3 mt-2">
                        <input type="password" class="form-control" id="newPassword" placeholder="Password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-2">Save</button>
            </form>
            <table class="table table-bordered small-table" id="userTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Password</th> <!-- Added Password column -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- User rows will be dynamically populated here -->
                </tbody>
            </table>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm">
                            <input type="hidden" id="editUserId">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="editName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="editRole" class="form-label">Role</label>
                                <select class="form-control" id="editRole" required>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Student">Student</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editCourse" class="form-label">Course</label>
                                <input type="text" class="form-control" id="editCourse" required>
                            </div>
                            <div class="mb-3">
                                <label for="editYear" class="form-label">Year</label>
                                <input type="text" class="form-control" id="editYear" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Password</label> <!-- Added Password field -->
                                <input type="password" class="form-control" id="editPassword" required>
                            </div>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
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
            function fetchUsers() {
                $.ajax({
                    url: "../../controller/manage_users.php",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = "";
                        data.forEach(user => {
                            rows += `
                                <tr>
                                    <td>${user.full_name}</td>
                                    <td>${user.email}</td>
                                    <td>${user.role}</td>
                                    <td>${user.course}</td>
                                    <td>${user.year}</td>
                                    <td>${user.password}</td> <!-- Display password -->
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-btn" data-id="${user.id}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-btn" data-id="${user.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $("#userTable tbody").html(rows);
                    }
                });
            }

            fetchUsers();

            $("#addUserBtn").on("click", function () {
                $("#addUserForm").toggle();
            });

            $("#addUserForm").on("submit", function (e) {
                e.preventDefault();
                const newUser = {
                    full_name: $("#newName").val(),
                    email: $("#newEmail").val(),
                    role: $("#newRole").val(),
                    course: $("#newCourse").val(),
                    year: $("#newYear").val(),
                    password: $("#newPassword").val(),
                    action: "add"
                };

                $.ajax({
                    url: "../../controller/manage_users.php",
                    method: "POST",
                    data: newUser,
                    success: function () {
                        fetchUsers();
                        $("#addUserForm").trigger("reset").hide();
                    }
                });
            });

            $(document).on("click", ".edit-btn", function () {
                const userId = $(this).data("id");
                $.ajax({
                    url: "../../controller/manage_users.php",
                    method: "GET",
                    data: { id: userId },
                    dataType: "json",
                    success: function (user) {
                        $("#editUserId").val(user.id);
                        $("#editName").val(user.full_name);
                        $("#editEmail").val(user.email);
                        $("#editRole").val(user.role);
                        $("#editCourse").val(user.course);
                        $("#editYear").val(user.year);
                        $("#editPassword").val(user.password); // Populate password field
                        $("#editUserModal").modal("show");
                    }
                });
            });

            $("#editUserForm").on("submit", function (e) {
                e.preventDefault();
                const updatedUser = {
                    id: $("#editUserId").val(),
                    full_name: $("#editName").val(),
                    email: $("#editEmail").val(),
                    role: $("#editRole").val(),
                    course: $("#editCourse").val(),
                    year: $("#editYear").val(),
                    password: $("#editPassword").val(), // Include password in the update
                    action: "edit"
                };

                $.ajax({
                    url: "../../controller/manage_users.php",
                    method: "POST",
                    data: updatedUser,
                    success: function () {
                        $("#editUserModal").modal("hide");
                        fetchUsers();
                    }
                });
            });

            $(document).on("click", ".delete-btn", function () {
                const userId = $(this).data("id");
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: "../../controller/manage_users.php",
                        method: "POST",
                        data: { action: "delete", id: userId },
                        success: function () {
                            fetchUsers();
                        }
                    });
                }
            });
        });

        function filterTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("userTable");
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

