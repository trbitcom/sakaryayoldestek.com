<?php require_once 'header.php'; ?>

<!-- Mini Header -->
<div class="position-relative bg-secondary text-white overflow-hidden"
    style="min-height: 300px; padding-top: 120px; padding-bottom: 3rem;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(135deg, rgba(26,26,29,0.95), rgba(26,26,29,0.8)); z-index: 1;"></div>
    <div class="position-absolute top-50 start-50 translate-middle rounded-circle bg-warning opacity-10"
        style="width: min(500px, 80vw); height: min(500px, 80vw); filter: blur(100px); z-index: 0;"></div>

    <div class="container position-relative h-100 d-flex flex-column justify-content-center" style="z-index: 2;">
        <h1 class="display-4 fw-bold mb-0 text-warning text-center">İletişim</h1>
        <p class="text-center text-white-50 mb-0 mt-2">7/24 ulaşabilirsiniz, size en yakın ekibimizi yönlendirelim.</p>
        <?php if (!empty($settings['owner_name'])): ?>
            <p class="text-center text-white-50 mb-0 mt-1 small">İşletme Sahibi: <span
                    class="text-white fw-bold"><?= htmlspecialchars($settings['owner_name']) ?></span></p>
        <?php endif; ?>
    </div>
</div>

<!-- Contact Info Cards -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-phone-alt fa-2x text-warning"></i>
                    </div>
                    <h2 class="h5 fw-bold">Telefon</h2>
                    <p class="text-muted mb-3">7/24 acil hattımız</p>
                    <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                        class="btn btn-danger rounded-pill fw-bold px-4">
                        <?= isset($settings['phone']) ? htmlspecialchars($settings['phone']) : '0555 123 45 67' ?>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">
                    <div class="mb-3">
                        <i class="fab fa-whatsapp fa-2x text-success"></i>
                    </div>
                    <h2 class="h5 fw-bold">WhatsApp</h2>
                    <p class="text-muted mb-3">Konumunuzu anında gönderin</p>
                    <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                        class="btn btn-success rounded-pill fw-bold px-4">
                        Mesaj Gönder
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                    </div>
                    <h2 class="h5 fw-bold">Adres</h2>
                    <p class="text-muted mb-0">
                        <?= !empty($settings['address']) ? nl2br(htmlspecialchars($settings['address'])) : 'Sakarya, Türkiye' ?>
                    </p>
                    <?php if (!empty($settings['owner_name'])): ?>
                        <p class="text-muted small mt-2 mb-0 border-top pt-2">
                            <i class="fas fa-user-tie me-1"></i> İşletme Sahibi:
                            <strong><?= htmlspecialchars($settings['owner_name']) ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Map -->
        <?php if (!empty($settings['google_maps'])): ?>
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                <div class="ratio ratio-21x9" style="max-height: 450px;">
                    <?= $settings['google_maps'] ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- CTA -->
        <div class="card bg-dark text-white border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-5 text-center">
                <i class="fas fa-headset fa-3x text-warning mb-3"></i>
                <h3 class="fw-bold mb-3">Yolda mı kaldınız?</h3>
                <p class="text-white-50 mb-4">Sakarya, Kocaeli ve Düzce genelinde 7/24 hizmetinizdeyiz. Hemen arayın
                    veya WhatsApp'tan konumunuzu gönderin.</p>
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-center">
                    <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                        class="btn btn-warning btn-lg rounded-pill px-5 fw-bold text-dark">
                        <i class="fas fa-phone me-2"></i> HEMEN ARA
                    </a>
                    <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                        class="btn btn-success btn-lg rounded-pill px-5 fw-bold">
                        <i class="fab fa-whatsapp me-2"></i> WHATSAPP
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once 'footer.php'; ?>
