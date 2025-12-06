
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// config.php dosyasını dahil et
include 'config.php';

// Veritabanından veri çekmek için SQL sorgusunu yaz
$sql = "SELECT kayit_id, cinsi, balik_cikis_yontemi FROM balik";
$result = $conn->query($sql);

// HTML başlık ve stil kısmı

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veritabanından Veri Çekme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Veritabanından Gelen Bilgi</h2>
    
    <!-- Verileri listele -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cinsi</th>
                <th>Baligin Cikis Yöntemi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Verileri döngüyle listele
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["kayit_id"] . "</td>
                            <td>" . $row["cinsi"] . "</td>
                            <td>" . $row["balik_cikis_yontemi"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Kayıt bulunamadı</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// Bağlantıyı kapat
$conn->close();
?>