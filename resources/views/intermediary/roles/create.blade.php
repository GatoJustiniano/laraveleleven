@extends('layouts.master', ['activePage' => 'roles'])
@section('title', 'Crear nuevo rol')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body ">

        <form method="POST" action="{{ route('roles.store') }}" class="form-horizontal">
          @csrf
          
          <div class="form-group">
            <label for="name" class="form-label">Nombre del rol</label>
            <input type="text" class="form-control" name="name" 
              autocomplete="off" autofocus>
          </div>
          <label for="name" class="form-label mt-3">Permisos:</label>
          <div class="row ms-2">
                @foreach ($permissions as $id => $permission)
                  <div class="col-md-5 form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="permissions[]"
                    value="{{ $id }}">
                    <label class="form-check-label" >{{ $permission }}</label>
                  </div>
                @endforeach            
          </div>
          <button type="submit" class="btn btn-outline-success btn-lg mt-3">Guardar</button>
        </form>

      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <a href="{{ URL::previous() }}" class="btn btn-label-secondary d-grid w-100 mb-3">
          Retroceder
        </a>
        <a href="{{ route('permissions.create') }}" class="btn btn-label-secondary d-grid w-100 mb-3">
          Crear nuevo permiso
        </a>
      </div>
    </div>
  </div>
</div>
@endsection