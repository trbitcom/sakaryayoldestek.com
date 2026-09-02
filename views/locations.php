<?php require_once 'header.php'; ?>

<main>
<!-- Hero Section -->
<header class="page-hero-bg text-white text-center py-5 d-flex align-items-center justify-content-center"
    style="min-height: 40vh; padding-top: 90px;">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3 animate-shine text-uppercase">Hizmet Bölgelerimiz</h1>
        <p class="lead mb-4 opacity-75">Sakarya, Kocaeli ve Düzce'nin her noktasına 7/24 hizmet veriyoruz.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="locationSearch" class="visually-hidden">Bölge veya ilçe ara</label>
                <input type="text" id="locationSearch"
                    class="form-control form-control-lg rounded-pill shadow-lg border-0 px-4"
                    placeholder="Bölge veya İlçe Ara..." aria-label="Bölge veya ilçe ara">
            </div>
        </div>
    </div>
</header>

<?php renderBreadcrumb([
    ['label' => 'Hizmet Bölgeleri'],
]); ?>

<section class="py-5 bg-white">
    <div class="container">
        <?php
        // İl bazlı gruplama (Hick's Law: 21 seçeneği tek listede göstermek yerine grupla)
        $provinceGroups = [
            'Sakarya' => ['adapazari-oto-cekici', 'akyazi', 'arifiye', 'erenler', 'ferizli', 'geyve', 'hendek', 'karapurcek', 'karasu', 'kaynarca', 'kocaali', 'pamukova', 'sapanca', 'serdivan-oto-cekici', 'sogutlu', 'tarakli'],
            'Kocaeli' => ['izmit', 'akmese', 'sevindikli'],
            'Otoyol Güzergahları' => ['kuzey-marmara-otoyolu', 'sapanca-anadolu-otoyolu'],
        ];

        $stmt = $pdo->query("SELECT name, slug FROM locations WHERE is_active = 1");
        $bySlug = [];
        foreach ($stmt->fetchAll() as $row) {
            $bySlug[$row['slug']] = $row;
        }

        foreach ($provinceGroups as $groupName => $slugs):
            $groupSlugs = array_values(array_filter($slugs, fn($s) => isset($bySlug[$s])));
            if (empty($groupSlugs)) continue;
            usort($groupSlugs, fn($a, $b) => strcmp($bySlug[$a]['name'], $bySlug[$b]['name']));
            ?>
            <div class="location-group mb-5" data-group>
                <h2 class="h4 fw-bold mb-3 pb-2 border-bottom border-3 border-warning d-inline-block">
                    <i class="fas fa-map-marked-alt text-warning me-2"></i><?= htmlspecialchars($groupName) ?>
                </h2>
                <div class="row g-3">
                    <?php foreach ($groupSlugs as $slug): $row = $bySlug[$slug]; ?>
                        <div class="col-6 col-md-4 col-lg-3 location-item">
                            <a href="<?= BASE_URL . $row['slug'] ?>"
                                class="card h-100 text-decoration-none border shadow-sm hover-up text-center p-3">
                                <div class="card-body p-2">
                                    <i class="fas fa-map-marker-alt text-danger fa-2x mb-3"></i>
                                    <h3 class="h5 card-title text-dark fw-bold m-0">
                                        <?= htmlspecialchars($row['name']) ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- No Results Message -->
        <div id="noResults" class="text-center py-5 d-none" role="status" aria-live="polite">
            <i class="fas fa-search-location fa-3x text-muted mb-3"></i>
            <h2 class="h4 text-muted">Aradığınız bölge bulunamadı.</h2>
            <p>Yine de bizi arayabilirsiniz, belki oraya da geliyoruz!</p>
            <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                class="btn btn-primary rounded-pill px-4">
                <i class="fas fa-phone me-2"></i> Bizi Arayın
            </a>
        </div>
    </div>
</section>

<!-- Urgent CTA -->
<section class="py-5 bg-warning text-center">
    <div class="container">
        <h2 class="fw-bold text-dark mb-4">LİSTEDE YOK MU?</h2>
        <p class="fs-4 text-dark mb-4">Endişelenmeyin! Hizmet ağımız sürekli genişliyor. Konumunuzu bize WhatsApp'tan
            atın.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                class="btn btn-success btn-lg rounded-pill px-5 shadow-lg">
                <i class="fab fa-whatsapp me-2"></i> KONUM GÖNDER
            </a>
            <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                class="btn btn-dark btn-lg rounded-pill px-5 shadow-lg">
                <i class="fas fa-phone-alt me-2"></i> HEMEN ARA
            </a>
        </div>
    </div>
</section>
</main>

<script>
    document.getElementById('locationSearch').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let hasVisible = false;

        document.querySelectorAll('[data-group]').forEach(function (group) {
            let groupHasVisible = false;
            group.querySelectorAll('.location-item').forEach(function (item) {
                let text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.classList.remove('d-none');
                    groupHasVisible = true;
                    hasVisible = true;
                } else {
                    item.classList.add('d-none');
                }
            });
            group.classList.toggle('d-none', !groupHasVisible);
        });

        if (!hasVisible) {
            document.getElementById('noResults').classList.remove('d-none');
        } else {
            document.getElementById('noResults').classList.add('d-none');
        }
    });
</script>

<?php require_once 'footer.php'; ?>