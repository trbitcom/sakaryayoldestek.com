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
  <!-- Marka Renkleri ve Fontlar (frontend ile ortak) -->
  <link rel="stylesheet" href="../public/css/style.css">
  <link rel="stylesheet" href="../public/css/admin.css">

  <style>
    /* Table responsiveness fix */
    @media (max-width: 768px) {
      .table-responsive-stack tr {
        display: flex;
        flex-direction: column;
        margin-bottom: 1rem;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 10px;
        background: white;
      }

      .table-responsive-stack td {
        display: flex;
        justify-content: space-between;
        border: none;
        padding: 0.5rem 0;
      }

      .table-responsive-stack td:before {
        content: attr(data-label);
        font-weight: bold;
        margin-right: 1rem;
        color: #6c757d;
      }

      .table-responsive-stack thead {
        display: none;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark admin-navbar shadow-sm mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php"><i class="fas fa-truck-pickup me-2"></i>Sakarya Yol Destek</a>

      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link text-white<?= $currentPage === 'index.php' ? ' active' : '' ?>" href="index.php"><i class="fas fa-home me-1"></i>
              Anasayfa</a></li>
          <li class="nav-item"><a class="nav-link text-white<?= in_array($currentPage, ['locations.php', 'location-add.php']) ? ' active' : '' ?>" href="locations.php"><i
                class="fas fa-map-marker-alt me-1"></i> Bölgeler</a></li>
          <li class="nav-item"><a class="nav-link text-white<?= $currentPage === 'references.php' ? ' active' : '' ?>" href="references.php"><i
                class="fas fa-handshake me-1"></i> Referanslar</a></li>
          <li class="nav-item"><a class="nav-link text-white<?= in_array($currentPage, ['pages.php', 'page_edit.php']) ? ' active' : '' ?>" href="pages.php"><i class="fas fa-file-alt me-1"></i>
              Sayfalar</a></li>
          <li class="nav-item"><a class="nav-link text-white<?= $currentPage === 'settings.php' ? ' active' : '' ?>" href="settings.php"><i class="fas fa-cog me-1"></i>
              Ayarlar</a></li>
          <li class="nav-item"><a class="nav-link text-white opacity-75" href="../" target="_blank"><i
                class="fas fa-external-link-alt me-1"></i> Siteye Git</a></li>
        </ul>

        <div class="d-flex align-items-center mt-3 mt-lg-0">
          <div class="text-white me-3 d-none d-lg-block">
            <small>Merhaba,</small> <span
              class="fw-bold"><?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Yönetici' ?></span>
          </div>
          <a class="btn btn-light btn-sm fw-bold text-primary" href="logout.php">
            <i class="fas fa-sign-out-alt me-1"></i> Çıkış
          </a>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <!-- Main Content Start -->