<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcityease";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the database
        $sql = "INSERT INTO signup (role, email, password, firstname, middlename, lastname, suffix, sex, civilstatus, dateofbirth, region, province, municipality)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssssssss", $role, $email, $hashed_password, $firstname, $middlename, $lastname, $suffix, $sex, $civilstatus, $dob, $region, $province, $municipality);

            if ($stmt->execute()) {
                // Set up session and log the user in
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;

                // Redirect to homepage
                header("Location: homepage.php");
                exit();
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
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
                <p style="color: red;"><?php echo htmlspecialchars($message); ?></p>
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
                    <label for="region">Region:</label>
                    <select name="region" id="region" required>
                        <option value="" selected disabled>Select a region</option>
                        <!-- Add all regions -->
                        <option value="NCR">National Capital Region (NCR)</option>
                        <option value="CAR">Cordillera Administrative Region (CAR)</option>
                        <option value="I">Ilocos Region</option>
                        <option value="II">Cagayan Valley</option>
                        <option value="III">Central Luzon</option>
                        <option value="IV-A">CALABARZON</option>
                        <option value="IV-B">MIMAROPA</option>
                        <option value="V">Bicol Region</option>
                        <option value="VI">Western Visayas</option>
                        <option value="VII">Central Visayas</option>
                        <option value="VIII">Eastern Visayas</option>
                        <option value="IX">Zamboanga Peninsula</option>
                        <option value="X">Northern Mindanao</option>
                        <option value="XI">Davao Region</option>
                        <option value="XII">SOCCSKSARGEN</option>
                        <option value="CARAGA">Caraga</option>
                        <option value="BARMM">Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="province">Province:</label>
                    <select name="province" id="province" required>
                        <option value="" selected disabled>Select a province</option>
                        <!-- Provinces will be populated dynamically based on selected region -->
                    </select>
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
        document.getElementById('region').addEventListener('change', function() {
            var region = this.value;
            var provinceSelect = document.getElementById('province');

            provinceSelect.innerHTML = '<option value="" selected disabled>Select a province</option>';
            
            var provinces = {
                'NCR': ['Metro Manila'],
                'CAR': ['Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'],
                'I': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
                'II': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
                'III': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
                'IV-A': ['Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'],
                'IV-B': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
                'V': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'],
                'VI': ['Aklan', 'Antique', 'Capiz', 'Iloilo', 'Negros Occidental'],
                'VII': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
                'VIII': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'],
                'IX': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
                'X': ['Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'],
                'XI': ['Davao de Oro', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'],
                'XII': ['Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'],
                'CARAGA': ['Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'],
                'BARMM': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
            };
            
            if (provinces[region]) {
                provinces[region].forEach(function(province) {
                    var option = document.createElement('option');
                    option.value = province;
                    option.textContent = province;
                    provinceSelect.appendChild(option);
                });
            }
        });

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
