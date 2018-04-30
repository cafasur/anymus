<nav class="navbar navbar-dark sticky-top bg-secondary flex-md-nowrap p-0 navbar-expand-lg">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 text-center" href="#">CAFASUR</a>

    <div class="menus d-flex justify-content-between w-100">
        <ul class="navbar-nav">
            <li class="nav-item dropdown bg-primary">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cubes fa-fw"></i> Aplicaciones</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown bg-primary">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gears fa-fw"></i> Configuración</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item text-nowrap bg-danger">
                <a class="nav-link" href="{{ route('logout') }}">Salir <i class="fa fa-sign-out fa-fw"></i></a>
            </li>
        </ul>
    </div>
</nav>