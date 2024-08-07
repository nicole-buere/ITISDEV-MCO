<?php
session_start();
require_once '../includes/db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Prepare and execute the SQL statement to fetch user details
$stmt = $conn->prepare("SELECT * FROM signup WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $middlename = trim($_POST['middlename']);
    $suffix = trim($_POST['suffix']);
    $sex = trim($_POST['sex']);
    $civilstatus = trim($_POST['civilstatus']);
    $dateofbirth = trim($_POST['dateofbirth']);
    $region = trim($_POST['region']);
    $province = trim($_POST['province']);
    $municipality = trim($_POST['municipality']);

    // Simple validation (you may need more complex checks)
    if (empty($firstname) || empty($lastname) || empty($dateofbirth)) {
        $error = "Please fill in all required fields.";
    } else {
        // Prepare and execute the update SQL statement without the role field
        $stmt = $conn->prepare(
            "UPDATE signup 
             SET firstname = ?, lastname = ?, middlename = ?, suffix = ?, sex = ?, civilstatus = ?, dateofbirth = ?, region = ?, province = ?, municipality = ? 
             WHERE email = ?"
        );

        // Bind parameters, excluding the role
        $stmt->bind_param(
            "sssssssssss",  // Note: 11 parameters, excluding the role
            $firstname, $lastname, $middlename, $suffix, $sex, $civilstatus, $dateofbirth, $region, $province, $municipality, $email
        );

        if ($stmt->execute()) {
            $success = "Profile updated successfully!";
        } else {
            $error = "Failed to update profile.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - CityEase</title>
    <link rel="stylesheet" href="../css/edit.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/forms.css"> <!-- Link to the forms CSS -->
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="../assets/logo-noname.png" alt="Logo" class="header-logo">
            <h2>CityEase</h2>
        </div>
        <nav>
            <a class="first-button" href="../views/homepage.php">Home</a>
            <a class="first-button" href="../views/aboutus.php">About Us</a>
            <div class="dropdown">
                <button class="dropbtn">Services</button>
                <div class="dropdown-content">
                    <a href="../views/reportIssue.php">Report an Issue</a>
                    <a href="../views/requestDoc.php">Request Document</a>
                </div>
            </div>
            <a class="first-button" href="../views/Transactions.php">Transactions</a>
        </nav>
        <div class="dropdown profile-dropdown">
            <img src="../assets/profile-user.png" alt="Profile" class="profile dropbtn">
            <div class="dropdown-content">
                <a href="../views/profile.php"><i class="fas fa-user"></i> View Profile</a>
                <a href="../views/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>
    <div class="formContainerCenter">
        <h2 class="formTitle">Edit Profile</h2>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required>
            </div>

            <div class="form-group">
                <label for="middlename">Middle Name</label>
                <input type="text" id="middlename" name="middlename" value="<?php echo htmlspecialchars($user['middlename']); ?>">
            </div>

            <div class="form-group">
                <label for="suffix">Suffix</label>
                <select id="suffix" name="suffix">
                    <option value="" <?php if ($user['suffix'] === '') echo 'selected'; ?>>None</option>
                    <option value="Jr." <?php if ($user['suffix'] === 'Jr.') echo 'selected'; ?>>Jr.</option>
                    <option value="Sr." <?php if ($user['suffix'] === 'Sr.') echo 'selected'; ?>>Sr.</option>
                    <option value="II" <?php if ($user['suffix'] === 'II') echo 'selected'; ?>>II</option>
                    <option value="III" <?php if ($user['suffix'] === 'III') echo 'selected'; ?>>III</option>
                    <option value="IV" <?php if ($user['suffix'] === 'IV') echo 'selected'; ?>>IV</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sex">Gender</label>
                <select id="sex" name="sex">
                    <option value="Male" <?php if ($user['sex'] === 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($user['sex'] === 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($user['sex'] === 'Other') echo 'selected'; ?>>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="civilstatus">Civil Status</label>
                <select id="civilstatus" name="civilstatus">
                    <option value="single" <?php if ($user['civilstatus'] === 'single') echo 'selected'; ?>>Single</option>
                    <option value="married" <?php if ($user['civilstatus'] === 'married') echo 'selected'; ?>>Married</option>
                    <option value="widowed" <?php if ($user['civilstatus'] === 'widowed') echo 'selected'; ?>>Widowed</option>
                    <option value="divorced" <?php if ($user['civilstatus'] === 'divorced') echo 'selected'; ?>>Divorced</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateofbirth">Date of Birth</label>
                <input type="date" id="dateofbirth" name="dateofbirth" value="<?php echo htmlspecialchars($user['dateofbirth']); ?>" required>
            </div>

            <div class="form-group">
                <label for="region">Region</label>
                <input type="text" id="region" name="region" value="<?php echo htmlspecialchars($user['region']); ?>">
            </div>

            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" id="province" name="province" value="<?php echo htmlspecialchars($user['province']); ?>">
            </div>

            <div class="form-group">
                <label for="municipality">Municipality</label>
                <input type="text" id="municipality" name="municipality" value="<?php echo htmlspecialchars($user['municipality']); ?>">
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" readonly>
            </div>

            <button type="submit" class="submitButton">Update Profile</button>
        </form>
    </div>
    <footer class="footer">
        <div class="left-text">
            <p>&copy; CityEase 2024</p>
        </div>
        <p class="centered-footer-text">YOUR ONE-STOP PLATFORM FOR SEAMLESS COMMUNITY MANAGEMENT</p>
    </footer>
</body>
</html>
