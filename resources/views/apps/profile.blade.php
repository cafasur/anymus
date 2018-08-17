@component('layouts.dashboard')
    @slot('title')
        Usuarios
    @endslot

    @slot('subtitle')
        <i class="fa fa-user-circle fa-fw"></i> Perfil del usuario
    @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',0)

    @slot('body')
        <picture>
            <img src="{{ $user->avatar }}" alt="Imagen de perfil" class="img-thumbnail mx-auto d-block">
        </picture>

        <form action="{{ route('update.profile', $user) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="first_name">Nombres</label>
                    <div class="input-group">
                        <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" name="first_name" placeholder="Nombres" value="{{ $user->first_name }}" required>
                        @if($errors->has('first_name'))
                            <div class="invalid-feedback">
                                @foreach($errors->get('first_name') as $message)
                                    {{ $message }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="last_name">Apellidos</label>
                    <div class="input-group">
                        <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" name="last_name" placeholder="Apellidos" value="{{ $user->last_name }}" required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                @foreach($errors->get('last_name') as $message)
                                    {{ $message }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control" id="email" readonly value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="role">Rol</label>
                    <input type="text" class="form-control" id="role" readonly value="{{ $user->roles->first()->name }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="unit">Unidad</label>
                    <input type="text" class="form-control" id="unit" readonly value="{{ $user->unit->unit }}">
                </div>
            </div>
            <button type="submit" class="btn btn-secondary"><i class="fa fa-edit fa-fw"></i> Actualizar</button>
        </form>

        @if($errors->has('message'))
            <div class="row mt-3">
                <div class="col">
                    @component('components.alert')
                        @slot('type') danger @endslot
                        @slot('message'){{ $errors->first('message') }}@endslot
                    @endcomponent
                </div>
            </div>
        @endif

        @if(session('status'))
            <div class="row mt-3">
                <div class="col">
                    @component('components.alert')
                        @slot('type') {{ session('status') }} @endslot
                        @slot('icon') <i class="fa fa-warning fa-fw"></i> @endslot
                        @slot('message'){{ session('message') }}@endslot
                    @endcomponent
                </div>
            </div>
        @endif

    @endslot
@endcomponent