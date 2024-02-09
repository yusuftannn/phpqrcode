<?php
$file = $_GET['file'];

if (file_exists($file)) {
    // Kullanıcıya indirme başlat
    header('Content-Type: image/png');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    readfile($file);

    // Geçici dosyayı sil
    unlink($file);
} else {
    echo "Dosya bulunamadı.";
}
?>