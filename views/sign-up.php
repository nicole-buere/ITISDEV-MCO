<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcityease";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $firstname = $_POST['first_name'] ?? '';
    $middlename = $_POST['middle_name'] ?? '';
    $lastname = $_POST['last_name'] ?? '';
    $suffix = $_POST['suffix'] ?? '';
    $sex = $_POST['sex'] ?? '';
    $civilstatus = $_POST['civil_status'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $municipality = $_POST['municipality'] ?? '';

    if (empty($role) || empty($email) || empty($password) || empty($confirm_password) || empty($firstname) || empty($middlename) || empty($lastname) || empty($sex) || empty($civilstatus) || empty($dob) || empty($region) || empty($province) || empty($municipality)) {
        $message = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $sql = "INSERT INTO signup (role, email, password, firstname, middlename, lastname, suffix, sex, civilstatus, dateofbirth, region, province, municipality)
                VALUES ('$role', '$email', '$password', '$firstname', '$middlename', '$lastname', '$suffix', '$sex', '$civilstatus', '$dob', '$region', '$province', '$municipality')";
        if ($conn->query($sql) === TRUE) {
            header("Location: homepage.php");
            exit();
        } else {
            $message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CityEase - Sign up</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body>
    <div class="signup-box">
        <div class="greeting">
            <h1>CREATE YOUR ACCOUNT</h1>
            <?php if ($message): ?>
                <p style="color: red;"><?php echo $message; ?></p>
            <?php endif; ?>
        </div>

        <form id="signup-form" method="POST" action="">
            <div class="credentials">
                <div class="step-icons">
                    <img src="../assets/step1-inprog.png" alt="step 1 in progress" class="icon" id="step1-icon">
                    <span id="step1-status">Step 1: Log in Details</span>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <div class="role-options">
                        <input type="radio" id="user" name="role" value="user" required>
                        <label for="user">User</label>
                        <input type="radio" id="admin" name="role" value="admin" required>
                        <label for="admin">Admin</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                </div>
            </div>

            <div class="personal-info">
                <div class="step-icons">
                    <img src="../assets/step2-inprog.png" alt="step 2" class="icon" id="step2-icon">
                    <span id="step2-status">Step 2: Personal Information</span>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="suffix">Suffix</label>
                    <select id="suffix" name="suffix">
                        <option value="" selected>None</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sex">Sex</label>
                    <select id="sex" name="sex" required>
                        <option value="" selected>Select</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="civil_status">Civil Status</label>
                    <select id="civil_status" name="civil_status" required>
                        <option value="" selected>Select</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="widowed">Widowed</option>
                        <option value="divorced">Divorced</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" required>
                </div>
                <div class="form-group">
                    <label for="region">Region</label>
                    <input type="text" id="region" name="region" required>
                </div>
                <div class="form-group">
                    <label for="province">Province</label>
                    <input type="text" id="province" name="province" required>
                </div>
                <div class="form-group">
                    <label for="municipality">Municipality</label>
                    <input type="text" id="municipality" name="municipality" required>
                </div>
            </div>

            <button type="submit" id="signup-btn">Sign Up</button>
        </form>
    </div>

    <script>
        function validateForm() {
            const role = document.querySelector('input[name="role"]:checked');
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const firstname = document.getElementById('first_name').value;
            const middlename = document.getElementById('middle_name').value;
            const lastname = document.getElementById('last_name').value;
            const sex = document.getElementById('sex').value;
            const civilstatus = document.getElementById('civil_status').value;
            const dob = document.getElementById('dob').value;
            const region = document.getElementById('region').value;
            const province = document.getElementById('province').value;
            const municipality = document.getElementById('municipality').value;

            if (!role || !email || !password || !confirmPassword || !firstname || !middlename || !lastname || !sex || !civilstatus || !dob || !region || !province || !municipality || (password !== confirmPassword)) {
                alert("All fields are required and passwords must match.");
                return false;
            }
            return true;
        }

        document.getElementById('signup-form').addEventListener('submit', function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
