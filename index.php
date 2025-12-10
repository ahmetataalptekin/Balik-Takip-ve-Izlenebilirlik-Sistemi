
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
                    echo "<tr><td colspan='11'>Kayıt bulunamadı</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php endif; ?>
        <!-- QR Aç Kapa -->
        <div id="qr-section" style="max-width:340px; margin-top:20px;">
        <h2 id="qr-toggle" style="cursor:pointer; user-select:none; display:flex; align-items:center; gap:8px;">
            <span style="font-weight:600;">QR Kod</span>
            <span id="qr-arrow" aria-hidden="true">▾</span>
        </h2>

        <div id="qr-content" style="display:none; margin-top:10px;">
            <div id="qrcode" style="width:256px; height:256px;"></div>
            <div style="margin-top:8px;">
            <button id="downloadBtn" type="button">QR Kodu İndir</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("qr-toggle");
        const content = document.getElementById("qr-content");
        const arrow = document.getElementById("qr-arrow");
        const qrcodeEl = document.getElementById("qrcode");
        const downloadBtn = document.getElementById("downloadBtn");

        let qrCreated = false;
        let qrInstance = null;

        function createQR() {
            // temizle önceki varsa
            qrcodeEl.innerHTML = "";
            // QR kütüphanesi canvas/img oluşturuyor
            qrInstance = new QRCode(qrcodeEl, {
            text: window.location.href,
            width: 256,
            height: 256,
            correctLevel: QRCode.CorrectLevel.H
            });
            qrCreated = true;
        }

        toggle.addEventListener("click", function() {
            const isHidden = content.style.display === "none" || content.style.display === "";
            if (isHidden) {
            content.style.display = "block";
            arrow.textContent = "▴";
            if (!qrCreated) {
                // küçük delay: emin olmak için next tick'te oluştur
                setTimeout(createQR, 0);
            }
            } else {
            content.style.display = "none";
            arrow.textContent = "▾";
            }
        });

        // İndirme fonksiyonu: canvas veya img ise yakalayıp indirir
        downloadBtn.addEventListener("click", function() {
            // önce QR oluşturulmamışsa oluştur
            if (!qrCreated) {
            createQR();
            }

            // canvas varsa onu kullan
            const canvas = qrcodeEl.querySelector("canvas");
            if (canvas) {
            const dataUrl = canvas.toDataURL("image/png");
            const link = document.createElement("a");
            link.href = dataUrl;
            link.download = "qrcode.png";
            document.body.appendChild(link);
            link.click();
            link.remove();
            return;
            }

            // img varsa onu kullan
            const img = qrcodeEl.querySelector("img");
            if (img && img.src) {
            const link = document.createElement("a");
            link.href = img.src;
            link.download = "qrcode.png";
            document.body.appendChild(link);
            link.click();
            link.remove();
            return;
            }

            // Eğer hiçbiri yoksa kullanıcıya uyarı ver
            alert("QR kod henüz oluşturulmadı veya tarayıcınız desteklemiyor.");
        });

        // Eğer sayfa adresine göre otomatik açık olmasını istersen, buraya ekle:
        // if (window.location.search.includes("kayit_id=")) { toggle.click(); }
        });
    </script>

    <script src = "./index.js"></script>
    </div>
</body>

</html>

<?php
// Bağlantıyı kapat
$conn->close();

?>

