<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($metaTitle) ? $metaTitle : (defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici') ?></title>
  <meta name="description" content="<?= isset($metaDesc) ? $metaDesc : '' ?>">

  <!-- Google Search Console Doğrulama -->
  <meta name="google-site-verification" content="D2QGu9N-tQMcFNUbDdPkFtQJmwGFhHCPsFLRUY5A1lE" />

  <?php
  // Canonical URL ve Open Graph için mevcut sayfa adresini hesapla
  $currentPath = isset($url) ? implode('/', array_filter($url)) : '';
  $canonicalUrl = rtrim(BASE_URL, '/') . ($currentPath ? '/' . $currentPath : '/');
  ?>
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta name="robots" content="index, follow">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:locale" content="tr_TR">
  <meta property="og:site_name" content="<?= htmlspecialchars(defined('SITE_NAME') ? SITE_NAME : ($settings['site_title'] ?? 'Oto Çekici')) ?>">
  <meta property="og:title" content="<?= htmlspecialchars(isset($metaTitle) ? $metaTitle : '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars(isset($metaDesc) ? $metaDesc : '') ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <?php if (!empty($settings['logo'])): ?>
    <meta property="og:image" content="<?= BASE_URL ?>public/img/<?= htmlspecialchars($settings['logo']) ?>">
  <?php endif; ?>
  <meta name="twitter:card" content="summary_large_image">

  <!-- LocalBusiness Schema (Google Yerel SEO) -->
  <script type="application/ld+json">
  <?php
  $schemaAreas = [];
  try {
      $areaStmt = $pdo->query("SELECT name FROM locations WHERE is_active = 1");
      foreach ($areaStmt->fetchAll(PDO::FETCH_ASSOC) as $areaRow) {
          $schemaAreas[] = ['@type' => 'City', 'name' => $areaRow['name']];
      }
  } catch (Exception $e) {
      // sessiz geç
  }
  $schema = [
      '@context' => 'https://schema.org',
      '@type' => 'AutoRepair',
      'name' => $settings['site_title'] ?? (defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici'),
      'image' => !empty($settings['logo']) ? (BASE_URL . 'public/img/' . $settings['logo']) : null,
      'url' => rtrim(BASE_URL, '/'),
      'telephone' => $settings['phone'] ?? null,
      'priceRange' => '$$',
      'address' => [
          '@type' => 'PostalAddress',
          'addressLocality' => 'Sakarya',
          'addressRegion' => 'Sakarya',
          'addressCountry' => 'TR',
      ],
      'areaServed' => $schemaAreas ?: [['@type' => 'City', 'name' => 'Sakarya']],
      'openingHoursSpecification' => [[
          '@type' => 'OpeningHoursSpecification',
          'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
          'opens' => '00:00',
          'closes' => '23:59',
      ]],
  ];
  echo json_encode(array_filter($schema, fn($v) => $v !== null), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  ?>
  </script>

  <!-- Favicon -->
  <?php if (isset($settings['favicon']) && !empty($settings['favicon'])): ?>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>public/img/<?= htmlspecialchars($settings['favicon']) ?>">
  <?php endif; ?>

  <!-- Dış kaynaklara erken bağlantı (performans) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Roboto:wght@300;400;500;700&display=swap">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">

  <!-- Google Analytics -->
  <?php if (isset($settings['google_analytics']) && !empty($settings['google_analytics'])): ?>
    <?= $settings['google_analytics'] ?>
  <?php endif; ?>

  <style>
    /* Custom Header Styles */
    .navbar {
      transition: all 0.4s ease;
      background: rgba(0, 0, 0, 0.2) !important;
      padding: 10px 0;
    }

    .navbar.scrolled {
      background: #002550 !important;
      padding: 5px 0;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .nav-link {
      font-family: 'Rajdhani', sans-serif;
      font-weight: 600;
      font-size: 1.1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: white !important;
      position: relative;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: var(--primary-color);
      transition: width 0.3s;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .cta-btn-header {
      background: #E74C3C;
      color: white !important;
      font-weight: 800;
      border-radius: 50px;
      padding: 10px 25px;
      box-shadow: 0 0 15px rgba(231, 76, 60, 0.5);
      border: 2px solid white;
      animation: pulse-red 2s infinite;
    }

    .cta-btn-header:hover {
      background: white;
      color: #E74C3C !important;
      border-color: #E74C3C;
    }

    @keyframes pulse-red {
      0% {
        box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7);
      }

      70% {
        box-shadow: 0 0 0 10px rgba(231, 76, 60, 0);
      }

      100% {
        box-shadow: 0 0 0 0 rgba(231, 76, 60, 0);
      }
    }

    @media (max-width: 991px) {
      .navbar {
        background: #002550 !important;
      }
    }
  </style>
</head>

<body>

  <!-- Preloader -->
  <div id="preloader">
    <i class="fas fa-truck-pickup loader-icon"></i>
    <div class="loader-text">YÜKLENİYOR...</div>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold fs-3" href="<?= BASE_URL ?>">
        <?php if (isset($settings['logo']) && !empty($settings['logo'])): ?>
          <img src="<?= BASE_URL ?>public/img/<?= htmlspecialchars($settings['logo']) ?>" alt="Logo" height="50"
            class="d-inline-block align-text-center">
        <?php else: ?>
          <img src="https://via.placeholder.com/150x50/FE790E/002550?text=LOGO" alt="Placeholder Logo" height="40">
        <?php endif; ?>
      </a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto align-items-center">
          <li class="nav-item"><a class="nav-link px-3" href="<?= BASE_URL ?>">Anasayfa</a></li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">Hizmetlerimiz</a>
            <ul class="dropdown-menu shadow border-0">
              <?php
              $stmtHdrSvc = $pdo->query("SELECT name, slug, icon FROM services WHERE is_active = 1 ORDER BY sort_order ASC");
              while ($hdrSvc = $stmtHdrSvc->fetch()):
                ?>
                <li><a class="dropdown-item" href="<?= BASE_URL . $hdrSvc['slug'] ?>"><i
                      class="fas <?= htmlspecialchars($hdrSvc['icon'] ?: 'fa-truck-pickup') ?> text-warning me-2"></i><?= htmlspecialchars($hdrSvc['name']) ?></a>
                </li>
              <?php endwhile; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle px-3" href="#" role="button" data-bs-toggle="dropdown">Hizmet
              Bölgeleri</a>
            <ul class="dropdown-menu shadow border-0">
              <?php
              // Rastgele 5 Bölge
              $stmtLoc = $pdo->query("SELECT name, slug FROM locations WHERE is_active = 1 ORDER BY RAND() LIMIT 5");
              while ($loc = $stmtLoc->fetch()):
                ?>
                <li><a class="dropdown-item" href="<?= BASE_URL . $loc['slug'] ?>"><i
                      class="fas fa-map-marker-alt text-danger me-2"></i><?= htmlspecialchars($loc['name']) ?></a></li>
              <?php endwhile; ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item fw-bold text-center" href="<?= BASE_URL ?>bolgeler">Tüm Bölgeler</a></li>
            </ul>
          </li>

          <li class="nav-item"><a class="nav-link px-3" href="<?= BASE_URL ?>#about">Kurumsal</a></li>
          <li class="nav-item"><a class="nav-link px-3" href="<?= BASE_URL ?>iletisim">İletişim</a></li>
        </ul>

        <div class="d-none d-lg-block">
          <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
            class="cta-btn-header text-decoration-none">
            <i class="fas fa-phone-volume me-2"></i> 7/24 ACİL:
            <?= isset($settings['phone']) ? $settings['phone'] : '0555 123 45 67' ?>
          </a>
        </div>
      </div>
    </div>
  </nav>