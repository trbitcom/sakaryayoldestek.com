<?php require_once 'header.php'; ?>

<!-- Location Hero -->
<header class="position-relative overflow-hidden"
    style="height: 60vh; min-height: 500px; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
    <div class="position-absolute w-100 h-100"
        style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('<?= BASE_URL ?>public/img/hero-bg.jpg') center/cover; filter: blur(2px);">
    </div>
    <div class="container position-relative z-2">
        <span class="badge bg-warning text-dark fw-bold mb-3 px-3 py-2 animate-pulse"><i
                class="fas fa-map-marker-alt me-2"></i>7/24 HİZMET</span>
        <h1 class="display-3 fw-bold mb-3 text-uppercase"><?= htmlspecialchars($location['name']) ?><br><span
                class="text-warning">OTO ÇEKİCİ</span></h1>
        <p class="lead mb-4 fs-3">Yolda kalmayın! <?= htmlspecialchars($location['name']) ?> ve çevresinde en yakın
            ekibimiz 15 dakikada yanınızda.</p>

        <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
            <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                <i class="fas fa-phone-alt me-2 animate-shake"></i> HEMEN ARA
            </a>
            <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                <i class="fab fa-whatsapp me-2"></i> KONUM GÖNDER
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
                    <h2 class="h3 fw-bold mb-4 border-bottom pb-3"><i
                            class="fas fa-info-circle text-primary me-2"></i>Hizmet Detayları</h2>

                    <div class="content-text fs-5 text-muted" style="line-height: 1.8;">
                        <?= $location['content_text'] ?>
                    </div>
                </div>
            </div>

            <!-- Why Choose Us Grid -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 border-start border-5 border-warning">
                        <i class="fas fa-clock fa-2x text-warning mb-3"></i>
                        <h4 class="fw-bold">Hızlı Varış</h4>
                        <p class="text-muted m-0"><?= htmlspecialchars($location['name']) ?> trafik durumuna hakimiz. En
                            kısa yoldan yanınıza ulaşıyoruz.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 shadow-sm h-100 border-start border-5 border-primary">
                        <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                        <h4 class="fw-bold">Güvenli Taşıma</h4>
                        <p class="text-muted m-0">Aracınız sigortalı olarak taşınır. Gözünüz arkada kalmasın.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Sticky Sidebar Wrapper -->
            <div class="sticky-top" style="top: 100px; z-index: 1;">

                <!-- CTA Box -->
                <div class="card bg-dark text-white border-0 shadow rounded-4 mb-4 overflow-hidden text-center">
                    <div class="card-body p-4">
                        <i class="fas fa-headset fa-3x text-warning mb-3"></i>
                        <h4 class="fw-bold">Acil Yardım Hattı</h4>
                        <p class="text-white-50">Müşteri temsilcimiz çağrınızı bekliyor.</p>
                        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                            class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark fs-5 animate-pulse">
                            <i class="fas fa-phone me-2"></i>
                            <?= isset($settings['phone']) ? $settings['phone'] : '0555 123 45 67' ?>
                        </a>
                    </div>
                </div>

                <!-- Nearby Locations -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white fw-bold py-3 border-bottom">
                        <i class="fas fa-map-signs text-danger me-2"></i>Yakındaki Bölgeler
                    </div>
                    <div class="list-group list-group-flush">
                        <?php
                        $sidebarStmt = $pdo->query("SELECT name, slug FROM locations WHERE is_active = 1 ORDER BY RAND() LIMIT 6");
                        while ($sRow = $sidebarStmt->fetch()):
                            ?>
                            <a href="<?= BASE_URL . $sRow['slug'] ?>"
                                class="list-group-item list-group-item-action py-3 d-flex justify-content-between align-items-center">
                                <span><?= htmlspecialchars($sRow['name']) ?></span>
                                <i class="fas fa-chevron-right text-muted small"></i>
                            </a>
                        <?php endwhile; ?>
                    </div>
                    <div class="card-footer bg-white text-center p-3 border-top-0">
                        <a href="<?= BASE_URL ?>bolgeler"
                            class="btn btn-outline-primary btn-sm rounded-pill fw-bold w-100">Tüm Bölgeleri Gör</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CTA Strip -->
<section class="py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">ARACINIZ GÜVENDE!</h2>
        <p class="fs-4 mb-4"><?= htmlspecialchars($location['name']) ?> bölgesinde binlerce memnun müşteri.</p>
        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
            class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow">
            <i class="fas fa-phone me-2 text-primary"></i> HEMEN DESTEK AL
        </a>
    </div>
</section>

<?php require_once 'footer.php'; ?>