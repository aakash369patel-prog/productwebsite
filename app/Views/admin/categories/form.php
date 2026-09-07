<div class="page-header mb-4">
    <h1 class="h3 mb-1"><?= $category ? 'Edit Category' : 'Add Category' ?></h1>
    <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0"><li class="breadcrumb-item"><a href="<?= base_url('admin/categories') ?>">Categories</a></li><li class="breadcrumb-item active"><?= $category ? 'Edit' : 'Add' ?></li></ol></nav>
</div>

<div class="admin-card">
    <form method="post" enctype="multipart/form-data" action="<?= $category ? base_url('admin/categories/update/' . $category['id']) : base_url('admin/categories/store') ?>">
        <?= csrf_field() ?>
        <div class="row g-4">
            <div class="col-md-8">
                <div class="mb-3"><label class="form-label">Category Name *</label><input type="text" name="name" class="form-control" value="<?= old('name', $category['name'] ?? '') ?>" required></div>
                <div class="mb-3"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="<?= old('slug', $category['slug'] ?? '') ?>" placeholder="Auto-generated if empty"></div>
                <div class="mb-3"><label class="form-label">Short Description</label><textarea name="short_description" class="form-control" rows="2"><?= old('short_description', $category['short_description'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="5"><?= old('description', $category['description'] ?? '') ?></textarea></div>
                <div class="row g-3">
                    <div class="col-md-4"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="form-control" value="<?= old('sort_order', $category['sort_order'] ?? 0) ?>"></div>
                    <div class="col-md-4"><label class="form-label">Status *</label><select name="status" class="form-select" required><option value="active" <?= old('status', $category['status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active</option><option value="inactive" <?= old('status', $category['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option></select></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3"><label class="form-label">Category Image</label><input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp"><?php if (! empty($category['image'])): ?><img src="<?= upload_url($category['image']) ?>" class="img-preview mt-2"><?php endif; ?></div>
                <div class="mb-3"><label class="form-label">Meta Title</label><input type="text" name="meta_title" class="form-control" value="<?= old('meta_title', $category['meta_title'] ?? '') ?>"></div>
                <div class="mb-3"><label class="form-label">Meta Description</label><textarea name="meta_description" class="form-control" rows="2"><?= old('meta_description', $category['meta_description'] ?? '') ?></textarea></div>
                <div class="mb-3"><label class="form-label">Meta Keywords</label><input type="text" name="meta_keywords" class="form-control" value="<?= old('meta_keywords', $category['meta_keywords'] ?? '') ?>"></div>
            </div>
        </div>
        <div class="mt-4"><button type="submit" class="btn btn-primary"><?= $category ? 'Update Category' : 'Create Category' ?></button><a href="<?= base_url('admin/categories') ?>" class="btn btn-light ms-2">Cancel</a></div>
    </form>
</div>
