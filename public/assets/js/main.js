$(document).ready(function() {
    // Mobile Menu Toggle
    $('#menuToggle').on('click', function() {
        $('#mainNav').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close menu when clicking a link (optional)
    $('#mainNav a').on('click', function() {
        if ($(window).width() <= 768) {
            $('#mainNav').removeClass('active');
            $('#menuToggle i').addClass('fa-bars').removeClass('fa-times');
        }
    });

    // Sticky Header
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.site-header').addClass('sticky');
        } else {
            $('.site-header').removeClass('sticky');
        }
    });
});
