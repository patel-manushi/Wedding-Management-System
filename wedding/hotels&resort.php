<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wedding_planner01";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$message = '';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_application'])) {
    $hotel_id = $_POST['hotel_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $sql = "INSERT INTO hotel_applications (hotel_id, name, phone, email) VALUES ('$hotel_id', '$name', '$phone', '$email')";
    if ($conn->query($sql) === TRUE) {
        $message = "Application submitted successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM hotel_hotels ORDER BY id ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotels & Resorts</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
    padding: 0;
}

header {
    background: #1e88e5; /* Blue Header */
    color: white;
    padding: 20px;
    text-align: center;
}

.hotel-list {
    display: flex;
    overflow-x: auto;
    gap: 20px;
    padding: 20px;
    scroll-snap-type: x mandatory;
}

.hotel-card {
    scroll-snap-align: start;
    flex: 0 0 auto;
    width: 300px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.hotel-card:hover {
    transform: scale(1.03);
}

.hotel-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.hotel-card h2 {
    color: #1e88e5; /* Blue Text */
    text-align: center;
    padding: 10px 0;
}

.hotel-card p {
    padding: 0 20px;
}

.hotel-card .apply-form {
    padding: 20px;
    text-align: center;
}

.hotel-card .apply-btn,
.submit-btn {
    background: #1e88e5; /* Blue Button */
    color: white;
    padding: 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 10px;
    width: 100%;
}

.submit-btn:hover {
    background: #1565c0; /* Darker Blue Hover */
}

.apply-details {
    display: none;
    margin-top: 10px;
}

.apply-details input {
    width: 90%;
    padding: 8px;
    margin: 6px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.confirmation-message {
    text-align: center;
    color: green;
    font-size: 18px;
    margin-top: 15px;
}

    </style>
</head>
<body>
    <header>
        <h1>Our Stunning Hotels & Resorts</h1>
    </header>

    <?php if (!empty($message)): ?>
        <div class="confirmation-message"><?= $message ?></div>
    <?php endif; ?>

    <div class="hotel-list">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="hotel-card">
                <!-- Debug image output -->
                <img src="<?= htmlspecialchars($row['image_url']) ?>" 
                     alt="<?= htmlspecialchars($row['name']) ?>" 
                     onerror="this.onerror=null; this.src='images/placeholder.jpg'; this.style.border='2px solid red'; console.log('Image not found:', this.src);">

                <h2><?= htmlspecialchars($row['name']) ?></h2>
                <p><strong>Location:</strong> <?= htmlspecialchars($row['location']) ?></p>
                <p><strong>Price Range:</strong> <?= htmlspecialchars($row['price_range']) ?></p>
                <p><strong>Amenities:</strong> <?= htmlspecialchars($row['amenities']) ?></p>
                <p><strong>Guest Capacity:</strong> <?= htmlspecialchars($row['guest_capacity']) ?></p>
                <p><strong>Wedding Styles:</strong> <?= htmlspecialchars($row['wedding_styles']) ?></p>
                <p><strong>Contact:</strong> <?= htmlspecialchars($row['contact']) ?></p>
                <p><strong>Rating:</strong> <?= htmlspecialchars($row['rating']) ?>⭐</p>

                <div class="apply-form">
                    <button class="apply-btn" onclick="toggleForm(this)">Apply Now</button>
                    <form class="apply-details" method="POST">
                        <input type="hidden" name="hotel_id" value="<?= $row['id'] ?>">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="text" name="phone" placeholder="Phone Number" required>
                        <input type="email" name="email" placeholder="Email Address" required>
                        <input type="hidden" name="submit_application" value="1">
                        <button type="submit" class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <script>
        function toggleForm(button) {
            let form = button.nextElementSibling;
            form.style.display = form.style.display === "block" ? "none" : "block";
        }
    </script>
</body>
</html>
