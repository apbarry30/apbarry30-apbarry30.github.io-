/*
 * Copyright (c) 2019. OGK Creative
 */

jQuery(document).ready(function($) {

    // OWL CAROUSEL

    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        pagination: false,
        nav: false,
        rewindSpeed: 500
    });


    // Mobile Header
    $(".hamburger").on("click", function() {
        $(this).toggleClass("open");
        $(".site-content").toggleClass("open");
        $(".nav-menu").toggleClass("open");
    });




});

