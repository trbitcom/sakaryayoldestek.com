<?php
require_once 'inc/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold"><i class="fas fa-file-alt text-muted me-2"></i>Sayfa Yönetimi</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Sayfa Başlığı</th>
                        <th>URL (Slug)</th>
                        <th>Son Güncelleme</th>
                        <th class="text-end pe-4">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM pages ORDER BY id ASC");
                    while ($row = $stmt->fetch()):
                        ?>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                <?= htmlspecialchars($row['title']) ?>
                            </td>
                            <td><span class="badge bg-secondary">
                                    <?= htmlspecialchars($row['slug']) ?>
                                </span></td>
                            <td class="text-muted small">
                                <?= date('d.m.Y H:i', strtotime($row['updated_at'])) ?>
                            </td>
                            <td class="text-end pe-4">
                                <a href="page_edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary fw-bold">
                                    <i class="fas fa-edit me-1"></i> Düzenle
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>