<div class="row">
  <div class="form-group col-md-12">
      <input type="text" class="form-control form-control-sm" id="usu_nomE" placeholder="Nombres y Apellidos del usuario" value="{{$user->name}}">
  </div>

  <div class="form-group col-md-12">
      <input type="text" class="form-control form-control-sm" id="usu_emaE" placeholder="E-mail del usuario" value="{{$user->email}}">
  </div>
  <div class="form-group col-md-12">
      <input type="number" class="form-control form-control-sm" id="usu_limE" min="50" placeholder="Límite de búsqueda" value="{{$user->limite}}">
  </div>
  <div class="form-group col-md-12">
      <select class="form-control form-control-sm" id="usu_rolE">
        <option value="0">Rol --</option>
        @foreach($roles as $rol)
          <option value="{{$rol->id}}" @if($user->role_id == $rol->id) selected @endif>{{$rol->display_name}}</option>
        @endforeach
      </select>
  </div>
</div>
<input type="hidden" id="ide_usrE" value="{{$ide_usr}}">