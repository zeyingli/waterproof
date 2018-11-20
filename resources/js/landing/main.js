$(document).ready(function () {
    setTimeout(function () {
        $('.loader-logo').hide();
    }, 2000)
    
   $('.main-container').css('min-height', ($(window).height() - $('.wrapper > header').outerHeight() - $('.wrapper > .site-footer').outerHeight()  - 6 ) );
    
    
    /* hide header in iframe demo */

    if(window.top !== window.self) {
		$('.wrapper > header').hide();
        $('.wrapper').css('padding-top', '0');
	}
    
});
$(window).on('load', function () {
    $('.loader-logo').hide();
    $('.main-container').css('min-height', ($(window).height() - $('.wrapper > header').outerHeight() - $('.wrapper > .site-footer').outerHeight()  - 6 ) );
   
})
