<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbcityease";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reportType = $_POST['reportType'] ?? '';
    $discoveryDate = $_POST['discoveryDate'] ?? '';
    $timeOfIncident = $_POST['timeOfIncident'] ?? '';
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $municipality = $_POST['municipality'] ?? '';
    $details = $_POST['details'] ?? '';
    $involvedPersons = $_POST['involvedPersons'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($reportType) || empty($discoveryDate) || empty($timeOfIncident) || empty($region) || empty($province) || empty($municipality) || empty($details) || empty($involvedPersons) || empty($email)) {
        $message = "All fields are required.";
    } else {
        $sql = "INSERT INTO report (reportType, discoveryDate, timeOfIncident, region, province, municipality, details, involvedPersons, email)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssss", $reportType, $discoveryDate, $timeOfIncident, $region, $province, $municipality, $details, $involvedPersons, $email);

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
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo $message; ?></p>
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
        </form>
    </div>
</div>
</body>
</html>