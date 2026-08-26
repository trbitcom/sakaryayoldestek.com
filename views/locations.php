<?php require_once 'header.php'; ?>

<!-- Hero Section -->
<header class="bg-dark text-white text-center py-5 d-flex align-items-center justify-content-center"
    style="min-height: 40vh; background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('<?= BASE_URL ?>public/img/hero-bg.jpg') center/cover;">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3 animate-shine text-uppercase">Hizmet Bölgelerimiz</h1>
        <p class="lead mb-4 opacity-75">Sakarya, Kocaeli ve Düzce'nin her noktasına 7/24 hizmet veriyoruz.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <input type="text" id="locationSearch"
                    class="form-control form-control-lg rounded-pill shadow-lg border-0 px-4"
                    placeholder="Bölge veya İlçe Ara...">
            </div>
        </div>
    </div>
</header>

<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-3" id="locationsGrid">
            <?php
            // Tüm aktif bölgeleri çek
            $stmt = $pdo->query("SELECT name, slug FROM locations WHERE is_active = 1 ORDER BY name ASC");
            while ($row = $stmt->fetch()):
                ?>
                <div class="col-6 col-md-4 col-lg-3 location-item">
                    <a href="<?= BASE_URL . $row['slug'] ?>"
                        class="card h-100 text-decoration-none border shadow-sm hover-up text-center p-3">
                        <div class="card-body p-2">
                            <i class="fas fa-map-marker-alt text-danger fa-2x mb-3"></i>
                            <h5 class="card-title text-dark fw-bold m-0">
                                <?= htmlspecialchars($row['name']) ?>
                            </h5>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="text-center py-5 d-none">
            <i class="fas fa-search-location fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Aradığınız bölge bulunamadı.</h4>
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

<script>
    document.getElementById('locationSearch').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let items = document.querySelectorAll('.location-item');
        let hasVisible = false;

        items.forEach(function (item) {
            let text = item.textContent.toLowerCase();
            if (text.includes(filter)) {
                item.classList.remove('d-none');
                hasVisible = true;
            } else {
                item.classList.add('d-none');
            }
        });

        if (!hasVisible) {
            document.getElementById('noResults').classList.remove('d-none');
        } else {
            document.getElementById('noResults').classList.add('d-none');
        }
    });
</script>

<?php require_once 'footer.php'; ?>