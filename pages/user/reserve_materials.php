<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reserve</title>
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
        <div class="container mt-5" style="max-width: 600px; background-color: #ffffff; padding: 30px; border-radius: 20px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);">
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">Reservation submitted successfully!</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="alert alert-danger">Failed to submit reservation. Please try again.</div>
            <?php endif; ?>
            <h2 class="text-center mb-4" style="color: #1e3a8a; font-weight: bold; text-transform: uppercase;">Reserve Materials</h2>
            <form action="../../controller/reserve_materials.php" method="POST">
                <div class="mb-3">
                    <label for="requesterName" class="form-label">🧑 Name of Requester:</label>
                    <input type="text" class="form-control" id="requesterName" name="requester_name" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">🏢 Department / Office:</label>
                    <input type="text" class="form-control" id="department" name="department" placeholder="Enter your department or office" required>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label">🧰 Select Material:</label>
                    <select class="form-select" id="material" name="material" required>
                        <option value="" disabled selected>Select a material</option>
                        <!-- Materials will be dynamically populated here -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">🔢 Quantity:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="Enter quantity" required>
                </div>
                <div class="mb-3">
                    <label for="purpose" class="form-label">📝 Purpose:</label>
                    <textarea class="form-control" id="purpose" name="purpose" rows="3" placeholder="Enter the purpose of reservation" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="dateNeeded" class="form-label">📅 Date Needed:</label>
                    <input type="date" class="form-control" id="dateNeeded" name="date_needed" required>
                </div>
                <div class="mb-3">
                    <label for="returnDate" class="form-label">📅 Expected Return Date:</label>
                    <input type="date" class="form-control" id="returnDate" name="return_date" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" style="background-color: #1e3a8a; font-weight: bold;">Submit Request</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch materials from manage_inventory.php
            $.ajax({
                url: "../../controller/manage_inventory.php",
                method: "GET",
                dataType: "json",
                success: function (data) {
                    let options = '<option value="" disabled selected>Select a material</option>';
                    data.forEach(item => {
                        options += `<option value="${item.material_name}">${item.material_name} (${item.quantity_available} available)</option>`;
                    });
                    $("#material").html(options);
                }
            });
        });
    </script>
</body>
</html>

