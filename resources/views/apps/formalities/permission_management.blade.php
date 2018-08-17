@component('layouts.dashboard')
    @slot('title')
        Trámites
    @endslot

    @slot('subtitle')<i class="fa fa-users fa-fw"></i> Gestión de permisos @endslot

    @slot('buttons')
        <a href="{{ route('formalities.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Trámites</a>
        <a href="{{ route('home') }}" class="btn btn-outline-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',3)

    @slot('body')
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-permission-all-tab" data-toggle="tab" href="#nav-permission-all" role="tab" aria-controls="nav-permission-all" aria-selected="true">Todos los permisos</a>
                <a class="nav-item nav-link" id="nav-permission-not-check-tab" data-toggle="tab" href="#nav-permission-not-check" role="tab" aria-controls="nav-permission-not-check" aria-selected="true">Permisos sin aprobar</a>
                <a class="nav-item nav-link" id="nav-permission-not-arrival-time-tab" data-toggle="tab" href="#nav-permission-not-arrival-time" role="tab" aria-controls="nav-permission-not-arrival-time" aria-selected="true">Permisos por confirmar llegada</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-permission-all" role="tabpanel" aria-labelledby="nav-permission-all-tab">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr class="thead-light">
                        <th>Id</th>
                        <th>Fecha de elaboración</th>
                        <th>Trabajador</th>
                        <th>Motivo del permiso</th>
                        <th>Detalle del permiso</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($absenteeismControl as $item)
                        <tr class="{{ $item->status_id == 2 ? 'table-danger' : '' }} {{ $item->status_id == 3 ? 'table-success' : '' }} {{ $item->status_id == 4 ? 'table-info' : '' }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>{{ $item->user->full_name }}</td>
                            <td>{{ $item->absenteeism_type->name }}</td>
                            <td>{{ $item->detail_permission }}</td>
                            <td>{{ $item->status->name }}</td>
                            @if($item->status_id != 2)
                                <td>
                                    <a target="_blank" href="{{ route('formalities.print_form_absenteeism', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                                    <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                </td>
                            @else
                                <td>No hay acciones</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-permission-not-check" role="tabpanel" aria-labelledby="nav-permission-not-check-tab">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr class="thead-light">
                        <th>Id</th>
                        <th>Fecha de elaboración</th>
                        <th>Trabajador</th>
                        <th>Motivo del permiso</th>
                        <th>Detalle del permiso</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($absenteeismControlNotCheck as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>{{ $item->user->full_name }}</td>
                            <td>{{ $item->absenteeism_type->name }}</td>
                            <td>{{ $item->detail_permission }}</td>
                            <td>{{ $item->status->name }}</td>
                            <td>
                                <button-approve title="Aprobar" route="{{ route('formalities.approve_form_absenteeism', $item->id) }}"></button-approve>
                                <div class="dropdown d-inline" >
                                    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a href="#" class="dropdown-item">
                                            <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="ml-4 btn btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">
                                            <button-inactive title="Rechazar" route="{{ route('formalities.destroy_form_absenteeism', $item->id) }}"></button-inactive>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <strong>No hay registros pendientes</strong>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-permission-not-arrival-time" role="tabpanel" aria-labelledby="nav-permission-not-arrival-time-tab">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                    <tr class="thead-light">
                        <th>Id</th>
                        <th>Fecha de elaboración</th>
                        <th>Trabajador</th>
                        <th>Motivo del permiso</th>
                        <th>Detalle del permiso</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($absenteeismControlNotArrivalTime as $item)
                        <tr class="{{ $item->status_id == 2 ? 'table-danger' : '' }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>{{ $item->user->full_name }}</td>
                            <td>{{ $item->absenteeism_type->name }}</td>
                            <td>{{ $item->detail_permission }}</td>
                            <td>{{ $item->status->name }}</td>
                            <td>
                                <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                <button-check-arrival title="Marcar llegada" route="{{ route('formalities.check_arrival_form_absenteeism', $item->id) }}"></button-check-arrival>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <strong>No hay registros pendientes</strong>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(session('status'))
            @component('components.alert')
                @slot('type', session('status'))
                @slot('icon') <i class="fa fa-exclamation-triangle fa-fw"></i> @endslot
                @slot('message', session('message'))
            @endcomponent
        @endif
    @endslot
@endcomponent