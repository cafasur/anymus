@component('layouts.dashboard')
    @slot('title')
        <i class="fa fa-folder-open fa-fw" ></i> Procesos
    @endslot

    @slot('subtitle')
        Formato de informes SSF
    @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('body')
        <form-ssf :shipping-periods="{{ $shippingPeriods }}" :signatures-type="{{ $signaturesType }}" :user="{{ $user }}" :category-reports="{{ $categoryReports }}" :periodicities="{{ $periodicities }}">
        </form-ssf>

    @endslot
@endcomponent