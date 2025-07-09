$("document").ready(function () {
    $(".disabled_submit").submit(function (e) {
        // e.preventDefault();
        $(".disabled_button").prop("disabled", true);
        $(".disabled_submit .spinner").css("display", "block");
        $(".disabled_text").css("visibility", "hidden");
    });

    $(".view_mode a").click(function () {
        $(".view_mode a").removeClass("active");
        let type = $(this).data("type");
        // if(type == 'list') {

        // }
        $(this).addClass("active");
    });

    $(".wrapperMyAccount, .svgMyAccount").on("click", function () {
        if ($(".svgMyAccount").hasClass("rotate_180")) {
            $(".svgMyAccount").removeClass("rotate_180");
            $(".drop_down_account").css("display", "none");
        } else {
            $(".svgMyAccount").addClass("rotate_180");
            $(".drop_down_account").css("display", "block");
        }
    });
    $("form.logout_link").click(function () {
        $(this).submit();
    });
});

$(document).ready(function () {
    $(".alert .close").on("click", function () {
        $(this).closest(".alert").fadeOut();
    });
});
