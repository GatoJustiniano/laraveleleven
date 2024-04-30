@extends('layouts.master', ['activePage' => 'permissions'])
@section('title', 'Listado de Permisos')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div
                class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                <h5 class="card-title mb-sm-0 me-2">Listado de Permisos</h5>
                <div class="action-btns">
                    <a class="btn btn-label-info me-3" href="{{ URL::previous() }}">
                        Retroceder
                    </a>
                    @can('permissions.create')
                    <button type="button" class="btn btn-label-success" data-bs-toggle="modal"
                        data-bs-target="#addNewPermiso"> Crear
                    </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-sm mb-3">
                        <thead>
                            <tr>
                                <th scope="col"> # </th>
                                <th scope="col"> Nombre </th>
                                <th scope="col"> Guard </th>
                                <th scope="col"> Fecha Actualización </th>
                                <th scope="col"> Acciones </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td class="text-primary">{{ $permission->updated_at->format($settingGeneral->date_format
                                    . ' H:i:s') }}</td>
                                <td>
                                    <div class="d-inline-block text-nowrap">
                                        @can('permissions.show')
                                        <a href="{{ route('permissions.show',$permission->id) }}"
                                            class="btn btn-outline-secondary btn-icon btn-sm">
                                            <i class="material-icons">person</i>
                                        </a>
                                        @endcan
                                        @can('permissions.edit')
                                        <a href="{{ route('permissions.edit',$permission->id) }}"
                                            class="btn btn-outline-secondary btn-icon btn-sm">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @endcan
                                        @can('permissions.destroy')
                                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post"
                                            onsubmit="return confirm('Está seguro de eliminar?')"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" rel="tooltip" class="btn btn-outline-secondary btn-icon btn-sm" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">Sin registros.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $permissions->links() }}

                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addNewPermiso" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Crear nuevo permiso</h3>
                </div>
                <form method="POST" action="{{ route('permissions.store') }}" class="form-horizontal">
                    @csrf
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Nombre del permiso:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Ingrese un nombre de permiso" />
                    </div>
                    <div class="col-12 text-center mt-3">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Guardar</button>
                        <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal"
                            aria-label="Close">Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection