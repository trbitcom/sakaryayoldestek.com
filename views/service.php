<?php require_once 'header.php'; ?>

<main>
<!-- Service Hero -->
<header class="position-relative overflow-hidden"
    style="height: 50vh; min-height: 420px; padding-top: 90px; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
    <div class="position-absolute w-100 h-100 page-hero-bg"></div>
    <div class="container position-relative z-2">
        <div class="mb-3">
            <i class="fas <?= htmlspecialchars($service['icon'] ?: 'fa-truck-pickup') ?> fa-3x text-warning"></i>
        </div>
        <h1 class="display-4 fw-bold mb-3 text-uppercase"><?= htmlspecialchars($service['name']) ?></h1>
        <p class="lead mb-4 fs-4">Sakarya, Kocaeli ve Düzce genelinde 7/24 hizmetinizdeyiz.</p>

        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                <i class="fas fa-phone-alt me-2 animate-shake"></i> HEMEN ARA
            </a>
            <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                <i class="fab fa-whatsapp me-2"></i> WHATSAPP
            </a>
        </div>
    </div>
</header>

<div class="container py-5 my-5">
    <div class="row g-5">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5">
                    <div class="content-text fs-5 text-muted" style="line-height: 1.8;">
                        <?= $service['content_text'] ?>
                    </div>
                </div>
            </div>

            <!-- Bölge Bağlantısı -->
            <div class="p-4 bg-white rounded-4 shadow-sm border-start border-5 border-warning">
                <h4 class="fw-bold"><i class="fas fa-map-marked-alt text-warning me-2"></i>Hizmet Bölgelerimiz</h4>
                <p class="text-muted mb-3">Bu hizmeti Sakarya'nın tüm ilçelerinde sunuyoruz.</p>
                <a href="<?= BASE_URL ?>bolgeler" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                    Tüm Bölgeleri Gör <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 1;">

                <!-- CTA Box -->
                <div class="card bg-dark text-white border-0 shadow rounded-4 mb-4 overflow-hidden text-center">
                    <div class="card-body p-4">
                        <i class="fas fa-headset fa-3x text-warning mb-3"></i>
                        <h4 class="fw-bold">Acil Yardım Hattı</h4>
                        <p class="text-white-75">Müşteri temsilcimiz çağrınızı bekliyor.</p>
                        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                            class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark fs-5 animate-pulse">
                            <i class="fas fa-phone me-2"></i>
                            <?= isset($settings['phone']) ? $settings['phone'] : '0555 123 45 67' ?>
                        </a>
                    </div>
                </div>

                <!-- Diğer Hizmetler -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white fw-bold py-3 border-bottom">
                        <i class="fas fa-list text-danger me-2"></i>Diğer Hizmetlerimiz
                    </div>
                    <div class="list-group list-group-flush">
                        <?php
                        $otherStmt = $pdo->prepare("SELECT name, slug, icon FROM services WHERE is_active = 1 AND slug != ? ORDER BY sort_order ASC");
                        $otherStmt->execute([$service['slug']]);
                        while ($sRow = $otherStmt->fetch()):
                            ?>
                            <a href="<?= BASE_URL . $sRow['slug'] ?>"
                                class="list-group-item list-group-item-action py-3 d-flex align-items-center gap-2">
                                <i class="fas <?= htmlspecialchars($sRow['icon'] ?: 'fa-truck-pickup') ?> text-warning"></i>
                                <span><?= htmlspecialchars($sRow['name']) ?></span>
                            </a>
                        <?php endwhile; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CTA Strip -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">YOLDA KALMAYIN, HEMEN ARAYIN!</h2>
        <p class="fs-4 mb-4">Sakarya genelinde 7/24 <?= htmlspecialchars(mb_strtolower($service['name'], 'UTF-8')) ?> için yanınızdayız.</p>
        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
            class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow">
            <i class="fas fa-phone me-2 text-primary"></i> HEMEN DESTEK AL
        </a>
    </div>
</section>
</main>

<?php require_once 'footer.php'; ?>
