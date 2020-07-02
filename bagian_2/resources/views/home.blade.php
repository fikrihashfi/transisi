@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <div class="d-flex flex-row align-items-center justify-content-center m-2">
                        <a class="btn btn-success text-white m-1" href="{{route('companies.index')}}">Company</a>
                        <a class="btn btn-primary text-white m-1" href="{{route('employees.index')}}">Employee</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
