<section class="page-banner">
    <div class="container">
        <h1><?= esc($category ? $category['name'] : 'Our Products') ?></h1>
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
                <?php if ($category): ?>
                <li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    <span itemprop="name"><?= esc($category['name']) ?></span>
                    <meta itemprop="position" content="3">
                </li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</section>

<section class="section-padding bg-light">
    <div class="container">
        <div class="products-toolbar">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-lg-4 col-md-6">
                    <label class="form-label">Search Products</label>
                    <input type="text" name="search" class="form-control" value="<?= esc($search ?? '') ?>" placeholder="Search by name, category...">
                </div>
                <div class="col-lg-3 col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-select" onchange="if(this.value) window.location=this.value;">
                        <option value="<?= base_url('products') ?>">All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= base_url('category/' . $cat['slug']) ?>" <?= ($category && $category['slug'] === $cat['slug']) ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?> (<?= (int) ($cat['product_count'] ?? 0) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-2 col-md-6">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Search</button>
                </div>
            </form>
        </div>

        <?php if ($category && ! empty($category['description'])): ?>
        <div class="category-intro mb-4">
            <p><?= esc($category['short_description']) ?></p>
        </div>
        <?php endif; ?>

        <?php if (empty($products)): ?>
            <div class="empty-state text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h3>No products found</h3>
                <p class="text-muted">Try adjusting your search or browse all categories.</p>
                <a href="<?= base_url('products') ?>" class="btn btn-primary">View All Products</a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                    <?= view('frontend/partials/product_card', ['product' => $product]) ?>
                <?php endforeach; ?>
            </div>
            <div class="mt-5 d-flex justify-content-center">
                <?= $pager->links('default', 'bootstrap_full') ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if (! $category): ?>
<section class="section-padding bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Browse by Category</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($categories as $cat): ?>
            <div class="col-lg-3 col-md-6">
                <div class="category-card h-100">
                    <div class="category-image">
                        <img src="<?= upload_url($cat['image']) ?>" alt="<?= esc($cat['name']) ?>" loading="lazy">
                    </div>
                    <div class="category-body">
                        <h3><?= esc($cat['name']) ?></h3>
                        <p><?= esc(truncate_text($cat['short_description'], 90)) ?></p>
                        <span class="product-count"><?= (int) ($cat['product_count'] ?? 0) ?> Products</span>
                        <a href="<?= base_url('category/' . $cat['slug']) ?>" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
