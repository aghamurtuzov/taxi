$(function() {

    // Run transitions
    $( document ).ready(function() {

        // Get animation class and panel
        var transition = 'flipBounceXIn';

        // Add animation class to panel element
        $(".panel").velocity("transition." + transition, { 
        	stagger: 1000,
        	duration: 1000
		});
    });
});