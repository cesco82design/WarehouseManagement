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
	var d = new Date();
	var n = d.getFullYear();
	var m = d.getYear() + 1882;
	jQuery('.datepicker').datepicker({
        inline: true,
		//dateFormat: 'dd/mm/yy',
		monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
		monthNamesShort: [ "Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic" ],
		dayNames: [ "Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato" ],
		dayNamesMin: [ "Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa" ],
		dayNamesShort: [ "Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab" ],
		dateFormat: 'mm/dd/yy',
		changeYear: true,
		yearRange: '1950:' + m
  	});
    $("#barcode").keydown(function(e){
        //if(e.which==17||e.which==13||e.which==74){
        if(e.which==13||e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    });
	//$('#barcode').on('change', function(event){console.log(event); });
	$("#reg_dipendente").change(function() {
	        //$('.reg_mi').fadeToggle();		//toggle fadeIn/fadeOut
	        $('.reg_mi').slideToggle();			//toggle effetto slide
	    /*if(this.checked) {				//questo con un normale if + else
	  	    $('.reg_mi').fadeIn();
	    } else {
	    	$('.reg_mi').fadeOut();
	    }*/
	});
    jQuery(".imgLiquidFill").imgLiquid({
	    fill: true,
	    horizontalAlign: "center",
	    verticalAlign: "50%"
	});
});