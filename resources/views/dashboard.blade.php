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
              <!-- <form> -->
                <div class="row">
                  <!-- <div class="col-md-5">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Company (disabled)</label>
                      <input type="text" class="form-control" disabled="">
                    </div>
                  </div> -->
                  <!-- <div class="col-md-3">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Username</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Email address</label>
                      <input type="email" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Fist Name</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Last Name</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Adress</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">City</label>
                      <input type="text" class="form-control">
                    </div>
                  </div> -->
                  <div class="col-md-8">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Palabras clave</label>
                      <input type="text" class="form-control" id="palabras_clave">
                    </div>
                  </div>
                  <!-- <div class="col-md-4">
                    <div class="form-group bmd-form-group">
                      <label class="bmd-label-floating">Postal Code</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div> -->
                <!-- <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>About Me</label>
                      <div class="form-group bmd-form-group">
                        <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                        <textarea class="form-control" rows="5"></textarea>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-4">
                  <button type="submit" style="width: 100%" class="btn btn-success btn-sm pull-right" id="btn_palabras_clave" data-id="{{Auth::user()->id}}"> Buscar </button>
                </div>
                <div class="clearfix"></div>
              <!-- </form> -->
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row"> -->
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-success">
                <h4 class="card-title ">Detalles</h4>
                <p class="card-category"> Consultas realizadas</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <!-- <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('user.create') }}" class="btn btn-sm btn-success">{{ __('Add user') }}</a>
                  </div>
                </div> -->
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-success">
                      <tr>
                        <th>Palabras Clave</th>
                        <th>Fecha</th>
                        <th><center>Descargar</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($consultas as $con)
                        <tr>
                          <td>{{$con->palabras_clave}}</td>
                          <td>{{$con->fecha}}</td>
                          <td><center><a class="btn btn-warning btn-sm" id="descargarResultado" data-id="{{$con->id}}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Descargar resultado"><icons-image _ngcontent-rgp-c22="" _nghost-rgp-c19=""><i _ngcontent-rgp-c19="" class="material-icons icon-image-preview text-white">get_app</i></icons-image></a></center></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        <!-- </div> -->
      </div>
    </div>
  </div>  
@endsection

<!-- @push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush -->