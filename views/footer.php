<footer class="text-center text-lg-start mt-auto pt-5 pb-4">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    <?php if (isset($settings['logo']) && !empty($settings['logo'])): ?>
                        <img src="<?= BASE_URL ?>public/img/<?= htmlspecialchars($settings['logo']) ?>" alt="Logo"
                            height="50" class="d-inline-block align-text-top">
                    <?php else: ?>
                        <i class="fas fa-truck-pickup me-3 text-warning"></i>
                        <?= defined('SITE_NAME') ? SITE_NAME : 'Oto Çekici' ?>
                    <?php endif; ?>
                </h6>
                <p>
                    Sakarya, Kocaeli ve Düzce bölgelerinde 7/24 profesyonel oto çekici ve yol yardım hizmeti. Yolda
                    kalmayın, bizi arayın.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">Hizmetler</h6>
                <p><a href="<?= BASE_URL ?>#services" class="text-reset">Oto Çekici</a></p>
                <p><a href="<?= BASE_URL ?>#services" class="text-reset">Akü Takviye</a></p>
                <p><a href="<?= BASE_URL ?>#services" class="text-reset">Yol Yardım</a></p>
                <p><a href="<?= BASE_URL ?>#services" class="text-reset">Çoklu Taşıma</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4">İletişim</h6>
                <p><i class="fas fa-home me-3"></i> <?= !empty($settings['address']) ? htmlspecialchars($settings['address']) : 'Sakarya, Türkiye' ?></p>
                <p><i class="fas fa-envelope me-3"></i> info@otocekici.com</p>
                <p><i class="fas fa-phone me-3"></i>
                    <?= isset($settings['phone']) ? $settings['phone'] : '0555 123 45 67' ?></p>
                <p><a href="<?= BASE_URL ?>iletisim" class="text-reset text-decoration-underline">İletişim
                        Sayfası →</a></p>
            </div>
        </div>

        <!-- Legal Links -->
        <div class="row mt-4 pt-3 border-top border-secondary text-center text-md-start"
            style="position: relative; z-index: 10;">
            <div class="col-md-12 text-center small">
                <?php
                $stmtLinks = $pdo->query("SELECT title, slug FROM pages ORDER BY id ASC");
                while ($pLink = $stmtLinks->fetch()):
                    ?>
                    <a href="<?= BASE_URL . $pLink['slug'] ?>"
                        class="text-decoration-none text-light me-3 opacity-75 hover-opacity-100"><?= htmlspecialchars($pLink['title']) ?></a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); font-size: 0.9rem;">
        © <?= date('Y') ?> Tüm Hakları Saklıdır:
        <a class="text-reset fw-bold" href="<?= BASE_URL ?>"><?= SITE_NAME ?></a>
    </div>
</footer>

<!-- Mobile Sticky Bar (Visible only on mobile) -->
<div class="mobile-sticky-bar d-md-none">
    <a href="https://wa.me/905551234567" class="sticky-btn sticky-whatsapp">
        <i class="fab fa-whatsapp me-2"></i> WHATSAPP
    </a>
    <a href="tel:05551234567" class="sticky-btn sticky-call">
        <i class="fas fa-phone-alt me-2 animate-shake"></i> HEMEN ARA
    </a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="<?= BASE_URL ?>public/js/script.js"></script>

<!-- Navbar Scroll Script -->
<script>
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

</body>

</html>