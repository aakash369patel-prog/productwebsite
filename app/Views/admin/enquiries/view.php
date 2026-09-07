<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div><h1 class="h3 mb-1">Enquiry #<?= $enquiry['id'] ?></h1><p class="text-muted mb-0"><?= format_date($enquiry['created_at'], 'd M Y H:i') ?></p></div>
    <a href="<?= base_url('admin/enquiries') ?>" class="btn btn-light">Back to List</a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <table class="table table-bordered">
                <tr><th width="180">Product</th><td><?php if ($enquiry['product_name']): ?><a href="<?= base_url('product/' . ($enquiry['product_slug'] ?? '')) ?>" target="_blank"><?= esc($enquiry['product_name']) ?></a><?php else: ?>N/A<?php endif; ?></td></tr>
                <tr><th>Name</th><td><?= esc($enquiry['name']) ?></td></tr>
                <tr><th>Company</th><td><?= esc($enquiry['company_name'] ?? '-') ?></td></tr>
                <tr><th>Email</th><td><a href="mailto:<?= esc($enquiry['email']) ?>"><?= esc($enquiry['email']) ?></a></td></tr>
                <tr><th>Phone</th><td><?= esc($enquiry['phone']) ?></td></tr>
                <tr><th>Country</th><td><?= esc($enquiry['country'] ?? '-') ?></td></tr>
                <tr><th>Quantity</th><td><?= esc($enquiry['quantity'] ?? '-') ?> <?= esc($enquiry['unit'] ?? '') ?></td></tr>
                <tr><th>Message</th><td><?= nl2br(esc($enquiry['message'])) ?></td></tr>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="admin-card">
            <h5 class="mb-3">Status</h5>
            <select id="enquiryStatus" class="form-select mb-3" data-url="<?= base_url('admin/enquiries/status/' . $enquiry['id']) ?>">
                <?php foreach (['new','read','replied','closed'] as $st): ?>
                    <option value="<?= $st ?>" <?= $enquiry['status'] === $st ? 'selected' : '' ?>><?= ucfirst($st) ?></option>
                <?php endforeach; ?>
            </select>
            <a href="mailto:<?= esc($enquiry['email']) ?>?subject=Re: Enquiry for <?= esc($enquiry['product_name'] ?? 'Product') ?>" class="btn btn-primary w-100 mb-2"><i class="fas fa-reply me-1"></i>Reply via Email</a>
            <button class="btn btn-danger w-100 btn-delete" data-url="<?= base_url('admin/enquiries/delete/' . $enquiry['id']) ?>"><i class="fas fa-trash me-1"></i>Delete Enquiry</button>
        </div>
    </div>
</div>
