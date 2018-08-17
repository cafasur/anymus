@component('layouts.dashboard')
    @slot('title')
        Usuarios
    @endslot

    @slot('subtitle')
        <i class="fa fa-user-plus fa-fw"></i> Crear usuario
    @endslot

    @slot('buttons')
        <a href="{{ route('users.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Usuarios</a>
        <a href="{{ route('home') }}" class="btn btn-outline-primary"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',1)

    @slot('body')
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="first_name">Nombres</label>
                    <input type="text" class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" name="first_name" required>
                    @if($errors->has('first_name'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="last_name">Apellidos</label>
                    <input type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" name="last_name" required>
                    @if($errors->has('last_name'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('last_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="email">Correo</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" required>
                    @if($errors->has('email'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="unit">Unidad</label>
                    <select class="form-control {{ $errors->has('unit') ? 'is-invalid' : '' }}" id="unit" name="unit" required>
                        <option value="0" selected disabled>Selecione una unidad</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->id }} - {{ $unit->unit }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('unit'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('unit') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="status">Estado del usuario</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" id="status" name="status" required>
                        <option value="0" selected disabled>Selecione un estado</option>
                        @foreach($userStatus as $userState)
                            <option value="{{ $userState->id }}">{{ $userState->id }} - {{ $userState->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('status'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="password">Clave (opcional)</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" name="password">
                    @if($errors->has('password'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-md-3">
                    <label for="password_confirmation">Confirmar clave</label>
                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-row mt-5">
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Crear</button>
                </div>
            </div>
            @if(session('status'))
                @component('components.alert')
                    @slot('type', session('status'))
                    @slot('icon') <i class="fa fa-exclamation-triangle fa-fw"></i> @endslot
                    @slot('message', session('message'))
                @endcomponent
            @endif
        </form>
    @endslot
@endcomponent