/*
 * Copyright (c) 2019. OGK Creative
 */

jQuery(document).ready(function($) {
        //slider
    $('.slider').slick({
            dots:false,
            slidesToScroll:1,
            slidesToShow: 1,
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            centerPadding:50,
            centerMode: true,
    });

    $('.button--bubble').each(function() {
        var $circlesTopLeft = $(this).parent().find('.circle.top-left');
        var $circlesBottomRight = $(this).parent().find('.circle.bottom-right');

        var tl = new TimelineLite();
        var tl2 = new TimelineLite();

        var btTl = new TimelineLite({ paused: true });

        tl.to($circlesTopLeft, 1.2, { x: -25, y: -25, scaleY: 2, ease: SlowMo.ease.config(0.1, 0.7, false) });
        tl.to($circlesTopLeft.eq(0), 0.1, { scale: 0.2, x: '+=6', y: '-=2' });
        tl.to($circlesTopLeft.eq(1), 0.1, { scaleX: 1, scaleY: 0.8, x: '-=10', y: '-=7' }, '-=0.1');
        tl.to($circlesTopLeft.eq(2), 0.1, { scale: 0.2, x: '-=15', y: '+=6' }, '-=0.1');
        tl.to($circlesTopLeft.eq(0), 1, { scale: 0, x: '-=5', y: '-=15', opacity: 0 });
        tl.to($circlesTopLeft.eq(1), 1, { scaleX: 0.4, scaleY: 0.4, x: '-=10', y: '-=10', opacity: 0 }, '-=1');
        tl.to($circlesTopLeft.eq(2), 1, { scale: 0, x: '-=15', y: '+=5', opacity: 0 }, '-=1');

        var tlBt1 = new TimelineLite();
        var tlBt2 = new TimelineLite();

        tlBt1.set($circlesTopLeft, { x: 0, y: 0, rotation: -45 });
        tlBt1.add(tl);

        tl2.set($circlesBottomRight, { x: 0, y: 0 });
        tl2.to($circlesBottomRight, 1.1, { x: 30, y: 30, ease: SlowMo.ease.config(0.1, 0.7, false) });
        tl2.to($circlesBottomRight.eq(0), 0.1, { scale: 0.2, x: '-=6', y: '+=3' });
        tl2.to($circlesBottomRight.eq(1), 0.1, { scale: 0.8, x: '+=7', y: '+=3' }, '-=0.1');
        tl2.to($circlesBottomRight.eq(2), 0.1, { scale: 0.2, x: '+=15', y: '-=6' }, '-=0.2');
        tl2.to($circlesBottomRight.eq(0), 1, { scale: 0, x: '+=5', y: '+=15', opacity: 0 });
        tl2.to($circlesBottomRight.eq(1), 1, { scale: 0.4, x: '+=7', y: '+=7', opacity: 0 }, '-=1');
        tl2.to($circlesBottomRight.eq(2), 1, { scale: 0, x: '+=15', y: '-=5', opacity: 0 }, '-=1');

        tlBt2.set($circlesBottomRight, { x: 0, y: 0, rotation: 45 });
        tlBt2.add(tl2);

        btTl.add(tlBt1);
        btTl.to($(this).parent().find('.button.effect-button'), 0.8, { scaleY: 1.1 }, 0.1);
        btTl.add(tlBt2, 0.2);
        btTl.to($(this).parent().find('.button.effect-button'), 1.8, { scale: 1, ease: Elastic.easeOut.config(1.2, 0.4) }, 1.2);

        btTl.timeScale(2.6);

        $(this).on('mouseover', function() {
            btTl.restart();
        });
    });

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
//default JS Setting
var rellax = new Rellax('.rellax', {
    breakpoints:[576, 768, 1201]
});

