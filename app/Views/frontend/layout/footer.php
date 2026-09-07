    </main>
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title"><?= esc(site_name()) ?></h5>
                        <p class="footer-text">Trusted manufacturer and exporter delivering premium natural products to global B2B buyers with quality assurance and reliable bulk supply.</p>
                        <div class="social-links">
                            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="<?= base_url('/') ?>">Home</a></li>
                            <li><a href="<?= base_url('about') ?>">About Us</a></li>
                            <li><a href="<?= base_url('products') ?>">Products</a></li>
                            <li><a href="<?= base_url('contact') ?>">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">Product Categories</h5>
                        <ul class="footer-links">
                            <?php
                            $footerCategories = model(\App\Models\ProductCategoryModel::class)->getActiveCategories(6);
                            foreach ($footerCategories as $cat): ?>
                                <li><a href="<?= base_url('products/' . $cat['slug']) ?>"><?= esc($cat['name']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="footer-title">Contact Info</h5>
                        <ul class="footer-contact">
                            <li><i class="fas fa-map-marker-alt"></i> 123 Export Park, Industrial Area, India</li>
                            <li><i class="fas fa-phone"></i> +91-9876543210</li>
                            <li><i class="fas fa-envelope"></i> info@example.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="mb-0">&copy; <?= date('Y') ?> <?= esc(site_name()) ?>. All rights reserved.</p>
                <p class="mb-0"><a href="<?= base_url('sitemap.xml') ?>">Sitemap</a></p>
            </div>
        </div>
    </footer>

    <?= view('frontend/partials/enquiry_modal') ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>const BASE_URL = '<?= base_url() ?>'; const CSRF_TOKEN = '<?= csrf_hash() ?>'; const CSRF_NAME = '<?= csrf_token() ?>';</script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <?= $this->renderSection('scripts') ?? '' ?>
</body>
</html>
