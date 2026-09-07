<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><style>body{font-family:Arial,sans-serif;line-height:1.6;color:#333}.container{max-width:600px;margin:0 auto;padding:20px}.header{background:#2d6a4f;color:#fff;padding:20px;text-align:center;border-radius:8px 8px 0 0}.content{background:#f9f9f9;padding:20px;border:1px solid #ddd}.footer{text-align:center;padding:15px;font-size:12px;color:#666}</style></head>
<body>
<div class="container">
    <div class="header"><h2>Enquiry Received</h2></div>
    <div class="content">
        <p>Dear <?= esc($enquiry['name']) ?>,</p>
        <p>Thank you for your enquiry regarding <strong><?= esc($product['name']) ?></strong>. We have received your message and our team will get back to you within 24-48 business hours.</p>
        <p><strong>Your enquiry details:</strong></p>
        <ul>
            <li>Product: <?= esc($product['name']) ?></li>
            <li>Quantity: <?= esc($enquiry['quantity'] ?? 'Not specified') ?> <?= esc($enquiry['unit'] ?? '') ?></li>
        </ul>
        <p>Best regards,<br><?= esc(site_name()) ?> Team</p>
    </div>
    <div class="footer">&copy; <?= date('Y') ?> <?= esc(site_name()) ?></div>
</div>
</body>
</html>
