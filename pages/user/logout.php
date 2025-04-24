<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Log Out</title>
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
        <div class="container mt-5">
            <!-- Content goes here -->
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

