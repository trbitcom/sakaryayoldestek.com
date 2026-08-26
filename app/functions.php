<?php
// XSS ve zararlı kod temizliği
function filter($str) {
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

// Türkçe karakterleri SEO uyumlu İngilizceye çevirir (sakarya-oto-cekici)
function permalink($str) {
    $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
    $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', '', '');
    $str = strtolower(str_replace($find, $replace, $str));
    $str = preg_replace("@[^a-z0-9\-şğıöçü]@", "-", $str);
    $str = preg_replace('@\-+@', '-', $str);
    $str = trim($str, '-');
    return $str;
}

// Aktif URL'i parçalamak için
function getUrl() {
    if (isset($_GET['route'])) {
        return explode('/', filter($_GET['route']));
    }
    return [];
}
?>