<?php
require_once 'inc/header.php';

// Değişkenleri tanımla
$id = 0;
$name = '';
$slug = '';
$icon = 'fa-truck-pickup';
$meta_title = '';
$meta_desc = '';
$short_desc = '';
$content_text = '';
$is_active = 1;
$sort_order = 0;
$btnText = "Kaydet";
$headerText = "Yeni Hizmet Ekle";

$iconOptions = [
    'fa-truck-pickup' => 'Çekici',
    'fa-tools' => 'Yol Yardım',
    'fa-car-battery' => 'Akü',
    'fa-car' => 'Araç Taşıma',
    'fa-motorcycle' => 'Motosiklet',
    'fa-truck-moving' => 'Ağır Vasıta',
];

// DÜZENLEME MODU
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

    if ($row) {
        $name = $row['name'];
        $slug = $row['slug'];
        $icon = $row['icon'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $short_desc = $row['short_desc'];
        $content_text = $row['content_text'];
        $is_active = $row['is_active'];
        $sort_order = $row['sort_order'];
        $btnText = "Güncelle";
        $headerText = "Hizmeti Düzenle: " . htmlspecialchars($name);
    }
}

// FORM GÖNDERİLDİĞİNDE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $icon = trim($_POST['icon'] ?? 'fa-truck-pickup');
    $meta_title = trim($_POST['meta_title']);
    $meta_desc = trim($_POST['meta_desc']);
    $short_desc = trim($_POST['short_desc']);
    $content_text = $_POST['content_text']; // HTML içerdiği için trim yapmıyoruz
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    $sort_order = (int) trim($_POST['sort_order'] ?? 0);

    $slugInput = trim($_POST['slug']);
    if (empty($slugInput)) {
        $slug = permalink($name);
    } else {
        $slug = permalink($slugInput);
    }

    if (empty($name)) {
        $error = "Lütfen hizmet adını girin.";
    } else {
        if ($id > 0) {
            $sql = "UPDATE services SET name=?, slug=?, icon=?, meta_title=?, meta_desc=?, short_desc=?, content_text=?, is_active=?, sort_order=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $icon, $meta_title, $meta_desc, $short_desc, $content_text, $is_active, $sort_order, $id]);
        } else {
            $sql = "INSERT INTO services (name, slug, icon, meta_title, meta_desc, short_desc, content_text, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $icon, $meta_title, $meta_desc, $short_desc, $content_text, $is_active, $sort_order]);
        }

        echo '<script>window.location.href = "services.php";</script>';
        exit;
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><?= $headerText ?></h4>
            </div>
            <div class="card-body">

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Hizmet Adı</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required placeholder="Örn: Akü Takviye Hizmeti">
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">URL (Slug) - <small class="text-muted">Boş bırakırsan otomatik oluşur</small></label>
                            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($slug) ?>" placeholder="aku-takviye">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">İkon</label>
                            <select name="icon" class="form-select">
                                <?php foreach ($iconOptions as $val => $label): ?>
                                    <option value="<?= $val ?>" <?= $icon === $val ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="card bg-light mb-3 border-0">
                        <div class="card-body">
                            <h6 class="text-primary fw-bold"><i class="fas fa-search"></i> Google Görünümü (SEO)</h6>
                            <div class="mb-2">
                                <label class="form-label">Sayfa Başlığı (Title)</label>
                                <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($meta_title) ?>" placeholder="Örn: Sakarya Akü Takviye Hizmeti - 7/24">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Açıklama (Description)</label>
                                <textarea name="meta_desc" class="form-control" rows="2" placeholder="Google'da çıkacak kısa açıklama..."><?= htmlspecialchars($meta_desc) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kısa Açıklama <small class="text-muted">(anasayfa kartında görünür)</small></label>
                        <input type="text" name="short_desc" class="form-control" value="<?= htmlspecialchars($short_desc) ?>" placeholder="Anasayfa hizmet kartında görünecek kısa metin">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sayfa İçeriği</label>
                        <textarea name="content_text" class="form-control" rows="10" placeholder="Hizmetle ilgili detaylı içerik... HTML kullanabilirsiniz."><?= $content_text ?></textarea>
                        <div class="form-text">Buraya &lt;h2&gt;, &lt;p&gt; gibi HTML etiketleri yazabilirsiniz.</div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Sıralama <small class="text-muted">(küçük sayı önce gösterilir)</small></label>
                            <input type="number" name="sort_order" class="form-control" value="<?= htmlspecialchars($sort_order) ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="is_active" id="activeCheck" <?= $is_active ? 'checked' : '' ?>>
                                <label class="form-check-label" for="activeCheck">Bu hizmet yayında olsun mu?</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg fw-bold"><?= $btnText ?></button>
                        <a href="services.php" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>
