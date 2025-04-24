<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Repair</title>
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
            background: linear-gradient(135deg, #ffffff, #e3f2fd); /* Gradient background */
            padding: 30px; /* Increased padding for better spacing */
            border-radius: 15px; /* More rounded corners */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Enhanced shadow effect */
            border: 1px solid #ddd; /* Subtle border for definition */
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .sidebar img {
                width: 30%;
            }
            .container.mt-5 {
                margin-left: 0;
                margin-top: 20px;
            }
        }
        @media (max-width: 576px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                text-align: center; /* Center-align content for smaller screens */
            }
            .sidebar img {
                width: 40%; /* Adjust logo size for smaller screens */
            }
            .sidebar .nav-link {
                justify-content: center; /* Center-align nav links */
                font-size: 0.8rem; /* Reduce font size */
            }
            .sidebar .nav-link span {
                margin-right: 5px; /* Reduce spacing between icon and text */
                font-size: 1rem; /* Adjust icon size */
            }
            .container.mt-5 {
                margin-left: 0;
                margin-top: 10px;
                padding: 20px; /* Adjust padding for smaller screens */
            }
            .btn-primary {
                width: 100%; /* Make buttons full-width */
            }
        }
        .container.mt-5 h2 {
            font-family: 'Arial', sans-serif; /* Modern font */
            font-weight: bold;
            color: #1e3a8a; /* Match sidebar color */
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #1e3a8a; /* Match sidebar color */
            border: none;
        }
        .btn-primary:hover {
            background-color: #163a73; /* Darker shade on hover */
        }
        thead {
            background-color: #163a73; /* Set thead background color */
            color: white; /* Ensure text is visible */
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
            <h2>Request Repair Service</h2>
            <form action="submit_request.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="requester_name" class="form-label">Requester Name</label>
                    <input type="text" class="form-control" id="requester_name" name="requester_name" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department / Office</label>
                    <input type="text" class="form-control" id="department" name="department" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location of Issue</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="service_type" class="form-label">Type of Service Needed</label>
                    <select class="form-select" id="service_type" name="service_type" required>
                        <option value="" disabled selected>Select Service</option>
                        <option value="Electrical">Electrical</option>
                        <option value="Plumbing">Plumbing</option>
                        <option value="Computer">Computer</option>
                        <option value="Mechanical">Mechanical</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description of Problem</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="priority" class="form-label">Priority Level</label>
                    <select class="form-select" id="priority" name="priority" required>
                        <option value="" disabled selected>Select Priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date_requested" class="form-label">Date Requested</label>
                    <input type="text" class="form-control" id="date_requested" name="date_requested" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <button type="submit" class="btn btn-primary">Submit Request</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

