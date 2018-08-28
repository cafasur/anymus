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
                <a class="nav-item nav-link active" id="nav-form-absenteeism-tab" data-toggle="tab" href="#nav-form-absenteeism" role="tab" aria-controls="nav-form-absenteeism" aria-selected="true">Formato de ausentismo</a>
                <a class="nav-item nav-link" id="nav-permission-all-tab" data-toggle="tab" href="#nav-permission-all" role="tab" aria-controls="nav-permission-all" >Todos los permisos</a>
                <a class="nav-item nav-link" id="nav-permission-not-check-tab" data-toggle="tab" href="#nav-permission-not-check" role="tab" aria-controls="nav-permission-not-check" aria-selected="true">Permisos sin aprobar</a>
                <a class="nav-item nav-link" id="nav-permission-not-arrival-time-tab" data-toggle="tab" href="#nav-permission-not-arrival-time" role="tab" aria-controls="nav-permission-not-arrival-time" aria-selected="true">Permisos por confirmar llegada</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-form-absenteeism" role="tabpanel" aria-labelledby="nav-form-absenteeism-tab">
                <form class="mt-3" action="{{ route('formalities.store_form_absenteeism2') }}" method="POST">
                    @csrf
                    <h4 class="mb-2">Datos del trabajador</h4>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="user">Usuario</label>
                            <select class="form-control {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user" id="user" required>
                                <option value="" selected disabled>Selecione un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"> {{ $user->full_name }}  {{ $user->document }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('user'))
                                <div class="invalid-tooltip">
                                    {{ $errors->first('user') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr class="my-2">
                    <h4 class="mb-2">Datos del permiso</h4>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="absenteeismType">Motivo del permiso</label>
                            <select class="form-control {{ $errors->has('absenteeismType') ? 'is-invalid' : '' }}" name="absenteeismType" id="absenteeismType" required>
                                <option value="" disabled selected>Selecione una opción</option>
                                @foreach($absenteeismTypes as $absenteeismType)
                                    <option value="{{ $absenteeismType->id }}">{{ $absenteeismType->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('absenteeismType'))
                                <div class="invalid-tooltip">
                                    {{ $errors->first('absenteeismType') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datePermission">Fecha y hora del permiso</label>
                            <input value="{{ old('datePermission') }}" class="form-control {{ $errors->has('datePermission') ? 'is-invalid' : '' }}" type="datetime-local" id="datePermission" name="datePermission" required>
                            @if($errors->has('datePermission'))
                                <div class="invalid-tooltip">
                                    {{ $errors->first('datePermission') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <label for="detailPermission">Detalle el motivo del permiso</label>
                            <textarea class="form-control {{ $errors->has('detailPermission') ? 'is-invalid' : '' }}" name="detailPermission" id="detailPermission" rows="3" required>{{ old('detailPermission') }}</textarea>
                            @if($errors->has('detailPermission'))
                                <div class="invalid-tooltip">
                                    {{ $errors->first('detailPermission') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save fa-fw"></i> Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-permission-all" role="tabpanel" aria-labelledby="nav-permission-all-tab">
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
                        <tr class="{{ $item->status_id == 2 ? 'table-danger' : '' }} {{ $item->status_id == 3 ? 'table-danger' : '' }} {{ $item->status_id == 4 ? 'table-success' : '' }} {{ $item->status_id == 5 ? 'table-info' : '' }}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->created_at->toDateString() }}</td>
                            <td>{{ $item->user->full_name }}</td>
                            <td>{{ $item->absenteeism_type->name }}</td>
                            <td>{{ $item->detail_permission }}</td>
                            <td>{{ $item->status->name }}</td>
                            <td>
                                <a target="_blank" href="{{ route('formalities.show_form_absenteeism', $item->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye fa-fw"></i> Ver</a>
                                <a target="_blank" href="{{ route('formalities.print_form_absenteeism', $item->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-print fa-fw"></i> Imprimir</a>
                            </td>
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
                                            <button-inactive title="Rechazar" route="{{ route('formalities.refuse_form_absenteeism', $item->id) }}"></button-inactive>
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