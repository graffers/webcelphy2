<?php
session_start();

// Pastikan pengguna telah login
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit;
}

// Sertakan file koneksi
include "config.php";

// Query SQL untuk mendapatkan data pengguna
$sql = "SELECT id, username FROM table_apt";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/db.css">
    <title>Welcome, <?php echo $_SESSION['username']; ?>!</title>
</head>
<body>

<div class="sidebar">
    <a href="dashboardlog.php">Dashboard</a>
    <a href="users.php" class="active">Users</a>
    <a href="riwayat.php">Riwayat Penyakit Pasien</a>
    <a href="input_rme.php">Input RME</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h4>Users</h4><br>
    
    <!-- Tampilkan data dalam tabel -->
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
        </tr>
        <?php
        // Periksa apakah ada data yang ditemukan
        if ($result->num_rows > 0) {
            // Loop melalui setiap baris data
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["username"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Tidak ada data ditemukan</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
