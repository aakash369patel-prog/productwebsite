<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">Home Banners</h1><p class="text-muted mb-0">Manage homepage hero banners</p></div>
    <a href="<?= base_url('admin/banners/create') ?>" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Banner</a>
</div>

<div class="admin-card mb-4">
    <form method="get" class="row g-3">
        <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search title or badge..." value="<?= esc($filters['search'] ?? '') ?>"></div>
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
        <table class="table table-hover<?= empty($banners) ? '' : ' admin-datatable' ?>">
            <thead>
                <tr><th>ID</th><th>Image</th><th>Title</th><th>Badge</th><th>Sort</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php if (empty($banners)): ?>
                <tr><td colspan="7" class="text-center text-muted py-4">No banners found. Add your first homepage banner.</td></tr>
                <?php else: foreach ($banners as $banner): ?>
                <tr>
                    <td><?= $banner['id'] ?></td>
                    <td><img src="<?= ! empty($banner['image']) ? upload_url($banner['image']) : base_url('assets/images/hero-banner.jpg') ?>" alt="" class="table-thumb" onerror="this.src='<?= base_url('assets/images/placeholder.svg') ?>'"></td>
                    <td><?= esc($banner['title']) ?></td>
                    <td><?= esc($banner['badge']) ?></td>
                    <td><?= $banner['sort_order'] ?></td>
                    <td><span class="badge bg-<?= $banner['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($banner['status']) ?></span></td>
                    <td class="table-actions">
                        <a href="<?= base_url('admin/banners/view/' . $banner['id']) ?>" class="btn btn-sm btn-light" title="View"><i class="fas fa-eye"></i></a>
                        <a href="<?= base_url('admin/banners/edit/' . $banner['id']) ?>" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('admin/banners/delete/' . $banner['id']) ?>" title="Delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager): ?><div class="p-3"><?= $pager->links() ?></div><?php endif; ?>
</div>
