<!-- Mini Header -->
<div class="position-relative bg-secondary text-white overflow-hidden"
    style="min-height: 300px; padding-top: 120px; padding-bottom: 3rem;">
    <div class="position-absolute top-0 start-0 w-100 h-100"
        style="background: linear-gradient(135deg, rgba(26,26,29,0.95), rgba(26,26,29,0.8)); z-index: 1;"></div>
    <!-- Decorative Circle -->
    <div class="position-absolute top-50 start-50 translate-middle rounded-circle bg-warning opacity-10"
        style="width: min(500px, 80vw); height: min(500px, 80vw); filter: blur(100px); z-index: 0;"></div>

    <div class="container position-relative h-100 d-flex flex-column justify-content-center" style="z-index: 2;">
        <h1 class="display-4 fw-bold mb-0 text-warning text-center"><?= htmlspecialchars($page['title']) ?></h1>
    </div>
</div>

<?php renderBreadcrumb([
    ['label' => $page['title']],
]); ?>

<!-- Content -->
<main class="py-5 bg-light" style="min-height: 60vh;">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-5 bg-white">
                        <div class="page-content text-dark fs-5" style="line-height: 1.8; font-weight: 300;">
                            <?php
                            // If content is empty
                            if (empty($page['content'])) {
                                echo '<div class="alert alert-info border-0 shadow-sm"><i class="fas fa-info-circle me-2"></i>Bu sayfa için henüz içerik eklenmemiştir.</div>';
                            } else {
                                echo nl2br($page['content']);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Page Specific Styles */
    .page-content h2,
    .page-content h3 {
        color: var(--secondary-color);
        font-weight: 700;
        margin-top: 1.5rem;
        margin-bottom: 1rem;
    }

    .page-content ul {
        list-style-type: none;
        padding-left: 0;
    }

    .page-content ul li {
        padding-left: 1.5rem;
        position: relative;
        margin-bottom: 0.5rem;
    }

    .page-content ul li::before {
        content: '\f058';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        color: var(--primary-color);
        position: absolute;
        left: 0;
        top: 3px;
        font-size: 0.9em;
    }
</style>