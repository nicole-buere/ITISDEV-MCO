<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../css/forms.css">
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
    <div class="formContainer">
        <h1 class="formTitle">Payment</h1>
        <img src="../assets/logo-noname.png" alt="logo no name" class="logo">
        <div class="centerDiv">
            <form action="process_payment.php" method="POST" action="hopepage.php">
                <label for="paymentMethod">Payment Method:</label>
                <select id="paymentMethod" name="paymentMethod" onchange="showPaymentFields()" required>
                    <option value="" disabled selected>Select a payment method</option>
                    <option value="creditCard">Credit/Debit Card</option>
                    <option value="gcash">GCash</option>
                    <option value="maya">Maya</option>
                    <option value="bankTransfer">Bank Transfer</option>
                    <option value="cashOnDelivery">Cash on Delivery</option>
                </select>
                <br><br>

                <!-- Credit/Debit Card Fields -->
                <div id="creditCardFields" style="display: none;">
                    <h2>Credit/Debit Card Details</h2>
                    <label for="name">Name on Card:</label>
                    <input type="text" id="name" name="name">
                    <br>

                    <label for="cardNumber">Credit Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" pattern="\d{13,19}" title="Card number should be between 13 and 19 digits">
                    <br>

                    <label for="expiryDate">Expiry Date (MM/YY):</label>
                    <input type="text" id="expiryDate" name="expiryDate" pattern="\d{2}/\d{2}" title="Expiry date should be in MM/YY format">
                    <br>

                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" pattern="\d{3,4}" title="CVV should be 3 or 4 digits">
                    <br>
                </div>

                <!-- GCash Fields -->
                <div id="gcashFields" style="display: none;">
                    <h2>GCash Details</h2>
                    <label for="gcashNO">GCash number:</label>
                    <input type="number" id="gcashNO" name="gcashNO">
                    <br>
                </div>

                <!-- maya Fields -->
                <div id="mayaFields" style="display: none;">
                    <h2>Maya Details</h2>
                    <label for="mayaNO">maya number:</label>
                    <input type="number" id="mayaNO" name="mayaNO">
                    <br>
                </div>

                <!-- Bank Transfer Fields -->
                <div id="bankTransferFields" style="display: none;">
                    <h2>Bank Transfer Details</h2>
                    <label for="bankAccount">Bank Account Number:</label>
                    <input type="text" id="bankAccount" name="bankAccount">
                    <br>

                    <label for="bankName">Bank Name:</label>
                    <input type="text" id="bankName" name="bankName">
                    <br>

                    <label for="transferAmount">Transfer Amount:</label>
                    <input type="number" id="transferAmount" name="transferAmount" min="0.01" step="0.01">
                    <br>
                </div>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>

                <div id="addressFields">
                    <h2>Shipping Address Details</h2>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address">
                    <br>
                </div>

                <button class="submitButton" type="submit">Submit Payment</button>
            </form>
        </div>
    </div>
</body>
</html>
