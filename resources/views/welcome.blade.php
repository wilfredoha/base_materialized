@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-12 col-md-12">
          <h2 class="text-white text-center"> Buscador de literatura científica en español </h2><br><br>
          <center>
	          <img src="{{ asset('material') }}/img/umanizales.png" height="180" style="margin-right: 100px;">
	          <img src="{{ asset('material') }}/img/semillero.png" height="180" style="margin-left: 100px">    	
          </center>
      </div>
  </div>
</div>
@endsection
