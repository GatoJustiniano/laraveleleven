@extends('layouts.master', ['activePage' => 'users'])

@section('content')

    @include('dashboard.partials.validation-error')
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body ">

                    <form action="{{ route('user.update',$user->id) }}" method="POST">
                        @method('PUT')
                        @include('dashboard.user._form',['pass' => false])
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
