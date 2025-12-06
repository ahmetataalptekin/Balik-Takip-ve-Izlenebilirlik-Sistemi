<?php
$servername = "localhost";  // Hostinger'da genellikle localhost
$username = "u673327981_balik";  // Kullanıcı adı
$password = "Bkcmmo3-";  // Veritabanı şifresi
$dbname = "u673327981_balik";  // Veritabanı adı

// Bağlantı
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>