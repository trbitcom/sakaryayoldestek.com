<?php
$formSuccess = false;
$formError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $phone === '') {
        $formError = 'Lütfen isim ve telefon alanlarını doldurun.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, phone, message) VALUES (:name, :phone, :message)");
        $stmt->execute(['name' => $name, 'phone' => $phone, 'message' => $message]);
        header("Location: " . BASE_URL . "iletisim?gonderildi=1");
        exit;
    }
}

if (isset($_GET['gonderildi'])) {
    $formSuccess = true;
}

require_once 'header.php';
?>

<main>
<!-- Mini Header -->
<div class="position-relative bg-secondary text-white overflow-hidden"
    style="min-height: 300px; padding-top: 120px; padding-bottom: 3rem;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(135deg, rgba(26,26,29,0.95), rgba(26,26,29,0.8)); z-index: 1;"></div>
    <div class="position-absolute top-50 start-50 translate-middle rounded-circle bg-warning opacity-10"
        style="width: min(500px, 80vw); height: min(500px, 80vw); filter: blur(100px); z-index: 0;"></div>

    <div class="container position-relative h-100 d-flex flex-column justify-content-center" style="z-index: 2;">
        <h1 class="display-4 fw-bold mb-0 text-warning text-center">İletişim</h1>
        <p class="text-center text-white-75 mb-0 mt-2">7/24 ulaşabilirsiniz, size en yakın ekibimizi yönlendirelim.</p>
        <?php if (!empty($settings['owner_name'])): ?>
            <p class="text-center text-white-75 mb-0 mt-1 small">İşletme Sahibi: <span
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

        <!-- Form + Map -->
        <div class="row g-4 mb-5">
            <div class="col-lg-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 p-4">
                    <h2 class="h5 fw-bold mb-3">Aramak İstemiyorsanız Yazın</h2>
                    <p class="text-muted small mb-4">Bilgilerinizi bırakın, ekibimiz en kısa sürede size dönsün.</p>

                    <?php if ($formSuccess): ?>
                        <div class="alert alert-success" role="status">
                            <i class="fas fa-check-circle me-2"></i>Mesajınız alındı, en kısa sürede size dönüş yapacağız.
                        </div>
                    <?php endif; ?>
                    <?php if ($formError): ?>
                        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
                    <?php endif; ?>

                    <form method="POST" action="<?= BASE_URL ?>iletisim">
                        <input type="hidden" name="contact_form" value="1">
                        <div class="mb-3">
                            <label for="contactName" class="form-label fw-bold small">Adınız Soyadınız</label>
                            <input type="text" id="contactName" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactPhone" class="form-label fw-bold small">Telefon Numaranız</label>
                            <input type="tel" id="contactPhone" name="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactMessage" class="form-label fw-bold small">Konumunuz / Mesajınız
                                (opsiyonel)</label>
                            <textarea id="contactMessage" name="message" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning fw-bold w-100 rounded-pill">
                            <i class="fas fa-paper-plane me-2"></i>Gönder
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7">
                <?php if (!empty($settings['google_maps'])): ?>
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                        <div class="ratio ratio-21x9 h-100" style="min-height: 300px;">
                            <?= $settings['google_maps'] ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- CTA -->
        <div class="card bg-dark text-white border-0 shadow rounded-4 overflow-hidden">
            <div class="card-body p-5 text-center">
                <i class="fas fa-headset fa-3x text-warning mb-3"></i>
                <h3 class="fw-bold mb-3">Yolda mı kaldınız?</h3>
                <p class="text-white-75 mb-4">Sakarya, Kocaeli ve Düzce genelinde 7/24 hizmetinizdeyiz. Hemen arayın
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
</main>

<?php require_once 'footer.php'; ?>
