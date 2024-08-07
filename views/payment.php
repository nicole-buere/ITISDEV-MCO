<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../css/payment.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script>
        function updateTotalAmount() {
            var amount = document.getElementById('amount').value;
            document.getElementById('totalAmount').textContent = 'Total Amount: $' + amount;
        }

        function showPaymentFields() {
            var method = document.getElementById('paymentMethod').value;
            document.getElementById('creditCardFields').style.display = method === 'creditCard' ? 'block' : 'none';
            document.getElementById('gcashFields').style.display = method === 'gcash' ? 'block' : 'none';
            document.getElementById('mayaFields').style.display = method === 'maya' ? 'block' : 'none';
            document.getElementById('bankTransferFields').style.display = method === 'bankTransfer' ? 'block' : 'none';
            document.getElementById('cashOnDeliveryFields').style.display = method === 'cod' ? 'block' : 'none';
        }
    </script>
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

<main>
    <h1 class="formTitle">Payment</h1>
    <div class="formContainer">
        <form action="redirect-pay.php" method="POST" class="centerForm">
            <label for="paymentMethod">Payment Method:</label>
            <select id="paymentMethod" name="paymentMethod" onchange="showPaymentFields()" required>
                <option value="" disabled selected>Select a payment method</option>
                <option value="creditCard">Credit/Debit Card</option>
                <option value="gcash">GCash</option>
                <option value="maya">Maya</option>
                <option value="bankTransfer">Bank Transfer</option>
                <option value="cashOnDelivery">Cash on Delivery</option>
            </select>

            <!-- Credit/Debit Card Fields -->
            <div id="creditCardFields" class="paymentFields">
                <h2>Credit/Debit Card Details</h2>
                <label for="name">Name on Card:</label> 
                <input type="text" id="name" name="name"><br>
                <label for="cardNumber">Credit Card Number:</label>
                <input type="text" id="cardNumber" name="cardNumber" pattern="\d{13,19}" title="Card number should be between 13 and 19 digits"><br>
                <label for="expiryDate">Expiry Date (MM/YY):</label>
                <input type="text" id="expiryDate" name="expiryDate" pattern="\d{2}/\d{2}" title="Expiry date should be in MM/YY format">
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" pattern="\d{3,4}" title="CVV should be 3 or 4 digits">
            </div>

            <!-- GCash Fields -->
            <div id="gcashFields" class="paymentFields">
                <h2>GCash Details</h2>
                <label for="gcashNO">GCash number:</label>
                <input type="text" id="gcashNO" name="gcashNO">
            </div>

            <!-- Maya Fields -->
            <div id="mayaFields" class="paymentFields">
                <h2>Maya Details</h2>
                <label for="mayaNO">Maya number:</label>
                <input type="text" id="mayaNO" name="mayaNO">
            </div>

            <!-- Bank Transfer Fields -->
            <div id="bankTransferFields" class="paymentFields">
                <h2>Bank Transfer Details</h2>
                <label for="bankAccount">Bank Account Number:</label>
                <input type="text" id="bankAccount" name="bankAccount"><br>
                <label for="bankName">Bank Name:</label>
                <input type="text" id="bankName" name="bankName"><br>
                <label for="transferAmount">Transfer Amount:</label>
                <input type="number" id="transferAmount" name="transferAmount" min="0.01" step="0.01">
            </div>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button class="submitButton" type="submit">Submit Payment</button>
        </form>
    </div>
</main>

<footer class="footer">
    <div class="left-text">
        <p>&copy; CityEase 2024</p>
    </div>
    <p class="centered-footer-text">YOUR ONE-STOP PLATFORM FOR SEAMLESS COMMUNITY MANAGEMENT</p>
</footer>

</body>
</html>
