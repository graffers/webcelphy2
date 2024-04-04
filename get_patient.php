<?php
// Mengimpor file config.php untuk mendapatkan koneksi database
require_once "config.php";

// Periksa apakah ada parameter ID yang dikirimkan
if(isset($_GET['id'])) {
    // Bersihkan dan simpan parameter ID
    $id = trim($_GET['id']);

    // Query untuk mengambil data pasien berdasarkan ID
    $sql = "SELECT id, nama, tanggal_lahir, alamat, jenis_kelamin, nomor_telepon FROM pasien WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // Bind parameter ID
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Mengembalikan data dalam format JSON
        echo json_encode($row);
    } else {
        // Jika data tidak ditemukan, mengembalikan pesan kesalahan
        echo json_encode(array("error" => "Data pasien tidak ditemukan."));
    }
} else {
    // Jika parameter ID tidak ditemukan, mengembalikan pesan kesalahan
    echo json_encode(array("error" => "Parameter ID tidak ditemukan."));
}

// Menutup koneksi database
$conn->close();
?>
