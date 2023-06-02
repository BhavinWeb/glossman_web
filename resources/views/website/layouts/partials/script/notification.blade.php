<script>
    //    Toastr
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}", 'Success!')
    @elseif(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}", 'Warning!')
    @elseif(Session::has('error'))
        toastr.error("{{ Session::get('error') }}", 'Error!')
    @endif
    // toast config
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "hideMethod": "fadeOut"
    }
    //    sweet alert 2
    $('.login_required').on('click',function(event) {
        event.preventDefault();
        swal({
                title: `User Unauthenticated .`,
                text: "If you perform this action, you need to login your account first.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((confirmed) => {
                if (confirmed) {
                    window.location.href = "{{ route('users.login') }}";
                }
            });
    });
</script>
