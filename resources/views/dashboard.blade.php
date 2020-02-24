@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-success">
              <h4 class="card-title">Buscador</h4>
              <p class="card-category">Criterio de búsqueda</p>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Palabras clave</label>
                      <input type="text" class="form-control" id="palabras_clave">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <button type="submit" style="width: 100%" class="btn btn-success btn-sm pull-right" id="primeraConsulta"> Buscar </button> <!-- btn_palabras_clave -->
                  </div>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title ">Detalles</h4>
            <p class="card-category"> Búsqueda realizada  - filtros</p>
          </div>
          <div class="card-body">
            <div id="detalle"></div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title ">Detalles</h4>
            <p class="card-category"> Consultas realizadas</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-success">
                  <tr>
                    <th>Palabras Clave</th>
                    <th>Fecha</th>
                    <th>Filtro</th>
                    <th><center>Descargar</center></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($consultas as $con)
                    <tr>
                      <td>{{$con->palabras_clave}}</td>
                      <td>{{$con->fecha}}</td>
                      <td>{!!$con->filtros!!}</td>
                      <td><center><a class="btn btn-warning btn-sm" id="descargarResultado" data-id="{{$con->id}}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Descargar resultado"><icons-image _ngcontent-rgp-c22="" _nghost-rgp-c19=""><i _ngcontent-rgp-c19="" class="material-icons icon-image-preview text-white">get_app</i></icons-image></a></center></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
