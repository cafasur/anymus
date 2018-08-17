@extends('layouts.login')

@section('content')
    <form class="form-signin" action="" method="POST">
        @csrf
        <img class="mb-2" src="{{ asset('images/Logo_CAFASUR.png') }}" alt="Logo_CAFASUR" width="265" height="240">
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1>

        <div class="form-label-group">
            <input type="email" name="email" id="inputEmail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Correo" required autofocus>
            @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>

        <div class="form-label-group">
            <input type="password" name="password" id="inputPassword" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Clave" required>
            @if($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
            @endif
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Acceder</button>
        <p class="mt-1">
            <a href="{{ route('index') }}">Volver al inicio</a>
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