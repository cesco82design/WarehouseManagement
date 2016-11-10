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
	var y = n-18;
	var z = n-3;
	//var m = d.getYear() + 1882;
	//var t = d.getYear() + y;
	//alert(n);
	//alert(y);

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
		yearRange: '1950:' + y
  	});
	jQuery('.datatrattamento').datepicker({
        inline: true,
		//dateFormat: 'dd/mm/yy',
		monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
		monthNamesShort: [ "Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic" ],
		dayNames: [ "Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato" ],
		dayNamesMin: [ "Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa" ],
		dayNamesShort: [ "Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab" ],
		dateFormat: 'mm/dd/yy',
  	});
	jQuery('.datacliente').datepicker({
        inline: true,
		//dateFormat: 'dd/mm/yy',
		monthNames: ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'],
		monthNamesShort: [ "Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic" ],
		dayNames: [ "Domenica", "Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato" ],
		dayNamesMin: [ "Do", "Lu", "Ma", "Me", "Gi", "Ve", "Sa" ],
		dayNamesShort: [ "Dom", "Lun", "Mar", "Mer", "Gio", "Ven", "Sab" ],
		dateFormat: 'mm/dd/yy',
		changeYear: true,
		yearRange: '1930:' + z
  	});
    $(".barcode_input").keydown(function(e){
        //if(e.which==17||e.which==13||e.which==74){
        if(e.which==13||e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    });
	//$('#barcode').on('change', function(event){console.log(event); });
	$("#reg_dipendente").change(function() {
				//toggle effetto slide
	         var $this = $('#reg_dipendente');
	         var $required = $('.reg_mi input');
	        //$('.reg_mi').fadeToggle();		//toggle fadeIn/fadeOut
	        $('.reg_mi').slideToggle();			//toggle effetto slide
    		$this.is(":checked") ? $required.prop('required', 'true') : $required.removeProp('required')
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
	jQuery("#search_client").click(function(){
		jQuery("#form_search").slideToggle();
	});
	$('.selectpicker').selectpicker();
	if (jQuery('.add_scheda_cliente').length > 0) { 
		$('input[name="add_scheda"]').on('change', function(){
		    if ($(this).val()=='cliente') {		         
		         $("#cliente").show();
		         $("#card").hide();
		    } else  {
		         $("#cliente").hide();
		         $("#card").show();
		    }
		});
		$('input[name="trattamento"]').on('change', function(){
		    if ($(this).val()=='select') {		         
		         $("#trattamentos").show();
		         $("#trattamentom").hide();
		    } else  {
		         $("#trattamentos").hide();
		         $("#trattamentom").show();
		    }
		});
		$('.prod_input').click(function() {
		    if( $(this).is(':checked')) {
		        $("#prodotti").fadeIn();
		    } else {
		        $("#prodotti").fadeOut();
		    }
		}); 
		$('.more_input').click(function() {
			$('<div class="col-xs-12 col-sm-6"><input type="text" name="barcode[]" placeholder="Inserisci il barcode del prodotto" class="barcode_input col-xs-12" /></div>').appendTo('.other_input');
		});
	}
	if (jQuery('#loginform').length > 0 ) {
		jQuery('#user').focus();
	}
});