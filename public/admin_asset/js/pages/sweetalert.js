(function($) {
    $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            text: "Delete This Data?",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
            }
        });
    });
})(jQuery);
