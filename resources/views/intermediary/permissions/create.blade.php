@extends('layouts.master', ['activePage' => 'permissions'])
@section('title', 'Crear nuevo permiso')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body ">

        <form method="POST" action="{{ route('permissions.store') }}" class="form-horizontal">
          @csrf
          
          <div class="form-group">
            <label for="name" class="form-label">Nombre del permiso</label>
            <input type="text" class="form-control" name="name" 
              autocomplete="off" autofocus>
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
        <a href="{{ route('roles.index') }}" class="btn btn-label-secondary d-grid w-100 mb-3">
          Lista de roles
        </a>
      </div>
    </div>
  </div>
</div>
@endsection