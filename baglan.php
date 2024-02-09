<?php
    try {
        $db = new PDO("mysql:host=localhost;dbname=qrcodedb;charset=utf8mb4", "root", "");
    } catch (PDOException $e) {
        echo 'Bağlantı hatası: ' . $e->getMessage();
    }
?>