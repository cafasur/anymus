@component('layouts.dashboard')
    @slot('title')
        Trámites
    @endslot

    @slot('subtitle')
        <i class="fa fa-eye fa-fw" ></i> Ver Formato de control de ausentismo
    @endslot

    @slot('buttons')
        <a href="{{ route('formalities.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Trámites</a>
        <a href="{{ route('home') }}" class="btn btn-outline-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',3)

    @slot('body')
        <form action="#">
            <h4 class="mb-2">Datos del trabajador</h4>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="documentType">Tipo documento</label>
                    <input type="text" value="{{ $absenteeismControl->user->document_types->name }}" class="form-control" id="documentType" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="document"># Documento</label>
                    <input type="number" value="{{ $absenteeismControl->user->document }}" class="form-control" id="document" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">Nombre</label>
                    <input type="text" value="{{ $absenteeismControl->user->full_name }}" class="form-control" id="name" disabled>
                </div>
            </div>
            <hr class="my-2">
            <h4 class="mb-2">Datos del permiso</h4>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="id"># De permiso</label>
                    <input type="number" value="{{ $absenteeismControl->id }}" class="form-control" id="id" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="id">Estado del permiso</label>
                    <input type="text" value="{{ $absenteeismControl->status->name }}" class="form-control" id="id" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="datePermission">Fecha del permiso</label>
                    <input value="{{ $absenteeismControl->date_permission }}" class="form-control" type="date" id="datePermission" name="datePermission" disabled readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="datePermission">Fecha de llegada</label>
                    <input value="{{ $absenteeismControl->arrival_date }}" class="form-control" type="date" id="datePermission" name="datePermission" disabled readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="absenteeismType">Motivo del permiso</label>
                    <select class="form-control" name="absenteeismType" id="absenteeismType" disabled readonly>
                        <option value="{{ $absenteeismControl->absenteeism_type_id }}" disabled selected>{{ $absenteeismControl->absenteeism_type->name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="departureTime">Hora de salida</label>
                    <input value="{{ $absenteeismControl->departure_time }}" class="form-control" type="time" id="departureTime" name="departureTime" disabled readonly>
                </div>
                <div class="form-group col-md-2">
                    <label for="ArrivalTime">Hora de llegada</label>
                    <input value="{{ $absenteeismControl->arrival_time }}" class="form-control" type="time" id="ArrivalTime" name="ArrivalTime" disabled readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="id">Nota</label>
                    <input type="text" value="{{ $absenteeismControl->note }}" class="form-control" id="id" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="detailPermission">Detalle el motivo del permiso</label>
                    <textarea class="form-control" name="detailPermission" id="detailPermission" rows="3" readonly disabled>{{ $absenteeismControl->detail_permission }}</textarea>
                </div>
            </div>
        </form>
    @endslot
@endcomponent