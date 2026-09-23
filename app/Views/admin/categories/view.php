<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">View Category</h1><p class="text-muted mb-0"><?= esc($category['name']) ?></p></div>
    <div class="d-flex flex-wrap gap-2"><a href="<?= base_url('admin/categories/edit/' . $category['id']) ?>" class="btn btn-primary">Edit</a><a href="<?= base_url('admin/categories') ?>" class="btn btn-light">Back</a></div>
</div>
<div class="admin-card">
    <div class="row g-4">
        <div class="col-md-4"><?php if ($category['image']): ?><img src="<?= upload_url($category['image']) ?>" class="img-fluid rounded"><?php endif; ?></div>
        <div class="col-md-8">
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr><th width="180">Name</th><td><?= esc($category['name']) ?></td></tr>
                <tr><th>Slug</th><td><?= esc($category['slug']) ?></td></tr>
                <tr><th>Status</th><td><?= ucfirst($category['status']) ?></td></tr>
                <tr><th>Sort Order</th><td><?= $category['sort_order'] ?></td></tr>
                <tr><th>Short Description</th><td><?= esc($category['short_description']) ?></td></tr>
                <tr><th>Description</th><td><?= $category['description'] ?></td></tr>
                <tr><th>Created</th><td><?= format_date($category['created_at'], 'd M Y H:i') ?></td></tr>
            </table>
            </div>
        </div>
    </div>
</div>
