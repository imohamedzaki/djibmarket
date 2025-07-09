<script>
    if ($('.z_alert_wrapper').data('trigger') == 'trigger') {
        // Delay the addition of the 'active' class to trigger the transition
        setTimeout(function() {
            document.querySelector('.z_alert_wrapper').classList.add('active');
        }, 100); // 100ms delay to ensure the animation is triggered

        setTimeout(function() {
            document.querySelector('.z_alert_wrapper').classList.add('shrink-bar');
        }, 600); // Delay of 600ms to allow the slide-in animation to complete first

        // Step 3: Listen for the 'transitionend' event to remove the 'active' class
        const alertWrapper = document.querySelector('.z_alert_wrapper');

        // Listen for the transitionend event on the wrapper
        alertWrapper.addEventListener('transitionend', function(event) {
            // Check if the event is related to the 'width' transition of the '::after' pseudo-element
            if (event.propertyName === 'width') {
                alertWrapper.classList.remove('active');
            }
        });
    }
</script>
