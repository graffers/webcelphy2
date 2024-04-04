<?php
session_start();

// Periksa apakah pengguna belum login
if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit;
}

// Mengimpor file config.php untuk mendapatkan koneksi database
require_once "config.php";

// Inisialisasi variabel pencarian
$search = "";

// Periksa apakah ada parameter pencarian yang dikirimkan
if(isset($_GET['search'])) {
    // Bersihkan dan simpan parameter pencarian
    $search = trim($_GET['search']);
}

// Query untuk mengambil data dari tabel pasien dengan filter pencarian
$sql = "SELECT id, nama, tanggal_lahir, alamat, jenis_kelamin, nomor_telepon FROM pasien WHERE nama LIKE ?";
$stmt = $conn->prepare($sql);
// Bind parameter untuk pencarian
$stmt->bind_param("s", $search_param);
$search_param = "%" . $search . "%";
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/db.css">
    <link rel="stylesheet" href="css/tb.css">
    <link rel="stylesheet" href="css/modal.css"> <!-- Tambahkan file CSS untuk modal -->
    <script src="modal.js"></script> <!-- Tambahkan file JavaScript untuk modal -->
    <script src="script.js"></script>

    <title>Rekam Medis Elektronik</title>
</head>
<body>

<div class="sidebar">
    <a href="dashboardlog.php">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="riwayat.php" class="active">Riwayat Penyakit Pasien</a>
    <a href="input_rme.php">Input RME</a>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h2>Data Pasien</h2>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Edit Data Pasien</h2>
            <form id="editForm" action="get_patient.php" method="POST">
                <input type="hidden" id="editId" name="id">
                <label for="editNama">Nama:</label>
                <input type="text" id="editNama" name="nama" required><br><br>
                <label for="editTanggalLahir">Tanggal Lahir:</label>
                <input type="date" id="editTanggalLahir" name="tanggal_lahir" required><br><br>
                <label for="editAlamat">Alamat:</label>
                <textarea id="editAlamat" name="alamat" required></textarea><br><br>
                <label for="editJenisKelamin">Jenis Kelamin:</label>
                <select id="editJenisKelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select><br><br>
                <label for="editNomorTelepon">Nomor Telepon:</label>
                <input type="text" id="editNomorTelepon" name="nomor_telepon"><br><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>

    <div class="table-wrapper">
        <table class="fl-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Nomor Telepon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["tanggal_lahir"] . "</td>";
                        echo "<td>" . $row["alamat"] . "</td>";
                        echo "<td>" . $row["jenis_kelamin"] . "</td>";
                        echo "<td>" . $row["nomor_telepon"] . "</td>";
                        echo "<td><button class='editBtn' data-id='" . $row["id"] . "'>Edit</button> | <a href='delete.php?id=" . $row["id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
