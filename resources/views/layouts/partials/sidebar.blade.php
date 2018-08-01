<nav class="col-md-2 d-none d-md-block sidebar px-0">
    <div class="sidebar-sticky">

        <div class="info-user text-center">
            <img src="{{ auth()->user()->avatar  }}" alt="Avatar" class="rounded-circle">
            <h5 class="mt-2 text-white">{{ auth()->user()->first_name }}</h5>
            <span></span>
        </div>

        <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fa fa-dashboard fa-fw"></i> Dashboard <span class="sr-only">(current)</span>
                    </a>
                </li>

                @isset($routes)
                    {{ $routes }}
                    <li class="nav-item">
                        <a class="nav-link link-sidebar" href="#">
                            <span data-feather="file"></span>Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-sidebar" href="#">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-sidebar" href="#">
                            <span data-feather="users"></span>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item link-sidebar">
                        <a class="nav-link" href="#">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link link-sidebar" href="#">
                        <span data-feather="layers"></span>
                        Integrations
                    </a>
                </li>
                @endisset
            </ul>
    </div>
</nav>