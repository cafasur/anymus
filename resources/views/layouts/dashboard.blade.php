<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    @include('layouts.partials.navbar')

    <div class="container-fluid">
        <div class="row">
            @include('layouts.partials.sidebar')

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 mb-3">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $title }}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            @isset($buttons)
                                {{ $buttons }}
                            @endisset
                        </div>
                    </div>
                </div>

                <h2 class="mb-4">{{ $subtitle }}</h2>

                <div id="app">{{ $body }}</div>
            </main>
        </div>
    </div>
</body>
</html>
