@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center animate__animated animate__zoomInDown">
            <div class="col-md-8">
                <div class="card animate__animated animate__zoomIn">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success animate__animated animate__fadeInUpBig" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="animate__animated animate__zoomInUp">
                            {{ __('You are logged in!') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
