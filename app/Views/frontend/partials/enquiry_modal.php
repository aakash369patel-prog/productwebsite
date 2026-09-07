<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content enquiry-modal">
            <div class="modal-header border-0">
                <div>
                    <h5 class="modal-title" id="enquiryModalLabel">Send Product Enquiry</h5>
                    <p class="text-muted mb-0 small">Get best price and bulk supply details</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form id="enquiryForm" novalidate>
                    <?= csrf_field() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product <span class="text-danger">*</span></label>
                            <select name="product_id" id="enquiry_product_id" class="form-select" required>
                                <option value="">Select Product</option>
                                <?php
                                $enquiryProducts = model(\App\Models\ProductModel::class)->where('status', 'active')->orderBy('name', 'ASC')->findAll();
                                foreach ($enquiryProducts as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Your Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Country</label>
                            <input type="text" name="country" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Unit</label>
                            <select name="unit" class="form-select">
                                <option value="">Unit</option>
                                <option value="Kg">Kg</option>
                                <option value="Litre">Litre</option>
                                <option value="MT">MT</option>
                                <option value="Pieces">Pieces</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="4" required placeholder="Tell us about your requirements..."></textarea>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100" id="enquirySubmitBtn">
                                <span class="btn-text"><i class="fas fa-paper-plane me-2"></i>Submit Enquiry</span>
                                <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-2"></span>Sending...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
