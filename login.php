<?php
session_start();

// Sisipkan file konfigurasi database
require_once 'config.php';

if(isset($_SESSION['username'])) {
    header("Location: dashboardlog.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query untuk memeriksa apakah kombinasi username dan password ada di database
    $query = "SELECT * FROM table_apt WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if($result->num_rows == 1) {
        // Jika data ditemukan, atur sesi pengguna
        $_SESSION['username'] = $username;
        
        // Alihkan ke halaman utama atau halaman lainnya setelah login berhasil
        header("Location: dashboardlog.php");
        exit();
    } else {
        $error = "Kombinasi username dan password tidak valid.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login RME</title>
</head>
<body>
    <h2 class="h2-center"></h2>

    <form class="form" action="login.php" method="post">
    <p class="heading">Login</p>
    <input id="username" class="input" name="username" placeholder="Username" type="text" required>
    <input id="password" class="input" name="password" placeholder="Password" type="password" required> 
    <input class="btn" type="submit" value="Login">
    </form>

    <?php
    // Tampilkan pesan kesalahan jika ada
    if (isset($_GET['error'])) {
        echo "<p style='color:red;'>".$_GET['error']."</p>";
    }
    ?>
</body>
</html>
