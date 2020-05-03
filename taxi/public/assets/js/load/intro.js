$(function() {

    // Run transitions
    $( document ).ready(function() {

        // Get animation class and panel
        var transition = 'flipBounceXIn';

        // Add animation class to panel element
        $(".panel").velocity("transition." + transition, { 
        	stagger: 500,
        	duration: 500
		});
    });

    // Run animations
    $('.panel').mouseenter(function() {

        // Get animation class and panel
        var animation = 'pulse';

        // Add animation class to panel element
        $(this).velocity("callout." + animation, { stagger: 500 });
        $('.velocity-transition').parents('.panel').removeAttr('style');
    });

});