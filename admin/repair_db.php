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
    $columns = ['whatsapp', 'google_maps', 'google_analytics', 'phone', 'site_url', 'site_title', 'address', 'owner_name'];
    foreach ($columns as $col) {
        try {
            $pdo->query("SELECT $col FROM settings LIMIT 1");
        } catch (PDOException $e) {
            $type = in_array($col, ['google_analytics', 'google_maps', 'address']) ? 'TEXT' : 'VARCHAR(255)';
            $pdo->exec("ALTER TABLE settings ADD COLUMN $col $type DEFAULT NULL");
            echo "$col sütunu eklendi.<br>";
        }
    }

    // pages tablosunda meta_desc sütunu var mı
    try {
        $pdo->query("SELECT meta_desc FROM pages LIMIT 1");
    } catch (PDOException $e) {
        $pdo->exec("ALTER TABLE pages ADD COLUMN meta_desc VARCHAR(255) DEFAULT NULL");
        echo "pages.meta_desc sütunu eklendi.<br>";
    }

    // contact_messages tablosu var mı
    try {
        $pdo->query("SELECT id FROM contact_messages LIMIT 1");
    } catch (PDOException $e) {
        $pdo->exec("CREATE TABLE contact_messages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(150) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            message TEXT DEFAULT NULL,
            is_read TINYINT(1) NOT NULL DEFAULT 0,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        )");
        echo "contact_messages tablosu oluşturuldu.<br>";
    }

    echo "<b>Veritabanı onarımı tamamlandı!</b> Bu dosyayı silebilirsiniz.";

} catch (PDOException $e) {
    die("Hata: " . $e->getMessage());
}
?>