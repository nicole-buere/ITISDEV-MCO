<!-- this is the log in page -->
<!DOCTYPE html>
<html>
<head>
    <title>CityEase - Log in</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="login-box">
        <!-- contains logo and greeting -->
        <div class="greeting">
            <img src="../assets/logo-noname.png" alt="logo no name" class="logo">
            <h1>Welcome to CityEase!</h1>
        </div>

        <!-- log in form -->
        <div class="credentials">
            <form action="login.php" method="post">
                <label for="username">Email</label>
                <input type="text" name="username" id="username" placeholder="Enter email address" required>
                <br>
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                    <button type="button" id="toggle-password">
                        <img src="../assets/show.png" alt="Show" id="toggle-icon">
                    </button>
                </div>
                <br>
                <input type="submit" value="Login" id="login">
                <p id="registertext">
                    Don't have an account? <a href="register.php">Sign up here</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        // script for the show/hide button (eye icon) for password
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('password');
            var toggleIcon = document.getElementById('toggle-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.src = '../assets/hidden.png';
            } else {
                passwordField.type = 'password';
                toggleIcon.src = '../assets/show.png';
            }
        });
    </script>
</body>
</html>
