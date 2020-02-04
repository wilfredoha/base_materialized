$.ajaxSetup({
	headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
});

$(document).on('click', '#btn_palabras_clave', function(){

    var palabras_clave = $('#palabras_clave').val();
    var i_ide_usr = $(this).attr("data-id");

    palabras_clave = palabras_clave.split(' ').join('%20');

    
	$.ajax({
		type : 'POST',
        url  : 'buscarPalabras',
        data : { palabras_clave : palabras_clave, i_ide_usr : i_ide_usr },
		beforeSend: function(){
		    // $('#dimmer').css("display", "block");
	    },
		success: function(data){
			// $('#dimmer').css("display", "none");
            // $('#detalleVencidos').html(data);
            alert(data);
	    },
		error: function(data){
            // $('#dimmer').css("display", "none");
            alert("Error");
		}
    });

});