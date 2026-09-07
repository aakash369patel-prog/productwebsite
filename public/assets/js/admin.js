(function($) {
    'use strict';

    $('#sidebarToggle').on('click', function() {
        $('#adminSidebar').toggleClass('show');
        $('#sidebarOverlay').toggleClass('show');
    });

    $('#sidebarOverlay').on('click', function() {
        $('#adminSidebar').removeClass('show');
        $(this).removeClass('show');
    });

    if ($('.admin-datatable').length && !$.fn.DataTable.isDataTable('.admin-datatable')) {
        $('.admin-datatable').DataTable({
            paging: false,
            searching: false,
            info: false,
            order: []
        });
    }

    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const url = $(this).data('url');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post(url, { [CSRF_NAME]: CSRF_TOKEN }, function(response) {
                    if (response.success) {
                        Swal.fire('Deleted!', response.message, 'success').then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }, 'json').fail(function() {
                    Swal.fire('Error', 'Delete request failed.', 'error');
                });
            }
        });
    });

    $(document).on('click', '.btn-delete-gallery', function() {
        const url = $(this).data('url');
        const $item = $(this).closest('.gallery-item');

        Swal.fire({
            title: 'Delete image?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Delete'
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post(url, { [CSRF_NAME]: CSRF_TOKEN }, function(response) {
                    if (response.success) {
                        $item.remove();
                        Swal.fire('Deleted', response.message, 'success');
                    }
                }, 'json');
            }
        });
    });

    $('#enquiryStatus').on('change', function() {
        const url = $(this).data('url');
        const status = $(this).val();

        $.post(url, { status: status, [CSRF_NAME]: CSRF_TOKEN }, function(response) {
            if (response.success) {
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: response.message, showConfirmButton: false, timer: 2000 });
            }
        }, 'json');
    });
})(jQuery);
