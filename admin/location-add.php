<?php
require_once 'inc/header.php';

// Değişkenleri tanımla (Hata almamak için boş tanımlıyoruz)
$id = 0;
$name = '';
$slug = '';
$meta_title = '';
$meta_desc = '';
$content_text = '';
$is_active = 1;
$btnText = "Kaydet";
$headerText = "Yeni Bölge Ekle";

// DÜZENLEME MODU: Eğer URL'de ID varsa verileri çek
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM locations WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $row = $stmt->fetch();

    if ($row) {
        $name = $row['name'];
        $slug = $row['slug'];
        $meta_title = $row['meta_title'];
        $meta_desc = $row['meta_desc'];
        $content_text = $row['content_text'];
        $is_active = $row['is_active'];
        $btnText = "Güncelle";
        $headerText = "Bölgeyi Düzenle: " . htmlspecialchars($name);
    }
}

// FORM GÖNDERİLDİĞİNDE (POST İŞLEMİ)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $meta_title = trim($_POST['meta_title']);
    $meta_desc = trim($_POST['meta_desc']);
    $content_text = $_POST['content_text']; // HTML içerdiği için trim yapmıyoruz
    $is_active = isset($_POST['is_active']) ? 1 : 0;
    
    // Slug (URL) Belirleme
    // Eğer kullanıcı slug girmediyse başlıktan üret, girdiyse onu temizle
    $slugInput = trim($_POST['slug']);
    if (empty($slugInput)) {
        $slug = permalink($name);
    } else {
        $slug = permalink($slugInput);
    }

    if (empty($name)) {
        $error = "Lütfen bölge adını girin.";
    } else {
        if ($id > 0) {
            // GÜNCELLEME İŞLEMİ
            $sql = "UPDATE locations SET name=?, slug=?, meta_title=?, meta_desc=?, content_text=?, is_active=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $meta_title, $meta_desc, $content_text, $is_active, $id]);
        } else {
            // YENİ EKLEME İŞLEMİ
            $sql = "INSERT INTO locations (name, slug, meta_title, meta_desc, content_text, is_active) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $slug, $meta_title, $meta_desc, $content_text, $is_active]);
        }
        
        // İşlem bitince listeye dön
        echo '<script>window.location.href = "locations.php";</script>';
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
                
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Bölge Adı (İl/İlçe)</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required placeholder="Örn: Karasu">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">URL (Slug) - <small class="text-muted">Boş bırakırsan otomatik oluşur</small></label>
                        <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($slug) ?>" placeholder="karasu-oto-cekici">
                    </div>

                    <div class="card bg-light mb-3 border-0">
                        <div class="card-body">
                            <h6 class="text-primary fw-bold"><i class="fas fa-search"></i> Google Görünümü (SEO)</h6>
                            <div class="mb-2">
                                <label class="form-label">Sayfa Başlığı (Title)</label>
                                <input type="text" name="meta_title" class="form-control" value="<?= htmlspecialchars($meta_title) ?>" placeholder="Örn: Karasu Oto Çekici - En Yakın 7/24 Yol Yardım">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Açıklama (Description)</label>
                                <textarea name="meta_desc" class="form-control" rows="2" placeholder="Google'da çıkacak kısa açıklama..."><?= htmlspecialchars($meta_desc) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Sayfa İçeriği</label>
                        <textarea name="content_text" class="form-control" rows="10" placeholder="Bölge ile ilgili yazılar, makaleler... HTML kullanabilirsiniz."><?= $content_text ?></textarea>
                        <div class="form-text">Buraya &lt;h2&gt;, &lt;p&gt; gibi HTML etiketleri yazabilirsiniz.</div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="is_active" id="activeCheck" <?= $is_active ? 'checked' : '' ?>>
                        <label class="form-check-label" for="activeCheck">Bu sayfa yayında olsun mu?</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg fw-bold"><?= $btnText ?></button>
                        <a href="locations.php" class="btn btn-secondary">İptal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>