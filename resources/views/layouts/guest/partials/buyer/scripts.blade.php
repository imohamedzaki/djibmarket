<!-- Core JavaScript -->
<script src="{{ asset('assets/plugins/jquery/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Base Scripts -->
<script src="{{ asset('assets/shared') }}/js/bundle.js?ver=3.2.2"></script>
<script src="{{ asset('assets/shared') }}/js/scripts.js?ver=3.2.2"></script>
<script src="{{ asset('assets/shared') }}/js/charts/chart-ecommerce.js?ver=3.2.2"></script>

@includeIf('includes.z_alert.contentJS')

@yield('scripts')

<script>
    // Disable submit button on form submit
    $('form').on('submit', function(e) {
        var submitButton = $('.submitButton');

        // Disable the button
        submitButton.prop('disabled', true);

        // Change the button text
        // submitButton.find('.button-text').text('Submitting...');

        // Show the loading spinner
        $('.loadingSpinner').removeClass('d-none');
    });
</script>
