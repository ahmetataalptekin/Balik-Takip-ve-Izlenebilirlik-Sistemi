
<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// config.php dosyasını dahil et
include 'config.php';
$target_id = $_GET['kayit_id'] ?? 0;

// Veritabanından veri çekmek için SQL sorgusunu yaz
$sql = "SELECT kayit_id, cinsi, balik_cikis_yontemi, tutuldugu_bolge, sudan_cikis_tarihi, cikaran_gemi_id,
cikaran_gemi, limana_cikis_tarihi, cikarildigi_liman, tedarikci_id, tedarikci_adi FROM balik WHERE kayit_id = $target_id";
$result = $conn->query($sql);

// HTML başlık ve stil kısmı

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balık Takip ve İzlenebilirlik Sistemi</title>
    <link href = "./style.css" rel = "stylesheet">
</head>

<body>
    <div id = "container">
        <h1 id = "main-title">
        BALIK TAKIP VE IZLENEBILIRLIK SISTEMI
        </h1>
        <h2>
        Baliklari denizden ciktigi andan itibaren izlenebilirligini saglayan sistem.
        </h2>
        <h3>
        Alacaginiz baligin oldugu kutudaki QR kodu okutun ve asagidaki tabloya bilgileriniz gelecek.
        Alternatif olarak baligin ID numarasini asagidaki butona tiklayarak da arama yapabilirsiniz.
        </h3>
        <input type="text" id="fish_id_input" placeholder="Balık ID'sini Girin"/>
        <button id="id_search">ID İle Balık Ara</button>
        
        <?php if ($target_id != 0): ?>

        <h2>Veritabanından Gelen Bilgi</h2>
        <!-- Verileri listele -->
        <table class="fish-table">
            <thead>
                <?php if ($result->num_rows > 0): ?>
                <tr>
                    <th>ID</th>
                    <th>Cinsi</th>
                    <th>Balığın Çıkış Yöntemi</th>
                    <th>Tutulduğu Bölge</th>
                    <th>Sudan Çıkış Tarihi</th>
                    <th>Çıkaran Gemi ID</th>
                    <th>Çıkaran Gemi</th>
                    <th>Limana Çıkış Tarihi</th>
                    <th>Çıkarıldığı Liman</th>
                    <th>Tedarikçi ID</th>
                    <th>Tedarikçi Adı</th>
                </tr>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0)
                {
                    // Verileri döngüyle listele
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["kayit_id"] . "</td>
                                <td>" . $row["cinsi"] . "</td>
                                <td>" . $row["balik_cikis_yontemi"] . "</td>
                                <td>" . $row["tutuldugu_bolge"] . "</td>
                                <td>" . $row["sudan_cikis_tarihi"] . "</td>
                                <td>" . $row["cikaran_gemi_id"] . "</td>
                                <td>" . $row["cikaran_gemi"] . "</td>
                                <td>" . $row["limana_cikis_tarihi"] . "</td>
                                <td>" . $row["cikarildigi_liman"] . "</td>
                                <td>" . $row["tedarikci_id"] . "</td>
                                <td>" . $row["tedarikci_adi"] . "</td>
                            </tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='3'>Kayıt bulunamadı</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php endif; ?>
        <br><br>
        <h2>QR Kod:</h2>
        <div id="qrcode"></div>
        <button id="downloadBtn">QR Kodu Indir</button>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script src = "./index.js"></script>
    </div>
</body>

</html>

<?php
// Bağlantıyı kapat
$conn->close();

?>

