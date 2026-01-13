
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Wedding Planner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="admin-header">Admin Dashboard</div>
<div class="dashboard-container">
    <div class="sidebar">
    <button onclick="showService('decoration')">Decoration</button>
    <button onclick="showService('catering')">Catering</button>
    <button onclick="showService('photographer')">Photographer</button>
        <button onclick="showService('makeup')">Makeup</button>
        <button onclick="showService('hotel')">Hotel & Resort</button>
        <button onclick="showService('destination')">Destination Wedding</button>
        <button><a href="admin_logout.php" style="text-decoration: none; color:yellow"><b>Logout</b></a></button>
    </div>
    <div class="content" id="data-container">
        <p>Select a service to view data.</p>
    </div>
</div>
<script src="script.js"></script>
<script>
function showService(service) {
    fetch('fetch_data.php?service=' + service)
    .then(res => res.text())
    .then(html => {
        document.getElementById('data-container').innerHTML = html;
    });
}
</script>
</body>
</html>
