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

    if (empty($contactNO) || empty($email) || empty($region) || empty($province) || empty($municipality) || empty($requestDoc)) {
        $message = "All fields are required.";
    } else {
        // Check if file was uploaded
        if (isset($_FILES['IDinput']) && $_FILES['IDinput']['error'] == 0) {
            // Read the file content
            $fileContent = file_get_contents($_FILES['IDinput']['tmp_name']);

            $sql = "INSERT INTO request (contactnum, region, province, municipality, email, doc_type, governmentid)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssssssb", $contactNO, $region, $province, $municipality, $email, $requestDoc, $fileContent);

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
    <title>Request Documents</title>
    <link rel="stylesheet" href="../css/forms.css">
    <style>
        body {
            background: linear-gradient(-180deg, #1070E8, #D1DDEB);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .formContainer {
            width: 80%;
            max-width: 1200px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            max-height: 2000px; 
            overflow-y: auto; 
            box-sizing: border-box;
        }

        .logo {
            width: 150px;
            height: auto;
            position: absolute;
            top: 40px; 
            left: 20px;
        }

        .formTitle {
            text-align: center;
            color: #1F628E;
            margin-top: 180px; 
            margin-bottom: 20px;
        }

        .formTitle span {
            display: block;
            font-size: 0.8em;
            color: #1F628E;
        }

        .message {
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            margin-right: 10px;
        }

        .half-width {
            flex: 0 0 48%;
        }

        .full-width {
            width: 100%;
        }

        .formFieldLabel {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        .contactField {
            padding: 8px; 
            border-radius: 4px; 
        }

        .submitButton {
            display: block;
            width: 100%;
            padding: 25px;  
            background-color: #1F628E;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.5em; 
            cursor: pointer;
            margin-top: 30px; 
            box-sizing: border-box; 
        }

        .submitButton:hover {
            background-color: #155a8a;
        }
    </style>
</head>
<body>
    <div class="formContainer">
        <img src="../assets/logo-noname.png" alt="CityEase Logo" class="logo">
        <h1 class="formTitle">Request a Document <span><?php echo isset($_SESSION['requestId']) ? 'Request ID: ' . $_SESSION['requestId'] : ''; ?></span></h1>
        <?php if ($message): ?>
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="contactNO" class="formFieldLabel">Contact Number:</label>
                    <input type="text" name="contactNO" id="contactNO" class="contactField" required>
                </div>
                <div class="form-group half-width">
                    <label for="email" class="formFieldLabel">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="region" class="formFieldLabel">Region:</label>
                    <input type="text" name="region" id="region" required>
                </div>
                <div class="form-group half-width">
                    <label for="province" class="formFieldLabel">Province:</label>
                    <input type="text" name="province" id="province" required>
                </div>
                <div class="form-group half-width">
                    <label for="municipality" class="formFieldLabel">Municipality:</label>
                    <input type="text" name="municipality" id="municipality" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="requestDoc" class="formFieldLabel">Document Type:</label>
                    <select name="requestDoc" id="requestDoc" required>
                        <option class="selectOption" value="barangayClearance">Barangay Clearance</option>
                        <option class="selectOption" value="barangayID">Barangay ID</option>
                        <option class="selectOption" value="barangayCertificateOfResidency">Barangay Certificate of Residency</option>
                        <option class="selectOption" value="firstTimeJobseekerCertificate">First Time Jobseeker Certificate</option>
                        <option class="selectOption" value="barangayBusinessPermit">Barangay Business Permit</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="IDinput" class="formFieldLabel">Government ID:</label>
                    <input type="file" name="IDinput" id="IDinput" required>
                </div>
            </div>
            <button type="submit" class="submitButton">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
