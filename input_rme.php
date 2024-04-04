<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirim dari formulir
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Periksa apakah semua field formulir telah diisi
    if (!empty($nama) && !empty($tanggal_lahir) && !empty($alamat) && !empty($jenis_kelamin)) {
        try {
            // Prepare an SQL statement for inserting data into the Pasien table
            $stmt = $conn->prepare("INSERT INTO Pasien (nama, tanggal_lahir, alamat, jenis_kelamin, nomor_telepon) VALUES (?, ?, ?, ?, ?)");

            // Bind parameters to the prepared statement
            $stmt->bind_param("sssss", $nama, $tanggal_lahir, $alamat, $jenis_kelamin, $nomor_telepon);

            // Execute the prepared statement
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();

            echo "Data berhasil dimasukkan";

        } catch (mysqli_sql_exception $e) {
            // Handle exceptions and errors
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Silakan isi semua field formulir.";
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/db.css">
    <link rel="stylesheet" href="css/db2.css">
    <title>Input RME</title>
</head>
<body>

<div class="sidebar">
    <a href="dashboardlog.php">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="riwayat.php">Riwayat Penyakit Pasien</a>
    <a href="input_rme.php" class="active">Input RME</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h4>Users</h4><br>
    <h2>Formulir Input Pasien</h2>
    <form action="input_rme.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>
        
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required><br><br>
        
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea><br><br>
        
        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>
        
        <label for="nomor_telepon">Nomor Telepon:</label>
        <input type="text" id="nomor_telepon" name="nomor_telepon"><br><br>
        
        <!-- Tambahkan input fields lain sesuai kebutuhan -->
        
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
