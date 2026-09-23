<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">View Product</h1><p class="text-muted mb-0"><?= esc($product['name']) ?></p></div>
    <div class="d-flex flex-wrap gap-2"><a href="<?= base_url('product/' . $product['slug']) ?>" class="btn btn-outline-primary" target="_blank">View on Site</a><a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-primary">Edit</a></div>
</div>
<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr><th width="200">Name</th><td><?= esc($product['name']) ?></td></tr>
                <tr><th>Category</th><td><?= esc($product['category_name'] ?? '') ?></td></tr>
                <tr><th>Slug</th><td><?= esc($product['slug']) ?></td></tr>
                <tr><th>MOQ</th><td><?= esc($product['moq'] ?? '-') ?> <?= esc($product['moq_unit'] ?? '') ?></td></tr>
                <tr><th>Status</th><td><?= ucfirst($product['status']) ?></td></tr>
                <tr><th>Description</th><td><?= $product['description'] ?></td></tr>
            </table>
            </div>
            <?php if (! empty($specifications)): ?>
            <h5 class="mt-4">Specifications</h5>
            <div class="table-responsive">
            <table class="table table-striped"><thead><tr><th>Name</th><th>Value</th></tr></thead><tbody>
                <?php foreach ($specifications as $s): ?><tr><td><?= esc($s['specification_name']) ?></td><td><?= esc($s['specification_value']) ?></td></tr><?php endforeach; ?>
            </tbody></table>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card">
            <?php if ($product['main_image']): ?><img src="<?= upload_url($product['main_image']) ?>" class="img-fluid rounded mb-3"><?php endif; ?>
            <?php if (! empty($gallery)): ?>
            <div class="gallery-preview">
                <?php foreach ($gallery as $img): ?><img src="<?= upload_url($img['image']) ?>" alt="" class="mb-2"><?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
