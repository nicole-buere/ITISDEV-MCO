<!-- shows all user's transactions -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase Homepage</title>
    <link rel="stylesheet" href="../css/transactions.css">
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
                <a href="../views/settings.php"><i class="fas fa-cog"></i> Profile Settings</a>
                <a href="../views/index.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </header>

    <div class="main-content">
        <h2>Your Transactions</h2>
        <table>
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database connection
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

                // Fetch user's email from session (assuming user is logged in and email is stored in session)
                session_start();
                $userEmail = $_SESSION['email'];

                // Fetch transactions from report table
                $reportSql = "SELECT reportid, reportType FROM report WHERE email='$userEmail'";
                $reportResult = $conn->query($reportSql);

                if ($reportResult->num_rows > 0) {
                    // Output data for each row
                    while($row = $reportResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["reportid"] . "</td>";
                        echo "<td>Report</td>";
                        echo "<td>" . $row["reportType"] . "</td>";
                        echo "<td>Pending</td>";  // Replace with actual status if available
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No report transactions found.</td></tr>";
                }

                // Fetch transactions from request table
                $requestSql = "SELECT requestid, requestDoc FROM request WHERE email='$userEmail'";
                $requestResult = $conn->query($requestSql);

                if ($requestResult->num_rows > 0) {
                    // Output data for each row
                    while($row = $requestResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["requestid"] . "</td>";
                        echo "<td>Request</td>";
                        echo "<td>" . $row["requestDoc"] . "</td>";
                        echo "<td>Pending</td>";  // Replace with actual status if available
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No document request transactions found.</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <div class="left-text">
            <p>&copy; CityEase 2024</p>
        </div>
        <p class="centered-footer-text">YOUR ONE-STOP PLATFORM FOR SEAMLESS COMMUNITY MANAGEMENT</p>
    </footer>
</body>
</html>