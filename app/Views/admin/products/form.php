<div class="page-header mb-4">
    <h1 class="h3 mb-1"><?= $product ? 'Edit Product' : 'Add Product' ?></h1>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?= base_url('admin/products') ?>">Products</a></li><li class="breadcrumb-item active"><?= $product ? 'Edit' : 'Add' ?></li></ol></nav>
</div>

<form method="post" enctype="multipart/form-data" action="<?= $product ? base_url('admin/products/update/' . $product['id']) : base_url('admin/products/store') ?>">
    <?= csrf_field() ?>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="admin-card mb-4">
                <h5 class="mb-3">Basic Information</h5>
                <div class="mb-3"><label class="form-label">Product Name *</label><input type="text" name="name" class="form-control" value="<?= old('name', $product['name'] ?? '') ?>" required></div>
                <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="<?= old('slug', $product['slug'] ?? '') ?>"></div>
                <?php if (false): // Category field disabled ?>
                <div class="mb-3"><label class="form-label">Category *</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= old('category_id', $product['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>
                <input type="hidden" name="category_id" value="<?= esc(old('category_id', $product['category_id'] ?? ($categories[0]['id'] ?? 1))) ?>">
                <div class="mb-3"><label class="form-label">Short Description</label><textarea name="short_description" class="form-control" rows="2"><?= old('short_description', $product['short_description'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Full Description</label><textarea name="description" class="form-control" rows="5"><?= old('description', $product['description'] ?? '') ?></textarea></div>
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label">MOQ</label><input type="text" name="moq" class="form-control" value="<?= old('moq', $product['moq'] ?? '') ?>"></div>
                    <div class="col-md-4"><label class="form-label">MOQ Unit</label><input type="text" name="moq_unit" class="form-control" value="<?= old('moq_unit', $product['moq_unit'] ?? '') ?>" placeholder="Kg, Litre, MT"></div>
                </div>
            </div>

            <div class="admin-card mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Product Specifications</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="addSpecRow"><i class="fas fa-plus me-1"></i>Add Specification</button>
                </div>
                <div id="specificationsContainer">
                    <?php
                    $specs = old('specifications') ?: $specifications;
                    if (empty($specs)) $specs = [['specification_name' => '', 'specification_value' => '']];
                    foreach ($specs as $i => $spec): ?>
                    <div class="row g-2 spec-row mb-2">
                        <div class="col-md-5"><input type="text" name="specifications[<?= $i ?>][specification_name]" class="form-control" placeholder="Specification Name" value="<?= esc($spec['specification_name'] ?? '') ?>"></div>
                        <div class="col-md-5"><input type="text" name="specifications[<?= $i ?>][specification_value]" class="form-control" placeholder="Specification Value" value="<?= esc($spec['specification_value'] ?? '') ?>"></div>
                        <div class="col-md-2"><button type="button" class="btn btn-outline-danger w-100 remove-spec-row"><i class="fas fa-times"></i></button></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="admin-card mb-4">
                <h5 class="mb-3">Additional Information</h5>
                <div class="mb-3"><label class="form-label">Applications</label><textarea name="applications" class="form-control" rows="2"><?= old('applications', $product['applications'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Benefits</label><textarea name="benefits" class="form-control" rows="2"><?= old('benefits', $product['benefits'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Packaging Information</label><textarea name="packaging_information" class="form-control" rows="2"><?= old('packaging_information', $product['packaging_information'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Availability Information</label><textarea name="availability_information" class="form-control" rows="2"><?= old('availability_information', $product['availability_information'] ?? '') ?></textarea></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="admin-card mb-4">
                <h5 class="mb-3">Publish</h5>
                <div class="mb-3"><label class="form-label">Status</label><select name="status" class="form-select"><option value="active" <?= old('status', $product['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= old('status', $product['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option></select></div>
                <div class="form-check mb-3"><input type="checkbox" name="is_featured" value="1" class="form-check-input" id="isFeatured" <?= old('is_featured', $product['is_featured'] ?? 0) ? 'checked' : '' ?>><label class="form-check-label" for="isFeatured">Featured Product</label></div>
                <button type="submit" class="btn btn-primary w-100"><?= $product ? 'Update Product' : 'Create Product' ?></button>
            </div>
            <div class="admin-card mb-4">
                <h5 class="mb-3">Main Image</h5>
                <input type="file" name="main_image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                <?php if (! empty($product['main_image'])): ?><img src="<?= upload_url($product['main_image']) ?>" class="img-preview mt-2"><?php endif; ?>
            </div>
            <div class="admin-card mb-4">
                <h5 class="mb-3">Gallery Images</h5>
                <input type="file" name="gallery[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>
                <?php if (! empty($gallery)): ?>
                <div class="gallery-preview mt-3">
                    <?php foreach ($gallery as $img): ?>
                    <div class="gallery-item" data-id="<?= $img['id'] ?>">
                        <img src="<?= upload_url($img['image']) ?>" alt="">
                        <button type="button" class="btn btn-sm btn-danger btn-delete-gallery" data-url="<?= base_url('admin/products/gallery/delete/' . $img['id']) ?>"><i class="fas fa-trash"></i></button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="admin-card">
                <h5 class="mb-3">SEO</h5>
                <div class="mb-3"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="<?= old('meta_title', $product['meta_title'] ?? '') ?>"></div>
                <div class="mb-3"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2"><?= old('meta_description', $product['meta_description'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Meta Keywords</label><input type="text" name="meta_keywords" class="form-control" value="<?= old('meta_keywords', $product['meta_keywords'] ?? '') ?>"></div>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let specIndex = document.querySelectorAll('.spec-row').length;
    document.getElementById('addSpecRow').addEventListener('click', function() {
        const html = `<div class="row g-2 spec-row mb-2">
            <div class="col-md-5"><input type="text" name="specifications[${specIndex}][specification_name]" class="form-control" placeholder="Specification Name"></div>
            <div class="col-md-5"><input type="text" name="specifications[${specIndex}][specification_value]" class="form-control" placeholder="Specification Value"></div>
            <div class="col-md-2"><button type="button" class="btn btn-outline-danger w-100 remove-spec-row"><i class="fas fa-times"></i></button></div>
        </div>`;
        document.getElementById('specificationsContainer').insertAdjacentHTML('beforeend', html);
        specIndex++;
    });
    document.getElementById('specificationsContainer').addEventListener('click', function(e) {
        if (e.target.closest('.remove-spec-row')) {
            const rows = document.querySelectorAll('.spec-row');
            if (rows.length > 1) e.target.closest('.spec-row').remove();
        }
    });
});
</script>
