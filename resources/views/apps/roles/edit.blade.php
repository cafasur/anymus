@component('layouts.dashboard')
    @slot('title')
        Roles
    @endslot

    @slot('subtitle')
        <i class="fa fa-user-plus fa-fw"></i> Editar rol - {{ $rol->name }}
    @endslot

    @slot('buttons')
        <a href="{{ route('roles.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Roles</a>
        <a href="{{ route('home') }}" class="btn btn-outline-primary"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',2)

    @slot('body')
        <form action="{{ route('roles.update', $rol->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="name">Nombre del rol</label>
                    <input type="text" value="{{ $rol->name }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" required>
                    @if($errors->has('name'))
                        <div class="invalid-tooltip">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-row mt-5">
                <div class="form-group col-md-4">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Editar</button>
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