<!-- fake paymongo -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paymongo</title>
    <link rel="stylesheet" href="../css/paymongo.css">
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="../assets/paymongo-logo.png" alt="Logo" class="header-logo">
        </div>
    </div>

    <div class="amount-pay">
        <h1>Amount to Pay</h1>
        <h2>₱20.00</h2>
        <hr>
        <p>Payment for processing fee</p>
        <p><strong>ITEM NAME:</strong> Document: [insert chosen document]</p>
        <button class="pay-button" onclick="processPayment()">Pay</button>
    </div>

    <div class="payment-success" style="display: none;">
        <img src="../assets/check.png" alt="success" class="success-pay">
        <h1>Payment Successful</h1>
        <p>Reference Number: <span id="reference-number"></span></p>
        <p>Transaction Date: <span id="transaction-date"></span></p>
        <button class="redirect-button" onclick="redirectToCityEase()">Redirect Back to CityEase</button>
    </div>

    <script>
        let referenceNumber = localStorage.getItem('referenceNumber') || 193284;

        function processPayment() {
            // Increment reference number
            referenceNumber++;
            localStorage.setItem('referenceNumber', referenceNumber);

            // Display payment success section
            document.querySelector('.amount-pay').style.display = 'none';
            document.querySelector('.payment-success').style.display = 'block';

            // Set reference number and transaction date
            document.getElementById('reference-number').innerText = referenceNumber;
            document.getElementById('transaction-date').innerText = new Date().toLocaleString();
        }

        function redirectToCityEase() {
            window.location.href = "../views/homepage.php";
        }

        // Ensure "Amount to Pay" section is shown on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.amount-pay').style.display = 'block';
            document.querySelector('.payment-success').style.display = 'none';
        });
    </script>
</body>
</html>