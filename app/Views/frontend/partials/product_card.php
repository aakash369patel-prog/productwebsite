<div class="col-lg-3 col-md-6">
    <div class="product-card h-100">
        <div class="product-image">
            <a href="<?= base_url('product/' . $product['slug']) ?>">
                <img src="<?= upload_url($product['main_image']) ?>" alt="<?= esc($product['name']) ?>" loading="lazy">
            </a>
            <?php if (! empty($product['is_featured'])): ?>
                <span class="badge-featured">Featured</span>
            <?php endif; ?>
        </div>
        <div class="product-body">
            <span class="product-category"><?= esc($product['category_name'] ?? '') ?></span>
            <h3><a href="<?= base_url('product/' . $product['slug']) ?>"><?= esc($product['name']) ?></a></h3>
            <p><?= esc(truncate_text($product['short_description'], 80)) ?></p>
            <?php if (! empty($product['moq'])): ?>
                <div class="product-moq"><strong>MOQ:</strong> <?= esc($product['moq']) ?> <?= esc($product['moq_unit'] ?? '') ?></div>
            <?php endif; ?>
            <div class="product-actions">
                <a href="<?= base_url('product/' . $product['slug']) ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                <button class="btn btn-sm btn-primary btn-enquiry-product" data-product-id="<?= $product['id'] ?>" data-product-name="<?= esc($product['name']) ?>">Send Enquiry</button>
            </div>
        </div>
    </div>
</div>
