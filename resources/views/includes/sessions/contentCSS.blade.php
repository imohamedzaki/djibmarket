<style>
    .alert ul {
        padding: 0;
    }

    .alert {
        position: relative;
        font-size: .8rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;

        /* custom */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1.8rem;
        padding-right: 1.4rem;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-dismissible {
        padding-right: 4rem;
    }

    .fade {
        transition: opacity 0.15s linear;
    }

    .show {
        opacity: 1;
    }

    .close {
        float: right;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        opacity: 0.5;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        position: relative !important;
        top: auto !important;
        margin-left: 1rem;
    }

    .close:hover {
        color: #000;
        text-decoration: none;
    }

    .close:not(:disabled):not(.disabled):focus,
    .close:not(:disabled):not(.disabled):hover {
        opacity: 0.75;
    }
</style>
