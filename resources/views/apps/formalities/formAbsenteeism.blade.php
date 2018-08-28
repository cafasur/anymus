@component('layouts.dashboard')
    @slot('title')
        Trámites
    @endslot

    @slot('subtitle')
        <i class="fa fa-file-contract fa-fw" ></i> Formato de control de ausentismo
    @endslot

    @slot('buttons')
        <a href="{{ route('formalities.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Trámites</a>
        <a href="{{ route('home') }}" class="btn btn-outline-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',3)

    @slot('body')
        <form action="{{ route('formalities.store_form_absenteeism', $user->id) }}" method="POST">
            @csrf
            <h4 class="mb-2">Datos del trabajador</h4>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="documentType">Tipo documento</label>
                    <input type="text" value="{{ $user->document_types->name }}" class="form-control" id="documentType" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="document"># Documento</label>
                    <input type="number" value="{{ $user->document }}" class="form-control" id="document" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">Nombre</label>
                    <input type="text" value="{{ $user->full_name }}" class="form-control" id="name" disabled>
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