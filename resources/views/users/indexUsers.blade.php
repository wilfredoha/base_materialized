@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])

@section('content')

 <!-- Ventana modal creación de usuarios -->
  <div class="modal fade modalCrearUsuario" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Crear Usuario</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body formUsuAdmin">
             <div class="row">
               <div class="form-group col-md-12">
                   <input type="text" class="form-control form-control-sm" id="usu_nom" placeholder="Nombres y Apellidos del usuario">
               </div>

               <div class="form-group col-md-12">
                   <input type="text" class="form-control form-control-sm" id="usu_ema" placeholder="E-mail del usuario">
               </div>
               <div class="form-group col-md-12">
                   <input type="text" class="form-control form-control-sm" id="usu_pas" placeholder="Contraseña">
               </div>
               <div class="form-group col-md-12">
                   <select class="form-control form-control-sm" id="usu_rol">
                       <option value="0">Rol --</option>
                       @foreach($roles as $rol)
                           <option value="{{$rol->id}}">{{$rol->display_name}}</option>
                       @endforeach
                   </select>
               </div>
             </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn_guardarUsuario">Crear</button>
            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Ventana modal editar de usuarios -->
   <div class="modal fade modalEditarUsuario" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
     <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
       <div class="modal-content">
         <div class="modal-header">
             <h6 class="modal-title" id="modal-title-default">Crear Usuario</h6>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">×</span>
             </button>
         </div>
         <div class="modal-body" id="formEditarUsuario">

         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-success" id="btn_editarUsuario">Crear</button>
             <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-success">
                <h4 class="card-title ">Usuarios</h4>
                <p class="card-category"> Manejo de Usuarios</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a id="modalCrearUsuario" class="btn btn-sm btn-success text-white">Agregar Usuario</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-success">
                      <th>
                          Nombre
                      </th>
                      <th>
                        Email
                      </th>
                      <th class="text-center">
                        Acciones
                      </th>
                    </thead>
                    <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>
                            {{ $user->name }}
                          </td>
                          <td>
                            {{ $user->email }}
                          </td>
                          <td class="td-actions text-right">
                            <center><a class="btn btn-success text-white" id="btn_editarUsu" data-id="{{ $user->id }}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Editar usuario"><icons-image _ngcontent-cdb-c22="" _nghost-cdb-c19=""><i _ngcontent-cdb-c19="" class="material-icons icon-image-preview">create</i></icons-image></a></center>
                          </td>
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
  </div>
@endsection