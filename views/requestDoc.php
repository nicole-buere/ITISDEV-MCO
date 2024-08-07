<?php
session_start(); // Start the session

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
    $contactNO = $_POST['contactNO'] ?? '';
    $email = $_POST['email'] ?? '';
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $municipality = $_POST['municipality'] ?? '';
    $requestDoc = $_POST['requestDoc'] ?? '';
    $requestReason = $_POST['requestReason'] ?? '';
    $requesterName = $_POST['requesterName'] ?? '';
    $deliveryAddress = $_POST['deliveryAddress'] ?? '';

    if (empty($contactNO) || empty($email) || empty($region) || empty($province) || empty($municipality) || empty($requestDoc) || empty($requestReason) || empty($requesterName) || empty($deliveryAddress)) {
        $message = "All fields are required.";
    } else {
        // Check if file was uploaded
        if (isset($_FILES['IDinput']) && $_FILES['IDinput']['error'] == 0) {
            // Read the file content
            $fileContent = file_get_contents($_FILES['IDinput']['tmp_name']);

            $sql = "INSERT INTO request (contactnum, region, province, municipality, email, doc_type, governmentid, request_reason, requester_name, delivery_address)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssssbsss", $contactNO, $region, $province, $municipality, $email, $requestDoc, $fileContent, $requestReason, $requesterName, $deliveryAddress);

                if ($stmt->execute()) {
                    $requestId = $stmt->insert_id; // Get the last inserted ID
                    $message = "Request submitted successfully. Request ID: " . $requestId;

                    // Store requestId in session
                    $_SESSION['requestId'] = $requestId;

                    // Redirect to payment.php after successful submission
                    header("Location: payment.php");
                    exit(); // Ensure no further code is executed
                } else {
                    $message = "Execute Error: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $message = "Prepare Error: " . $conn->error;
            }
        } else {
            $message = "Failed to upload file. Error Code: " . ($_FILES['IDinput']['error'] ?? 'unknown');
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
    <title>CityEase Request Document</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/req-doc.css">
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
                <a href="../views/settings.php"><i class="fas fa-cog"></i> Profile Settings</a>
                <a href="../views/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="main-content">     
        <h1 class="formTitle">Request a Document <span><?php echo isset($_SESSION['requestId']) ? 'Request ID: ' . $_SESSION['requestId'] : ''; ?></span></h1>
        <?php if ($message): ?>
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo $message; ?></p>
        <?php endif; ?>
        <p class="note">Take note that your profile information will be considered as the requester's information.</p>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-container">
                <div class="form-group half-width">
                    <label for="requestDoc" class="formFieldLabel">Document Type:</label>
                    <select name="requestDoc" id="requestDoc" required>
                        <option value="" selected>Select a document</option>
                        <option class="selectOption" value="barangayClearance">Barangay Clearance</option>
                        <option class="selectOption" value="barangayID">Barangay ID</option>
                        <option class="selectOption" value="barangayCertificateOfResidency">Barangay Certificate of Residency</option>
                        <option class="selectOption" value="firstTimeJobseekerCertificate">First Time Jobseeker Certificate</option>
                        <option class="selectOption" value="barangayBusinessPermit">Barangay Business Permit</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="requestReason" class="formFieldLabel">Reason for Requesting <span class="sample">(e.g., for employment, school, business)</span>:</label>
                    <input type="text" name="requestReason" id="requestReason" class="requestReasonField" required>
                </div>

                <div class="form-group full-width">
                    <label for="contactNO" class="formFieldLabel">Contact Number <span class="sample">(e.g., 0999472839)</span>:</label>
                    <input type="text" name="contactNO" id="contactNO" class="contactField" required>
                </div>

                <div class="form-group full-width">
                    <label for="IDinput" class="formFieldLabel">Government ID <span class="sample">(e.g., Scanned Copy of Driver License, Passport)</span>:</label>
                    <input type="file" name="IDinput" id="IDinput" class="fileInput" required>
                </div>

                <div class="form-group full-width">
                    <label for="deliveryAddress" class="formFieldLabel">Delivery Address <span class="sample">(e.g., Lot 123, Street, City)</span>:</label>
                    <input type="text" name="deliveryAddress" id="deliveryAddress" class="deliveryAddressField" required>
                </div>

                <button type="submit" class="submitButton">Proceed to Payment</button>
            </div>
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