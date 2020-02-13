{{$totalResultados}}
<hr>
<div class="row">
	@foreach($anios as $a)
		<div class="col-md-3">
			<input type="checkbox" name="anio" value="{{$a['clave']}}"> {{$a['nombre']}} ({{$a['total']}})
		</div>
	@endforeach
</div>
<hr>
<div class="row">
	@foreach($idioma as $i)
		<div class="col-md-3">
			<input type="checkbox" name="idio" value="{{$i['clave']}}"> {{$i['nombre']}} ({{$i['total']}})
		</div>
	@endforeach	
</div>
<hr>
<div class="row">
	@foreach($disciplina as $d)
		<div class="col-md-4">
			<input type="checkbox" name="disc" value="{{$d['clave']}}"> {{$d['nombre']}} ({{$d['total']}})
		</div>
	@endforeach
</div>
<hr>
<div class="row">
	@foreach($pais as $p)
		<div class="col-md-3">
			<input type="checkbox" name="pais" value="{{$p['clave']}}"> {{$p['nombre']}} ({{$p['total']}})
		</div>
	@endforeach	
</div>
<hr>
<div class="col-md-4">
    <button type="submit" style="width: 100%" class="btn btn-success btn-sm float-right" id="btn_palabras_clave" data-id="{{Auth::user()->id}}"> Consultar </button>
</div>