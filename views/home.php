<!-- Hero Section -->
<header class="hero-section position-relative overflow-hidden" style="height: 100vh;">
    <video autoplay muted loop playsinline class="position-absolute w-100 h-100 object-fit-cover"
        style="top: 0; left: 0; z-index: 0;">
        <source src="<?= BASE_URL ?>public/img/hero-video.mp4" type="video/mp4">
    </video>
    <div class="hero-overlay position-absolute w-100 h-100" style="background: rgba(0,0,0,0.7); z-index: 1;"></div>

    <div class="container hero-content text-center position-relative h-100 d-flex flex-column justify-content-center align-items-center"
        style="z-index: 2;">
        <h1 class="display-1 fw-bold mb-4 text-white"
            style="font-family: 'Rajdhani', sans-serif; text-shadow: 2px 2px 10px rgba(0,0,0,0.5);">SAKARYA OTO
            ÇEKİCİ<br><span class="text-warning">7/24 YOL YARDIM</span></h1>
        <p class="lead mb-5 text-white fs-3 d-none d-md-block">Sakarya, Kocaeli ve Düzce'de 7/24 Oto Çekici, Yol Yardım ve Oto Kurtarıcı Hizmeti</p>

        <div class="d-flex flex-column flex-md-row gap-3 w-100 justify-content-center px-4">
            <a href="https://wa.me/<?= isset($settings['whatsapp']) ? $settings['whatsapp'] : '905551234567' ?>"
                class="btn btn-success btn-lg hero-cta-btn px-5 py-4 rounded-pill shadow-lg border-2 fw-bold fs-4">
                <i class="fab fa-whatsapp me-2"></i> WHATSAPP KONUM AT
            </a>
            <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
                class="btn btn-danger btn-lg hero-cta-btn px-5 py-4 rounded-pill animate-pulse shadow-lg border-2 fw-bold fs-4">
                <i class="fas fa-phone-alt me-2 animate-shake"></i> HEMEN ARA
            </a>
        </div>
    </div>
</header>

<!-- Trust Badges Section -->
<section class="py-4 bg-dark text-white border-bottom border-warning border-3">
    <div class="container">
        <div class="row text-center g-2 g-md-4">
            <div class="col-4 trust-badge-item d-flex flex-column flex-md-row align-items-center justify-content-center">
                <i class="fas fa-stopwatch trust-badge-icon text-warning mb-2 mb-md-0 me-md-3"></i>
                <div class="text-center text-md-start">
                    <p class="m-0 fw-bold trust-badge-title">15 DAKİKADA VARIŞ</p>
                    <small class="text-muted d-none d-md-block">En Yakın Ekip Yönlendirilir</small>
                </div>
            </div>
            <div
                class="col-4 trust-badge-item d-flex flex-column flex-md-row align-items-center justify-content-center border-start border-end border-secondary">
                <i class="fas fa-shield-alt trust-badge-icon text-warning mb-2 mb-md-0 me-md-3"></i>
                <div class="text-center text-md-start">
                    <p class="m-0 fw-bold trust-badge-title">KASKOLU TAŞIMA</p>
                    <small class="text-muted d-none d-md-block">Aracınız Güvencemiz Altında</small>
                </div>
            </div>
            <div class="col-4 trust-badge-item d-flex flex-column flex-md-row align-items-center justify-content-center">
                <i class="fas fa-lira-sign trust-badge-icon text-warning mb-2 mb-md-0 me-md-3"></i>
                <div class="text-center text-md-start">
                    <p class="m-0 fw-bold trust-badge-title">UYGUN FİYAT</p>
                    <small class="text-muted d-none d-md-block">Sürpriz Ekstra Ücret Yok</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <?php
                    $aboutImg = !empty($settings['about_image']) ? BASE_URL . 'public/img/' . htmlspecialchars($settings['about_image']) : 'https://images.unsplash.com/photo-1615906655593-ad0386982a0f?auto=format&fit=crop&q=80&w=800';
                    ?>
                    <img src="<?= $aboutImg ?>" class="img-fluid rounded-4 shadow-lg" alt="Hakkımızda" width="900" height="675">
                    <div class="position-absolute bottom-0 start-0 bg-warning p-4 rounded-end-4 shadow"
                        style="margin-bottom: -20px;">
                        <span
                            class="display-4 fw-bold text-dark d-block"><?= htmlspecialchars($settings['about_exp_years'] ?? '15') ?></span>
                        <span class="h6 text-uppercase fw-bold text-dark m-0">Yıllık Tecrübe</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <p class="text-warning fw-bold text-uppercase mb-3 tracking-widest" style="font-family: 'Rajdhani', sans-serif;">Hakkımızda</p>
                <h2 class="display-5 fw-bold mb-4">
                    <?= htmlspecialchars($settings['about_title'] ?? 'Güvenilir ve Hızlı Çekici Çözüm Ortağınız') ?>
                </h2>
                <div class="text-muted mb-4" style="white-space: pre-line; line-height: 1.8;">
                    <?= $settings['about_desc'] ?? 'Yolda kaldığınızda endişelenmenize gerek yok. Uzman ekibimiz ve modern araç filomuzla 7/24 yanınızdayız.' ?>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                            <span class="fw-bold">7/24 Kesintisiz Hizmet</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                            <span class="fw-bold">Resmi Belgeli & Kaskolu</span>
                        </div>
                    </div>
                </div>

                <a href="<?= BASE_URL ?>iletisim" class="btn btn-dark rounded-pill px-5 py-3 fw-bold shadow hover-scale">
                    <i class="fas fa-arrow-right me-2"></i> BİZE ULAŞIN
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section id="services" class="py-5" style="background: #f4f6f9;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold text-dark">HİZMETLERİMİZ</h2>
            <div class="width-50 height-4 bg-primary mx-auto mt-3 rounded"></div>
        </div>

        <div class="row g-4">
            <?php
            $stmtSvc = $pdo->query("SELECT name, slug, icon, short_desc FROM services WHERE is_active = 1 ORDER BY sort_order ASC");
            while ($svc = $stmtSvc->fetch()):
                ?>
                <div class="col-md-4">
                    <a href="<?= BASE_URL . $svc['slug'] ?>" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-up"
                            style="border-radius: 15px; transition: 0.3s; background: white;">
                            <div class="card-body p-4 text-center">
                                <div class="d-inline-block p-3 rounded-circle bg-light mb-3 text-warning">
                                    <i class="fas <?= htmlspecialchars($svc['icon'] ?: 'fa-truck-pickup') ?> fa-2x"></i>
                                </div>
                                <h3 class="h4 fw-bold mb-3 text-dark"><?= htmlspecialchars($svc['name']) ?></h3>
                                <p class="text-muted"><?= htmlspecialchars($svc['short_desc']) ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- References Section (Marquee) -->
<section class="py-5 bg-white border-bottom">
    <div class="container overflow-hidden">
        <h2 class="text-center mb-5 fw-bold text-dark">REFERANSLARIMIZ</h2>
        <div class="marquee-wrapper" style="overflow: hidden; white-space: nowrap; position: relative;">
            <div class="marquee-content d-inline-block" style="animation: scroll 20s linear infinite;">
                <?php
                // Logoları çek ve 3 kez tekrarla (Sonsuz döngü görüntüsü için)
                $stmtRef = $pdo->query("SELECT image FROM `references` ORDER BY id DESC");
                $refs = $stmtRef->fetchAll();
                if (count($refs) > 0) {
                    for ($i = 0; $i < 4; $i++) {
                        foreach ($refs as $ref): ?>
                            <div class="d-inline-block mx-4 align-middle">
                                <img src="<?= BASE_URL ?>public/img/references/<?= htmlspecialchars($ref['image']) ?>"
                                    alt="Referans firma logosu" width="160" height="80"
                                    style="height: 80px; width: auto; filter: grayscale(100%); opacity: 0.7; transition: 0.3s;"
                                    class="ref-logo"
                                    onmouseover="this.style.filter='none'; this.style.opacity='1'; this.style.transform='scale(1.1)'"
                                    onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.7'; this.style.transform='scale(1)'">
                            </div>
                        <?php endforeach;
                    }
                } else {
                    echo '<div class="text-center text-muted">Henüz referans eklenmemiş.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes scroll {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .ref-logo {
        cursor: pointer;
    }

    .marquee-wrapper:hover .marquee-content {
        animation-play-state: paused;
    }
</style>

<!-- Locations Section (Modern) -->
<section id="locations" class="py-5" style="background: linear-gradient(to bottom, #ffffff, #f8f9fa);">
    <div class="container py-4">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill mb-3">7/24 AKTİF BÖLGELER</span>
                <h2 class="fw-bold display-6 mb-3">HİZMET BÖLGELERİMİZ</h2>
                <div class="width-50 height-4 bg-dark mx-auto rounded"></div>
            </div>
        </div>

        <div class="row g-3">
            <?php
            $stmt = $pdo->query("SELECT name, slug FROM locations WHERE is_active = 1 LIMIT 12");
            while ($row = $stmt->fetch()):
                ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="<?= BASE_URL . $row['slug'] ?>" class="text-decoration-none">
                        <div class="card h-100 border-0 shadow-sm hover-up-lg text-center p-3"
                            style="transition: all 0.3s ease; background: white; border-bottom: 3px solid transparent;">
                            <div class="card-body p-2">
                                <div class="mb-3 d-inline-block p-2 rounded-circle bg-light text-danger">
                                    <i class="fas fa-map-marker-alt fa-lg"></i>
                                </div>
                                <h3 class="card-title text-dark fw-bold m-0 fs-6"><?= htmlspecialchars($row['name']) ?></h3>
                                <small class="text-muted text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">OTO
                                    ÇEKİCİ</small>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= BASE_URL ?>bolgeler"
                class="btn btn-outline-dark rounded-pill px-5 py-3 fw-bold shadow-sm hover-scale">
                <i class="fas fa-map-marked-alt me-2"></i> TÜM BÖLGELERİ GÖR
            </a>
        </div>
    </div>
</section>

<style>
    .hover-up-lg:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        border-bottom: 3px solid var(--bs-warning) !important;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>

<!-- Bilgilendirici İçerik Bloğu -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h2 class="fw-bold mb-4">Sakarya Oto Çekici ve Yol Yardım Hizmeti Hakkında Bilmeniz Gerekenler</h2>
                <div class="text-muted" style="line-height: 1.9; font-size: 1.05rem;">

                    <h3 class="h5 fw-bold mt-4 mb-2">Hangi Durumlarda Çekici Çağırmalısınız?</h3>
                    <p>Aracınız trafik ortasında, otoyolda veya park halindeyken hareket edemez duruma geldiğinde
                        çekici hizmetine ihtiyaç duyarsınız. En sık karşılaşılan durumlar arasında motor arızası,
                        şanzıman sorunu, kaza sonrası hasar, lastik patlaması sonrası stepnesi olmayan araçlar,
                        yakıt bitmesi (özellikle dizel araçlarda hava alması durumunda) ve elektrik/elektronik
                        arızalar yer alır. Bu durumların bazılarında (akü, lastik, yakıt) yerinde müdahale
                        yeterli olabilirken, aracın sürüşe uygun olmadığı ciddi arıza ve kazalarda çekici
                        şarttır.</p>

                    <h3 class="h5 fw-bold mt-4 mb-2">Hangi Araç Tiplerine Hizmet Veriyoruz?</h3>
                    <p>Binek otomobiller ve SUV'lardan hafif ticari araçlara, motosikletlerden ağır vasıtalara
                        (kamyon, tır, otobüs, iş makinesi) kadar geniş bir araç yelpazesine hizmet veriyoruz.
                        Elektrikli ve hibrit araçlar için özel platformlu taşıma, sıfır km araçlar için ise
                        bayiden adrese sigortalı nakliye imkanı sunuyoruz. Her araç tipi farklı ekipman ve
                        deneyim gerektirdiği için filomuzu bu çeşitliliğe göre donattık.</p>

                    <h3 class="h5 fw-bold mt-4 mb-2">Otoyolda Araç Arızalandığında Ne Yapmalısınız?</h3>
                    <p>Aracınız E-5, TEM veya Kuzey Marmara Otoyolu gibi bir güzergâhta arızalanırsa, önce
                        aracı mümkünse banketin en sağına, trafik akışından uzağa çekin ve dörtlü flaşörleri
                        yakın. Reflektörünüzü aracın en az 30 metre gerisine yerleştirin, siz ve yolcularınız
                        bariyerin dışına, güvenli bir noktaya geçin. Aracın içinde veya yakınında beklemeyin.
                        Ardından bizi arayarak bulunduğunuz kilometre işaretini veya en yakın gişe/tesis
                        bilgisini paylaşın; otoyol koşullarına uygun donanımlı ekibimiz size yönlendirilir.</p>

                    <h3 class="h5 fw-bold mt-4 mb-2">Sakarya'da Hizmet Verdiğimiz Bölgeler</h3>
                    <p>Sakarya'nın Adapazarı, Serdivan, Erenler, Hendek, Akyazı, Karasu, Sapanca, Arifiye,
                        Ferizli, Geyve, Karapürçek, Kaynarca, Kocaali, Pamukova, Söğütlü ve Taraklı olmak üzere
                        tüm 16 ilçesinde; ayrıca Kocaeli (İzmit dahil) ve Düzce genelinde 7/24 hizmet
                        veriyoruz. Bölgenizi yukarıdaki bölgeler bölümünden veya
                        <a href="<?= BASE_URL ?>bolgeler">tüm bölgeler sayfamızdan</a> bulabilirsiniz.</p>

                    <h3 class="h5 fw-bold mt-4 mb-2">Yol Yardım mı, Çekici mi?</h3>
                    <p>İkisi arasındaki fark, müdahalenin yerinde yapılıp yapılamamasıdır. Akü takviyesi,
                        lastik değişimi, yakıt ikmali gibi basit sorunları ekibimiz olduğunuz yerde çözer; bu
                        yol yardımdır. Aracınız sürüşe uygun değilse (ağır hasar, çalışmayan motor, ciddi
                        arıza) aracı bir servise veya istediğiniz adrese güvenli şekilde taşırız; bu da çekici
                        hizmetidir. Hangisine ihtiyacınız olduğuna karar veremiyorsanız bizi arayın, telefonda
                        durumunuzu değerlendirip doğru ekibi yönlendiririz.</p>

                    <h3 class="h5 fw-bold mt-4 mb-2">Konum Gönderme Süreci Nasıl İşliyor?</h3>
                    <p>Bizi aradığınızda veya WhatsApp'tan yazdığınızda, konumunuzu paylaşmanız yeterlidir
                        (WhatsApp'ın "konum gönder" özelliğini kullanabilir, ya da bulunduğunuz cadde/kilometre
                        bilgisini sözlü iletebilirsiniz). Konumunuza en yakın ekibimiz belirlenir ve size doğru
                        yönlendirilir; ortalama 15-20 dakika içinde yanınızda oluruz. Süreç boyunca ekibimizle
                        telefonda irtibatta kalabilirsiniz.</p>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Accordion (Modern) -->
<section class="py-5" style="background-color: #f9f9f9;">
    <div class="container py-4">
        <h2 class="text-center mb-5 fw-bold display-6">SIKÇA SORULAN SORULAR</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion custom-accordion" id="faqAccordion">

                    <div class="accordion-item border-0 mb-3 shadow-sm bg-white rounded overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq1">
                                <i class="fas fa-clock text-warning me-3"></i>Çekici bekleme süresi ne kadar?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted ps-5">
                                Konumunuza bağlı olarak ortalama varış süremiz 15 ile 30 dakika arasındadır. Trafik
                                durumuna göre operatörümüz size net süre verecektir.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm bg-white rounded overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq2">
                                <i class="fas fa-shield-alt text-warning me-3"></i>Araçlarım sigortalı mı taşınıyor?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted ps-5">
                                Evet, taşıdığımız tüm araçlar "Taşıyıcı Sorumluluk Sigortası" kapsamında tam güvence
                                altındadır. Olası hasarlara karşı aracınız sigortalanır.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm bg-white rounded overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq3">
                                <i class="fas fa-lira-sign text-warning me-3"></i>Fiyatlarınız neye göre belirleniyor?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted ps-5">
                                Fiyatlandırma; aracın türü, durumu (kazalı/arızalı), gideceği mesafe ve kullanılacak
                                ekipmana göre değişiklik gösterir. Telefonda net fiyat alabilirsiniz.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 mb-3 shadow-sm bg-white rounded overflow-hidden">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold py-3 fs-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#faq4">
                                <i class="fas fa-question-circle text-warning me-3"></i>Yol yardım ile çekici hizmeti
                                arasındaki fark nedir?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted ps-5">
                                Yol yardım, aracınızı çekmeden olduğu yerde müdahale etmektir (akü takviyesi, lastik
                                değişimi, yakıt ikmali gibi). Çekici hizmeti ise aracın yerinde onarılamadığı,
                                sürüşe uygun olmadığı durumlarda aracı güvenli şekilde bir servise veya adrese
                                taşımaktır. Ekibimiz önce yerinde müdahaleyi dener, gerekirse çekici hizmetine geçer.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => [
        [
            '@type' => 'Question',
            'name' => 'Çekici bekleme süresi ne kadar?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Konumunuza bağlı olarak ortalama varış süremiz 15 ile 30 dakika arasındadır. Trafik durumuna göre operatörümüz size net süre verecektir.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Araçlarım sigortalı mı taşınıyor?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Evet, taşıdığımız tüm araçlar "Taşıyıcı Sorumluluk Sigortası" kapsamında tam güvence altındadır. Olası hasarlara karşı aracınız sigortalanır.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Fiyatlarınız neye göre belirleniyor?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Fiyatlandırma; aracın türü, durumu (kazalı/arızalı), gideceği mesafe ve kullanılacak ekipmana göre değişiklik gösterir. Telefonda net fiyat alabilirsiniz.',
            ],
        ],
        [
            '@type' => 'Question',
            'name' => 'Yol yardım ile çekici hizmeti arasındaki fark nedir?',
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => 'Yol yardım, aracınızı çekmeden olduğu yerde müdahale etmektir (akü takviyesi, lastik değişimi, yakıt ikmali gibi). Çekici hizmeti ise aracın yerinde onarılamadığı durumlarda aracı güvenli şekilde bir servise veya adrese taşımaktır.',
            ],
        ],
    ],
];
?>
<script type="application/ld+json">
<?= json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>
</script>

<style>
    .custom-accordion .accordion-button:not(.collapsed) {
        background-color: var(--bs-warning);
        color: black;
        box-shadow: none;
    }

    .custom-accordion .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0, 0, 0, .125);
    }

    .custom-accordion .accordion-button::after {
        filter: grayscale(100%);
    }

    .custom-accordion .accordion-button:not(.collapsed)::after {
        filter: none;
    }
</style>

<!-- Statistics Section -->
<section class="py-5 bg-dark text-white border-bottom border-secondary">
    <div class="container py-4">
        <div class="row text-center g-4">
            <div class="col-6 col-md-3">
                <div class="mb-0">
                    <i class="fas fa-shield-alt fa-2x text-warning"></i>
                </div>
                <p class="text-uppercase tracking-widest text-light mt-2 small">Sigortalı Taşıma</p>
            </div>
            <div class="col-6 col-md-3 border-start border-secondary">
                <div class="mb-0">
                    <i class="fas fa-clock fa-2x text-warning"></i>
                </div>
                <p class="text-uppercase tracking-widest text-light mt-2 small">7/24 Aktif Hizmet</p>
            </div>
            <div class="col-6 col-md-3 border-start border-secondary">
                <div class="display-4 fw-bold text-warning mb-0 counter">
                    <?= htmlspecialchars($settings['stat_years'] ?? '0') ?>
                </div>
                <p class="text-uppercase tracking-widest text-light mt-2 small">Yıllık Tecrübe</p>
            </div>
            <div class="col-6 col-md-3 border-start border-secondary">
                <div class="display-4 fw-bold text-warning mb-0 counter">
                    <?= htmlspecialchars($settings['stat_team'] ?? '0') ?>
                </div>
                <p class="text-uppercase tracking-widest text-light mt-2 small">Uzman Personel</p>
            </div>
        </div>
    </div>
</section>





<!-- Urgent CTA Strip -->
<section class="py-5 bg-warning border-top border-bottom border-dark border-3">
    <div class="container text-center">
        <h2 class="fw-bold display-5 mb-4 text-dark">YOLDA ZAMAN KAYBETMEYİN!</h2>
        <p class="fs-4 mb-4 text-dark">Profesyonel ekibimiz 7/24 sizin için hazır bekliyor.</p>
        <a href="tel:<?= isset($settings['phone']) ? $settings['phone'] : '05551234567' ?>"
            class="btn btn-dark btn-lg px-5 py-3 rounded-pill fs-3 animate-pulse">
            <i class="fas fa-phone me-2 text-warning"></i> HEMEN ARA
        </a>
    </div>
</section>

<!-- Map Section -->
<?php if (!empty($settings['google_maps'])): ?>
    <section class="p-0 border-top border-dark">
        <div class="ratio ratio-21x9" style="max-height: 450px;">
            <?= $settings['google_maps'] ?>
        </div>
    </section>
<?php endif; ?>