<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="assets/image/logo.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMCC Repair & Maintenance System</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="assets/css/fonts.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: rgba(255, 255, 255, 0.5);
            display: flex;
        }

        .header {
            background: linear-gradient(90deg, #1e40af, #1e3a8a);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 50%;
            height: 15%;
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
            right: 10px;
            width: 100px;
            height: auto;
            margin-right: 3%;
        }

        .form-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            border: 2px solid #1e3a8a;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
            margin-top: 12%;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

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

        .modal-content {
            border-radius: 15px;
            text-align: center;
            padding: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        .modal-dialog {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .modal-icon {
            font-size: 50px;
        }

        .form-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .form-tabs button {
            background: #1e3a8a;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-tabs button.active {
            background: #1e40af;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
        }
        .mt-3 {
            font-size: 12px;
        }

        .sidebar {
            background-color: #1e3a8a;
            color: #ffffff;
            width: 250px;
            height: 100vh;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: #ffffff;
            margin: 10px 0;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #374151;
            border-radius: 5px;
            padding: 10px;
        }

        .content {
            margin-left: 270px;
            padding: 20px;
            width: 100%;
        }
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

    <div id="loginFormSection" class="form-section active">
        <h2>LOGIN</h2>
        <form id="loginForm">
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control kanit" name="email" id="loginEmail" placeholder="Email" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control kanit" name="password" id="loginPassword" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-login kanit">
                <span class="login-text">Log in</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
        </form>
        <p class="mt-3">Don’t have an account? <a href="#" id="switchToRegister">Sign Up</a></p>
    </div>

    <div id="registerFormSection" class="form-section">
        <h2>REGISTER</h2>
        <form id="registerForm">
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-person"></i>
                </span>
                <input type="text" class="form-control kanit" name="fullName" id="fullName" placeholder="Full Name" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-envelope"></i>
                </span>
                <input type="email" class="form-control kanit" name="email" id="registerEmail" placeholder="Email" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-lock"></i>
                </span>
                <input type="password" class="form-control kanit" name="password" id="registerPassword" placeholder="Password" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-person-badge"></i>
                </span>
                <select class="form-control kanit" name="role" id="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="Faculty">Faculty</option>
                    <option value="Student">Student</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-book"></i>
                </span>
                <input type="text" class="form-control kanit" name="course" id="course" placeholder="Course" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="bi bi-calendar"></i>
                </span>
                <input type="text" class="form-control kanit" name="year" id="year" placeholder="Year" required>
            </div>
            <p class="text-danger" id="passwordError" style="display: none;">Password must be at least 8 characters long.</p>
            <button type="submit" class="btn btn-login kanit">
                <span class="login-text">Register</span>
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
            <p class="mt-3">Already have an account? <a href="#" id="switchToLogin">Sign In</a></p>
        </form>
    </div>

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
            $("#loginTab").on("click", function () {
                $(this).addClass("active");
                $("#loginFormSection").addClass("active");
                $("#registerFormSection").removeClass("active");
            });

            $("#loginForm").on("submit", function (e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "controller/login1.php", // Ensure this path is correct
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            $("#successModal").modal("show");
                            setTimeout(function () {
                                window.location.href = "pages/user/dashboard.php";
                            }, 2000);
                        } else {
                            $("#errorMessage").text(response.message);
                            $("#errorModal").modal("show");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText); // Log the server response
                        $("#errorMessage").text("An error occurred. Please try again.");
                        $("#errorModal").modal("show");
                    }
                });
            });

            $("#registerForm").on("submit", function (e) {
                e.preventDefault();
                const password = $("#registerPassword").val();

                if (password.length < 8) {
                    $("#passwordError").show();
                    return;
                } else {
                    $("#passwordError").hide();
                }

                var formData = $(this).serialize();
                $.ajax({
                    type: "POST",
                    url: "controller/register.php", // Ensure this path is correct
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            alert(response.message);
                            $("#switchToLogin").click();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX Error:", xhr.responseText); // Log the server response
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            $("#switchToRegister").on("click", function (e) {
                e.preventDefault();
                $("#loginFormSection").removeClass("active");
                $("#registerFormSection").addClass("active");
            });

            $("#switchToLogin").on("click", function (e) {
                e.preventDefault();
                $("#registerFormSection").removeClass("active");
                $("#loginFormSection").addClass("active");
            });
        });
    </script>
</body>

</html>
