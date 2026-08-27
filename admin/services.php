<?php
require_once 'inc/header.php';

// Silme İşlemi
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM services WHERE id = :id");
    $stmt->execute(['id' => $id]);
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> Hizmet başarıyla silindi.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
}
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 border-bottom pb-3">
    <h2 class="h3 m-0 text-primary fw-bold"><i class="fas fa-concierge-bell text-muted me-2"></i>Hizmetlerimiz</h2>
    <a href="service-add.php" class="btn btn-primary mt-3 mt-md-0 shadow-sm rounded-pill fw-bold px-4">
        <i class="fas fa-plus-circle me-2"></i> Yeni Hizmet Ekle
    </a>
</div>

<div class="card shadow border-0 rounded-3 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0 align-middle">
                <thead class="bg-primary text-white">
                    <tr>
                        <th width="60" class="ps-3">#</th>
                        <th>İkon</th>
                        <th>Hizmet Adı</th>
                        <th>URL (Slug)</th>
                        <th>Durum</th>
                        <th width="150" class="text-end pe-3">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->query("SELECT * FROM services ORDER BY sort_order ASC, id ASC");
                    while ($row = $stmt->fetch()):
                        ?>
                        <tr>
                            <td class="ps-3 text-muted"><?= $row['id'] ?></td>
                            <td><i class="fas <?= htmlspecialchars($row['icon'] ?: 'fa-truck-pickup') ?> text-warning fa-lg"></i></td>
                            <td class="fw-bold text-dark"><?= htmlspecialchars($row['name']) ?></td>
                            <td>
                                <a href="../<?= $row['slug'] ?>" target="_blank"
                                    class="badge bg-light text-primary text-decoration-none border border-primary">
                                    <i class="fas fa-external-link-alt small me-1"></i>/<?= $row['slug'] ?>
                                </a>
                            </td>
                            <td>
                                <?php if ($row['is_active']): ?>
                                    <span class="badge bg-success rounded-pill px-3 py-2"><i
                                            class="fas fa-check-circle me-1"></i> Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill px-3 py-2"><i
                                            class="fas fa-pause-circle me-1"></i> Pasif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end pe-3">
                                <a href="service-add.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning mx-1"
                                    title="Düzenle">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete('services.php?delete=<?= $row['id'] ?>')"
                                    class="btn btn-sm btn-outline-danger mx-1" title="Sil">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>
