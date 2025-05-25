<?php
session_start();
include("connection.php");


if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="logo1.png">
    <title>Flicker - Secure Payment</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .payment-box {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }
        label {
            font-weight: 600;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #4facfe;
            outline: none;
        }
        .pay-btn {
            width: 100%;
            background: #28a745;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .pay-btn:hover {
            background: #218838;
        }
        #payment-status {
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        /* Modal Styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="payment-box">
    <div class="info">
        <?php
        $movieName = isset($_GET['movieName']) ? urldecode($_GET['movieName']) : 'Unknown Movie';
        $sid = isset($_GET['sid']) ? urldecode($_GET['sid']) : 'Unknown sid';
        $price = isset($_GET['price']) ? urldecode($_GET['price']) : 'Unknown price';
        $tname = isset($_GET['tname']) ? urldecode($_GET['tname']) : 'Unknown theatre'; 
        $time = isset($_GET['time']) ? urldecode($_GET['time']) : 'Unknown time';
        ?>

        <p>Movie: <?php echo htmlspecialchars($movieName); ?></p>
        <p>Theatre: <?php echo htmlspecialchars($tname); ?></p>
        <p>Rs. <?php echo htmlspecialchars($price); ?></p>
        <p>Showtime <?php echo htmlspecialchars($time); ?></p>
    </div>
    <h2>Secure Payment</h2>
    <form id="payment-form" action="index.php" method="POST" onsubmit="return validateForm()">
        <div class="input-group">
            <label for="name">Cardholder Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="input-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card-number" maxlength="16" required>
        </div>
        <div class="input-group">
            <label for="expiry">Expiry Date</label>
            <input type="month" id="expiry" name="expiry" required>
        </div>
        <div class="input-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required>
        </div>
        <button type="submit" class="pay-btn">Pay Now</button>
    </form>
    <p id="payment-status"></p>
</div>

<!-- Modal for Payment Status -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <p id="modal-message"></p>
    </div>
</div>

<script>
    function validateForm() {
        const cardNumber = document.getElementById("card-number").value;
        const cvv = document.getElementById("cvv").value;
        const expiry = document.getElementById("expiry").value;
        const paymentStatus = document.getElementById("payment-status");

        // Basic validation for card number and CVV
        const cardNumberPattern = /^[0-9]{16}$/;
        const cvvPattern = /^[0-9]{3}$/;

        if (!cardNumberPattern.test(cardNumber)) {
            paymentStatus.innerText = "Invalid card number. Please enter a 16-digit number.";
            return false;
        }

        if (!cvvPattern.test(cvv)) {
            paymentStatus.innerText = "Invalid CVV. Please enter a 3-digit number.";
            return false;
        }

        // Validate expiry date
        const currentDate = new Date();
        const selectedExpiry = new Date(expiry + "-01"); // Add a day to the month to create a valid date
        if (selectedExpiry < currentDate) {
            paymentStatus.innerText = "Expiry date cannot be in the past.";
            return false;
        }

        // If all validations pass, show success alert
        alert("Payment Successful! 🎉");
        window.location.href = "index.php"; 
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none"; // Hide modal
        window.location.href = "index.php"; // Redirect after closing modal
    }

    // Close the modal when the user clicks anywhere outside of it
    window.onclick = function(event) {
        const modal = document.getElementById("myModal");
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

</body>
</html>