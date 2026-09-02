<?php require_once 'header.php'; ?>

<main>
<?php renderBreadcrumb([
    ['label' => 'Sayfa Bulunamadı'],
]); ?>

<section class="d-flex flex-column align-items-center justify-content-center text-center px-3"
    style="min-height: 70vh; padding-top: 40px;">
    <i class="fas fa-map-signs fa-4x text-warning mb-4"></i>
    <h1 class="display-4 fw-bold mb-3">404</h1>
    <h2 class="h4 text-muted mb-4">Aradığınız sayfa bulunamadı.</h2>
    <p class="text-muted mb-4" style="max-width: 500px;">Bu sayfa kaldırılmış, adı değişmiş ya da hiç var olmamış
        olabilir. Yolda kaldıysanız aşağıdan hemen bize ulaşabilirsiniz.</p>

    <div class="d-flex flex-column flex-md-row gap-3">
        <a href="<?= BASE_URL ?>" class="btn btn-dark rounded-pill px-5 py-3 fw-bold">
            <i class="fas fa-home me-2"></i> Anasayfaya Dön
        </a>
        <a href="<?= BASE_URL ?>bolgeler" class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold">
            <i class="fas fa-map-marked-alt me-2"></i> Size En Yakın Bölgeyi Bulun
        </a>
        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
            class="btn btn-danger rounded-pill px-5 py-3 fw-bold">
            <i class="fas fa-phone-alt me-2"></i> HEMEN ARA
        </a>
    </div>
</section>
</main>

<?php require_once 'footer.php'; ?>
