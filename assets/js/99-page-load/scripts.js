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
    fadeInSpeed = 700;

    $('.inview-fadeUp').on('inview', function (event, isInView) {
        if (isInView) {
            // element is now visible in the viewport
            $(this).addClass("fadeUp");
        } else {
            // element has gone out of viewport
        }
    });


    $('.portfolio-item').on('click', function(){
       var target =  $(this).data('name');
       var openPop = "." + target;
       var memberPopup = $('.port-popup');
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
        var target =  $(this).data('name');
        var navItem = "." + target;
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

var scrollObject = {
    y: window.pageYOffset
}

var getScrollPosition = (e) => {

    var prevY = scrollObject.y

    scrollObject = {
        y: window.pageYOffset
    }

    if(scrollObject.y > 5) {
        document.body.classList.add('scrolled')
        if(prevY >= scrollObject.y) {
            document.body.classList.add('scrolled-up')
        }
        else {
            document.body.classList.remove('scrolled-up')
        }
    } else {
        document.body.classList.remove('scrolled','scrolled-up')
    }
}

window.onscroll = getScrollPosition

//default JS Setting
// var rellax = new Rellax('.rellax', {
//     breakpoints:[576, 768, 1201]
// });

