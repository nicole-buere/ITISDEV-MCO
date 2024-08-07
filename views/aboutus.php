<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CityEase About Us</title>
    <link rel="stylesheet" href="../css/aboutus.css">
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
        <div class="intro">
            <img src="../assets/smart-city.jpg" alt="Smart City" class="header-logo">
            <div>
                <h1>Making Smart Cities Happen</h1>
                <p>CityEase is a comprehensive software solution designed to empower Local Government Units (LGUs) in the Philippines to digitally transform and advance cities, municipalities, and barangays into self-reliant communities, known as Smart Cities.</p>
                <p>Developed with the goal of providing more digital accessibility to key city services and infrastructures such as transportation, electricity, water, healthcare, and more, CityEase enables Smart Cities like yours to actively engage with its citizens and their well-being.</p>
            </div>
        </div>

        <div class="creators">
            <h2>Meet Our Team</h2>
            <p>This is created by Group 5 of the ITISDEV Course, of De La Salle University Manila</p>
            <div class="team-members">
                <div class="member">
                    <h2>Nicole Buere</h2>
                </div>
                <div class="member">
                    <h2>Luisa Jacob</h2>
                </div>
                <div class="member">
                    <h2>Lara Pegalan</h2>
                </div>
                <div class="member">
                    <h2>Nadeen Ramos</h2>
                </div>
                <div class="member">
                    <h2>Josef Tan</h2>
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