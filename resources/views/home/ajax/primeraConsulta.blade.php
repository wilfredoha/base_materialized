<h4>Criterio de búsqueda: {{$pal_bus}} - Total resultados: {{$totalResultados}}</h4>
<hr>
<h4>Seleccione los años</h4><br>
<div class="row">
	@foreach($anios as $a)
		<div class="col-md-3">
			<input type="checkbox" name="anio" value="{{$a['clave']}}" data-nom="{{$a['nombre']}}"><label> {{$a['nombre']}} ({{$a['total']}})</label>
		</div>
	@endforeach
</div>
<hr>
<h4>Seleccione los idiomas</h4><br>
<div class="row">
	@foreach($idioma as $i)
		<div class="col-md-3">
		  	<input type="checkbox" name="idio" value="{{$i['clave']}}" data-nom="{{$i['nombre']}}"><label> {{$i['nombre']}} ({{$i['total']}})</label>
		</div>
	@endforeach	
</div>
<hr>
<h4>Seleccione las disciplinas</h4><br>
<div class="row">
	@foreach($disciplina as $d)
		<div class="col-md-4">
		  	<input type="checkbox" name="disc" value="{{$d['clave']}}" data-nom="{{$d['nombre']}}"><label> {{$d['nombre']}} ({{$d['total']}})</label>
		</div>
	@endforeach
</div>
<hr>
<h4>Seleccione los países</h4><br>
<div class="row">
	@foreach($pais as $p)
		<div class="col-md-3">
		  	<input type="checkbox" name="pais" value="{{$p['clave']}}" data-nom="{{$p['nombre']}}"><label> {{$p['nombre']}} ({{$p['total']}})</label>
		</div>
	@endforeach	
</div>
<hr>
<div class="col-md-4">
    <button type="submit" style="width: 100%" class="btn btn-success btn-sm float-right" id="btn_busqueda_filtro" data-id="{{Auth::user()->id}}"> Consultar </button>
</div>

<input type="hidden" id="pal_cla" value="{{$palabras_clave}}">

<style type="text/css">
	/*.prueba + label {
	  display: block;
	  margin: 0.2em;
	  cursor: pointer;
	  padding: 0.2em;
	}

	.prueba {
	  display: none;
	}

	.prueba + label:before {
	  content: "\2714";
	  border: 0.1em solid #000;
	  border-radius: 0.2em;
	  display: inline-block;
	  width: 1em;
	  height: 1em;
	  padding-left: 0.2em;
	  padding-bottom: 0.3em;
	  margin-right: 0.2em;
	  vertical-align: bottom;
	  color: transparent;
	  transition: .2s;
	}

	.prueba + label:active:before {
	  transform: scale(0);
	}

	.prueba:checked + label:before {
	  background-color: MediumSeaGreen;
	  border-color: MediumSeaGreen;
	  color: #fff;
	}

	.prueba:disabled + label:before {
	  transform: scale(1);
	  border-color: #aaa;
	}

	.prueba:checked:disabled + label:before {
	  transform: scale(1);
	  background-color: #bfb;
	  border-color: #bfb;
	}*/
</style>