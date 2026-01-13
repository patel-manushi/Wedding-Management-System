<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "wedding_planner01");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for makeup artists
$sql = "SELECT * FROM makeup_artists LIMIT 4";
$result = $conn->query($sql);

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['artist_id'])) {
    $artist_id = $_POST['artist_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $preferred_date = $_POST['preferred_date'];
    $message = $_POST['message'];

    // Insert user application into the database
    $stmt = $conn->prepare("INSERT INTO makeup_applications (artist_id, user_name, user_email, user_phone, preferred_date, message) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $artist_id, $user_name, $user_email, $user_phone, $preferred_date, $message);
    
    // Check if the insertion was successful
    if ($stmt->execute()) {
        echo "<div style='color: green; text-align: center;'>Application submitted successfully!</div>";
    } else {
        echo "<div style='color: red; text-align: center;'>There was an error submitting your application.</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makeup Artists</title>
    <style>
        body {
    margin: 0;
    background-color: #e0f7fa; /* Light Blue Background */
    font-family: 'Segoe UI', sans-serif;
}

.section-heading {
    text-align: center;
    padding: 40px 20px 20px;
    color: #0288d1; /* Blue Text */
    font-size: 32px;
    font-weight: bold;
    border-bottom: 3px solid #03a9f4; /* Lighter Blue Border */
    width: max-content;
    margin: 0 auto 30px;
}

.artist-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
    padding: 0 40px 40px;
}

.artist-card {
    background: #ffffff;
    border-left: 8px solid #03a9f4; /* Light Blue Border */
    border-radius: 18px;
    padding: 20px;
    box-shadow: 0 6px 16px rgba(3, 169, 244, 0.2);
    transition: 0.3s ease;
}

.artist-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(3, 169, 244, 0.3);
}

.artist-card h2 {
    margin: 0;
    color: #0288d1; /* Blue Text */
    font-size: 22px;
}

.artist-card p {
    margin: 5px 0;
    color: #0277bd; /* Slightly Darker Blue Text */
    font-size: 15px;
}

.artist-card strong {
    color: #01579b; /* Dark Blue Text */
}

.artist-card a {
    color: #03a9f4; /* Light Blue Link */
    text-decoration: none;
    font-weight: 600;
}

.apply-form {
    display: none;
    padding: 20px;
    background-color: #fff;
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 6px 16px rgba(3, 169, 244, 0.2);
}

.apply-form input,
.apply-form textarea {
    width: 90%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.apply-form button {
    padding: 10px 20px;
    background-color: #0288d1; /* Blue Button */
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.apply-form button:hover {
    background-color: #03a9f4; /* Lighter Blue on Hover */
}

.apply-now-btn {
    background-color: #0288d1; /* Blue Button */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.apply-now-btn:hover {
    background-color: #03a9f4; /* Lighter Blue on Hover */
}
.artist-card img {
    width: 100%; /* Ensures the image fills the container */
    height: 220px; /* Set a fixed height for uniformity */
    object-fit: cover; /* Ensures the image covers the area without distortion */
    border-radius: 14px;
    margin-bottom: 15px;
    border: 2px solid #b3e5fc; /* Very Light Blue Border */
}

    </style>

    <script>
        // JavaScript to show the form when "Apply Now" is clicked
        function showApplyForm(artistId) {
            // Hide all forms first
            const forms = document.querySelectorAll('.apply-form');
            forms.forEach(form => form.style.display = 'none');

            // Show the specific form related to the clicked artist
            const form = document.getElementById('apply-form-' + artistId);
            form.style.display = 'block';
        }
    </script>
</head>
<body>

<h1 class="section-heading">Top Makeup Artists for Your Wedding</h1>

<div class="artist-container">
<?php while($row = $result->fetch_assoc()) { ?>
    <div class="artist-card">
        <img src="source images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <h2>💄 <?php echo $row['name']; ?></h2>
        <p>📍 <?php echo $row['location']; ?> | <?php echo $row['travel_info']; ?></p>

        <strong>Specializes in:</strong>
        <p><?php echo nl2br($row['specialization']); ?></p>

        <p>🖼️ <strong>Portfolio:</strong> <a href="<?php echo $row['portfolio_link']; ?>" target="_blank">View Gallery</a></p>
        <p>💰 <strong>Packages Start at:</strong> <?php echo $row['package_price']; ?></p>
        <p>🎁 <strong>Trial Available:</strong> <?php echo $row['trial_info']; ?></p>
        <p>📅 <strong>Availability:</strong> <?php echo $row['availability']; ?></p>
        <p>⭐ <strong>Experience:</strong> <?php echo $row['experience']; ?></p>
        <p>💬 <strong>Reviews:</strong> <?php echo $row['reviews']; ?></p>
        <p>📞 <strong>Contact:</strong> <?php echo $row['contact_info']; ?></p>
        <p>🔒 <strong>Booking Policy:</strong> <?php echo $row['booking_policy']; ?></p>

        <!-- Apply Now Button -->
        <button class="apply-now-btn" onclick="showApplyForm(<?php echo $row['id']; ?>)">Apply Now</button>

        <!-- Apply Now Form (Initially Hidden) -->
        <form id="apply-form-<?php echo $row['id']; ?>" action="makeup.php" method="POST" class="apply-form">
            <input type="hidden" name="artist_id" value="<?php echo $row['id']; ?>">
            <input type="text" name="user_name" placeholder="Your Name" required>
            <input type="email" name="user_email" placeholder="Your Email" required>
            <input type="text" name="user_phone" placeholder="Your Phone Number" required>
            <input type="date" name="preferred_date" required>
            <textarea name="message" rows="4" placeholder="Message" required></textarea>
            <button type="submit">Apply Now</button>
        </form>
    </div>
<?php } ?>
</div>

</body>
</html>
