@extends('layouts.login')

@section('content')
    <form class="form-signin mt-4">
        <img class="mb-4" src="{{ asset('images/Logo_CAFASUR.png') }}" alt="Logo_CAFASUR" width="270" height="250">
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>
        <a class="btn btn-lg btn-primary btn-block" href="{{ route('login') }}"><i class="fab fa-google fa-fw"></i> Cuenta Corporativa</a>
        <p class="mt-2">
            <a href="{{ route('indexAlternative') }}">Acceder con usuario y clave</a>
        </p>

        @if($errors->has('message'))
        <div class="row mt-2">
            <div class="col">
                @component('components.alert')
                    @slot('type') danger @endslot
                    @slot('message'){{ $errors->first('message') }}@endslot
                @endcomponent
            </div>
        </div>
        @endif

        <p class="mt-3 mb-3 text-muted">&copy; CAFASUR 2018 - Hecho con ❤ por @Dguzman</p>
    </form>
@endsection