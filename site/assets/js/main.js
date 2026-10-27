$(document).ready(function(){
//CUSTOM JS LUTOVICH//
//OWL SLIDER MAIN
    $('.owl-index-slider').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        stagePadding: 0,
        nav: true,
        navText:false,
        smartSpeed: 0,
        dots: false,
        navRewind: false,
        autoplay: true,
        autoplayHoverPause: false,
        autoplayTimeout: 8000,
        autoplaySpeed: 600,
        mouseDrag: true,
        touchDrag: true
    });
//OWL ITEMS
    $('.owl-items-slider').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        autoplaySpeed: 400,
        navSpeed: 200,
        navRewind: false,
        nav: true,
        dots: false,
        navText: ['', ''],
        loop: true,
        margin: 10,
        navRewind: true,
        mouseDrag: true,
        touchDrag: true,
        /*dotsContainer: '.owl-pager',*/
        responsive: {
            0: {
                items: 1
            },
            420: {
                items: 2,
                margin: 5
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });
    
//mobile-menu-toggler
    $('._js-b-toggle-navigation-menu').on('click', function () {
        $('.navigation-menu').toggleClass('_toggled');
        return false;
    });
        $('.li-dropper .b-dropper').on('click', function () {
        $(this).toggleClass('_toggled');
        $(this).parents('.li-dropper').children('.inset').slideToggle();
        return false;
    });
//pager up
    $(function () {
        $(window).scroll(function () {
            if ($(document).height() > $(window).height()) {
                $('.pager-up').fadeIn();
                $('.pager-down').fadeIn();
            } else  {
                $('.pager-up').fadeOut();
                $('.pager-down').fadeOut();
            }
        });
        var page_H = $(document).height();
        $('.pager-up').click(function () {
            $('body,html').animate({scrollTop: 0}, 300);
        });
        $('.pager-down').click(function () {
            $('body,html').animate({ scrollTop: $(document).height() }, 300);
        });
    });

//custom scroller
    $(window).on('resize load', function () {
        $("._js-styled-scroller").mCustomScrollbar({
            axis:"x",
            theme:"dark-thin",
            autoExpandScrollbar:true,
            advanced:{autoExpandHorizontalScroll:true},
            scrollButtons:{enable:true}
        });
    });








//mobile-menu-new
    $('._js-b-toggle-mobile-menu').on('click', function () {
        $('._js-s-toggle-mobile-menu').toggleClass('_toggled');
        $('._js-b-toggle-mobile-menu').toggleClass('_toggled');
        $('._js-b-toggle-mobile-menu').toggleClass('_toggled');
        $('body').toggleClass('_blocked');
        return false;
    });
//mobile-menu-toggle-inset-new
    $('.w-mobile-menu .b-dropper').on('click', function () {
        $(this).toggleClass('_toggled');
        $(this).parents('.li-dropper').toggleClass('_toggled');
        $(this).parents('.li-dropper').children('.inset').slideToggle();
        return false;
    });



//input styler
    $(function() {
        $('.select__default').styler();
    });
//filters ui slider http://ghusse.github.io/jQRangeSlider/options.html#optionsUsage
    $("._range-slider").rangeSlider({
        bounds: {
            min: 0, //min value
            max: 500 //max value
        },
        defaultValues: {
            min: 72, //max value start
            max: 250 //max value start
        }
    });
//toggle w-filter
    $('.w-filter.dropper .b-dropper').on('click', function () {
        $(this).toggleClass('_toggled');
        $(this).parents('.name').siblings('.inset').slideToggle();
        return false;
    }); 
//popup
    $('.s-popup__background, ._js-pop-close').on('click', function () {
        $('.s-popup').hide();
        $('.w-popup').hide();
        $('.s-popup__background').hide();
        return false;
    }); 
    $('._js-b-pop-callback').on('click', function () {
        $('.s-popup').show();
        $('.s-popup__background').show();
        $('.w-popup._js-pop-callback').css("display" , "inline-block");
        return false;
    }); 
    $('._js-b-pop-message').on('click', function () {
        $('.s-popup').show();
        $('.s-popup__background').show();
        $('.w-popup._js-pop-message').css("display" , "inline-block");
        return false;
    }); 
//double-changed-button
    $('._js-b-double-changed').on('click', function () {
        $(this).toggleClass('_toggled');
        return false;
    });
//change-tabs
    if ($('._js-swithible-tabs').length) {
            $('._js-change-tabs ._js-change-tab').on('click', function () {
               $('._js-tabs-content ._js-tab-content').removeClass('_active').eq($(this).index()).addClass('_active');
               $('._js-change-tabs ._js-change-tab').removeClass('_active').eq($(this).index()).addClass('_active');
                return false;
            });
    }
//article-spoiler
    $('._js-article-spoiler').on('click', function () {
        $(this).toggleClass('_toggled');
        $(this).children('.article-spoiler-content').slideToggle('');
        $(this).children('.name').toggleClass('_toggled');
        return false;
    });

//mobile-menu-inset-toggler-old
    $('.main-menu__li.li-dropper .b-dropper').on('click', function () {
        $(this).toggleClass('_toggled');
        $(this).parents('.main-menu__li').children('.inset').slideToggle();
        $(this).parents('.main-menu__link').toggleClass('_toggled');
        $(this).parents('.main-menu__no-link').toggleClass('_toggled');
        return false;
    });
//psccontrolls
    $('.pcscontrolls .minus_item').on('click', function (e) {
        e.preventDefault();
        var countField = $(this).parents('.pcscontrolls').children('input'),
        rowid = $(countField).attr('data-rowid'),
        currentCount = parseInt(countField.val(), 10);
        countField.val(currentCount - 1);
    });
    $('.pcscontrolls .plus_item').on('click', function (e) {
        e.preventDefault();
        var countField = $(this).parents('.pcscontrolls').children('input'),
        rowid = $(countField).attr('data-rowid'),
        currentCount = parseInt(countField.val(), 10);
        countField.val(currentCount + 1);
    });

//OWL ITEMS
    $('.owl-items-slider').owlCarousel({
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        autoplaySpeed: 400,
        navSpeed: 200,
        navRewind: false,
        nav: true,
        dots: false,
        navText: ['', ''],
        loop: true,
        margin: 0,
        navRewind: true,
        mouseDrag: true,
        touchDrag: true,
        /*dotsContainer: '.owl-pager',*/
        responsive: {
            0: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 4
            }
        }
    });
//fixed top menu 
    $(window).scroll(function() {
        if ($(window).scrollTop() > 241) {
        $('header').addClass('fixed');
        } 
        else {
        $('header').removeClass('fixed');
        }
    });
//fancybox
    if ($('.w-instagram').length > 0) {    
        $("a.grouped_elements").fancybox();
    }
});