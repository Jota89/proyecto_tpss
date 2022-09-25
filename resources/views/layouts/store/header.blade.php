<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm" style="height: 4.375rem;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h1>{{ config('app.name', 'NovaPlus') }}</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
                        <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item {{ (request()->is('tienda/categoria/samsung')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showCategory','samsung') }}">Samsumg</a>
                    </li>
                    <li class="nav-item {{ (request()->is('tienda/categoria/iphone')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showCategory','iphone') }}">Iphone</a>
                    </li>
                    <li class="nav-item {{ (request()->is('tienda/categoria/motorola')) ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('showCategory','motorola') }}">Motorola</a>
                    </li>
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('register'))
                            <li class="nav-item {{ (request()->is('register')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                            </li>
                        @endif
                        @if (Route::has('login'))
                            <li class="nav-item {{ (request()->is('login')) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Mi Cuenta') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600">Mi Cuenta</span>
                                {{-- <img height="27" class="img-profile rounded-circle" src="{{URL::asset('/img/undraw_profile.svg')}}"> --}}
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/mi-cuenta') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="{{ url('/mi-cuenta/ordenes') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mis Ordenes
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    @endguest
                    {{-- <li class="nav-item">
                        <a class="nav-link my-cart-icon">
                            <i class="fas fa-shopping-cart fa-lg"></i> 
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" id="cartDropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
                            <span class="badge badge-pill badge-info">
                                @php $cant = 0 @endphp
                                @if(session('status')!='APPROVED')
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $cant += $details['quantity'] @endphp
                                    @endforeach
                                @endif
                                {{ $cant }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="cartDropdown">
                            <div class="row total-header-section">
                                <div class="col-lg-6 col-sm-6 col-6">
                                    <i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i> 
                                    <span class="badge badge-pill badge-info">
                                        @php $cant = 0 @endphp
                                        @if(session('status')!='APPROVED')
                                            @foreach((array) session('cart') as $id => $details)
                                                @php $cant += $details['quantity'] @endphp
                                            @endforeach
                                        @endif
                                        {{ $cant }}
                                    </span>
                                </div>
                                @php $total = 0 @endphp
                                @if(session('status')!='APPROVED')
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                    @endforeach
                                @endif

                                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                    <p>Total: <span class="text-info">${{ number_format($total, 0, ',', '.') }}</span></p>
                                </div>
                            </div>
                            @if(session('status')!='APPROVED')
                                @if(session('cart'))
                                    @foreach((array)session('cart') as $id => $details)
                                        <div class="row cart-detail">
                                            <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                                @php $imagen = $details['image']['name'] @endphp
                                                <img class="card-img-top mb-5 mb-md-0" height="60" src="{{URL::asset('/img/productos/'.$imagen)}}" />
                                            </div>
                                            <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                                <p>{{ $details['name'] }}</p>
                                                <span class="price text-info"> ${{ number_format($details['price'], 0, ',', '.') }}</span> <span class="count"> Cant: {{ $details['quantity'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                            <div class="text-center w-100 d-flex justify-content-evenly pt-3 border-top">
                                {{-- {{  var_dump(session('status')) }} --}}
                                @if(session('status')=='PENDIENTE')
                                    @include('layouts.store.wompi')
                                @elseif(session('status')=='PENDIENTE' || session('status')!='APPROVED')
                                    <a class="btn btn-outline-secondary flex-shrink-0 my-cart-btn" type="button" href="{{ route('cart') }}">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Ver carrito
                                    </a>
                                    <a class="btn btn-outline-info flex-shrink-0 my-cart-btn" type="button" href="{{ route('checkout') }}"><i class="fa fa-credit-card fa-sm" aria-hidden="true"></i> Pagar
                                    </a>
                                @elseif(session('status')=='APPROVED' || session('status')=='')
                                    <div class="shadow bg-light rounded-3 text-center mx-auto">
                                        <div class="container-fluid py-2 text-center mx-auto my-2">
                                            <h3 class="d-block w-100 fw-bold ">Uppps!!!</h3>
                                            <p class="col-md-12 fs-5 text-center mx-auto">No tienes ningun produto en tu carrito de compras. <br>Te invitamos a que visites nuestra tienda y elijas alguno de nuestros productos</p>
                                            <a href="{{ route('tienda') }}" class="btn btn-outline-secondary flex-shrink-0 my-cart-btn mx-auto"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</header>