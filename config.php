<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_apt"; // Ganti dengan nama database Anda

// Buat koneksi ke database MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>