<h4>Criterio de búsqueda: {{$pal_bus}} - Total resultados: {{$totalResultados}}</h4>
<hr>
<h4>Seleccione los años</h4><br>
<div class="row">
	@foreach($anios as $a)
		<div class="col-md-3">
		  	<input type="checkbox" name="anio" value="{{$a['clave']}}" data-nom="{{$a['nombre']}}"> {{$a['nombre']}} ({{$a['total']}})
		</div>
	@endforeach
</div>
<hr>
<h4>Seleccione los idiomas</h4><br>
<div class="row">
	@foreach($idioma as $i)
		<div class="col-md-3">
		  	<input type="checkbox" name="idio" value="{{$i['clave']}}" data-nom="{{$i['nombre']}}"> {{$i['nombre']}} ({{$i['total']}})
		</div>
	@endforeach	
</div>
<hr>
<h4>Seleccione las disciplinas</h4><br>
<div class="row">
	@foreach($disciplina as $d)
		<div class="col-md-4">
		  	<input type="checkbox" name="disc" value="{{$d['clave']}}" data-nom="{{$d['nombre']}}"> {{$d['nombre']}} ({{$d['total']}})
		</div>
	@endforeach
</div>
<hr>
<h4>Seleccione los países</h4><br>
<div class="row">
	@foreach($pais as $p)
		<div class="col-md-3">
		  	<input type="checkbox" name="pais" value="{{$p['clave']}}" data-nom="{{$p['nombre']}}"> {{$p['nombre']}} ({{$p['total']}})
		</div>
	@endforeach	
</div>
<hr>
<div class="col-md-4">
    <button type="submit" style="width: 100%" class="btn btn-success btn-sm float-right" id="btn_busqueda_filtro" data-id="{{Auth::user()->id}}"> Consultar </button>
</div>

<input type="hidden" id="pal_cla" value="{{$palabras_clave}}">

<style type="text/css"></style>