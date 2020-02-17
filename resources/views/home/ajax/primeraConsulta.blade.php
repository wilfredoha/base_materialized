<h4>Criterio de búsqueda: {{$pal_bus}} - Total resultados: {{$totalResultados}}</h4>
<hr>
<div class="row">
	@foreach($anios as $a)
		<div class="col-md-3">
			<label class="container">{{$a['nombre']}} ({{$a['total']}})
			  	<input type="checkbox" name="anio" value="{{$a['clave']}}" data-nom="{{$a['nombre']}}">
			  	<span class="checkmark"></span>
			</label>
			<!-- <input type="checkbox" name="anio" value="{{$a['clave']}}" data-nom="{{$a['nombre']}}"> {{$a['nombre']}} ({{$a['total']}}) -->
		</div>
	@endforeach
</div>
<hr>
<div class="row">
	@foreach($idioma as $i)
		<div class="col-md-3">
			<label class="container">{{$i['nombre']}} ({{$i['total']}})
			  	<input type="checkbox" name="idio" value="{{$i['clave']}}" data-nom="{{$i['nombre']}}"> 
			  	<span class="checkmark"></span>
			</label>
		</div>
	@endforeach	
</div>
<hr>
<div class="row">
	@foreach($disciplina as $d)
		<div class="col-md-4">
			<label class="container">{{$d['nombre']}} ({{$d['total']}})
			  	<input type="checkbox" name="disc" value="{{$d['clave']}}" data-nom="{{$d['nombre']}}"> 
			  	<span class="checkmark"></span>
			</label>
		</div>
	@endforeach
</div>
<hr>
<div class="row">
	@foreach($pais as $p)
		<div class="col-md-3">
			<label class="container">{{$p['nombre']}} ({{$p['total']}})
			  	<input type="checkbox" name="pais" value="{{$p['clave']}}" data-nom="{{$p['nombre']}}"> 
			  	<span class="checkmark"></span>
			</label>
		</div>
	@endforeach	
</div>
<hr>
<div class="col-md-4">
    <button type="submit" style="width: 100%" class="btn btn-success btn-sm float-right" id="btn_busqueda_filtro" data-id="{{Auth::user()->id}}"> Consultar </button>
</div>

<input type="hidden" id="pal_cla" value="{{$palabras_clave}}">