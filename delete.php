<?php
// Mengimpor file config.php untuk mendapatkan koneksi database
require_once "config.php";

// Pastikan id tersedia
if (isset($_GET["id"]) && !empty($_GET["id"])) {
    // Persiapkan pernyataan hapus
    $sql = "DELETE FROM pasien WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variabel ke pernyataan persiapan sebagai parameter
        $stmt->bind_param("i", $param_id);

        // Atur parameter
        $param_id = trim($_GET["id"]);

        // Mencoba mengeksekusi pernyataan persiapan
        if ($stmt->execute()) {
            // Data telah dihapus berhasil. Redirect ke halaman data pasien.
            header("location: riwayat.php");
            exit();
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }
    }

    // Tutup pernyataan
    $stmt->close();
}

// Tutup koneksi database
$conn->close();
?>
