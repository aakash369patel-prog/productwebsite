(function($) {
    'use strict';

    function submitEnquiry(form) {
        const $form = $(form);
        const $btn = $form.find('[type="submit"]');
        const originalText = $btn.html();

        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Sending...');

        const formData = {};
        $form.serializeArray().forEach(function(item) {
            formData[item.name] = item.value;
        });
        formData[CSRF_NAME] = CSRF_TOKEN;

        $.ajax({
            url: BASE_URL + 'enquiry/submit',
            method: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({ icon: 'success', title: 'Success!', text: response.message, confirmButtonColor: '#2d6a4f' });
                    $form[0].reset();
                    $('#enquiryModal').modal('hide');
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: response.message || 'Something went wrong.', confirmButtonColor: '#2d6a4f' });
                }
            },
            error: function(xhr) {
                let message = 'Failed to submit enquiry. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    message = xhr.responseJSON.message;
                }
                Swal.fire({ icon: 'error', title: 'Error', text: message, confirmButtonColor: '#2d6a4f' });
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    }

    $('#enquiryForm').on('submit', function(e) {
        e.preventDefault();
        submitEnquiry(this);
    });

    $('.enquiry-inline-form').on('submit', function(e) {
        e.preventDefault();
        submitEnquiry(this);
    });

    $('.btn-enquiry-product').on('click', function() {
        const productId = $(this).data('product-id');
        $('#enquiry_product_id').val(productId);
        $('#enquiryModal').modal('show');
    });

    $('[data-preselect-product]').each(function() {
        const id = $(this).data('preselect-product');
        $(this).find('[name="product_id"]').val(id);
    });

    $('.thumb-btn').on('click', function() {
        const src = $(this).data('image');
        $('#mainProductImage').attr('src', src);
        $('.main-gallery-image .glightbox').attr('href', src);
        $('.thumb-btn').removeClass('active');
        $(this).addClass('active');
    });

    if (typeof GLightbox !== 'undefined') {
        GLightbox({ selector: '.glightbox' });
    }

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 50) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
    });

    const homeBannerCarousel = document.getElementById('homeBannerCarousel');
    if (homeBannerCarousel && typeof bootstrap !== 'undefined') {
        bootstrap.Carousel.getOrCreateInstance(homeBannerCarousel, {
            interval: 6000,
            ride: 'carousel',
            pause: 'hover',
            wrap: true,
            touch: true
        });
    }
})(jQuery);
