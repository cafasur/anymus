@component('layouts.dashboard')
    @slot('title')
        Usuarios
    @endslot

    @slot('subtitle')<i class="fa fa-users-cog fa-fw"></i> Inicio @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',1)

    @slot('body')
        <table class="table table-hover table-bordered text-center">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Unidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->unit->unit }}</td>
                    <td>{{ $user->status->name }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-user-edit fa-fw"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endslot
@endcomponent