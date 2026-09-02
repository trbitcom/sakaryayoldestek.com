<?php
require_once 'inc/header.php';

if (isset($_GET['read'])) {
    $id = (int) $_GET['read'];
    $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    header("Location: messages.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$id]);
    header("Location: messages.php?success=deleted");
    exit;
}

$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold"><i class="fas fa-envelope text-muted me-2"></i>İletişim Mesajları</h2>
</div>

<?php if (count($messages) === 0): ?>
    <div class="alert alert-warning">Henüz mesaj gelmemiş.</div>
<?php endif; ?>

<div class="row g-3">
    <?php foreach ($messages as $msg): ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 <?= $msg['is_read'] ? '' : 'border-start border-4 border-warning' ?>">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                        <div>
                            <h3 class="h6 fw-bold mb-1">
                                <?= htmlspecialchars($msg['name']) ?>
                                <?php if (!$msg['is_read']): ?>
                                    <span class="badge bg-warning text-dark ms-2">Yeni</span>
                                <?php endif; ?>
                            </h3>
                            <p class="mb-1"><i class="fas fa-phone-alt text-muted me-2"></i><a
                                    href="tel:<?= htmlspecialchars($msg['phone']) ?>"><?= htmlspecialchars($msg['phone']) ?></a>
                            </p>
                            <?php if (!empty($msg['message'])): ?>
                                <p class="text-muted mb-1"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                            <?php endif; ?>
                            <p class="text-muted small mb-0"><?= date('d.m.Y H:i', strtotime($msg['created_at'])) ?></p>
                        </div>
                        <div class="d-flex gap-2">
                            <?php if (!$msg['is_read']): ?>
                                <a href="?read=<?= $msg['id'] ?>" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-check"></i> Okundu
                                </a>
                            <?php endif; ?>
                            <a href="?delete=<?= $msg['id'] ?>" class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Silmek istediğine emin misin?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once 'inc/footer.php'; ?>
