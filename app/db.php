<?php
try {
    $host = 'localhost';
    $dbname = 'oto_cekici';
    $user = 'root';
    $pass = ''; 
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hataları göster
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Verileri dizi olarak çek (Düzeltildi)
        PDO::ATTR_EMULATE_PREPARES   => false,                  // SQL Injection koruması (Düzeltildi)
    ];

    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?>