/*Hi everyone this my top viewed pen :O 
i have ever created :) hope that this pen help
you a lot in your project testimonial section.
connect with me if u want on facebook :)

fb.com/shabab.sourav
*/

/*
practice carosal concept using slick slider
for working perfectly add slick.js and slick.css 
file to your project folder
*/

/*------------------------------------
	Testimonial Slick Carousel as Nav
--------------------------------------*/
$(".slider-nav").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    centerPadding: "10px",
    infinite: false,
    responsive: [
        {
            breakpoint: 450,
            settings: {
                dots: false,
                slidesToShow: 3,
                centerPadding: "0px",
                autoplay: true,
            },
        },
        {
            breakpoint: 420,
            settings: {
                autoplay: true,
                dots: false,
                slidesToShow: 1,
                centerMode: false,
            },
        },
    ],
});
