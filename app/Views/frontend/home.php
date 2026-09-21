<?php $banners = $banners ?? []; $bannerCount = count($banners); ?>
<section class="hero-section">
    <?php if ($bannerCount === 0): ?>
        <div class="hero-slide" style="background-image: url('<?= base_url('assets/images/hero-banner.jpg') ?>');">
            <div class="container position-relative">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-7">
                        <span class="hero-badge">Trusted B2B Exporter</span>
                        <h1 class="hero-title">Premium Natural Products for Global Markets</h1>
                        <p class="hero-text">We manufacture and export high-quality organic powders, essential oils, cold pressed oils and tea ingredients with export-grade documentation and reliable bulk supply.</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="<?= base_url('products') ?>" class="btn btn-primary btn-lg">Explore Products</a>
                            <button class="btn btn-outline-light btn-lg" data-bs-toggle="modal" data-bs-target="#enquiryModal">Send Enquiry</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php elseif ($bannerCount === 1): ?>
        <?php $banner = $banners[0]; ?>
        <div class="hero-slide" style="background-image: url('<?= esc(banner_image_url($banner['image']), 'attr') ?>');">
            <div class="container position-relative">
                <div class="row align-items-center min-vh-75">
                    <div class="col-lg-7">
                        <?php if (! empty($banner['badge'])): ?><span class="hero-badge"><?= esc($banner['badge']) ?></span><?php endif; ?>
                        <h1 class="hero-title"><?= esc($banner['title']) ?></h1>
                        <?php if (! empty($banner['description'])): ?><p class="hero-text"><?= esc($banner['description']) ?></p><?php endif; ?>
                        <div class="d-flex flex-wrap gap-3">
                            <?= banner_cta($banner['button_text'] ?? '', $banner['button_url'] ?? '', 'btn btn-primary btn-lg') ?>
                            <?= banner_cta($banner['secondary_button_text'] ?? '', $banner['secondary_button_url'] ?? '', 'btn btn-outline-light btn-lg') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div id="homeBannerCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($banners as $i => $banner): ?>
                    <button type="button" data-bs-target="#homeBannerCarousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" <?= $i === 0 ? 'aria-current="true"' : '' ?> aria-label="Slide <?= $i + 1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($banners as $i => $banner): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <div class="hero-slide" style="background-image: url('<?= esc(banner_image_url($banner['image']), 'attr') ?>');">
                        <div class="container position-relative">
                            <div class="row align-items-center min-vh-75">
                                <div class="col-lg-7">
                                    <?php if (! empty($banner['badge'])): ?><span class="hero-badge"><?= esc($banner['badge']) ?></span><?php endif; ?>
                                    <h1 class="hero-title"><?= esc($banner['title']) ?></h1>
                                    <?php if (! empty($banner['description'])): ?><p class="hero-text"><?= esc($banner['description']) ?></p><?php endif; ?>
                                    <div class="d-flex flex-wrap gap-3">
                                        <?= banner_cta($banner['button_text'] ?? '', $banner['button_url'] ?? '', 'btn btn-primary btn-lg') ?>
                                        <?= banner_cta($banner['secondary_button_text'] ?? '', $banner['secondary_button_url'] ?? '', 'btn btn-outline-light btn-lg') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homeBannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php endif; ?>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-image-wrap">
                    <img src="<?= base_url('assets/images/about-company.jpg') ?>" alt="About our company" class="img-fluid rounded-4 shadow" loading="lazy" onerror="this.src='<?= base_url('assets/images/placeholder.svg') ?>'">
                </div>
            </div>
            <div class="col-lg-6">
                <span class="section-label">About Company</span>
                <h2 class="section-title">Leading Manufacturer & Exporter of Natural Products</h2>
                <p class="section-text">With decades of expertise in sourcing, processing and exporting natural ingredients, we serve global buyers across food, nutraceutical, cosmetic and wellness industries with consistent quality and competitive pricing.</p>
                <ul class="feature-list">
                    <li><i class="fas fa-check-circle"></i> ISO compliant manufacturing facilities</li>
                    <li><i class="fas fa-check-circle"></i> Export documentation support</li>
                    <li><i class="fas fa-check-circle"></i> Custom packaging & private labeling</li>
                </ul>
                <a href="<?= base_url('about') ?>" class="btn btn-primary mt-3">Read More</a>
            </div>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Our Range</span>
            <h2 class="section-title">Product Categories</h2>
            <p class="section-text mx-auto" style="max-width:640px">Browse our comprehensive catalogue of export-quality natural products organized by category.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
            <div class="col-lg-3 col-md-6">
                <div class="category-card h-100">
                    <div class="category-image">
                        <img src="<?= upload_url($category['image']) ?>" alt="<?= esc($category['name']) ?>" loading="lazy">
                    </div>
                    <div class="category-body">
                        <h3><?= esc($category['name']) ?></h3>
                        <p><?= esc(truncate_text($category['short_description'], 90)) ?></p>
                        <span class="product-count"><?= (int) ($category['product_count'] ?? 0) ?> Products</span>
                        <a href="<?= base_url('category/' . $category['slug']) ?>" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end mb-5 gap-3">
            <div>
                <span class="section-label">Featured</span>
                <h2 class="section-title mb-0">Featured Products</h2>
            </div>
            <a href="<?= base_url('products') ?>" class="btn btn-outline-primary">View All Products</a>
        </div>
        <div class="row g-4">
            <?php foreach ($featuredProducts as $product): ?>
            <?= view('frontend/partials/product_card', ['product' => $product]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Latest Arrivals</span>
            <h2 class="section-title">New Products</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($latestProducts as $product): ?>
            <?= view('frontend/partials/product_card', ['product' => $product]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-padding why-choose-section">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label text-white-50">Why Choose Us</span>
            <h2 class="section-title text-white">Your Trusted Export Partner</h2>
        </div>
        <div class="row g-4">
            <?php
            $features = [
                ['Quality', 'fas fa-award', 'Strict quality control with batch-wise testing and certification support.'],
                ['Competitive Pricing', 'fas fa-tags', 'Direct manufacturer pricing with flexible MOQ for bulk buyers.'],
                ['Bulk Supply', 'fas fa-boxes-stacked', 'Scalable production capacity for large export orders.'],
                ['Export Quality', 'fas fa-globe', 'Compliant with international standards and export regulations.'],
                ['Customer Support', 'fas fa-headset', 'Dedicated support team for enquiries and order coordination.'],
            ];
            foreach ($features as $feature): ?>
            <div class="col-lg-4 col-md-6">
                <div class="why-card">
                    <div class="why-icon"><i class="<?= $feature[1] ?>"></i></div>
                    <h3><?= $feature[0] ?></h3>
                    <p><?= $feature[2] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container text-center">
        <h2>Get Best Price for Bulk Orders</h2>
        <p>Send us your product requirements and receive a competitive quotation within 24 hours.</p>
        <button class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#enquiryModal">
            <i class="fas fa-paper-plane me-2"></i>Send Enquiry
        </button>
    </div>
</section>

<section class="section-padding bg-white" id="home-enquiry">
    <div class="container">
        <div class="row g-4 align-items-stretch">
            <div class="col-lg-5">
                <span class="section-label">Contact</span>
                <h2 class="section-title">Quick Enquiry Form</h2>
                <p class="section-text">Fill out the form and our export team will get back to you with pricing and availability details.</p>
            </div>
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <?= view('frontend/partials/enquiry_form_inline') ?>
                </div>
            </div>
        </div>
    </div>
</section>
