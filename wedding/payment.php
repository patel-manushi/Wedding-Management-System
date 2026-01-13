<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = htmlspecialchars($_POST['payment_method']);

    if ($payment_method == "Other") {
        header("Location: https://yourwebsite.com");
        exit();
    }

    // Basic Details
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $amount = htmlspecialchars($_POST['amount']);

    echo "<div style='font-family: Arial, sans-serif; padding: 20px;'>";
    echo "<h2 style='color: #28a745;'>Payment Details Received</h2>";
    echo "<p><strong>Name:</strong> $name</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone</p>";
    echo "<p><strong>Amount:</strong> ₹$amount</p>";
    echo "<p><strong>Payment Method:</strong> $payment_method</p>";

    if ($payment_method == "Credit Card" || $payment_method == "Debit Card") {
        $card_number = htmlspecialchars($_POST['card_number']);
        $card_name = htmlspecialchars($_POST['card_name']);
        $expiry = htmlspecialchars($_POST['expiry']);
        $cvv = htmlspecialchars($_POST['cvv']);

        echo "<h3 style='margin-top: 20px; color:#007bff;'>Card Details:</h3>";
        echo "<p><strong>Card Number:</strong> $card_number</p>";
        echo "<p><strong>Name on Card:</strong> $card_name</p>";
        echo "<p><strong>Expiry Date:</strong> $expiry</p>";
        echo "<p><strong>CVV:</strong> (hidden)</p>";
    }
    
    echo "</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amazon Style Payment</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .payment-container {
            background: white;
            width: 500px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 100px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #f9f9f9;
            font-size: 16px;
        }
        .payment-details, .card-details {
            display: none;
            margin-bottom: 20px;
        }
        #methodLogo {
            text-align: center;
            margin: 10px 0;
        }
        #methodLogo img {
            height: 50px;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #ff9900;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #e68a00;
        }
    </style>

    <script>
        function showPaymentDetails() {
            var method = document.getElementById("payment_method").value;
            var detailSection = document.getElementById("paymentDetails");
            var cardSection = document.getElementById("cardDetails");
            var methodLogo = document.getElementById("methodLogo");

            if (method === "Other") {
                window.location.href = "https://yourwebsite.com";
            } else {
                detailSection.style.display = "block";
            }

            // Show logos
            var logoPath = "";
            if (method === "Credit Card") {
                cardSection.style.display = "block";
                logoPath = "images/creditcard.png";
            } else if (method === "Debit Card") {
                cardSection.style.display = "block";
                logoPath = "images/debitcard.png";
            } else if (method === "UPI") {
                cardSection.style.display = "none";
                logoPath = "images/upi.png";
            } else if (method === "Net Banking") {
                cardSection.style.display = "none";
                logoPath = "images/netbanking.png";
            } else if (method === "Cash") {
                cardSection.style.display = "none";
                logoPath = "images/cash.png";
            } else {
                cardSection.style.display = "none";
            }

            if (logoPath !== "") {
                methodLogo.innerHTML = "<img src='" + logoPath + "' alt='Payment Logo'>";
            } else {
                methodLogo.innerHTML = "";
            }

            document.getElementById("detailsText").innerHTML = "You selected <b>" + method + "</b>.";
        }
    </script>

</head>
<body>

<div class="payment-container">
    <div class="logo">
        <img src="your_logo.png" alt="Logo">
    </div>
    <h2>Secure Payment</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="number" name="amount" placeholder="Payment Amount (₹)" required>

        <select name="payment_method" id="payment_method" onchange="showPaymentDetails()" required>
            <option value="">Select Payment Method</option>
            <option value="Cash">Cash</option>
            <option value="UPI">UPI</option>
            <option value="Net Banking">Net Banking</option>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Other">Other</option>
        </select>

        <div id="paymentDetails" class="payment-details">
            <div id="methodLogo"></div>
            <p id="detailsText" style="color: #555;"></p>
        </div>

        <div id="cardDetails" class="card-details">
            <input type="text" name="card_number" placeholder="Card Number" maxlength="16">
            <input type="text" name="card_name" placeholder="Name on Card">
            <input type="text" name="expiry" placeholder="Expiry Date (MM/YY)">
            <input type="text" name="cvv" placeholder="CVV" maxlength="3">
        </div>

        <button type="submit">Proceed to Pay</button>
    </form>
</div>

</body>
</html>
