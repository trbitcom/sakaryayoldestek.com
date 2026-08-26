<?php require_once 'inc/header.php'; ?>

<div class="row">
    <div class="col-md-12 mb-4">
        <h2>Hoşgeldiniz</h2>
        <p class="lead">Sitenizin içeriklerini buradan yönetebilirsiniz.</p>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Toplam Bölge/Sayfa</div>
            <div class="card-body">
                <?php 
                $count = $pdo->query("SELECT COUNT(*) FROM locations")->fetchColumn(); 
                ?>
                <h1 class="card-title display-4"><?= $count ?></h1>
                <p class="card-text">Adet aktif hizmet sayfası var.</p>
                <a href="locations.php" class="btn btn-light btn-sm text-primary fw-bold">Yönet</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Hızlı İşlemler</div>
            <div class="card-body">
                <a href="location-add.php" class="btn btn-light w-100 mb-2">Yeni İlçe/Bölge Ekle</a>
                <a href="../" target="_blank" class="btn btn-outline-light w-100">Siteyi Ziyaret Et</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>