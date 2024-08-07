<?php
session_start();
require_once '../includes/db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

$email = $_SESSION['email'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reportType = trim($_POST['reportType'] ?? '');
    $discoveryDate = trim($_POST['discoveryDate'] ?? '');
    $details = trim($_POST['details'] ?? '');

    if (empty($reportType) || empty($discoveryDate) || empty($details)) {
        $message = "All fields are required.";
    } else {
        // Fetch user details
        $sqlFetch = $conn->prepare("SELECT region, province, municipality FROM signup WHERE email = ?");
        $sqlFetch->bind_param("s", $email);
        $sqlFetch->execute();
        $resultFetch = $sqlFetch->get_result();

        if ($resultFetch->num_rows > 0) {
            $row = $resultFetch->fetch_assoc();
            $region = $row['region'];
            $province = $row['province'];
            $municipality = $row['municipality'];

            // Insert report details into the database
            $sql = "INSERT INTO report (reportType, discoveryDate, details, region, province, municipality, email)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssssss", $reportType, $discoveryDate, $details, $region, $province, $municipality, $email);
                
                if ($stmt->execute()) {
                    $reportId = $stmt->insert_id;
                    $message = "Report submitted successfully. Report ID: " . $reportId;
                } else {
                    $message = "Execute Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $message = "Prepare Error: " . $conn->error;
            }
        } else {
            $message = "No user details found.";
        }

        $sqlFetch->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase Report an Issue</title>
    <link rel="stylesheet" href="../css/report.css">
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
        <h1 class="formTitle">Report an Issue</h1>
        <?php if ($message): ?>
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="formContainer">
                <div class="form-group full-width">
                    <label for="reportType" class="formFieldLabel">Type of Incident:</label>
                    <input type="text" name="reportType" id="reportType" placeholder="e.g., infrastructure, environment, public safety" required>
                </div>
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="discoveryDate" class="formFieldLabel">Date of Incident:</label>
                        <input type="date" name="discoveryDate" id="discoveryDate" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="timeOfIncident" class="formFieldLabel">Time of Incident:</label>
                        <input type="time" name="timeOfIncident" id="timeOfIncident" required>
                    </div>
                </div>
                <div class="form-group full-width">
                    <label for="details" class="formFieldLabel">Narrative Details of Incident:</label>
                    <textarea name="details" id="details" required></textarea>
                </div>
                <div class="form-group full-width">
                    <label for="involvedPersons" class="formFieldLabel">Involved Person/s (if you don't know the name, describe the person by age, gender, etc.):</label>
                    <textarea name="involvedPersons" id="involvedPersons" required></textarea>
                </div>
                <button type="submit" id="submitReport" class="submitButton">Submit Report</button>
            </div>
        </form>
    </div>
</body>
</html>
