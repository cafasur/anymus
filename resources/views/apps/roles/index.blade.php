@component('layouts.dashboard')
    @slot('title')
        Roles
    @endslot

    @slot('subtitle')<i class="fa fa-user-shield fa-fw"></i> Inicio @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',2)

    @slot('body')
        <table class="table table-hover table-bordered text-center">
            <thead class="thead-light">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Creado</th>
                <th scope="col">Actualizado</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $rol)
                <tr>
                    <th scope="row">{{ $rol->id }}</th>
                    <td>{{ $rol->name }}</td>
                    <td>{{ $rol->created_at }}</td>
                    <td>{{ $rol->updated_at }}</td>
                    <td>
                        <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-user-edit fa-fw"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endslot
@endcomponent