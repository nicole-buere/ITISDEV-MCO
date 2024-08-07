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
    $contactNO = trim($_POST['contactNO'] ?? '');
    $requestDoc = trim($_POST['requestDoc'] ?? '');
    $requestReason = trim($_POST['requestReason'] ?? '');
    $deliveryAddress = trim($_POST['deliveryAddress'] ?? '');

    if (empty($contactNO) || empty($requestDoc) || empty($requestReason) || empty($deliveryAddress) || empty($email)) {
        $message = "All fields are required.";
    } else {
        // Fetch user details
        $sqlFetch = $conn->prepare("SELECT region, province, municipality, firstname, middlename, lastname FROM signup WHERE email = ?");
        $sqlFetch->bind_param("s", $email);
        $sqlFetch->execute();
        $resultFetch = $sqlFetch->get_result();

        if ($resultFetch->num_rows > 0) {
            $row = $resultFetch->fetch_assoc();
            $region = $row['region'];
            $province = $row['province'];
            $municipality = $row['municipality'];
            $requesterName = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'];

            // Check if file was uploaded
            if (isset($_FILES['governmentID']) && $_FILES['governmentID']['error'] == 0) {
                $fileContent = file_get_contents($_FILES['governmentID']['tmp_name']);
                
                if ($fileContent !== false) {
                    // Insert request details into the database
                    $sql = "INSERT INTO request (contactNO, region, province, municipality, email, requestDoc, governmentID, requestReason, requesterName, deliveryAddress)
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    if ($stmt = $conn->prepare($sql)) {
                        $null = NULL;
                        $stmt->bind_param("ssssssbsss", $contactNO, $region, $province, $municipality, $email, $requestDoc, $null, $requestReason, $requesterName, $deliveryAddress);
                        $stmt->send_long_data(6, $fileContent);
                        
                        if ($stmt->execute()) {
                            $requestId = $stmt->insert_id;
                            $message = "Request submitted successfully. Request ID: " . $requestId;

                            // Store requestId in session
                            $_SESSION['requestId'] = $requestId;

                            // Redirect to payment.php after successful submission
                            header("Location: payment.php");
                            exit();
                        } else {
                            $message = "Execute Error: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        $message = "Prepare Error: " . $conn->error;
                    }
                } else {
                    $message = "Failed to read file content.";
                }
            } else {
                $message = "Failed to upload file. Error Code: " . ($_FILES['governmentID']['error'] ?? 'unknown');
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
                <a href="../views/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="main-content">     
        <h1 class="formTitle">Request a Document <span><?php echo isset($_SESSION['requestId']) ? 'Request ID: ' . $_SESSION['requestId'] : ''; ?></span></h1>
        <?php if ($message): ?>
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo htmlspecialchars($message); ?></p>
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
                    <label for="governmentID" class="formFieldLabel">Government ID <span class="sample">(e.g., Scanned Copy of Driver License, Passport)</span>:</label>
                    <input type="file" name="governmentID" id="governmentID" class="fileInput" required>
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
