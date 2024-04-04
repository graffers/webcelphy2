<?php
// Mengimpor file config.php untuk mendapatkan koneksi database
require_once "config.php";

// Periksa apakah data telah dikirimkan melalui formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data yang dikirimkan dari formulir
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Prepare statement SQL untuk update data pasien
    $sql = "UPDATE pasien SET nama=?, tanggal_lahir=?, alamat=?, jenis_kelamin=?, nomor_telepon=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nama, $tanggal_lahir, $alamat, $jenis_kelamin, $nomor_telepon, $id);
    
    // Eksekusi statement SQL
    if ($stmt->execute()) {
        // Redirect ke halaman riwayat.php setelah berhasil update
        header("location: riwayat.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "Error updating record: " . $conn->error;
    }
    
    // Tutup statement dan koneksi database
    $stmt->close();
    $conn->close();
}
?>
