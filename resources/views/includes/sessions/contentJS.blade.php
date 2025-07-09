<script>
    $(document).ready(function() {
        $(".alert .close").on("click", function() {
            $(this).closest(".alert").hide();
        });
    });
</script>
