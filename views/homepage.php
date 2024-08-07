<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase Homepage</title>
    <link rel="stylesheet" href="../css/homepage.css">
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
        <div class="top-section">
            <div class="text-box">
                <h3>Welcome to CityEase!</h3>
                <h4>YOUR ONE-STOP PLATFORM FOR SEAMLESS COMMUNITY MANAGEMENT.</h4>
                <br>
                <p>At CityEase, we are dedicated to enhancing the efficiency and accessibility of local government services for</p>
                <p>barangays across our city. Our mission is to streamline the way citizens interact with their local government,</p>
                <p>making it easier to report issues, manage documents, and stay informed about community updates.</p>
            </div>
        </div>

        <div class="bottom-section">
            <div class="service">
                <h2>YOUR GATEWAY TO LOCAL SERVICES</h2>
                <div class="row-box">
                    <!-- for request documents -->
                    <div class="info-box">
                        <div class="img-box">
                            <img src="../assets/request.png" alt="Request Documents" class="profile">
                        </div>
                        <div class="description">
                            <h4>Request Documents</h4>
                            <p>Skip the trip to your barangay office and the long queues.</p>
                            <p>Simply request all your essential documents with a few clicks right here!</p>
                        </div>
                    </div>
                    <!-- for Report an Issue -->
                    <div class="info-box">
                        <div class="img-box">
                            <img src="../assets/report.png" alt="Report an Issue" class="profile">
                        </div>
                        <div class="description">
                            <h4>Report an Issue</h4>
                            <p>No need to visit the barangay office to voice your concerns.</p>
                            <p>Just click, report, and get a quick response to any issue in your community!</p>
                        </div>
                    </div>
                </div>        
            </div>

            <div class="about-cityease">
                <div class="text-content">
                    <h2>CityEase</h2>
                    <hr>
                    <p>CityEase is your comprehensive platform for effortless community management. Our user-friendly interface empowers you to report issues, manage documents, and access local services with ease.</p>
                    <p>Designed to enhance transparency and citizen engagement, CityEase connects you with your local government, ensuring your voice is heard and your needs are promptly addressed.</p>
                    <p>Embrace efficient, accessible, and innovative governance solutions with CityEase, and help shape a responsive and connected community.</p>
                </div>
                <img src="../assets/logowtext.png" alt="CityEase Logo">
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