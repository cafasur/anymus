@component('layouts.dashboard')
    @slot('title')
        Roles
    @endslot

    @slot('subtitle')<i class="fa fa-user-shield fa-fw"></i> Asignar Rol @endslot

    @slot('buttons')
        <a href="{{ route('roles.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Roles</a>
        <a href="{{ route('home') }}" class="btn btn-outline-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',2)

    @slot('body')
        <form-assign-role :users="{{ $users }}" :roles="{{ $roles }}"></form-assign-role>
    @endslot
@endcomponent