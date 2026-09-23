<div class="page-header mb-4">
    <h1 class="h3 mb-1">Dashboard</h1>
    <p class="text-muted mb-0">Welcome back, <?= esc($adminUser['name'] ?? 'Admin') ?></p>
</div>

<div class="row g-4 mb-4">
    <?php /*
    <div class="col-xl-3 col-md-6">
        <div class="stat-card stat-primary">
            <div class="stat-icon"><i class="fas fa-folder-tree"></i></div>
            <div><h3><?= $totalCategories ?></h3><p>Total Categories</p></div>
        </div>
    </div>
    */ ?>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card stat-success">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div><h3><?= $totalProducts ?></h3><p>Total Products</p></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card stat-warning">
            <div class="stat-icon"><i class="fas fa-envelope"></i></div>
            <div><h3><?= $newEnquiries ?></h3><p>New Enquiries</p></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card stat-info">
            <div class="stat-icon"><i class="fas fa-inbox"></i></div>
            <div><h3><?= $totalEnquiries ?></h3><p>Total Enquiries</p></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="card-header-flex">
                <h5>Recent Enquiries</h5>
                <a href="<?= base_url('admin/enquiries') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead><tr><th>ID</th><th>Product</th><th>Name</th><th>Date</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php if (empty($recentEnquiries)): ?>
                            <tr><td colspan="5" class="text-center text-muted">No enquiries yet</td></tr>
                        <?php else: foreach ($recentEnquiries as $e): ?>
                            <tr>
                                <td><a href="<?= base_url('admin/enquiries/view/' . $e['id']) ?>">#<?= $e['id'] ?></a></td>
                                <td><?= esc($e['product_name'] ?? 'General') ?></td>
                                <td><?= esc($e['name']) ?></td>
                                <td><?= format_date($e['created_at']) ?></td>
                                <td><span class="badge bg-<?= $e['status'] === 'new' ? 'warning' : 'secondary' ?>"><?= ucfirst($e['status']) ?></span></td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="card-header-flex">
                <h5>Latest Products</h5>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <ul class="list-group list-group-flush">
                <?php if (empty($latestProducts)): ?>
                    <li class="list-group-item text-muted text-center">No products yet</li>
                <?php else: foreach ($latestProducts as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= esc($p['name']) ?></strong>
                            <?php /* <small class="d-block text-muted"><?= esc($p['category_name'] ?? '') ?></small> */ ?>
                        </div>
                        <a href="<?= base_url('admin/products/edit/' . $p['id']) ?>" class="btn btn-sm btn-light">Edit</a>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</div>
