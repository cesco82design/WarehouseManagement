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
/*
 var DLElements = [];
    $("input").keydown(function(e) {
        // if <LF><CR> is detected, break the line
        if(e.ctrlKey && e.which == 17) {
        DLElements.push( $("#barcode").val() );
        $("#barcode").val( "" );
        e.preventDefault(); 
        }
        // Listen for <CTRL> J
        if(e.ctrlKey && e.which == 74) {
        e.preventDefault(); 
        }
        // Listen for <CTRL> M Mute
        if(e.ctrlKey && e.which == 77) {
        e.preventDefault(); 
        }

    });
    var holding_ctrl = false;

	$("input").keydown(function(e){
	    if(e.which==17){
	        holding_ctrl = true;
	    }
	}); 

	$("input").keyup(function(e){
	    if(e.which==17){
	        holding_ctrl = false;
	    }
	}); 


	$("input").keydown(function(e){
	    if(holding_ctrl && e.which==74){
	        e.preventDefault();
	    }else{
	        console.log(e.which);
	    }
	});
	*/

    $("#barcode").keydown(function(e){
        //if(e.which==17||e.which==13||e.which==74){
        if(e.which==13||e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    });
$('#barcode').on('change', function(event){console.log(event); });
    jQuery(".imgLiquidFill").imgLiquid({
	    fill: true,
	    horizontalAlign: "center",
	    verticalAlign: "50%"
	});
});