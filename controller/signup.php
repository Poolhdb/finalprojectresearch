<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair & Maintenance System</title>
    <link rel="stylesheet" href="../assets/css/index.css">
    <link rel="stylesheet" href="../assets/css/login.css">

</head>
<body>
    <div class="header">
        <img src="../assets/image/smcc_logo.png" alt="SMCC Logo" class="left-logo">
        <div class="header-title-container">
            Repair & Maintenance System
        </div>
        <nav class="nav-menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </nav>
    </div>
    <div class="container">
        <div class="left-section">
            <h1 class="system-title">Fast, Reliable, and Hassle-Free Maintenance Requests</h1>
            <p class="system-subtitle">Our system allows students and faculty to request technical assistance, schedule appointments, and track progress efficiently.</p>
        </div>
        <div class="right-section">
            <div class="logo-section">
                <img src="../assets/image/ccis_logo.png" alt="CCIS Logo" class="ccis-logo">
            </div>
            <div class="login-form">
                <h2 class="text-center">User Login</h2>
                <form action="../controller/login.php" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        <span class="input-group-text">
                            <i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-login">Login</button>
                    <p class="text-center mt-3">Don't have an account? <a href="signup.php">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.classList.toggle('bi-eye');
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
