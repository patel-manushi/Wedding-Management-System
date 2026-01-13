<?php
$conn = new mysqli("localhost", "root", "", "wedding_planner01");
if ($conn->connect_error) die("Connection failed");

$options_sql = "SELECT * FROM photography_options";
$result = $conn->query($options_sql);
$options = [];

while($row = $result->fetch_assoc()) {
    $options[$row['category']][] = $row;
}

// Handle submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['final_submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $selected_services = implode(", ", $_POST['services']);
    $total_price = $_POST['total_price'];

    $stmt = $conn->prepare("INSERT INTO photography_bookings (name, phone, email, selected_services, total_price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $phone, $email, $selected_services, $total_price);
    $stmt->execute();
    echo "<script>alert('Booking Submitted Successfully!');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Photography Services</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background: #eaf2f8; /* Light blue background */
    margin: 0;
    padding: 20px;
    color: #003d6b; /* Dark blue text */
}

.wrapper {
    max-width: 900px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    color: #005bb5; /* Blue color for header */
    font-size: 36px;
    margin-bottom: 40px;
}

.service-category {
    margin-bottom: 40px;
    background: #f0f8ff; /* Lighter blue background for category */
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #005bb5; /* Blue color for subheadings */
    margin-bottom: 20px;
    font-size: 24px;
}

label {
    display: block;
    background: #ffffff;
    border: 2px solid #cce7ff; /* Light blue border */
    padding: 15px 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s;
    font-size: 16px;
    font-weight: 500;
}

label:hover {
    border-color: #005bb5; /* Blue hover border */
    background: #d6eaff; /* Light blue hover background */
}

input[type="radio"], input[type="checkbox"] {
    margin-right: 15px;
    vertical-align: middle;
}

.total {
    font-size: 22px;
    font-weight: bold;
    color: #003d6b; /* Dark blue total text */
    margin-top: 20px;
    text-align: center;
}

.apply-btn, .submit-btn {
    background: linear-gradient(135deg, #0066cc, #3399ff); /* Blue gradient */
    color: white;
    padding: 15px 30px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    margin-top: 30px;
    cursor: pointer;
    width: 100%;
    display: block;
}

.apply-btn:hover, .submit-btn:hover {
    background: linear-gradient(135deg, #005bb5, #66aaff); /* Darker blue gradient on hover */
}

.submit-form {
    display: none;
    margin-top: 30px;
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}

.submit-form h2 {
    text-align: center;
    color: #005bb5; /* Blue color for form heading */
}

.submit-form div {
    margin-bottom: 20px;
}

.submit-form label {
    font-size: 18px;
    color: #333;
    margin-bottom: 10px;
    display: block;
}

.submit-form input[type="text"],
.submit-form input[type="email"] {
    width: 90%;
    padding: 12px;
    border: 2px solid #cce7ff; /* Light blue border */
    border-radius: 10px;
    font-size: 16px;
    margin-top: 5px;
}

.submit-form input[type="text"]:focus,
.submit-form input[type="email"]:focus {
    border-color: #0066cc; /* Blue focus border */
    outline: none;
}

.service-category:last-child {
    margin-bottom: 0;
}

</style>
</head>
<body>

    <div class="wrapper">
        <h1>Photography Services Booking</h1>

        <form id="photographyForm" method="POST" action="photographer.php">
            <?php foreach ($options as $category => $items): ?>
                <div class="service-category">
                    <h2><?= ucfirst($category) ?> Options</h2>
                    <?php foreach ($items as $item): ?>
                        <label>
                            <input 
                                type="<?= ($category == 'photography' || $category == 'videography') ? 'radio' : 'checkbox' ?>" 
                                name="services[]" 
                                value="<?= $item['name'] ?>" 
                                data-price="<?= $item['price'] ?>" 
                                onclick="calculateTotal()">
                            <?= $item['name'] ?> (₹<?= number_format($item['price']) ?>)
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div class="total">Total Price: ₹<span id="totalPrice">0</span></div>
            <input type="hidden" name="total_price" id="total_price_field">

            <button type="button" class="apply-btn" onclick="showForm()">Apply</button>

            <div class="submit-form" id="customerForm">
                <h2>Customer Information</h2>
                <div>
                    <label>Name: <input type="text" name="name" required></label>
                </div>
                <div>
                    <label>Phone: <input type="text" name="phone" required></label>
                </div>
                <div>
                    <label>Email: <input type="email" name="email" required></label>
                </div>
                <input type="hidden" name="final_submit" value="1">
                <button class="submit-btn" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('input[name="services[]"]:checked').forEach(input => {
                total += parseInt(input.getAttribute('data-price'));
            });
            document.getElementById('totalPrice').textContent = total;
            document.getElementById('total_price_field').value = total;
        }

        function showForm() {
            document.getElementById('customerForm').style.display = 'block';
        }
    </script>
</body>
</html>
