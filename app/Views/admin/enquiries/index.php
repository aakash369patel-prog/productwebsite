<div class="page-header mb-4"><h1 class="h3 mb-1">Product Enquiries</h1><p class="text-muted mb-0">Manage customer enquiries</p></div>

<div class="admin-card mb-4">
    <form method="get" class="row g-3">
        <div class="col-md-3"><input type="text" name="search" class="form-control" placeholder="Search..." value="<?= esc($filters['search'] ?? '') ?>"></div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <?php foreach (['new','read','replied','closed'] as $st): ?>
                    <option value="<?= $st ?>" <?= ($filters['status'] ?? '') === $st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="product_id" class="form-select">
                <option value="">All Products</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= ($filters['product_id'] ?? '') == $p['id'] ? 'selected' : '' ?>><?= esc($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2"><input type="date" name="date_from" class="form-control" value="<?= esc($filters['date_from'] ?? '') ?>"></div>
        <div class="col-md-2"><button class="btn btn-outline-primary w-100">Filter</button></div>
    </form>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="table table-hover admin-datatable">
            <thead><tr><th>ID</th><th>Product</th><th>Name</th><th>Company</th><th>Email</th><th>Phone</th><th>Country</th><th>Qty</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                <?php foreach ($enquiries as $e): ?>
                <tr>
                    <td>#<?= $e['id'] ?></td>
                    <td><?= esc($e['product_name'] ?? 'N/A') ?></td>
                    <td><?= esc($e['name']) ?></td>
                    <td><?= esc($e['company_name'] ?? '-') ?></td>
                    <td><?= esc($e['email']) ?></td>
                    <td><?= esc($e['phone']) ?></td>
                    <td><?= esc($e['country'] ?? '-') ?></td>
                    <td><?= esc($e['quantity'] ?? '-') ?> <?= esc($e['unit'] ?? '') ?></td>
                    <td><?= format_date($e['created_at']) ?></td>
                    <td><span class="badge bg-<?= $e['status'] === 'new' ? 'warning' : ($e['status'] === 'replied' ? 'success' : 'secondary') ?>"><?= ucfirst($e['status']) ?></span></td>
                    <td class="table-actions">
                        <a href="<?= base_url('admin/enquiries/view/' . $e['id']) ?>" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                        <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('admin/enquiries/delete/' . $e['id']) ?>"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager): ?><div class="p-3"><?= $pager->links() ?></div><?php endif; ?>
</div>
