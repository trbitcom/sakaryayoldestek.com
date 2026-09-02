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

// Breadcrumb (görsel + BreadcrumbList schema.org) yazdırır
// $items: [['label' => 'X', 'url' => '...'], ..., ['label' => 'Son Sayfa']]
function renderBreadcrumb($items) {
    $jsonld = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => rtrim(BASE_URL, '/')],
        ],
    ];

    echo '<nav aria-label="breadcrumb" class="bg-white border-bottom"><div class="container">';
    echo '<ol class="breadcrumb mb-0 py-2 small">';
    echo '<li class="breadcrumb-item"><a href="' . BASE_URL . '" class="text-decoration-none text-muted"><i class="fas fa-home"></i> Anasayfa</a></li>';

    $count = count($items);
    foreach ($items as $i => $item) {
        $position = $i + 2;
        $isLast = ($i === $count - 1);
        $url = !empty($item['url']) ? $item['url'] : null;

        if (!$isLast && $url) {
            echo '<li class="breadcrumb-item"><a href="' . htmlspecialchars($url) . '" class="text-decoration-none text-muted">' . htmlspecialchars($item['label']) . '</a></li>';
        } else {
            echo '<li class="breadcrumb-item active text-dark fw-bold" aria-current="page">' . htmlspecialchars($item['label']) . '</li>';
        }

        $listItem = ['@type' => 'ListItem', 'position' => $position, 'name' => $item['label']];
        if ($url) {
            $listItem['item'] = $url;
        } elseif ($isLast) {
            $listItem['item'] = $GLOBALS['canonicalUrl'] ?? BASE_URL;
        }
        $jsonld['itemListElement'][] = $listItem;
    }

    echo '</ol></div></nav>';
    echo '<script type="application/ld+json">' . json_encode($jsonld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
?>