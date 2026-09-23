<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <i class="fas fa-leaf"></i>
        <span><?= esc(site_name()) ?></span>
    </div>
    <nav class="sidebar-nav">
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= uri_string() === 'admin/dashboard' ? 'active' : '' ?>">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <div class="nav-group-label">Website</div>
        <a href="<?= base_url('admin/banners') ?>" class="nav-link <?= str_starts_with(uri_string(), 'admin/banners') ? 'active' : '' ?>">
            <i class="fas fa-images"></i> Home Banner
        </a>
        <div class="nav-group-label">Product Management</div>
        <?php /* Category module disabled
        <a href="<?= base_url('admin/categories') ?>" class="nav-link <?= str_starts_with(uri_string(), 'admin/categories') ? 'active' : '' ?>">
            <i class="fas fa-folder-tree"></i> Product Category
        </a>
        */ ?>
        <a href="<?= base_url('admin/products') ?>" class="nav-link <?= str_starts_with(uri_string(), 'admin/products') ? 'active' : '' ?>">
            <i class="fas fa-box"></i> Product Details
        </a>
        <div class="nav-group-label">Enquiries</div>
        <a href="<?= base_url('admin/enquiries') ?>" class="nav-link <?= str_starts_with(uri_string(), 'admin/enquiries') ? 'active' : '' ?>">
            <i class="fas fa-envelope"></i> Product Enquiry
        </a>
    </nav>
</aside>
<div class="admin-main">
    <header class="admin-topbar">
        <button class="btn btn-link sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <div class="topbar-right">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> <?= esc($adminUser['name'] ?? 'Admin') ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><span class="dropdown-item-text small text-muted"><?= esc($adminUser['email'] ?? '') ?></span></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= base_url('admin/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="admin-content">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $err): ?><li><?= esc($err) ?></li><?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
