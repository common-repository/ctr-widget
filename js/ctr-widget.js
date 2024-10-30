jQuery(document).ready(function($) {
    function isScrolledTo(elem) {
        var docViewTop = $(window).scrollTop(); //num of pixels hidden above current screen
        var docViewBottom = docViewTop + $(window).height();
        var elemTop = $(elem).offset().top; //num of pixels above the elem
        var elemBottom = elemTop + $(elem).height();
        return ((elemTop <= docViewTop));
    }
    var catcher = $('#ctr_widget-2-catch');
    var sticky = $('#ctr_widget-2');
    var widget_width = sticky.width();
    $(window).scroll(function() {
        if(isScrolledTo(sticky)) {
            sticky.css('position','fixed');
            sticky.css('top','0px');
            sticky.css('width', widget_width);
        }
        var stopHeight = catcher.offset().top + catcher.height();
        if ( stopHeight > sticky.offset().top) {
            sticky.css('position','absolute');
            sticky.css('top',stopHeight);
        }
    });
});