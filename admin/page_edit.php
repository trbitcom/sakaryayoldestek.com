<?php
require_once 'inc/header.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
$page = $stmt->fetch();

if (!$page) {
    echo '<div class="alert alert-danger">Sayfa bulunamadı!</div>';
    require_once 'inc/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    $stmt = $pdo->prepare("UPDATE pages SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header("Location: pages.php?success=updated");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold">Sayfa Düzenle: <span class="text-dark">
            <?= htmlspecialchars($page['title']) ?>
        </span></h2>
    <a href="pages.php" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Geri Dön</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold">Sayfa Başlığı</label>
                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($page['title']) ?>"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">İçerik</label>
                <textarea name="content" class="form-control" rows="15"
                    required><?= htmlspecialchars($page['content']) ?></textarea>
                <small class="text-muted">HTML etiketleri kullanabilirsiniz.</small>
            </div>

            <button type="submit" class="btn btn-success fw-bold px-4"><i class="fas fa-save me-2"></i>Kaydet</button>
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>