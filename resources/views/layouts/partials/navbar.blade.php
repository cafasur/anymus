<nav class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 navbar-expand-lg">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">CAFASUR</a>

    <div class="menus d-flex justify-content-between w-100">
        <ul class="navbar-nav">
            <li class="nav-item dropdown bg-primary">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cubes"></i> Aplicaciones</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    @isset($menu_apps)
                        @foreach($menu_apps as $menu_app)
                            <a class="dropdown-item" href="{{ route($menu_app['name_route']) }}"><i class="fa {{ $menu_app['icon'] }} fa-fw"></i> {{ $menu_app['name'] }}</a>
                        @endforeach
                    @endisset
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown bg-primary">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cogs fa-fw"></i> Configuración</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fa fa-user-circle fa-fw"></i> Mi perfil</a>
                    <!--<a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>-->
                </div>
            </li>
            <li class="nav-item text-nowrap bg-danger">
                <a class="nav-link" href="{{ route('logout') }}">Salir <i class="fa fa-sign-out-alt fa-fw"></i></a>
            </li>
        </ul>
    </div>
</nav>