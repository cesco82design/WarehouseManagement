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
    $("input").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});