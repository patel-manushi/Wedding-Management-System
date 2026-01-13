<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "wedding_planner01";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("
    CREATE TABLE IF NOT EXISTS wedding_price_log (
        id INT AUTO_INCREMENT PRIMARY KEY,
        package_name VARCHAR(255),
        price DECIMAL(10,2),
        grand_total DECIMAL(10,2) DEFAULT NULL,
        logged_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

$inserted_data = [];
$grand_total = 0;

// 🥘 Catering: pick latest between custom and fixed
$custom = $conn->query("SELECT id, total_price FROM catering_custom_orders ORDER BY id DESC LIMIT 1");
$fixed = $conn->query("SELECT id, total_price FROM catering_fixed_orders ORDER BY id DESC LIMIT 1");

if ($custom->num_rows && $fixed->num_rows) {
    $c = $custom->fetch_assoc();
    $f = $fixed->fetch_assoc();

    if ($c['id'] > $f['id']) {
        $label = "Catering (Custom)";
        $price = $c['total_price'];
    } else {
        $label = "Catering (Fixed)";
        $price = $f['total_price'];
    }
} elseif ($custom->num_rows) {
    $c = $custom->fetch_assoc();
    $label = "Catering (Custom)";
    $price = $c['total_price'];
} elseif ($fixed->num_rows) {
    $f = $fixed->fetch_assoc();
    $label = "Catering (Fixed)";
    $price = $f['total_price'];
} else {
    $label = "Catering";
    $price = 0;
}

if ($price > 0) {
    $inserted_data[] = ["package" => $label, "price" => $price];
    $grand_total += $price;

    $stmt = $conn->prepare("INSERT INTO wedding_price_log (package_name, price) VALUES (?, ?)");
    $stmt->bind_param("sd", $label, $price);
    $stmt->execute();
    $stmt->close();
}

// 🎀 Decoration
$decoration = $conn->query("SELECT total_price FROM decoration_bookings ORDER BY id DESC LIMIT 1");
if ($decoration->num_rows) {
    $d = $decoration->fetch_assoc();
    $label = "Decoration";
    $price = $d['total_price'];
    $inserted_data[] = ["package" => $label, "price" => $price];
    $grand_total += $price;

    $stmt = $conn->prepare("INSERT INTO wedding_price_log (package_name, price) VALUES (?, ?)");
    $stmt->bind_param("sd", $label, $price);
    $stmt->execute();
    $stmt->close();
}

// 📸 Photography
$photo = $conn->query("SELECT total_price FROM photography_bookings ORDER BY id DESC LIMIT 1");
if ($photo->num_rows) {
    $p = $photo->fetch_assoc();
    $label = "Photography";
    $price = $p['total_price'];
    $inserted_data[] = ["package" => $label, "price" => $price];
    $grand_total += $price;

    $stmt = $conn->prepare("INSERT INTO wedding_price_log (package_name, price) VALUES (?, ?)");
    $stmt->bind_param("sd", $label, $price);
    $stmt->execute();
    $stmt->close();
}

// 🧾 Grand Total Log
$label = "Grand Total";
$stmt = $conn->prepare("INSERT INTO wedding_price_log (package_name, price, grand_total) VALUES (?, 0, ?)");
$stmt->bind_param("sd", $label, $grand_total);
$stmt->execute();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wedding Package Summary</title>
    <style>
        body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to right, #1e3c72, #2a5298);
    color: #e0f7fa;
    padding: 60px;
    font-size: 20px;
}

.summary {
    background-color: rgba(0, 123, 255, 0.1);
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(0, 0, 50, 0.4);
    padding: 40px;
    max-width: 900px;
    margin: auto;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #4fc3f7;
    font-size: 36px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 20px 15px;
    text-align: left;
    font-size: 22px;
}

th {
    border-bottom: 3px solid #4fc3f777;
    color: #81d4fa;
}

tr:nth-child(even) {
    background-color: rgba(33, 150, 243, 0.1);
}

.grand-total {
    font-weight: bold;
    font-size: 26px;
    text-align: right;
    margin-top: 30px;
    color: #29b6f6;
}

.pay-button {
    display: block;
    width: 100%;
    background-color: #2196f3;
    color: #ffffff;
    font-weight: bold;
    padding: 18px;
    margin-top: 30px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-size: 22px;
    text-align: center;
    text-decoration: none;
    transition: background 0.3s ease;
}

.pay-button:hover {
    background-color: #1976d2;
}

    </style>
</head>
<body>

<div class="summary">
    <h2>Latest Wedding Package Summary</h2>
    <table>
        <thead>
            <tr>
                <th>Service</th>
                <th>Total Price (₹)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inserted_data as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['package']) ?></td>
                    <td>₹<?= number_format($entry['price'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="grand-total">Grand Total: ₹<?= number_format($grand_total, 2) ?></div>

    <!-- Payment Button -->
    <a href="final_payments.php" class="pay-button">Pay Now ₹<?= number_format($grand_total, 2) ?></a>
</div>

</body>
</html>

<?php $conn->close(); ?>
