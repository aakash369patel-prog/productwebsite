<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pageTitle ?? site_name()) ?></title>
    <meta name="description" content="<?= esc($metaDescription ?? '') ?>">
    <meta name="keywords" content="<?= esc($metaKeywords ?? '') ?>">
    <link rel="canonical" href="<?= esc(current_url()) ?>">
    <meta property="og:title" content="<?= esc($pageTitle ?? site_name()) ?>">
    <meta property="og:description" content="<?= esc($metaDescription ?? '') ?>">
    <meta property="og:url" content="<?= esc(current_url()) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= esc(site_name()) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= esc($pageTitle ?? site_name()) ?>">
    <meta name="twitter:description" content="<?= esc($metaDescription ?? '') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "<?= esc(site_name()) ?>",
        "url": "<?= base_url() ?>",
        "description": "Leading B2B manufacturer and exporter of natural products",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+91-9876543210",
            "contactType": "sales",
            "email": "info@example.com"
        }
    }
    </script>
    <?= $this->renderSection('head') ?? '' ?>
</head>
<body>
    <header class="site-header sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
                    <span class="brand-icon"><i class="fas fa-leaf"></i></span>
                    <span class="brand-text"><?= esc(site_name()) ?></span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('about') ?>">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('products') ?>">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a></li>
                        <li class="nav-item ms-lg-2">
                            <button class="btn btn-primary btn-enquiry" data-bs-toggle="modal" data-bs-target="#enquiryModal">
                                <i class="fas fa-paper-plane me-1"></i> Get Quote
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
