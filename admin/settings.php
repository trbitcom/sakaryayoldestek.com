<?php
require_once 'inc/header.php';

// Ayarları Çek
$stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
$settings = $stmt->fetch();

// Form Gönderildi mi?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // 1. Genel Ayarlar
    if (isset($_POST['update_general'])) {
        $site_title = trim($_POST['site_title']);
        $site_url = trim($_POST['site_url']);
        $phone = trim($_POST['phone']);
        $whatsapp = trim($_POST['whatsapp']);

        $stat_happy = trim($_POST['stat_happy'] ?? 0);
        $stat_towed = trim($_POST['stat_towed'] ?? 0);
        $stat_years = trim($_POST['stat_years'] ?? 0);
        $stat_team  = trim($_POST['stat_team'] ?? 0);

        $about_title = trim($_POST['about_title'] ?? '');
        $about_desc  = trim($_POST['about_desc'] ?? '');
        $about_exp_years = trim($_POST['about_exp_years'] ?? '');

        // About Image Upload
        $aboutImagePath = $settings['about_image'];
        if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower(pathinfo($_FILES['about_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $newName = 'about.' . $ext;
                move_uploaded_file($_FILES['about_image']['tmp_name'], '../public/img/' . $newName);
                $aboutImagePath = $newName;
            }
        }

        // Logo Yükleme
        $logoPath = $settings['logo'];
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
            $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $newName = 'logo.' . $ext;
                move_uploaded_file($_FILES['logo']['tmp_name'], '../public/img/' . $newName);
                $logoPath = $newName;
            }
        }

        // Favicon Yükleme
        $faviconPath = $settings['favicon'];
        if (isset($_FILES['favicon']) && $_FILES['favicon']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION));
            if ($ext == 'ico' || $ext == 'png') {
                $newName = 'favicon.' . $ext;
                move_uploaded_file($_FILES['favicon']['tmp_name'], '../public/img/' . $newName);
                $faviconPath = $newName;
            }
        }

        // Hero Video Yükle (Sabit İsim: hero-video.mp4)
        if (isset($_FILES['hero_video']) && $_FILES['hero_video']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['hero_video']['name'], PATHINFO_EXTENSION));
            if ($ext == 'mp4') {
                move_uploaded_file($_FILES['hero_video']['tmp_name'], '../public/img/hero-video.mp4');
            }
        }

        $stmt = $pdo->prepare("UPDATE settings SET site_title=?, site_url=?, phone=?, whatsapp=?, logo=?, favicon=?, stat_happy=?, stat_towed=?, stat_years=?, stat_team=?, about_title=?, about_desc=?, about_image=?, about_exp_years=? WHERE id=1");
        $stmt->execute([$site_title, $site_url, $phone, $whatsapp, $logoPath, $faviconPath, $stat_happy, $stat_towed, $stat_years, $stat_team, $about_title, $about_desc, $aboutImagePath, $about_exp_years]);

        echo '<div class="alert alert-success">Genel ayarlar güncellendi!</div>';

        // Yenile (Değişkenlerin güncel kalması için)
        header("Refresh:1");
    }

    // 2. Entegrasyonlar
    if (isset($_POST['update_integrations'])) {
        $ga_code = $_POST['google_analytics'];
        $maps_code = $_POST['google_maps'];

        $stmt = $pdo->prepare("UPDATE settings SET google_analytics=?, google_maps=? WHERE id=1");
        $stmt->execute([$ga_code, $maps_code]);

        echo '<div class="alert alert-success">Entegrasyon ayarları güncellendi!</div>';
        header("Refresh:1");
    }

    // 3. SEO Araçları - Robots.txt
    if (isset($_POST['update_robots'])) {
        $content = $_POST['robots_txt'];
        file_put_contents('../robots.txt', $content);
        echo '<div class="alert alert-success">robots.txt dosyası güncellendi!</div>';
    }

    // 3. SEO Araçları - Sitemap
    if (isset($_POST['generate_sitemap'])) {
        $url = rtrim($settings['site_url'], '/');

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

        // Anasayfa
        $url_home = $xml->addChild('url');
        $url_home->addChild('loc', $url . '/');
        $url_home->addChild('changefreq', 'daily');
        $url_home->addChild('priority', '1.0');

        // Bölgeler
        $stmt = $pdo->query("SELECT slug FROM locations WHERE is_active=1");
        while ($row = $stmt->fetch()) {
            $url_loc = $xml->addChild('url');
            $url_loc->addChild('loc', $url . '/' . $row['slug']);
            $url_loc->addChild('changefreq', 'weekly');
            $url_loc->addChild('priority', '0.8');
        }

        // Tüm Bölgeler Listesi
        $url_bolgeler = $xml->addChild('url');
        $url_bolgeler->addChild('loc', $url . '/bolgeler');
        $url_bolgeler->addChild('changefreq', 'weekly');
        $url_bolgeler->addChild('priority', '0.6');

        // Genel Sayfalar
        $stmtPages = $pdo->query("SELECT slug FROM pages");
        while ($row = $stmtPages->fetch()) {
            $url_page = $xml->addChild('url');
            $url_page->addChild('loc', $url . '/' . $row['slug']);
            $url_page->addChild('changefreq', 'monthly');
            $url_page->addChild('priority', '0.4');
        }

        $xml->asXML('../sitemap.xml');
        echo '<div class="alert alert-success">Sitemap.xml başarıyla oluşturuldu!</div>';
    }
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold"><i class="fas fa-cog text-muted me-2"></i>Site Ayarları</h2>
</div>

<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-white">
        <ul class="nav nav-tabs card-header-tabs" id="settingsTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-bold" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                    type="button"><i class="fas fa-sliders-h me-2"></i>Genel</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" id="integration-tab" data-bs-toggle="tab" data-bs-target="#integration"
                    type="button"><i class="fas fa-code me-2"></i>Entegrasyon</button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo"
                    type="button"><i class="fas fa-search me-2"></i>SEO Araçları</button>
            </li>
        </ul>
    </div>
    <div class="card-body p-4">
        <div class="tab-content" id="settingsTabContent">

            <!-- Genel Ayarlar -->
            <div class="tab-pane fade show active" id="general">
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Site Başlığı</label>
                            <input type="text" name="site_title" class="form-control"
                                value="<?= htmlspecialchars($settings['site_title'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Site URL (Sonunda / olmadan)</label>
                            <input type="text" name="site_url" class="form-control"
                                value="<?= htmlspecialchars($settings['site_url'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Telefon</label>
                            <input type="text" name="phone" class="form-control"
                                value="<?= htmlspecialchars($settings['phone'] ?? '') ?>">
                        </div>
                        <label class="form-label fw-bold">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control"
                            value="<?= htmlspecialchars($settings['whatsapp'] ?? '') ?>">
                    </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bold">Mutlu Müşteri</label>
                    <input type="number" name="stat_happy" class="form-control"
                        value="<?= htmlspecialchars($settings['stat_happy'] ?? '0') ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bold">Çekilen Araç</label>
                    <input type="number" name="stat_towed" class="form-control"
                        value="<?= htmlspecialchars($settings['stat_towed'] ?? '0') ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bold">Yıllık Tecrübe</label>
                    <input type="number" name="stat_years" class="form-control"
                        value="<?= htmlspecialchars($settings['stat_years'] ?? '0') ?>">
                </div>
                <div class="col-md-3 mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">WhatsApp</label>
                        <input type="text" name="whatsapp" class="form-control"
                            value="<?= htmlspecialchars($settings['whatsapp'] ?? '') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Mutlu Müşteri</label>
                        <input type="number" name="stat_happy" class="form-control"
                            value="<?= htmlspecialchars($settings['stat_happy'] ?? '0') ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Çekilen Araç</label>
                        <input type="number" name="stat_towed" class="form-control"
                            value="<?= htmlspecialchars($settings['stat_towed'] ?? '0') ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Yıllık Tecrübe</label>
                        <input type="number" name="stat_years" class="form-control"
                            value="<?= htmlspecialchars($settings['stat_years'] ?? '0') ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Uzman Personel</label>
                        <input type="number" name="stat_team" class="form-control"
                            value="<?= htmlspecialchars($settings['stat_team'] ?? '0') ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5 class="border-bottom pb-2">Hakkımızda Bölümü</h5>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Başlık</label>
                        <input type="text" name="about_title" class="form-control"
                            value="<?= htmlspecialchars($settings['about_title'] ?? '') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Yıllık Tecrübe (Sayı)</label>
                        <input type="text" name="about_exp_years" class="form-control"
                            value="<?= htmlspecialchars($settings['about_exp_years'] ?? '15') ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Açıklama</label>
                        <textarea name="about_desc" class="form-control"
                            rows="4"><?= htmlspecialchars($settings['about_desc'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Hakkımızda Görseli</label>
                        <input type="file" name="about_image" class="form-control">
                        <?php if (!empty($settings['about_image'])): ?>
                            <small>Mevcut: <a href="../public/img/<?= $settings['about_image'] ?>"
                                    target="_blank"><?= $settings['about_image'] ?></a></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Logo Yükle</label>
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted d-block mt-1">Önerilen Boyut: <b>250x60 px</b> (PNG veya
                            SVG)</small>
                        <?php if (!empty($settings['logo'])): ?>
                            <small>Mevcut: <a href="../public/img/<?= $settings['logo'] ?>" target="_blank">
                                    <?= $settings['logo'] ?>
                                </a></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Favicon Yükle (.ico/.png)</label>
                        <input type="file" name="favicon" class="form-control">
                        <?php if (!empty($settings['favicon'])): ?>
                            <small>Mevcut: <a href="../public/img/<?= $settings['favicon'] ?>" target="_blank">
                                    <?= $settings['favicon'] ?>
                                </a></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Hero Video (.mp4)</label>
                        <input type="file" name="hero_video" class="form-control">
                        <small class="text-muted">Anasayfa arka plan videosu. Sadece MP4 formatı.</small>
                        <?php if (file_exists('../public/img/hero-video.mp4')): ?>
                            <div class="mt-2">
                                <small>Mevcut Video:</small>
                                <a href="../public/img/hero-video.mp4" target="_blank"
                                    class="badge bg-info text-decoration-none">Videoyu İzle</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <button type="submit" name="update_general" class="btn btn-success fw-bold"><i
                        class="fas fa-save me-2"></i>Kaydet</button>
                </form>
            </div>

            <!-- Entegrasyon -->
            <div class="tab-pane fade" id="integration">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Google Analytics / Tag Manager Kodu</label>
                        <textarea name="google_analytics" class="form-control font-monospace"
                            rows="5"><?= htmlspecialchars($settings['google_analytics'] ?? '') ?></textarea>
                        <small class="text-muted">Head etiketleri arasına basılacak kodlar.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Google Maps Embed Kodu</label>
                        <textarea name="google_maps" class="form-control font-monospace"
                            rows="4"><?= htmlspecialchars($settings['google_maps'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" name="update_integrations" class="btn btn-success fw-bold"><i
                            class="fas fa-save me-2"></i>Kaydet</button>
                </form>
            </div>

            <!-- SEO Araçları -->
            <div class="tab-pane fade" id="seo">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Robots.txt Düzenle</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <textarea name="robots_txt" class="form-control font-monospace"
                                    rows="8"><?= file_exists('../robots.txt') ? file_get_contents('../robots.txt') : "User-agent: *\nAllow: /" ?></textarea>
                            </div>
                            <button type="submit" name="update_robots" class="btn btn-primary fw-bold w-100"><i
                                    class="fas fa-file-code me-2"></i>Dosyayı Güncelle</button>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Sitemap Oluşturucu</h5>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Bu işlem veritabanındaki tüm aktif sayfaları tarayarak güncel bir
                            <strong>sitemap.xml</strong> dosyası oluşturur.
                        </div>
                        <form method="POST">
                            <button type="submit" name="generate_sitemap"
                                class="btn btn-warning w-100 py-3 fw-bold text-dark">
                                <i class="fas fa-sitemap fa-2x d-block mb-2"></i>
                                SITEMAP.XML OLUŞTUR
                            </button>
                        </form>

                        <?php if (file_exists('../sitemap.xml')): ?>
                            <div class="mt-3 text-center">
                                <a href="../sitemap.xml" target="_blank" class="btn btn-link fw-bold">Sitemap'i Görüntüle <i
                                        class="fas fa-external-link-alt"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>