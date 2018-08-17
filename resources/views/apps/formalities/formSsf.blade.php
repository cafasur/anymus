@component('layouts.dashboard')
    @slot('title')
        Trámites
    @endslot

    @slot('subtitle')
        <i class="fa fa-folder-open fa-fw" ></i> Formato de informes SSF
    @endslot

    @slot('buttons')
        <a href="{{ route('formalities.index') }}" class="btn btn-info"><i class="fa fa-arrow-circle-left fa-fw"></i> Trámites</a>
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp',3)

    @slot('body')
        <form-ssf :shipping-periods="{{ $shippingPeriods }}" :signatures-type="{{ $signaturesType }}" :user="{{ $user }}" :category-reports="{{ $categoryReports }}" :periodicities="{{ $periodicities }}">
        </form-ssf>

    @endslot
@endcomponent