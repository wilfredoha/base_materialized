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
			$('#detalle').html('');
			$("#overlay").fadeIn(300);　
	    },
		success: function(data){
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
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
	var filtroanio       = "<b>Año: </b>";
	var filtroidio       = "<b>Idioma: </b>";
	var filtrodisc       = "<b>Disciplina: </b>";
	var filtropais       = "<b>País: </b>";
	var filtro           = "";

    if(palabras_clave == ""){
    	Swal.fire({icon: 'warning',title: 'Oops...',text: 'Debe ingresar palabras clave!'})
    	return;
    }
    
    $.each($("input[name='anio']:checked"), function(){
        if (cadenaYear == "") {
        	cadenaYear = $(this).val();
        	filtroanio     = filtroanio + $(this).attr('data-nom');
        }else{
        	cadenaYear+="-"+$(this).val();
        	filtroanio     = filtroanio +  " - " + $(this).attr('data-nom');
        }
    });

    $.each($("input[name='idio']:checked"), function(){
        if (cadenaIdioma == "") {
        	cadenaIdioma = $(this).val();
        	filtroidio       = filtroidio + $(this).attr('data-nom');
        }else{
        	cadenaIdioma+="-"+$(this).val();
        	filtroidio       = filtroidio + " - " + $(this).attr('data-nom');
        }
    });
    
    $.each($("input[name='disc']:checked"), function(){
        if (cadenaDisciplina == "") {
        	cadenaDisciplina = $(this).val();
        	filtrodisc           = filtrodisc + $(this).attr('data-nom');
        }else{
        	cadenaDisciplina+="-"+$(this).val();
        	filtrodisc           = filtrodisc +  " - " + $(this).attr('data-nom');
        }
    });
    
    $.each($("input[name='pais']:checked"), function(){
        if(cadenaPais == ""){
			cadenaPais = $(this).val();
			filtropais     = filtropais + $(this).attr('data-nom');
		}else{
			cadenaPais+="-"+$(this).val();
			filtropais     = filtropais +  " - " + $(this).attr('data-nom');
		}
    });

    filtro = '"'+filtroanio + " <br> " + filtroidio + " <br> " + filtrodisc + " <br> " + filtropais+'"';
// alert(filtro);
// return;
	url = '"'+"service/r2020/getArticles/" + textoABuscar +"<<<"+cadenaYear+"<<<"+cadenaIdioma+"<<<"+cadenaDisciplina+"<<<"+cadenaPais+ "/paginador/50/0/default"+'"';
	
	$.ajax({
		type : 'POST',
        url  : 'buscarPalabras',
        data : { url: url, filtro : filtro, textoABuscar : textoABuscar },
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
			$("#overlay").fadeIn(300);
	    },
		success: function(data){
			setTimeout(function(){
				$("#overlay").fadeOut(300);
			},500);
			window.open(this.url);
	    },
		error: function(data){
            Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
		}
    });
});

$(document).on('click', '#modalCrearUsuario', function(){
	$('.modalCrearUsuario').modal("show");
});

$(document).on('click', '#btn_guardarUsuario', function(){
    var expre_reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	var usu_nom = $('#usu_nom').val();
	var usu_ema = $('#usu_ema').val();
	var usu_pas = $('#usu_pas').val();
	var usu_rol = $('#usu_rol').val();

	if (usu_nom == "" || usu_ema == "" || usu_pas == "" || usu_rol == "0") {
		Swal.fire({icon: 'warning',title: 'Atención!',text: 'Todos los campos son obligatorios!'})
		return;
	}

	if(!usu_ema.match(expre_reg))
	{
	    Swal.fire({icon: 'warning',title: 'Email Invalido!',text: 'Ingresa un Email apropiado!'})
	    return;
	}

	$.ajax({
	    type : 'POST',
	    data : {usu_nom : usu_nom, usu_ema : usu_ema, usu_pas : usu_pas, usu_rol : usu_rol},
	    url  : 'guardarUsuario',
	    beforeSend: function(){
	        $('.modalCrearUsuario').modal("hide");
	        $("#overlay").fadeIn(300);
	    },
	    success: function(data){
	        setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
	        Swal.fire({icon: 'success',title: 'Bien!',text: 'Usuario creado con éxito!'})
	        setTimeout(function(){ window.location.reload(true) }, 3000);

	    },
	    error: function(data){
	        setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
	        Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
	    }
	});
});

$(document).on('click', '#btn_editarUsu', function(){
	var ide_usr = $(this).attr('data-id');

	$.ajax({
        type : 'POST',
        data : {ide_usr : ide_usr},
        url  : 'editarUsuario',
        beforeSend: function(){
        	$("#overlay").fadeIn(300);
        },
        success: function(data){
        	setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
        	$('.modalEditarUsuario').modal("show");
        	$('#formEditarUsuario').html(data);
        },
        error: function(data){
        	setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
	        Swal.fire({icon: 'error',title: 'Oops...',text: 'Intente de nuevo!'})
        }
    });
});

$(document).on('click', '#btn_editarUsuario', function(){
	var expre_reg = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	var usu_nomE = $('#usu_nomE').val();
	var usu_emaE = $('#usu_emaE').val();
	var usu_limE = $('#usu_limE').val();
	var usu_rolE = $('#usu_rolE').val();
	var ide_usrE = $('#ide_usrE').val();

	if(usu_nomE == "" || usu_emaE == "" || usu_limE == "" || usu_rolE == "0") {
		Swal.fire({icon: 'warning',title: 'Atención!',text: 'Todos los campos son obligatorios!'})
		return;
	}

	if(!usu_emaE.match(expre_reg))
	{
	    Swal.fire({icon: 'warning',title: 'Email Invalido!',text: 'Ingresa un Email apropiado!'})
	    return;
	}

	$.ajax({
        type : 'POST',
        data : {usu_nomE:usu_nomE,usu_emaE:usu_emaE,usu_limE:usu_limE,usu_rolE:usu_rolE,ide_usrE:ide_usrE},
        url  : 'editarUsuarioFinal',
        beforeSend: function(){
        	$('.modalEditarUsuario').modal("hide");
        	$("#overlay").fadeIn(300);
        },
        success: function(data){
        	setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
        	Swal.fire({icon: 'success',title: 'Bien!',text: 'Usuario editado con éxito!'})
        	setTimeout(function(){ window.location.reload(true) }, 3000);
        },
        error: function(data){
        	setTimeout(function(){
	        	$("#overlay").fadeOut(300);
	        },500);
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