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




});

