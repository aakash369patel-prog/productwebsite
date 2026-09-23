<section class="page-banner">
    <div class="container">
        <h1><?= esc($product['name']) ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?= base_url('/') ?>" itemprop="item"><span itemprop="name">Home</span></a>
                    <meta itemprop="position" content="1">
                </li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?= base_url('products') ?>" itemprop="item"><span itemprop="name">Products</span></a>
                    <meta itemprop="position" content="2">
                </li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <a href="<?= base_url('category/' . $product['category_slug']) ?>" itemprop="item"><span itemprop="name"><?= esc($product['category_name']) ?></span></a>
                    <meta itemprop="position" content="3">
                </li>
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?= esc($product['name']) ?></span>
                    <meta itemprop="position" content="4">
                </li>
            </ol>
        </nav>
    </div>
</section>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "<?= esc($product['name']) ?>",
    "description": "<?= esc(truncate_text(strip_tags($product['short_description']), 200)) ?>",
    "image": "<?= upload_url($product['main_image']) ?>",
    "category": "<?= esc($product['category_name']) ?>",
    "brand": {
        "@type": "Brand",
        "name": "<?= esc(site_name()) ?>"
    },
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "USD",
        "url": "<?= current_url() ?>"
    }
}
</script>

<section class="section-padding bg-white product-detail-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="product-gallery">
                    <div class="main-gallery-image">
                        <a href="<?= upload_url($product['main_image']) ?>" class="glightbox" data-gallery="product">
                            <img src="<?= upload_url($product['main_image']) ?>" alt="<?= esc($product['name']) ?>" id="mainProductImage" loading="lazy">
                        </a>
                    </div>
                    <?php if (! empty($gallery)): ?>
                    <div class="gallery-thumbs mt-3">
                        <button type="button" class="thumb-btn active" data-image="<?= upload_url($product['main_image']) ?>">
                            <img src="<?= upload_url($product['main_image']) ?>" alt="Main" loading="lazy">
                        </button>
                        <?php foreach ($gallery as $img): ?>
                        <button type="button" class="thumb-btn" data-image="<?= upload_url($img['image']) ?>">
                            <img src="<?= upload_url($img['image']) ?>" alt="Gallery" loading="lazy">
                        </button>
                        <a href="<?= upload_url($img['image']) ?>" class="glightbox d-none" data-gallery="product"></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="product-category-badge"><?= esc($product['category_name']) ?></span>
                <h2 class="product-detail-title"><?= esc($product['name']) ?></h2>
                <p class="product-detail-desc"><?= esc($product['short_description']) ?></p>

                <div class="product-meta-box">
                    <?php if (! empty($product['moq'])): ?>
                    <div class="meta-item"><strong>MOQ:</strong> <?= esc($product['moq']) ?> <?= esc($product['moq_unit'] ?? '') ?></div>
                    <?php endif; ?>
                    <div class="meta-item"><strong>Business Type:</strong> Manufacturer / Exporter / Supplier</div>
                    <?php if (! empty($product['availability_information'])): ?>
                    <div class="meta-item"><strong>Availability:</strong> <?= esc($product['availability_information']) ?></div>
                    <?php endif; ?>
                </div>

                <?php if (! empty($specifications)): ?>
                <div class="spec-table-wrap mt-4">
                    <h4>Product Specifications</h4>
                    <div class="table-responsive">
                    <table class="table spec-table mb-0">
                        <tbody>
                            <?php foreach ($specifications as $spec): ?>
                            <tr>
                                <th><?= esc($spec['specification_name']) ?></th>
                                <td><?= esc($spec['specification_value']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php endif; ?>

                <button class="btn btn-primary btn-lg mt-4 btn-enquiry-product" data-product-id="<?= $product['id'] ?>" data-product-name="<?= esc($product['name']) ?>">
                    <i class="fas fa-paper-plane me-2"></i>Send Enquiry
                </button>
            </div>
        </div>

        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description">Description</button></li>
                <?php if (! empty($product['applications'])): ?><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#applications">Applications</button></li><?php endif; ?>
                <?php if (! empty($product['benefits'])): ?><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#benefits">Benefits</button></li><?php endif; ?>
                <?php if (! empty($product['packaging_information'])): ?><li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#packaging">Packaging</button></li><?php endif; ?>
            </ul>
            <div class="tab-content p-4 border border-top-0 rounded-bottom">
                <div class="tab-pane fade show active" id="description"><?= $product['description'] ?></div>
                <?php if (! empty($product['applications'])): ?><div class="tab-pane fade" id="applications"><?= nl2br(esc($product['applications'])) ?></div><?php endif; ?>
                <?php if (! empty($product['benefits'])): ?><div class="tab-pane fade" id="benefits"><?= nl2br(esc($product['benefits'])) ?></div><?php endif; ?>
                <?php if (! empty($product['packaging_information'])): ?><div class="tab-pane fade" id="packaging"><?= nl2br(esc($product['packaging_information'])) ?></div><?php endif; ?>
            </div>
        </div>

        <?php if (! empty($relatedProducts)): ?>
        <div class="mt-5">
            <h3 class="section-title mb-4">Related Products</h3>
            <div class="row g-4">
                <?php foreach ($relatedProducts as $related): ?>
                    <?= view('frontend/partials/product_card', ['product' => $related]) ?>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section-padding bg-light" id="product-enquiry">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form-card">
                    <h3 class="text-center mb-4">Enquire About <?= esc($product['name']) ?></h3>
                    <form class="enquiry-inline-form" novalidate data-preselect-product="<?= $product['id'] ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="row g-3">
                            <div class="col-md-6"><label class="form-label">Name *</label><input type="text" name="name" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Company</label><input type="text" name="company_name" class="form-control"></div>
                            <div class="col-md-6"><label class="form-label">Email *</label><input type="email" name="email" class="form-control" required></div>
                            <div class="col-md-6"><label class="form-label">Phone *</label><input type="text" name="phone" class="form-control" required></div>
                            <div class="col-md-4"><label class="form-label">Country</label><input type="text" name="country" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label">Quantity</label><input type="text" name="quantity" class="form-control"></div>
                            <div class="col-md-4"><label class="form-label">Unit</label><select name="unit" class="form-select"><option value="">Unit</option><option value="Kg">Kg</option><option value="Litre">Litre</option><option value="MT">MT</option></select></div>
                            <div class="col-12"><label class="form-label">Message *</label><textarea name="message" class="form-control" rows="4" required></textarea></div>
                            <div class="col-12"><button type="submit" class="btn btn-primary w-100">Submit Enquiry</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
