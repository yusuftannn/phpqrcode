<?php
require_once 'baglan.php';
require_once 'phpqrcode/qrlib.php'; // phpqrcode kütüphanesini dahil et

$urunlericek = $db->prepare("SELECT * FROM products");
$urunlericek->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
    <meta name="title" content="" />
    <meta name="author" content="Yusuf Tan" />
    <meta name="description" content="" />
    <title>PHP QR Code Project</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <?php
            $count = 1;
            while ($urunler = $urunlericek->fetch(PDO::FETCH_ASSOC)) {
                $urunAd = $urunler['urun_Ad'];
                $urunLink = $urunler['urun_Link']; // Veritabanından alınan özel link

                // QR kodunu oluştur
                $qrFile = 'qr_' . urlencode($urunAd) . '.png'; // Geçici dosya adı
                QRcode::png($urunLink, $qrFile, 'L', 10, 2);

                echo "<td>";
                echo "<p>Ürün Adı: $urunAd</p>";
                echo "<img src='$qrFile' alt='QR Code'>";
                echo "<br>";
                echo "<button onclick=\"window.location.href='qrDownload.php?file=" . urlencode($qrFile) . "'\">QR Kodunu İndir</button>";
                echo "</td>";

                if ($count % 5 == 0) {
                    echo "</tr><tr>";
                }

                $count++;
            }
            ?>
        </tr>
    </table>
</body>

</html>