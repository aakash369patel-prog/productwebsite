<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>body{font-family:Arial,sans-serif;line-height:1.6;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#2d6a4f;color:#fff;padding:20px;text-align:center;border-radius:8px 8px 0 0}.content{background:#f9f9f9;padding:20px;border:1px solid #ddd}.field{margin-bottom:12px}.label{font-weight:bold;color:#2d6a4f}.footer{text-align:center;padding:15px;font-size:12px;color:#666}</style></head>
<body>
<div class="container">
    <div class="header"><h2>New Product Enquiry</h2></div>
    <div class="content">
        <div class="field"><span class="label">Product:</span> <?= esc($product['name']) ?></div>
        <div class="field"><span class="label">Name:</span> <?= esc($enquiry['name']) ?></div>
        <div class="field"><span class="label">Company:</span> <?= esc($enquiry['company_name'] ?? 'N/A') ?></div>
        <div class="field"><span class="label">Email:</span> <?= esc($enquiry['email']) ?></div>
        <div class="field"><span class="label">Phone:</span> <?= esc($enquiry['phone']) ?></div>
        <div class="field"><span class="label">Country:</span> <?= esc($enquiry['country'] ?? 'N/A') ?></div>
        <div class="field"><span class="label">Quantity:</span> <?= esc($enquiry['quantity'] ?? 'N/A') ?> <?= esc($enquiry['unit'] ?? '') ?></div>
        <div class="field"><span class="label">Message:</span><br><?= nl2br(esc($enquiry['message'])) ?></div>
    </div>
    <div class="footer">&copy; <?= date('Y') ?> <?= esc(site_name()) ?></div>
</div>
</body>
</html>
