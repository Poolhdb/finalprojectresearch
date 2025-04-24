<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Purpose: This is the login page for the admin. It includes a form for username and password and uses AJAX for login validation. -->
    <meta charset="UTF-8">
    <link rel="icon" href="assets/image/logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCC Repair & Maintenance System</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: rgba(255, 255, 255, 0.5); /* Fallback transparent white */
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .header {
            background: linear-gradient(90deg, #1e40af, #1e3a8a); /* Gradient background */
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 50%; /* Header spans 50% of the page width */
            height: 15%; /* Reduced header height */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding: 20px;
            border-top-left-radius: 5px;
            border-bottom-right-radius: 100px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .smcc-logo {
            position: absolute;
            top: 10px;
            right: 10px; /* Position the logo in the top-right corner of the page */
            width: 100px;
            height: auto;
            margin-right: 3%;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            border: 2px solid #1e3a8a; /* Added border with color #1e3a8a */
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
            margin-top: 12%; /* Moved the form slightly higher */
            animation: fadeIn 0.5s ease-in-out; /* Fade-in animation */
        }

        /* Slide-down animation */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Centered modal styling */
        .modal-content {
            border-radius: 15px;
            text-align: center;
            padding: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Centering modal */
        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Icon styling */
        .modal-icon {
            font-size: 50px;
        }

        /* Responsive styles */
        @media (max-width: 1400px) {
            .header {
                width: 60%; /* Adjust header width */
            }
            .form-section {
                width: 350px; /* Adjust form width */
            }
        }

        @media (max-width: 1200px) {
            .header {
                width: 70%; /* Adjust header width */
            }
            .form-section {
                margin-top: 150px; /* Increase margin to move the form section lower */
                width: 280px; /* Adjust form width */
            }
        }
        @media (max-width: 990px) {
            .header {
                width: 80%; /* Adjust header width */
            }
            .form-section {
                margin-top: 150px; /* Increase margin to move the form section lower */
                width: 260px; /* Adjust form width */
            }
        }

        @media (max-width: 787px) {
            .header {
                width: 90%; /* Adjust header width */
                height: auto; /* Allow flexible height */
                text-align: center; /* Center align text */
            }
            .smcc-logo {
                top: 5px;
                right: 5px;
                width: 50px; /* Adjust logo size */
            }
            .form-section {
                margin-top: 150px; /* Increase margin to move the form section lower */
                width: 260px; /* Adjust form width */
            }
        }

        @media (max-width: 567px) {
            .header {
                padding: 5px;
                font-size: 0.9rem;
                width: 70%; /* Full width header */
                border-bottom-right-radius: 50px; /* Adjust radius */
            }
            .smcc-logo {
                width: 80px; /* Smaller logo */
            }
            .form-section {
                margin-top: 150px; /* Increase margin to move the form section lower */
                width: 260px; /* Adjust form width */
            }
        }

        @media (max-width: 390px) {
            .header {
                font-size: 0.8rem; /* Reduce font size */
            }
            .header-title {
                font-size: 1rem; /* Adjust title font size */
            }
            .smcc-logo {
                width: 70px; /* Smaller logo */
            }
            .form-section {
                width: 240px; /* Adjust form width */
                padding: 20px; /* Reduce padding */
                font-size: 0.9rem; /* Reduce form font size */
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-title">SMCC Repair & Maintenance System</div>
    </div>
    <img src="assets/image/Smcc_logo.jpeg" alt="SMCC Logo" class="smcc-logo">
    <div class="form-section">
        <img src="assets/image/ccis_logo.webp" alt="Admin Icon" class="admin-image">
        <h2>ADMIN</h2>
        <form id="loginForm" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" class="form-control kanit" name="username" id="username" placeholder="Username"
                    required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control kanit" name="password" id="password"
                    placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-login kanit">
                <span class="login-text">Log in</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
    </div>

    <!-- ✅ Success Modal (Centered) -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-success">
                <div class="modal-body">
                    <i class="bi bi-check-circle-fill text-success modal-icon"></i>
                    <h4 class="mt-2">Login Successful!</h4>
                    <p>Redirecting to the dashboard...</p>
                    <div class="spinner-border text-success mt-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ❌ Error Modal (Centered) -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg border-danger">
                <div class="modal-body">
                    <i class="bi bi-x-circle-fill text-danger modal-icon"></i>
                    <h4 class="mt-2">Login Failed!</h4>
                    <p id="errorMessage"></p>
                    <button type="button" class="btn btn-danger mt-2" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle login form submission
            $("#loginForm").on("submit", function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "controller/login.php", // Corrected path to the login script
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $("#successModal").modal("show"); // Show success modal
                            setTimeout(function () {
                                window.location.href = "pages/admin/dashboard.php"; // Redirect to dashboard
                            }, 2000); // Redirect after 2 seconds
                        } else {
                            $("#errorMessage").text(response.message);
                            $("#errorModal").modal("show"); // Show error modal
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error: " + error); // Log AJAX errors
                        $("#errorMessage").text("An error occurred. Please try again.");
                        $("#errorModal").modal("show");
                    }
                });
            });
        });
    </script>
</body>

</html>
