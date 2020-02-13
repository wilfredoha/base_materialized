var filtros;
var totalResultados;
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

$(document).on('click', '#primeraConsulta', function(){
	var palabras_clave = $('#palabras_clave').val();

	if(palabras_clave == ""){
    	Swal.fire({icon: 'warning',title: 'Oops...',text: 'Debe ingresar palabras clave!'})
    	return;
    }

    palabras_clave = palabras_clave.split(' ').join('%20');

	$.ajax({
		type : 'POST',
        url  : 'primeraConsulta',
        data : { palabras_clave : palabras_clave },
		beforeSend: function(){
			
	    },
		success: function(data){
			$('#detalle').html(data);
	    },
		error: function(data){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
		}
    });



	// $.ajax({
	// 	url: 'https://www.redalyc.org/service/r2020/getArticles/'+ palabras_clave + '%3C%3C%3C%3C%3C%3C1%3C%3C%3C%3C%3C%3C/1/50/0/default',
	// 	type : 'GET',
	// 	crossDomain: true,
	// 	dataType: "json",
	// 	headers:{
	// 		'Access-Control-Allow-Origin':'*',
	// 		'Access-Control-Allow-Methods':'GET, POST, PATCH, PUT, DELETE, OPTIONS',
	// 		'Access-Control-Allow-Headers':'Origin, Content-Type, X-Auth-Token'
	// 	},
	// 	beforeSend: function(){
			
	//     },
	// 	success: function(data){
	// 		$('$detalle').html(data);
	//     },
	// 	error: function(data){
 //            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
	// 	}
 //    });
 	
 	// const proxyurl = "https://cors-anywhere.herokuapp.com/";
 	// const url = 'https://www.redalyc.org/service/r2020/getArticles/'+ palabras_clave + '/1/10/1/default'; // site that doesn’t send Access-Control-*
 	// fetch(proxyurl + url) // https://cors-anywhere.herokuapp.com/https://example.com
 	// .then(response => response.text())
 	// .then(contents => prueba(JSON.parse(contents)))
 	// // .then(contents => console.log(contents))
 	// .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))


});

function prueba(arreglo){
	filtros = arreglo.filtros;
	totalResultados = arreglo.totalResultados;
	for(i=0; i<filtros.length; i++){
		console.log(filtros[i])
		console.log("")
	}
	filtros.forEach( function(valor, indice, array) {
	    console.log("En el índice " + indice + " hay este valor: " + valor);
	});
}