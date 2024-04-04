<?php
session_start();

// Periksa apakah pengguna belum login
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/db.css">
    <title>Rekam Medis Elektronik</title>
</head>
<body>

<div class="sidebar">
    <a href="dashboardlog.php" class="active">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="riwayat.php">Riwayat Penyakit Pasien</a>
    <a href="input_rme.php">Input RME</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h4>Interface Page</h4><br>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <h2>Selamat datang di RME (Rekam Medis Elektronik)</h2>
    <!-- Your content here -->
</div>

</body>
</html>
