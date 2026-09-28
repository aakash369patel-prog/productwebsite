<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">Products</h1><p class="text-muted mb-0">Manage product catalogue</p></div>
    <a href="<?= base_url('admin/products/create') ?>" class="btn btn-primary"><i class="fas fa-plus me-1"></i> Add Product</a>
</div>

<div class="admin-card mb-4">
    <form method="get" class="row g-3">
        <div class="col-md-3"><input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= esc($filters['search'] ?? '') ?>"></div>
        <?php if (false): // Category filter disabled ?>
        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($filters['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        <div class="col-md-2">
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
            <thead><tr><th>ID</th><th>Image</th><th>Name</th><?php /* <th>Category</th> */ ?><th>MOQ</th><th>Featured</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><img src="<?= upload_url($product['main_image']) ?>" alt="" class="table-thumb"></td>
                    <td><?= esc($product['name']) ?></td>
                    <?php /* <td><?= esc($product['category_name'] ?? '') ?></td> */ ?>
                    <td><?= esc($product['moq'] ?? '-') ?> <?= esc($product['moq_unit'] ?? '') ?></td>
                    <td><?= $product['is_featured'] ? '<span class="badge bg-info">Yes</span>' : '-' ?></td>
                    <td><span class="badge bg-<?= $product['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($product['status']) ?></span></td>
                    <td class="table-actions">
                        <a href="<?= base_url('admin/products/view/' . $product['id']) ?>" class="btn btn-sm btn-light"><i class="fas fa-eye"></i></a>
                        <a href="<?= base_url('admin/products/edit/' . $product['id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('admin/products/delete/' . $product['id']) ?>"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager): ?><div class="p-3"><?= $pager->links() ?></div><?php endif; ?>
</div>
