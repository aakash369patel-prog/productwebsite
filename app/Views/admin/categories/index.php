<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">Product Categories</h1><p class="text-muted mb-0">Manage product categories</p></div>
    <a href="<?= base_url('admin/categories/create') ?>" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Category</a>
</div>

<div class="admin-card mb-4">
    <form method="get" class="row g-3">
        <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search..." value="<?= esc($filters['search'] ?? '') ?>"></div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= ($filters['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <div class="col-md-2"><button class="btn btn-outline-primary w-100">Filter</button></div>
    </form>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover admin-datatable">
            <thead>
                <tr><th>ID</th><th>Image</th><th>Name</th><th>Slug</th><th>Sort</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><img src="<?= upload_url($cat['image']) ?>" alt="" class="table-thumb"></td>
                    <td><?= esc($cat['name']) ?></td>
                    <td><code><?= esc($cat['slug']) ?></code></td>
                    <td><?= $cat['sort_order'] ?></td>
                    <td><span class="badge bg-<?= $cat['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($cat['status']) ?></span></td>
                    <td class="table-actions">
                        <a href="<?= base_url('admin/categories/view/' . $cat['id']) ?>" class="btn btn-sm btn-light" title="View"><i class="fas fa-eye"></i></a>
                        <a href="<?= base_url('admin/categories/edit/' . $cat['id']) ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('admin/categories/delete/' . $cat['id']) ?>" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager): ?><div class="p-3"><?= $pager->links() ?></div><?php endif; ?>
</div>
