jQuery(window).load(function() {
	var windowSize = $(window).width(); 
	if(windowSize < 661){
		 jQuery('body').addClass('smartphone');
	}
	if (jQuery('.messaggio').length > 0) { 
	setTimeout(
	    function(){
		   jQuery('.messaggio').hide('slow');
	    },
	    3000
	  );
	}
});