<div class="page-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div><h1 class="h3 mb-1">View Home Banner</h1><p class="text-muted mb-0"><?= esc($banner['title']) ?></p></div>
    <div class="d-flex flex-wrap gap-2"><a href="<?= base_url('admin/banners/edit/' . $banner['id']) ?>" class="btn btn-primary">Edit</a><a href="<?= base_url('admin/banners') ?>" class="btn btn-light">Back</a></div>
</div>
<div class="admin-card">
    <div class="row g-4">
        <div class="col-md-4">
            <img src="<?= ! empty($banner['image']) ? upload_url($banner['image']) : base_url('assets/images/hero-banner.jpg') ?>" class="img-fluid rounded" alt="<?= esc($banner['title']) ?>" onerror="this.src='<?= base_url('assets/images/placeholder.svg') ?>'">
        </div>
        <div class="col-md-8">
            <div class="table-responsive">
            <table class="table table-bordered">
                <tr><th width="200">Badge</th><td><?= esc($banner['badge']) ?></td></tr>
                <tr><th>Title</th><td><?= esc($banner['title']) ?></td></tr>
                <tr><th>Description</th><td><?= esc($banner['description']) ?></td></tr>
                <tr><th>Primary Button</th><td><?= esc($banner['button_text']) ?> <?= $banner['button_url'] ? '(' . esc($banner['button_url']) . ')' : '' ?></td></tr>
                <tr><th>Secondary Button</th><td><?= esc($banner['secondary_button_text']) ?> <?= $banner['secondary_button_url'] ? '(' . esc($banner['secondary_button_url']) . ')' : '' ?></td></tr>
                <tr><th>Sort Order</th><td><?= $banner['sort_order'] ?></td></tr>
                <tr><th>Status</th><td><?= ucfirst($banner['status']) ?></td></tr>
                <tr><th>Created</th><td><?= format_date($banner['created_at'], 'd M Y H:i') ?></td></tr>
            </table>
            </div>
        </div>
    </div>
</div>
