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
    $region = $_POST['region'] ?? '';
    $province = $_POST['province'] ?? '';
    $municipality = $_POST['municipality'] ?? '';
    $details = $_POST['details'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($reportType) || empty($discoveryDate) || empty($region) || empty($province) || empty($municipality) || empty($details) || empty($email)) {
        $message = "All fields are required.";
    } else {
        $sql = "INSERT INTO report (type, dateofissuediscovery, details, region, province, municipality, email)
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
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Issue</title>
    <link rel="stylesheet" href="css/forms.css">
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
        }

        .logo {
            width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 20px;
        }

        .formTitle {
            text-align: center;
            color: #1F628E;
            margin-bottom: 20px;
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

        .third-width {
            flex: 0 0 30%;
        }

        .full-width {
            width: 100%;
        }

        .formFieldLabel {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        .submitButton {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #1F628E;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2em;
            cursor: pointer;
            margin-top: 20px;
        }

        .submitButton:hover {
            background-color: #155a8a;
        }
    </style>
</head>
<body>
    <div class="formContainer">
        <img src="../assets/logo-noname.png" alt="CityEase Logo" class="logo">
        <h1 class="formTitle">Report an Issue</h1>
        <?php if ($message): ?>
            <p class="message" style="color: <?php echo strpos($message, 'Error:') === 0 ? 'red' : 'green'; ?>;"><?php echo $message; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="reportType" class="formFieldLabel">Type:</label>
                    <input type="text" name="reportType" id="reportType" required>
                </div>
                <div class="form-group half-width">
                    <label for="discoveryDate" class="formFieldLabel">Date of Discovery:</label>
                    <input type="date" name="discoveryDate" id="discoveryDate" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group third-width">
                    <label for="region" class="formFieldLabel">Region:</label>
                    <select name="region" id="region" required>
                        <option value="" selected disabled>Select a region</option>
                        <!-- Add all regions -->
                        <option value="NCR">National Capital Region (NCR)</option>
                        <option value="CAR">Cordillera Administrative Region (CAR)</option>
                        <option value="I">Ilocos Region</option>
                        <option value="II">Cagayan Valley</option>
                        <option value="III">Central Luzon</option>
                        <option value="IV-A">CALABARZON</option>
                        <option value="IV-B">MIMAROPA</option>
                        <option value="V">Bicol Region</option>
                        <option value="VI">Western Visayas</option>
                        <option value="VII">Central Visayas</option>
                        <option value="VIII">Eastern Visayas</option>
                        <option value="IX">Zamboanga Peninsula</option>
                        <option value="X">Northern Mindanao</option>
                        <option value="XI">Davao Region</option>
                        <option value="XII">SOCCSKSARGEN</option>
                        <option value="CARAGA">Caraga</option>
                        <option value="BARMM">Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)</option>
                    </select>
                </div>
                <div class="form-group third-width">
                    <label for="province" class="formFieldLabel">Province:</label>
                    <select name="province" id="province" required>
                        <option value="" selected disabled>Select a province</option>
                        <!-- Provinces will be populated dynamically based on selected region -->
                    </select>
                </div>
                <div class="form-group third-width">
                    <label for="municipality" class="formFieldLabel">Municipality:</label>
                    <input type="text" name="municipality" id="municipality" required>
                </div>
            </div>
            <div class="form-group full-width">
                <label for="details" class="formFieldLabel">Details:</label>
                <textarea name="details" id="details" required></textarea>
            </div>
            <div class="form-group full-width">
                <label for="email" class="formFieldLabel">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <button type="submit" id="submitReport" class="submitButton">Submit Report</button>
        </form>
    </div>
    <script>
        document.getElementById('region').addEventListener('change', function() {
            var region = this.value;
            var provinceSelect = document.getElementById('province');

            provinceSelect.innerHTML = '<option value="" selected disabled>Select a province</option>';
            
            var provinces = {
                'NCR': ['Metro Manila'],
                'CAR': ['Abra', 'Apayao', 'Benguet', 'Ifugao', 'Kalinga', 'Mountain Province'],
                'I': ['Ilocos Norte', 'Ilocos Sur', 'La Union', 'Pangasinan'],
                'II': ['Batanes', 'Cagayan', 'Isabela', 'Nueva Vizcaya', 'Quirino'],
                'III': ['Aurora', 'Bataan', 'Bulacan', 'Nueva Ecija', 'Pampanga', 'Tarlac', 'Zambales'],
                'IV-A': ['Batangas', 'Cavite', 'Laguna', 'Quezon', 'Rizal'],
                'IV-B': ['Marinduque', 'Occidental Mindoro', 'Oriental Mindoro', 'Palawan', 'Romblon'],
                'V': ['Albay', 'Camarines Norte', 'Camarines Sur', 'Catanduanes', 'Masbate', 'Sorsogon'],
                'VI': ['Aklan', 'Antique', 'Capiz', 'Iloilo', 'Negros Occidental'],
                'VII': ['Bohol', 'Cebu', 'Negros Oriental', 'Siquijor'],
                'VIII': ['Biliran', 'Eastern Samar', 'Leyte', 'Northern Samar', 'Samar', 'Southern Leyte'],
                'IX': ['Zamboanga del Norte', 'Zamboanga del Sur', 'Zamboanga Sibugay'],
                'X': ['Bukidnon', 'Camiguin', 'Lanao del Norte', 'Misamis Occidental', 'Misamis Oriental'],
                'XI': ['Davao de Oro', 'Davao del Norte', 'Davao del Sur', 'Davao Occidental', 'Davao Oriental'],
                'XII': ['Cotabato', 'Sarangani', 'South Cotabato', 'Sultan Kudarat'],
                'CARAGA': ['Agusan del Norte', 'Agusan del Sur', 'Dinagat Islands', 'Surigao del Norte', 'Surigao del Sur'],
                'BARMM': ['Basilan', 'Lanao del Sur', 'Maguindanao', 'Sulu', 'Tawi-Tawi']
            };
            
            if (provinces[region]) {
                provinces[region].forEach(function(province) {
                    var option = document.createElement('option');
                    option.value = province;
                    option.textContent = province;
                    provinceSelect.appendChild(option);
                });
            }
        });
    </script>
</body>
</html>

