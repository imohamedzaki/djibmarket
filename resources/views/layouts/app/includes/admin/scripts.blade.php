<!-- JavaScript -->
<script src="{{ asset('assets/shared/js/bundle.js') }}"></script>
<script src="{{ asset('assets/shared/js/scripts.js') }}"></script>
<script src="{{ asset('assets/shared/js/charts/chart-lms.js') }}"></script>

<script>
    // Prevent dropdown user from closing when clicking links inside
    $(document).ready(function() {
        $('.user-dropdown .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });

        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>

@yield('js')
@yield('scripts')
