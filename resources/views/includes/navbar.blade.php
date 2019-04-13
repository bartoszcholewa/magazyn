        <!-- NAVBAR START -->

        <!-- UPPER NAVBAR -->
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">PROMAX | Magazyn <small>v.0.1.0</small></a>

            <!-- Authentication Links -->
            <ul class="nav px-3">
            @guest
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            {{-- @if (Route::has('register'))
                <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif --}}
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
                                <a class="nav-link {{ Request::is('dashboard') ? 'active' : null }}" href="/dashboard">
                                    <i class="fas fa-home"></i>
                                    {{ __('Dashboard') }} <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('suppliers') ? 'active' : null }}" href="/suppliers">
                                    <i class="fas fa-truck"></i>
                                    {{ __('Suppliers') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('materials') ? 'active' : null }}" href="/materials">
                                    <i class="fas fa-file"></i>
                                    {{ __('Materials') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('rolls') ? 'active' : null }}" href="/rolls">
                                    <i class="far fa-dot-circle"></i>
                                    {{ __('Rolls') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('orders') ? 'active' : null }}" href="/orders">
                                    <i class="fas fa-shopping-cart"></i>
                                    {{ __('Orders') }}
                                </a>
                            </li>
                            
                        </ul>
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>{{ __('Work Plan') }}:</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        @if(in_array(Auth::user()->type, array('admin', 'boss')))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('planplastykow/edycja') ? 'active' : null }}" href="/planplastykow/edycja">
                                <i class="far fa-calendar-alt"></i>
                                {{ __('Artists Plan') }}
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('planplastykow') ? 'active' : null }}" href="/planplastykow">
                                <i class="far fa-calendar-alt"></i>
                                {{ __('Artists Plan') }}
                            </a>
                        </li>
                        @endif
                    </ul>

                    @if(in_array(Auth::user()->type, array('admin', 'boss', 'picturewall')))
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>{{ __('Stock') }}:</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        @foreach (Navmat::all() as $material)
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('materials/'.$material->material_ID.'/raport') ? 'active' : null }}" href="/materials/{{$material->material_ID}}/raport">
                                <i class="far fa-dot-circle"></i>
                                {{$material->material_NAME}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                    @if(Auth::user()->type == "admin")
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>{{ __('Admin Panel') }}:</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="/users">
                                <i class="fas fa-user-cog"></i>
                                {{ __('Users') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logs">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ __('Logs') }}
                            </a>
                        </li>
                    </ul>
                    @endif
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>{{ __('Language') }}:</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        
                            <div class="row ml-2">

                            <a href="/lang/en" class="m-1">
                                <img src="/storage/ico/en.png">
                            </a>
                            <a href="/lang/pl" class="m-1">
                                <img src="/storage/ico/pl.png">
                            </a>
                            </div>

                    </ul>
                    </div>
                </nav>
                <!-- NAVBAR STOP -->