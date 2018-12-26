        <!-- NAVBAR START -->

        <!-- UPPER NAVBAR -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">PROMAX | Magazyn</a>

            <!-- Authentication Links -->
            <ul class="nav px-3">
            @guest
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @if (Route::has('register'))
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
            @else

            <li class="nav-item text-nowrap">
                    <a class="nav-link" href="/dashboard">{{ Auth::user()->name }}</a>
            </li>

            <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
             </li>
            @endguest
            </ul>
            
        </nav>
        <!-- UPPER NAVBAR -->
        
        <!-- SIDE NAVBAR -->
        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(1) === 'dashboard' ? 'active' : null }}" href="/dashboard">
                                    <i class="fas fa-home"></i>
                                    Dashboard <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(1) === 'materials' ? 'active' : null }}" href="/materials">
                                    <i class="fas fa-file"></i>
                                    Materiały
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::segment(1) === 'suppliers' ? 'active' : null }}" href="/suppliers">
                                    <i class="fas fa-shopping-cart"></i>
                                    Dostawcy
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-user-tie"></i>
                                    Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="far fa-chart-bar"></i>
                                    Reports
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                        <i class="fas fa-layer-group"></i>
                                    Integrations
                                </a>
                            </li>
                        </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Rolki:</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Latex Premium
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Flizelina
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Canvas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Laminat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Easy-Stick
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Winyl na Flizelinie
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-dot-circle"></i>
                                Winyl na Flizelinie Canvas
                            </a>
                        </li>
                    </ul>
                    </div>
                </nav>
                <!-- NAVBAR STOP -->