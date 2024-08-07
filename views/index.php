<?php
session_start();
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : array();
session_unset(); // Clear errors after displaying
?>
<!DOCTYPE html>
<html>
<head>
    <title>CityEase - Log in</title>
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
    <div class="login-box">
        <div class="greeting">
            <img src="../assets/logo-noname.png" alt="logo no name" class="logo">
            <h1>Welcome to CityEase!</h1>
        </div>
        <div class="credentials">
            <form action="login.php" method="post">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" placeholder="Enter email address" required>
                <br>
                <label for="password">Password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                    <button type="button" id="toggle-password">
                        <img src="../assets/show.png" alt="Show" id="toggle-icon">
                    </button>
                </div>
                <br>
                <input type="submit" name="login" value="Login" id="login">
                <p id="registertext">
                    Don't have an account? <a href="sign-up.php">Sign up here</a>
                </p>
                <?php if (!empty($errors['login'])): ?>
                    <p id="login-error" style="color: red;"><?= $errors['login'] ?></p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <script>
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
