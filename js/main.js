jQuery(function ($) {
    "use strict";
    /* ---------------------------------------------
    Menu Toggle 
    ------------------------------------------------ */
    $('.nav-toggler').click(function(){
        $('.main-menu').toggleClass('show');
    });

    /* ---------------------------------------------
    Mobile Menus
    ------------------------------------------------ */

    $('li.menu-item-has-children').append('<span/>');
    $('li.menu-item-has-children span').click(function(){
        $(this).parent().toggleClass('open');
    });


    /* ---------------------------------------------
    Site Search 
    ------------------------------------------------ */    
  
    $('.search-link span[class*="search"]').click(function(){
        $('.search-link .search-form').toggleClass('active');
    });

    /* post grid image color */
    $(".post-grid-image").each(function () {
        var postcolol = $(this).data('color');
        $(this).css("background-color", postcolol);
    });

    /* ---------------------------------------------
    Preloader
    ------------------------------------------------ */
    $(document).ready( function() {
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
    $('.mtwriter-posts').infiniteScroll({
        path: '.pagination .next',
        append: 'article.entry-blog',
        status: '.scroller-status',
        hideNav: '.pagination',
    });
    
});