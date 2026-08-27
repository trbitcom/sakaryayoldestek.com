<?php
// Hata raporlamayı açalım (Geliştirme aşamasında)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sabitler
if (($_SERVER['SERVER_NAME'] ?? '') === 'localhost') {
    define('BASE_URL', 'http://localhost/oto-cekici-projesi/');
} else {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    define('BASE_URL', $scheme . '://' . $_SERVER['HTTP_HOST'] . '/');
}
define('SITE_NAME', 'Sakarya Yol Destek');
?>