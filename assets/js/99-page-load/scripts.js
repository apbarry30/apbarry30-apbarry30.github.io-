/*
 * Copyright (c) 2019. OGK Creative
 */

jQuery(document).ready(function($) {

    // Mobile Header
    $(".hamburger").on("click", function() {
        $(this).toggleClass("open");
        $(".site-content").toggleClass("open");
        $(".nav-menu").toggleClass("open");
        $('body').toggleClass('fixed');
    });
    // IN VIEW ANIMATIONS
    let fadeInSpeed = 700;

    $('.inview-fadeUp').on('inview', function (event, isInView) {
        if (isInView) {
            // element is now visible in the viewport
            $(this).addClass("fadeUp");
        } else {
            // element has gone out of viewport
        }
    });

    // $('.projects-text').on('inview', function(event, IsInView){
    //     if (isInView) {
    //         // element is now visible in the viewport
    //         $(this).addClass('fixed');
    //     } else {
    //         // element has gone out of viewport
    //     }
    // });

    $('.portfolio-item').on('click', function(){
       target =  $(this).data('name');
       openPop = "." + target;
       memberPopup = $('.port-popup');
       $(openPop).addClass('open');
       $('body').addClass("fixed");
    });
    $('.x').on('click', function(){
        $('.port-popup').removeClass('open');
        $('body').removeClass('fixed');
    })
    $('body.fixed').on('click', function(){
        $('body').removeClass('fixed');
        $('.port-popup').removeClass('open');
    });

    $('.nav-name').on('mouseover', function(){
        $('.animate').removeClass('active');
        target =  $(this).data('name');
        navItem = "." + target;
        $(navItem).addClass('active');
    });
    $('.nav-name').on('mouseleave', function(){
        $('.animate').removeClass('active');
        $('.home').addClass('active');
    });

    return $(".print").typeText({
            then: function() {
                return this.typeText(".......................", {
                    typeSpeed: 250,
                });
            }
        });



});


