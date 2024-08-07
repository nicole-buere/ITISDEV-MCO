<?php
session_start();
require_once '../includes/db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase Profile</title>
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
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
            <img src="../assets/profile-user.png" alt="profile" class="profile dropbtn">
            <div class="dropdown-content">
                <a href="../views/profile.php"><i class="fas fa-user"></i> View Profile</a>
                <a href="../views/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>
    <div class="main-content">
        <div class="profile-container">
            <div class="profile-header">
                <img src="../assets/profile-user.png" alt="profile" class="profile-picture">
                <h3><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?></h3>
            </div>
            <div class="profile-details">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p><strong>Middle Name:</strong> <?php echo htmlspecialchars($user['middlename']); ?></p>
                <p><strong>Suffix:</strong> <?php echo htmlspecialchars($user['suffix']); ?></p>
                <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['sex']); ?></p>
                <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($user['civilstatus']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user['dateofbirth']); ?></p>
                <p><strong>Region:</strong> <?php echo htmlspecialchars($user['region']); ?></p>
                <p><strong>Province:</strong> <?php echo htmlspecialchars($user['province']); ?></p>
                <p><strong>Municipality:</strong> <?php echo htmlspecialchars($user['municipality']); ?></p>
                <p><strong>Role:</strong> <?php echo htmlspecialchars($user['role']); ?></p>
            </div>
            <a href="edit_profile.php" class="edit-profile-button">Edit Profile</a>
        </div>
    </div>
    <footer class="footer">
        <div class="left-text">
            <p>&copy; CityEase 2024</p>
        </div>
        <p class="centered-footer-text">YOUR ONE-STOP PLATFORM FOR SEAMLESS COMMUNITY MANAGEMENT</p>
    </footer>
</body>
</html>
