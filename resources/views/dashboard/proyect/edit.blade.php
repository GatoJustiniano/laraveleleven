@extends('layouts.master', ['activePage' => 'proyects'])

@section('content')

    @include('dashboard.partials.validation-error')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body ">
                    <form action="{{ route('proyect.update', $proyect->id) }}" method="POST">
                        @method('PUT')
                        @include('dashboard.proyect._form', ['formCreate' => false])
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
                </div>
                
            </div>
        </div>
    </div>

@endsection
