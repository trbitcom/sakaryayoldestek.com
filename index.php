<?php
require_once 'app/config.php';
require_once 'app/db.php';
require_once 'app/functions.php';

// URL yapısını al
$url = getUrl();

// Ayarları Çek
$stmtSettings = $pdo->query("SELECT * FROM settings WHERE id = 1");
$settings = $stmtSettings->fetch(PDO::FETCH_ASSOC);

// 1. Durum: Anasayfa (URL boşsa)
if (!isset($url[0]) || empty($url[0])) {
    $metaTitle = "Sakarya Oto Çekici, Yol Yardım ve Oto Kurtarıcı | 7/24";
    $metaDesc = "Sakarya çekici, Sakarya yol yardım ve Sakarya oto kurtarıcı hizmeti 15 dakikada yanınızda. Kocaeli ve Düzce'de de 7/24 hizmetteyiz.";

    require_once 'views/header.php';
    require_once 'views/home.php';
    require_once 'views/footer.php';
    exit;
}

// URL'in ilk parçası bizim slug'ımız (örn: /serdivan-oto-cekici)
$currentSlug = $url[0];

// Özel Sayfalar
if ($currentSlug == 'bolgeler') {
    $metaTitle = "Hizmet Bölgelerimiz - " . (defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici');
    $metaDesc = "Sakarya, Kocaeli ve Düzce genelinde hizmet verdiğimiz tüm ilçe ve bölgeler.";
    require_once 'views/locations.php';
    exit;
}

if ($currentSlug == 'iletisim') {
    $metaTitle = "İletişim - " . (defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici');
    $metaDesc = "Sakarya Yol Destek ile iletişime geçin. Telefon, WhatsApp ve adres bilgilerimiz.";
    require_once 'views/contact.php';
    exit;
}

// 2. Durum: Veritabanında bu URL var mı? (Locations tablosuna bak)
$stmt = $pdo->prepare("SELECT * FROM locations WHERE slug = :slug AND is_active = 1");
$stmt->execute(['slug' => $currentSlug]);
$location = $stmt->fetch();

if ($location) {
    // Bulundu! O bölgenin verilerini değişkene atayalım
    $metaTitle = $location['meta_title'];
    $metaDesc = $location['meta_desc'];

    require_once 'views/header.php';
    require_once 'views/page-location.php'; // Bölge özel sayfası
    require_once 'views/footer.php';
    exit;
}

// 2b. Durum: Hizmet Sayfaları (Services tablosuna bak)
$stmtSvc = $pdo->prepare("SELECT * FROM services WHERE slug = :slug AND is_active = 1");
$stmtSvc->execute(['slug' => $currentSlug]);
$service = $stmtSvc->fetch();

if ($service) {
    $metaTitle = $service['meta_title'];
    $metaDesc = $service['meta_desc'];

    require_once 'views/service.php'; // header/footer'ı kendi içinde çağırır
    exit;
}

// 3. Durum: Genel Sayfalar (Gizlilik, KVKK vb.)
$stmtPage = $pdo->prepare("SELECT * FROM pages WHERE slug = :slug");
$stmtPage->execute(['slug' => $currentSlug]);
$page = $stmtPage->fetch();

if ($page) {
    $metaTitle = $page['title'] . " - " . (defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici');

    require_once 'views/header.php';
    require_once 'views/page.php';
    require_once 'views/footer.php';
    exit;
}

// 3. Durum: Sayfa Bulunamadı
header("HTTP/1.0 404 Not Found");
echo "404 - Sayfa Bulunamadı";
// İstersen buraya views/404.php de ekleyebiliriz.
?>