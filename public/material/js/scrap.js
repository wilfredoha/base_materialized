$.ajaxSetup({
	headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
});

$(document).on('click', '#btn_palabras_clave', function(){

    var palabras_clave = $('#palabras_clave').val();
    var i_ide_usr = $(this).attr("data-id");

    if(palabras_clave == ""){
    	Swal.fire({icon: 'warning',title: 'Oops...',text: 'Debe ingresar palabras clave!'})
    	return;
    }

    $('#palabras_clave').val('');

    palabras_clave = palabras_clave.split(' ').join('%20');
	// $(this).prop("disabled", "true");

	$.ajax({
		type : 'POST',
        url  : 'buscarPalabras',
        data : { palabras_clave : palabras_clave, i_ide_usr : i_ide_usr },
		beforeSend: function(){
			Swal.fire({icon: 'info',title: 'Descarga en proceso',text: 'Recibirá un email cuando su búsqueda se haya finalizado'})
	    },
		success: function(data){

	    },
		error: function(data){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
		}
    });
});

$(document).on('click', '#descargarResultado', function(){
	var id_busqueda = $(this).attr('data-id');

	$.ajax({
		type : 'GET',
        url  : 'descargarResultado',
        data : { id_busqueda : id_busqueda },
		beforeSend: function(){
			
	    },
		success: function(data){
			window.open(this.url);
	    },
		error: function(data){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
		}
    });
});