<!-- JavaScript -->
<script src="{{ asset('assets/shared/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/shared/js/bundle.js') }}"></script>
<script src="{{ asset('assets/shared/js/scripts.js') }}"></script>
<script src="{{ asset('assets/shared/js/charts/chart-lms.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Prevent dropdown user from closing when clicking links inside
    $(document).ready(function() {
        $('.user-dropdown .dropdown-menu').on('click', function(e) {
            e.stopPropagation();
        });
    });
</script>
@yield('js')
@yield('scripts')

@stack('scripts')
@stack('js')
