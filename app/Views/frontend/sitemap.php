<?= '<?xml version="1.0" encoding="UTF-8"?>' . "\n" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url('/') ?></loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url('about') ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc><?= base_url('products') ?></loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc><?= base_url('contact') ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php foreach ($categories as $category): ?>
    <url>
        <loc><?= base_url('products/' . $category['slug']) ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; ?>
    <?php foreach ($products as $product): ?>
    <url>
        <loc><?= base_url('product/' . $product['slug']) ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    <?php endforeach; ?>
</urlset>
