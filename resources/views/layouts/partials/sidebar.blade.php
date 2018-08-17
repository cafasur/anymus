<nav class="col-md-2 d-none d-md-block sidebar px-0">
    <div class="sidebar-sticky">

        <div class="info-user text-center">
            <img src="{{ auth()->user()->avatar  }}" alt="Avatar" class="rounded-circle">
            <h5 class="mt-2 text-white">{{ auth()->user()->first_name }}</h5>
            <span></span>
        </div>

        <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link link-sidebar active" href="{{ route('home') }}">
                        <i class="fa fa-tachometer-alt fa-fw"></i> Inicio <span class="sr-only">(current)</span>
                    </a>
                </li>

                @isset($app_menu)
                    @foreach($app_menu as $menu )
                    <li class="nav-item">
                        <a class="nav-link link-sidebar" href="{{ route($menu['route']) }}">
                            <i class="fa {{ $menu['icon'] }} fa-fw"></i> {{ $menu['title'] }}
                        </a>
                    </li>
                    @endforeach
                @endisset
            </ul>
    </div>
</nav>