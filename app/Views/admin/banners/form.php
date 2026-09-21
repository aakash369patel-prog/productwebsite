<div class="page-header mb-4">
    <h1 class="h3 mb-1"><?= $banner ? 'Edit Home Banner' : 'Add Home Banner' ?></h1>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?= base_url('admin/banners') ?>">Home Banners</a></li><li class="breadcrumb-item active"><?= $banner ? 'Edit' : 'Add' ?></li></ol></nav>
</div>

<div class="admin-card">
    <form method="post" enctype="multipart/form-data" action="<?= $banner ? base_url('admin/banners/update/' . $banner['id']) : base_url('admin/banners/store') ?>">
        <?= csrf_field() ?>
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Badge</label>
                    <input type="text" name="badge" class="form-control" value="<?= old('badge', $banner['badge'] ?? '') ?>" placeholder="e.g. Trusted B2B Exporter">
                </div>
                <div class="mb-3">
                    <label class="form-label">Title *</label>
                    <input type="text" name="title" class="form-control" value="<?= old('title', $banner['title'] ?? '') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= old('description', $banner['description'] ?? '') ?></textarea>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Primary Button Text</label>
                        <input type="text" name="button_text" class="form-control" value="<?= old('button_text', $banner['button_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Primary Button URL</label>
                        <input type="text" name="button_url" class="form-control" value="<?= old('button_url', $banner['button_url'] ?? '') ?>" placeholder="products or enquiry">
                        <div class="form-text">Use <code>enquiry</code> to open the enquiry form. Leave blank to hide the button.</div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Secondary Button Text</label>
                        <input type="text" name="secondary_button_text" class="form-control" value="<?= old('secondary_button_text', $banner['secondary_button_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Secondary Button URL</label>
                        <input type="text" name="secondary_button_url" class="form-control" value="<?= old('secondary_button_url', $banner['secondary_button_url'] ?? '') ?>" placeholder="enquiry or contact">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control" value="<?= old('sort_order', $banner['sort_order'] ?? 0) ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="active" <?= old('status', $banner['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option>
                            <option value="inactive" <?= old('status', $banner['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    <div class="form-text">Recommended size: 1920 × 800 px. JPG, PNG or WEBP, max 5MB.</div>
                    <?php if (! empty($banner['image'])): ?>
                        <img src="<?= upload_url($banner['image']) ?>" class="img-preview mt-2" alt="Banner preview">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><?= $banner ? 'Update Banner' : 'Create Banner' ?></button>
            <a href="<?= base_url('admin/banners') ?>" class="btn btn-light ms-2">Cancel</a>
        </div>
    </form>
</div>
