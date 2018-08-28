@component('layouts.dashboard')
    @slot('title')
        Trámites
    @endslot

    @slot('subtitle')<i class="fa fa-file-invoice fa-fw"></i> Inicio @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',3)

    @slot('body')
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Mis permisos</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr class="thead-light">
                            <th>Id</th>
                            <th>Fecha de elaboración</th>
                            <th>Motivo del permiso</th>
                            <th>Detalle del permiso</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absenteeismControl as $item)
                        <tr class="{{ $item->status_id == 2 ? 'table-danger' : '' }} {{ $item->status_id == 3 ? 'table-danger' : '' }} {{ $item->status_id == 4 ? 'table-success' : '' }} {{ $item->status_id == 5 ? 'table-info' : '' }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>{{ $item->absenteeism_type->name }}</td>
                            <td>{{ $item->detail_permission }}</td>
                            <td>{{ $item->status->name }}</td>
                            @if($item->status_id == 1)
                            <td>
                                <a target="_blank" href="{{ route('formalities.print_form_absenteeism', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                                    <div class="dropdown d-inline" >
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">
                                                <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="ml-4 btn btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <button-inactive title="Anular" route="{{ route('formalities.cancel_form_absenteeism', $item->id) }}"></button-inactive>
                                            </a>
                                        </div>
                                    </div>
                            </td>
                            @elseif($item->status_id == 4)
                            <td>
                                    <a target="_blank" href="{{ route('formalities.print_form_absenteeism', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                                    <div class="dropdown d-inline" >
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Más</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">
                                                <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="ml-4 btn btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <button-check-arrival title="Marcar llegada" route="{{ route('formalities.check_arrival_form_absenteeism', $item->id) }}"></button-check-arrival>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">
                                                <button-inactive title="Anular" route="{{ route('formalities.cancel_form_absenteeism', $item->id) }}"></button-inactive>
                                            </a>
                                        </div>
                                    </div>
                            </td>
                            @else
                                <td>
                                    <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                    <a target="_blank" href="{{ route('formalities.print_form_absenteeism', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                                </td>
                            @endif
                        </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <strong>No hay registros</strong>
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