jQuery(function ($) {
    "use strict";
    /* ---------------------------------------------
    Menu Toggle 
    ------------------------------------------------ */
    $('.nav-toggler').on('click', function () {
        $('.main-menu').toggleClass('show');
    });

    /* ---------------------------------------------
    Mobile Menus
    ------------------------------------------------ */

    $('li.menu-item-has-children > a:first-child').after('<button/>');
    $('li.menu-item-has-children button').click(function () {
        $(this).parent().toggleClass('open');
    });


    /* ---------------------------------------------
    Site Search 
    ------------------------------------------------ */

    $('.search-link span[class*="search"]').on('click', function () {
        $('.search-link .search-form').toggleClass('active');
    });

    $('.search-link button').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            $('.search-link .search-form').toggleClass('active');
        }
    });

    /* post grid image color */
    $(".post-grid-image").each(function () {
        var postcolol = $(this).data('color');
        $(this).css("background-color", postcolol);
    });

    /* ---------------------------------------------
    Preloader
    ------------------------------------------------ */
    $(document).ready(function () {
        $('#wp-preloader').removeClass('d-flex');
        $('#wp-preloader').addClass('d-none');
    });

    /* ---------------------------------------------
    Back To Top
    ------------------------------------------------ */
    $(window).scroll(function () {
        //works when page scrolled to 500px
        if ($(this).scrollTop() >= 500) {
            $('a#backtotop').fadeIn(500);
        } else {
            $('a#backtotop').fadeOut(500);
        }
    });

    $("a#backtotop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
    });

    /* ---------------------------------------------
    Infinite Scroll
    ------------------------------------------------ */
    if (jQuery.fn.infiniteScroll) {
        $('.mtwriter-posts').infiniteScroll({
            path: '.pagination .next',
            append: 'article.entry-blog',
            status: '.scroller-status',
            hideNav: '.pagination',
        });
    }
});