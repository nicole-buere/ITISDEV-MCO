<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase Admin Homepage</title>
    <link rel="stylesheet" href="../css/admin-home.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/table.css">
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="../assets/logo-noname.png" alt="Logo" class="header-logo">
            <h2>CityEase</h2>
        </div>
        <nav>
            <a class="first-button" href="../views/admin-homepage.php">Home</a>
            <a class="first-button" href="../views/aboutus.php">About Us</a>
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
        <div class="greeting">
            <h1>Welcome, Admin!</h1>
            <p>Ready to make a difference today? Manage and respond to citizens' requests to keep our community thriving.</p>
        </div>
        <div class="service">
            <!-- Document Requests Section -->
            <div class="reqs">
                <div class="box">
                    <h3>Document Requests</h3>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date of Request</th>
                                <th>Request ID</th>
                                <th>Type of Document</th>
                                <th>Reason for Requesting</th>
                                <th>Requester</th>
                                <th>Contact Number</th>
                                <th>Government ID</th>
                                <th>Region</th>
                                <th>Province</th>
                                <th>Municipality</th>
                                <th>Delivery Address</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $conn = new mysqli("localhost", "root", "", "dbcityease");

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch document requests
                            $sql = "SELECT * FROM request";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["requestDate"] . "</td>
                                        <td>" . $row["requestid"] . "</td>
                                        <td>" . $row["requestDoc"] . "</td>
                                        <td>" . $row["requestReason"] . "</td>
                                        <td>" . $row["requesterName"] . "</td>
                                        <td>" . $row["contactNO"] . "</td>
                                        <td><a href='../assets/GovernmentID.png' download>Download ID</a></td>
                                        <td>" . $row["region"] . "</td>
                                        <td>" . $row["province"] . "</td>
                                        <td>" . $row["municipality"] . "</td>
                                        <td>" . $row["deliveryAddress"] . "</td>
                                        <td>
                                            <form method='POST' action='update_status.php'>
                                                <input type='hidden' name='id' value='" . $row["requestid"] . "'>
                                                <input type='hidden' name='type' value='request'>
                                                <select name='status' id='status' onchange='this.form.submit()'>
                                                    <option value='pending'" . ($row["status"] == 'pending' ? ' selected' : '') . ">Pending</option>
                                                    <option value='declined'" . ($row["status"] == 'declined' ? ' selected' : '') . ">Declined</option>
                                                    <option value='processing'" . ($row["status"] == 'processing' ? ' selected' : '') . ">Processing</option>
                                                    <option value='out_for_delivery'" . ($row["status"] == 'out_for_delivery' ? ' selected' : '') . ">Out for Delivery</option>
                                                    <option value='completed'" . ($row["status"] == 'completed' ? ' selected' : '') . ">Completed</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='12'>No document requests found</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Reported Issues Section -->
            <div class="reqs">
                <div class="box">
                    <h3>Reported Issues</h3>
                </div>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Date of Discovery</th>
                                <th>Report ID</th>
                                <th>Type of Incident</th>
                                <th>Date of Incident</th>
                                <th>Time of Incident</th>
                                <th>Involved Person</th>
                                <th>Region</th>
                                <th>Province</th>
                                <th>Municipality</th>
                                <th>Narrative Details of Incident</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Database connection
                            $conn = new mysqli("localhost", "root", "", "dbcityease");

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch reported issues
                            $sql = "SELECT * FROM report";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . htmlspecialchars($row["discoveryDate"]) . "</td>
                                        <td>" . htmlspecialchars($row["reportid"]) . "</td>
                                        <td>" . htmlspecialchars($row["reportType"]) . "</td>
                                        <td>" . htmlspecialchars($row["discoveryDate"]) . "</td>
                                        <td>--</td> <!-- Placeholder for Time of Incident if available -->
                                        <td>" . htmlspecialchars($row["email"]) . "</td>
                                        <td>" . htmlspecialchars($row["region"]) . "</td>
                                        <td>" . htmlspecialchars($row["province"]) . "</td>
                                        <td>" . htmlspecialchars($row["municipality"]) . "</td>
                                        <td>" . htmlspecialchars($row["details"]) . "</td>
                                        <td>
                                            <form method='POST' action='update_status.php'>
                                                <input type='hidden' name='id' value='" . htmlspecialchars($row["reportid"]) . "'>
                                                <input type='hidden' name='type' value='report'>
                                                <select name='status' id='status' onchange='this.form.submit()'>
                                                    <option value='pending'" . ($row["status"] == 'pending' ? ' selected' : '') . ">Pending</option>
                                                    <option value='declined'" . ($row["status"] == 'declined' ? ' selected' : '') . ">Declined</option>
                                                    <option value='responded'" . ($row["status"] == 'responded' ? ' selected' : '') . ">Responded</option>
                                                    <option value='resolved'" . ($row["status"] == 'resolved' ? ' selected' : '') . ">Resolved</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='11'>No reported issues found</td></tr>";
                            }

                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

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
