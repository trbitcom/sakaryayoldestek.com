<?php
require_once 'inc/header.php';

// Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("SELECT image FROM `references` WHERE id = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetchColumn();

    if ($img) {
        if (file_exists('../public/img/references/' . $img)) {
            unlink('../public/img/references/' . $img);
        }
        $pdo->prepare("DELETE FROM `references` WHERE id = ?")->execute([$id]);
        header("Location: references.php?success=deleted");
        exit;
    }
}

// Yükleme İşlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['ref_image'])) {
    $uploadDir = '../public/img/references/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['ref_image']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['ref_image']['error'][$key] == 0) {
            $ext = strtolower(pathinfo($_FILES['ref_image']['name'][$key], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($ext, $allowed)) {
                $newName = uniqid() . '.' . $ext;
                if (move_uploaded_file($tmp_name, $uploadDir . $newName)) {
                    $stmt = $pdo->prepare("INSERT INTO `references` (image) VALUES (?)");
                    $stmt->execute([$newName]);
                }
            }
        }
    }
    header("Location: references.php?success=uploaded");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold"><i class="fas fa-handshake text-muted me-2"></i>Referans Yönetimi</h2>
</div>

<!-- Upload Form -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" class="row align-items-end">
            <div class="col-md-9">
                <label class="form-label fw-bold">Yeni Referans Logosu Ekle</label>
                <input type="file" name="ref_image[]" class="form-control" multiple required>
                <small class="text-muted">Birden fazla dosya seçebilirsiniz. PNG veya JPG formatı önerilir.</small>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-success fw-bold w-100"><i
                        class="fas fa-upload me-2"></i>Yükle</button>
            </div>
        </form>
    </div>
</div>

<!-- References Grid -->
<div class="row g-4">
    <?php
    $stmt = $pdo->query("SELECT * FROM `references` ORDER BY id DESC");
    $refs = $stmt->fetchAll();

    if (count($refs) == 0) {
        echo '<div class="col-12"><div class="alert alert-warning">Henüz referans eklenmemiş.</div></div>';
    }

    foreach ($refs as $ref):
        ?>
        <div class="col-6 col-md-3 col-lg-2">
            <div class="card h-100 shadow-sm border-0 position-relative group-action">
                <div class="card-body d-flex align-items-center justify-content-center p-2"
                    style="background: #f8f9fa; height: 120px;">
                    <img src="../public/img/references/<?= htmlspecialchars($ref['image']) ?>" class="img-fluid"
                        style="max-height: 100%; max-width: 100%; filter: grayscale(100%); transition: 0.3s;">
                </div>
                <a href="?delete=<?= $ref['id'] ?>"
                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 rounded-circle"
                    onclick="return confirm('Silmek istediğine emin misin?')"
                    style="width: 30px; height: 30px; padding: 0; line-height: 30px;">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'inc/footer.php'; ?>