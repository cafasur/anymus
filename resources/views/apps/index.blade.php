@component('layouts.dashboard')
    @slot('title')
        Panel de control
    @endslot

    @slot('subtitle')
        Inicion
    @endslot

    @slot('buttons')
        <a href="{{ route('home') }}" class="btn btn-success"><i class="fa fa-home fa-fw"></i> Inicio</a>
    @endslot

    @slot('idApp', 0)

    @slot('body')
        <h1>hola</h1>
    @endslot
@endcomponent