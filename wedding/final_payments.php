<?php
// Database connection
$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "wedding_planner01"; // replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest total_price from each table
$decoration_sql = "SELECT total_price FROM decoration_bookings ORDER BY id DESC LIMIT 1";
$catering_fixed_sql = "SELECT total_price FROM catering_fixed_orders ORDER BY id DESC LIMIT 1";
$catering_custom_sql = "SELECT total_price FROM catering_custom_orders ORDER BY id DESC LIMIT 1";
$photography_sql = "SELECT total_price FROM photography_bookings ORDER BY id DESC LIMIT 1";

// Initialize prices
$decoration_price = 0;
$catering_fixed_price = 0;
$catering_custom_price = 0;
$photography_price = 0;

// Execute and fetch
$decoration_result = $conn->query($decoration_sql);
if ($decoration_result->num_rows > 0) {
    $row = $decoration_result->fetch_assoc();
    $decoration_price = $row['total_price'];
}

$catering_fixed_result = $conn->query($catering_fixed_sql);
if ($catering_fixed_result->num_rows > 0) {
    $row = $catering_fixed_result->fetch_assoc();
    $catering_fixed_price = $row['total_price'];
}

$catering_custom_result = $conn->query($catering_custom_sql);
if ($catering_custom_result->num_rows > 0) {
    $row = $catering_custom_result->fetch_assoc();
    $catering_custom_price = $row['total_price'];
}

$photography_result = $conn->query($photography_sql);
if ($photography_result->num_rows > 0) {
    $row = $photography_result->fetch_assoc();
    $photography_price = $row['total_price'];
}

// Calculate grand total
$grand_total = $decoration_price + $catering_fixed_price + $catering_custom_price + $photography_price;

// Insert into the new table
$insert_sql = "INSERT INTO wedding_grand_totals (decoration_price, catering_fixed_price, catering_custom_price, photography_price, grand_total)
VALUES ('$decoration_price', '$catering_fixed_price', '$catering_custom_price', '$photography_price', '$grand_total')";

if ($conn->query($insert_sql) === TRUE) {
   
} else {
    echo "Error: " . $insert_sql . "<br>" . $conn->error;
}

$conn->close();
?>







<?php
// app.php (PHP + MySQL Connection + Backend Logic)

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "wedding_planner01";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Fetch latest grand total
$grand_total = 0;
$result = $conn->query("SELECT grand_total FROM wedding_grand_totals ORDER BY id DESC LIMIT 1");

if ($result->num_rows) {
    $row = $result->fetch_assoc();
    $grand_total = $row['grand_total'];
}

// Handle form submit
$payment_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $payment_method = $_POST['payment_method'];

    // Create payment_logs table if not exists (optional)
    $conn->query("
        CREATE TABLE IF NOT EXISTS payment_logs (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(255),
            email VARCHAR(255),
            mobile VARCHAR(20),
            payment_method VARCHAR(50),
            amount DECIMAL(10,2),
            paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Insert into payment_logs (optional logging)
    $stmt = $conn->prepare("INSERT INTO payment_logs (customer_name, email, mobile, payment_method, amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $customer_name, $email, $mobile, $payment_method, $grand_total);
    $stmt->execute();
    $stmt->close();

    // Create final_payments table if not exists
    $conn->query("
        CREATE TABLE IF NOT EXISTS final_payments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            customer_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            mobile VARCHAR(20) NOT NULL,
            payment_method VARCHAR(50) NOT NULL,
            grand_total DECIMAL(10,2) NOT NULL,
            payment_status VARCHAR(50) DEFAULT 'Completed',
            paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    // Insert into final_payments
    $stmt2 = $conn->prepare("INSERT INTO final_payments (customer_name, email, mobile, payment_method, grand_total) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("ssssd", $customer_name, $email, $mobile, $payment_method, $grand_total);
    $stmt2->execute();
    $stmt2->close();

    $payment_message = "✅ Payment Successful! Thank you, $customer_name.";
}
?>

<!-- index.php (HTML + CSS Frontend) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wedding Payment Page</title>
    <style>
        /* --- CSS --- */
        body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #1e3c72, #2a5298);
    color: #e3f2fd;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
    margin: 0;
}

.payment-form {
    background: #ffffff;
    padding: 40px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0, 0, 50, 0.3);
    width: 100%;
    max-width: 520px;
}

h2 {
    text-align: center;
    color: #2196f3;
    margin-bottom: 25px;
    font-size: 32px;
}

label {
    font-weight: bold;
    margin-top: 12px;
    display: block;
    color: #1565c0;
    font-size: 18px;
}

input, select {
    width: 95%;
    padding: 14px;
    margin-top: 8px;
    margin-bottom: 22px;
    border-radius: 8px;
    border: 1px solid #90caf9;
    font-size: 18px;
    color: #333;
    background-color: #e3f2fd;
}

input:focus, select:focus {
    border-color: #42a5f5;
    outline: none;
    background-color: #ffffff;
}

.grand-total {
    background: #e3f2fd;
    padding: 18px;
    font-weight: bold;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 25px;
    font-size: 20px;
    color: #1565c0;
}

.pay-button {
    background-color: #2196f3;
    color: #ffffff;
    border: none;
    padding: 16px;
    width: 100%;
    font-size: 20px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.3s ease;
}

.pay-button:hover {
    background-color: #1976d2;
}

.success-message {
    background: #c8e6c9;
    color: #2e7d32;
    padding: 18px;
    border-radius: 10px;
    margin-top: 25px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

    </style>
</head>
<body>

<div class="payment-form">
    <h2>Wedding Payment</h2>

    <?php if ($payment_message): ?>
        <div class="success-message"><?= $payment_message ?></div>
    <?php else: ?>
        <form method="POST">
            <div class="grand-total">
                Grand Total to Pay: ₹<?= number_format($grand_total, 2) ?>
            </div>

            <label for="customer_name">Full Name</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="mobile">Mobile Number</label>
            <input type="text" id="mobile" name="mobile" required>

            <label for="payment_method">Select Payment Method</label>
            <select id="payment_method" name="payment_method" required>
                <option value="">-- Choose Payment Method --</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="UPI">UPI</option>
                <option value="Cheque">Cheque</option>
                <option value="Netbanking">Netbanking</option>
            </select>

            <button type="submit" class="pay-button">Pay Now ₹<?= number_format($grand_total, 2) ?></button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
