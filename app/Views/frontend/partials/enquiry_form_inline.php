<form class="enquiry-inline-form" novalidate>
    <?= csrf_field() ?>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Product <span class="text-danger">*</span></label>
            <select name="product_id" class="form-select" required>
                <option value="">Select Product</option>
                <?php
                $inlineProducts = model(\App\Models\ProductModel::class)->where('status', 'active')->orderBy('name', 'ASC')->findAll();
                foreach ($inlineProducts as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= esc($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Company</label>
            <input type="text" name="company_name" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Country</label>
            <input type="text" name="country" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">Qty</label>
            <input type="text" name="quantity" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label">Unit</label>
            <select name="unit" class="form-select">
                <option value="">Unit</option>
                <option value="Kg">Kg</option>
                <option value="Litre">Litre</option>
                <option value="MT">MT</option>
            </select>
        </div>
        <div class="col-12">
            <label class="form-label">Message <span class="text-danger">*</span></label>
            <textarea name="message" class="form-control" rows="3" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit Enquiry</button>
        </div>
    </div>
</form>
