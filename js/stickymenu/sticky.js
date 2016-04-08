$('nav li a').on('click', function() {

    var scrollAnchor = $(this).attr('data-scroll'),
        scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 45;

    $('body,html').animate({
        scrollTop: scrollPoint
    }, 500);

    return false;

})


$(window).scroll(function() {
    var windscroll = $(window).scrollTop();
    if (windscroll >= 750) {
        $('nav').addClass('fixed');
        $('section').each(function(i) {
            if ($(this).position().top <= windscroll - -100) {
                $('nav li a.active').removeClass('active');
                $('nav li a').eq(i).addClass('active');
            }
        });

    } else {

        $('nav').removeClass('fixed');
        $('nav li a.active').removeClass('active');
        $('nav li a:first').addClass('active');
    }

}).scroll();