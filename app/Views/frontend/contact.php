<section class="page-banner">
    <div class="container">
        <h1>Contact Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Home</a></li>
                <li class="breadcrumb-item active">Contact Us</li>
            </ol>
        </nav>
    </div>
</section>

<section class="section-padding bg-white">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <span class="section-label">Get In Touch</span>
                <h2 class="section-title">We'd Love to Hear From You</h2>
                <p class="section-text">Reach out for product enquiries, bulk pricing, samples or export partnership opportunities.</p>
                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Address</h4>
                            <p>123 Export Park, Industrial Area, Gujarat, India - 380001</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+91-9876543210</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>info@example.com</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Business Hours</h4>
                            <p>Mon - Sat: 9:00 AM - 6:00 PM IST</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 class="mb-4">Send Enquiry</h3>
                    <?= view('frontend/partials/enquiry_form_inline') ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="map-section">
    <iframe src="https://maps.google.com/maps?q=India&t=&z=5&ie=UTF8&iwloc=&output=embed" loading="lazy" title="Location map"></iframe>
</section>
