<style>
    .z_alert_wrapper {
        width: 26rem;

        display: flex;
        align-items: center;
        gap: .5rem;
        justify-content: space-between;
        padding: .9rem;
        border-radius: .5rem;
        border: 1px solid #3f724617;
        position: absolute;
        top: .5rem;
        right: 2rem;
        overflow: hidden;
        transform: translateX(calc(100% + 30px));
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.35);
        z-index: 99999;
    }

    .z_alert_wrapper_success {
        background: #defae1;
        color: #3f7246;
        border: 1.5px solid #3f724a63;
        box-shadow: 0px 7px 10px rgb(33 154 87 / 15%);
    }

    .z_alert_wrapper_danger {
        background: #FAD1D1;
        color: #723F3F;
        border: 1.5px solid #723f3f63;
        box-shadow: 0px 7px 10px rgb(154 33 33 / 15%);
    }

    .z_alert_wrapper_success::after {
        background: #3f7246;
    }

    .z_alert_wrapper_danger::after {
        background: #723F3F;
    }

    .z_alert_wrapper::after {
        position: absolute;
        display: block;
        content: '';
        width: 100%;
        height: 2px;
        bottom: 0;
        left: 0;
        transition: width 3s ease-in-out;
        /* Transition effect for the width */
    }

    .z_alert_wrapper.shrink-bar::after {
        width: 0%;
        /* Final state for the after element */
    }

    .z_alert_icon {
        font-size: 2rem;
        width: 20%;
        display: flex;
        justify-content: center;
        border-right: 1px solid;
        margin-right: 1rem;
    }

    .z_alert_content {
        width: 79%;
    }

    .z_alert_content h2 {
        font-size: 1.1rem;
        line-height: 2rem;
        margin: 0;
    }

    .z_alert_content span {
        font-size: .8rem;
        margin-top: .5rem;
    }

    .z_alert_wrapper.active {
        transform: translateX(0%);
    }
</style>
<?php /**PATH C:\laragon\www\djibmarket\resources\views/includes/z_alert/contentCSS.blade.php ENDPATH**/ ?>