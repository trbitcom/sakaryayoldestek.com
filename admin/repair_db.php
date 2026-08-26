<?php
require_once '../app/db.php';

try {
    echo "Veritabanı sütunları kontrol ediliyor...<br>";

    // Add logo column if not exists
    try {
        $pdo->query("SELECT logo FROM settings LIMIT 1");
        echo "Logo sütunu zaten var.<br>";
    } catch (PDOException $e) {
        $pdo->exec("ALTER TABLE settings ADD COLUMN logo VARCHAR(255) DEFAULT NULL");
        echo "Logo sütunu eklendi.<br>";
    }

    // Add favicon column if not exists
    try {
        $pdo->query("SELECT favicon FROM settings LIMIT 1");
        echo "Favicon sütunu zaten var.<br>";
    } catch (PDOException $e) {
        $pdo->exec("ALTER TABLE settings ADD COLUMN favicon VARCHAR(255) DEFAULT NULL");
        echo "Favicon sütunu eklendi.<br>";
    }

    // Add other potentially missing columns just in case
    $columns = ['whatsapp', 'google_maps', 'google_analytics', 'phone', 'site_url', 'site_title'];
    foreach ($columns as $col) {
        try {
            $pdo->query("SELECT $col FROM settings LIMIT 1");
        } catch (PDOException $e) {
            $type = ($col == 'google_analytics' || $col == 'google_maps') ? 'TEXT' : 'VARCHAR(255)';
            $pdo->exec("ALTER TABLE settings ADD COLUMN $col $type DEFAULT NULL");
            echo "$col sütunu eklendi.<br>";
        }
    }

    echo "<b>Veritabanı onarımı tamamlandı!</b> Bu dosyayı silebilirsiniz.";

} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
?>