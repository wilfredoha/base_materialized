var filtros;
var totalResultados;
$.ajaxSetup({
	headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
});

//búsqueda inicial para obtener filtros
$(document).on('click', '#primeraConsulta', function(){
	var palabras_clave = $('#palabras_clave').val();
	var pal_bus        = $('#palabras_clave').val();

	if(palabras_clave == ""){
    	Swal.fire({icon: 'warning',title: 'Oops...',text: 'Debe ingresar palabras clave!'})
    	return;
    }

    palabras_clave = palabras_clave.split(' ').join('%20');

	$.ajax({
		type : 'POST',
        url  : 'primeraConsulta',
        data : { palabras_clave : palabras_clave, pal_bus : pal_bus },
		beforeSend: function(){
			$('#palabras_clave').val('');
	    },
		success: function(data){
			$('#detalle').html(data);
	    },
		error: function(data){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
		}
    });
});

$(document).on('click', '#btn_busqueda_filtro', function(){

    var textoABuscar     = $('#pal_cla').val();
    var cadenaPais       = "";
    var cadenaYear       = "";
    var cadenaIdioma     = "";
	var cadenaDisciplina = "";
	var url              = "";

    if(palabras_clave == ""){
    	Swal.fire({icon: 'warning',title: 'Oops...',text: 'Debe ingresar palabras clave!'})
    	return;
    }
    
    $.each($("input[name='anio']:checked"), function(){
        if (cadenaYear == "") {
        	cadenaYear = $(this).val();
        }else{
        	cadenaYear+="-"+$(this).val();
        }
    });

    $.each($("input[name='idio']:checked"), function(){
        if (cadenaIdioma == "") {
        	cadenaIdioma = $(this).val();
        }else{
        	cadenaIdioma+="-"+$(this).val();
        }
    });

    $.each($("input[name='disc']:checked"), function(){
        if (cadenaDisciplina == "") {
        	cadenaDisciplina = $(this).val();
        }else{
        	cadenaDisciplina+="-"+$(this).val();
        }
    });

    $.each($("input[name='pais']:checked"), function(){
        if(cadenaPais == ""){
			cadenaPais = $(this).val();
		}else{
			cadenaPais+="-"+$(this).val();
		}
    });

	url = "service/r2020/getArticles/" + textoABuscar +"<<<"+cadenaYear+"<<<"+cadenaIdioma+"<<<"+cadenaDisciplina+"<<<"+cadenaPais+ "/" + 1 + "/" + 50 + "/1/default";
	
	$.ajax({
		type : 'POST',
        url  : 'buscarPalabras',
        data : { url: url },
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