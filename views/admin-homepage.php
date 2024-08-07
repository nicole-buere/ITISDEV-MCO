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
                <a href="../views/settings.php"><i class="fas fa-cog"></i> Profile Settings</a>
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
                            <tr>
                                <!-- Placeholder info, should be fetched from SQL table -->
                                <td>8/2/24</td>
                                <td>123</td>
                                <td>Birth Certificate</td>
                                <td>Personal Use</td>
                                <td>John Doe</td>
                                <td>1234567890</td>
                                <td>1234</td>
                                <td>Region 1</td>
                                <td>Province A</td>
                                <td>Municipality B</td>
                                <td>Home</td>
                                <td>
                                    <select name="status" id="status">
                                        <option value="pending">Pending</option>
                                        <option value="declined">Declined</option>
                                        <option value="processing">Processing</option>
                                        <option value="out_for_delivery">Out for Delivery</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- Add more rows here as needed -->
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
                                <th>Date of Request</th>
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
                            <tr>
                                <!-- Placeholder info, should be fetched from SQL table -->
                                <td>8/2/24</td>
                                <td>123</td>
                                <td>Noise Complaint</td>
                                <td>1/1/24</td>
                                <td>10:00 AM</td>
                                <td>John Doe</td>
                                <td>Region 1</td>
                                <td>Province A</td>
                                <td>Municipality B</td>
                                <td>Details of the incident here...</td>
                                <td>
                                    <select name="status" id="status">
                                        <option value="pending">Pending</option>
                                        <option value="declined">Declined</option>
                                        <option value="responded">Responding</option>
                                        <option value="resolved">Resolved</option>
                                    </select>
                                </td>
                            </tr>
                            <!-- Add more rows here as needed -->
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