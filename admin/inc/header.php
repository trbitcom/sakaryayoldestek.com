<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once '../app/db.php';
require_once '../app/functions.php';

// Güvenlik Duvarı: Giriş yapmamışsa login.php'ye at
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

$currentPage = basename($_SERVER['SCRIPT_NAME']);

$navItems = [
  ['href' => 'index.php', 'icon' => 'fa-chart-pie', 'label' => 'Anasayfa', 'match' => ['index.php']],
  ['href' => 'locations.php', 'icon' => 'fa-map-marker-alt', 'label' => 'Bölgeler', 'match' => ['locations.php', 'location-add.php']],
  ['href' => 'services.php', 'icon' => 'fa-concierge-bell', 'label' => 'Hizmetler', 'match' => ['services.php', 'service-add.php']],
  ['href' => 'references.php', 'icon' => 'fa-handshake', 'label' => 'Referanslar', 'match' => ['references.php']],
  ['href' => 'messages.php', 'icon' => 'fa-envelope', 'label' => 'Mesajlar', 'match' => ['messages.php']],
  ['href' => 'pages.php', 'icon' => 'fa-file-alt', 'label' => 'Sayfalar', 'match' => ['pages.php', 'page_edit.php']],
  ['href' => 'settings.php', 'icon' => 'fa-cog', 'label' => 'Ayarlar', 'match' => ['settings.php']],
];
?>
<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yönetim Paneli</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Roboto:wght@300;400;500;700&display=swap">
  <!-- Marka Renkleri ve Fontlar (frontend ile ortak) -->
  <link rel="stylesheet" href="../public/css/style.css">
  <link rel="stylesheet" href="../public/css/admin.css">
</head>

<body>

  <div class="admin-shell">

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
      <div class="sidebar-brand">
        <i class="fas fa-truck-pickup"></i>
        <span>Sakarya Yol Destek</span>
      </div>

      <?php
      try {
          $unreadCount = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
      } catch (PDOException $e) {
          $unreadCount = 0;
      }
      ?>
      <nav class="sidebar-nav">
        <?php foreach ($navItems as $item): ?>
          <a class="sidebar-link<?= in_array($currentPage, $item['match']) ? ' active' : '' ?>" href="<?= $item['href'] ?>">
            <i class="fas <?= $item['icon'] ?>"></i> <span><?= $item['label'] ?></span>
            <?php if ($item['href'] === 'messages.php' && $unreadCount > 0): ?>
              <span class="badge bg-danger rounded-pill ms-auto"><?= $unreadCount ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; ?>

        <div class="sidebar-divider"></div>

        <a class="sidebar-link" href="../" target="_blank">
          <i class="fas fa-external-link-alt"></i> <span>Siteye Git</span>
        </a>
      </nav>

      <div class="sidebar-user">
        <div class="sidebar-user-avatar">
          <?= strtoupper(substr($_SESSION['username'] ?? 'Y', 0, 1)) ?>
        </div>
        <div class="sidebar-user-info">
          <div class="sidebar-user-name"><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Yönetici' ?></div>
          <a href="logout.php" class="sidebar-user-logout"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a>
        </div>
      </div>
    </aside>

    <!-- Main -->
    <div class="admin-main">
      <div class="admin-topbar d-flex d-lg-none align-items-center justify-content-between">
        <button class="admin-sidebar-toggle" type="button" id="sidebarToggleBtn" aria-label="Menüyü aç">
          <i class="fas fa-bars"></i>
        </button>
        <span class="fw-bold"><i class="fas fa-truck-pickup me-2 text-warning"></i>Yönetim Paneli</span>
        <a href="../" target="_blank" class="text-muted"><i class="fas fa-external-link-alt"></i></a>
      </div>

      <div class="admin-sidebar-backdrop" id="sidebarBackdrop"></div>

      <div class="container-fluid admin-content">
        <!-- Main Content Start -->
