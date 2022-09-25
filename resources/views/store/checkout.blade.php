@extends('layouts.store.app')
@section('content')
    <header class="bg-dark py-4 hero hero-cart">
        <div class="container">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder mt-2">Checkout</h1>
                @php $cant = 0 @endphp
                @foreach((array) session('cart') as $id => $details)
                    @php $cant += $details['quantity'] @endphp
                @endforeach
            </div>
        </div>
    </header>
    <section class="container mt-0 pt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <strong>
                            <h5 class="mb-0">
                                @if($currentUser)
                                    Hola {{ $currentUser->nombre }}
                                @else
                                    Para continuar con tu compra ingresa tu e-mail o inicia sesión.
                                @endif
                            </h5>
                        </strong>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 border-secondary border-end">
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-muted">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" form="checkout-form" 
                                        @if($currentUser)
                                            @if($currentUser->email)
                                                value="{{ $currentUser->email }}"
                                            @endif
                                        @endif
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5" style="align-self: self-end;">
                                <div class="col-12">
                                    @guest
                                        <a class="btn btn-outline-secondary flex-shrink-0 my-cart-btn w-100" role="button" type="button" href="{{ route('login') }}">
                                            {{ __('Inicia sesión') }}
                                        </a>
                                    @endguest
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="needs-validation row" novalidate id="checkout-form" action="{{ route('create.order') }}" method="POST" enctype="multipart/form-data">
                <div class="col-md-7 checkout-data">

                        @csrf
                        <!-- Card -->
                        <div class="card  mb-4">
                            <!-- Billing address -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <strong><h5 class="mb-0">Datos del Cliente</h5></strong>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First name</label>
                                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" 
                                            @if($currentUser)
                                                @if($currentUser->nombre)
                                                    value="{{ $currentUser->nombre }}"
                                                @endif
                                            @endif
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last name</label>
                                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder=""
                                            @if($currentUser)
                                                @if($currentUser->apellido)
                                                    value="{{ $currentUser->apellido }}"
                                                @endif
                                            @endif
                                            required
                                            >
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tipo_doc">Tipo de Documento <span class="text-danger">*</span></label>
                                        @php
                                            $t_doc = 1;
                                        @endphp
                                        @if($currentUser)
                                            @if($currentUser->tipo_doc)
                                                @php
                                                    $t_doc = $currentUser->tipo_doc;
                                                @endphp
                                            @endif
                                        @endif
                                        {!! Form::select('tipo_doc', array('0' => 'Selecione...', 'CC' => 'Cedula', 'PP' => 'Pasaporte', 'NIT' => 'Nit', 'CE' => 'Cedula Extranjeria'), $t_doc,
                                        array('id' => 'tipo_doc', 'class' => 'form-select', 'required' => 'required' )) !!}
                                        <span id="tipo_doc_error" class="invalid-feedback" role="alert">
                                        </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="documento">Numero Documento <span class="text-danger">*</span></label>
                                        @php
                                            $doc = null;
                                        @endphp
                                        @if($currentUser)
                                            @if($currentUser->documento)
                                                @php
                                                    $doc = $currentUser->documento;
                                                @endphp
                                            @endif
                                        @endif
                                        {!! Form::number('documento', $doc, array('id' => 'documento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                                        <span id="documento_error" class="invalid-feedback" role="alert">
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="card  mb-4">
                            <!-- Billing address -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <strong><h5 class="mb-0">Direcci&oacute;n de entrega</h5></strong>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="address" class="form-label">Direccion</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder=""
                                            @if($currentUser)
                                                @if($currentUser->direccion)
                                                    value="{{ $currentUser->direccion }}"
                                                @endif
                                            @endif
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" 
                                            @if($currentUser)
                                                @if($currentUser->telefono)
                                                    value="{{ $currentUser->telefono }}"
                                                @endif
                                            @endif
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter your phone #
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="ciudad" class="form-label">Ciudad</label>
                                        <input type="text" class="form-control" id="ciudad" name="ciudad" 
                                            @if($currentUser)
                                                @if($currentUser->ciudad)
                                                    value="{{ $currentUser->ciudad }}"
                                                @endif
                                            @endif
                                            required
                                        >
                                        <div class="invalid-feedback">
                                            Please enter your city.
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state" class="form-label">Departamento</label>
                                        @if($currentUser)
                                            @if($currentUser->departamento)
                                                @php
                                                    $depto = $currentUser->departamento;
                                                @endphp
                                            @else
                                                @php
                                                    $depto = '';
                                                @endphp
                                            @endif
                                        @endif
                                        <select class="form-select" id="depto" name="depto" required>
                                            <option class="fbra_selectOption" value="">Seleccione...</option>
                                            <option class="fbra_selectOption" value="ANTIOQUIA">ANTIOQUIA</option>
                                            <option class="fbra_selectOption" value="ARAUCA">ARAUCA</option>
                                            <option class="fbra_selectOption" value="ATLANTICO">ATLANTICO</option>
                                            <option class="fbra_selectOption" value="BOGOTA D.C">BOGOTA D.C.</option>
                                            <option class="fbra_selectOption" value="BOLIVAR">BOLIVAR</option>
                                            <option class="fbra_selectOption" value="BOYACA">BOYACA</option>
                                            <option class="fbra_selectOption" value="CALDAS">CALDAS</option>
                                            <option class="fbra_selectOption" value="CAQUETA">CAQUETA</option>
                                            <option class="fbra_selectOption" value="CASANARE">CASANARE</option>
                                            <option class="fbra_selectOption" value="CAUCA">CAUCA</option>
                                            <option class="fbra_selectOption" value="CESAR">CESAR</option>
                                            <option class="fbra_selectOption" value="CHOCO">CHOCO</option>
                                            <option class="fbra_selectOption" value="CORDOBA">CORDOBA</option>
                                            <option class="fbra_selectOption" value="CUNDINAMARCA">CUNDINAMARCA</option>
                                            <option class="fbra_selectOption" value="HUILA">HUILA</option>
                                            <option class="fbra_selectOption" value="LA GUAJIRA">LA GUAJIRA</option>
                                            <option class="fbra_selectOption" value="MAGDALENA">MAGDALENA</option>
                                            <option class="fbra_selectOption" value="META">META</option>
                                            <option class="fbra_selectOption" value="NARIÑO">NARIÑO</option>
                                            <option class="fbra_selectOption" value="NORTE DE SANTANDER">NORTE DE SANTANDER</option>
                                            <option class="fbra_selectOption" value="PUTUMAYO">PUTUMAYO</option>
                                            <option class="fbra_selectOption" value="QUINDIO">QUINDIO</option>
                                            <option class="fbra_selectOption" value="RISARALDA">RISARALDA</option>
                                            <option class="fbra_selectOption" value="SANTANDER">SANTANDER</option>
                                            <option class="fbra_selectOption" value="SUCRE">SUCRE</option>
                                            <option class="fbra_selectOption" value="TOLIMA">TOLIMA</option>
                                            <option class="fbra_selectOption" value="VALLE DEL CAUCA">VALLE DEL CAUCA</option>
                                            <option class="fbra_selectOption" value="VAUPES">VAUPES</option>
                                            <option class="fbra_selectOption" value="VICHADA">VICHADA</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Tu Compra -->
                <div class="col-md-5 checkout-data">
                    <div class="card  mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <strong><h5 class="mb-0">Tu Compra</h5></strong>
                            <span class="badge badge-pill badge-info">{{ $cant }}</span>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <ul class="list-group">
                                @if(session('cart'))
                                    @foreach((array)session('cart') as $id => $details)
                                        <li class="list-group-item d-flex justify-content-between lh-sm">
                                            <div>
                                                <h6 class="my-0">{{ $details['name'] }}</h6>
                                            </div>
                                            <span class="text-muted">${{ number_format($details['price'], 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>
                                    @php $total = 0 @endphp
                                    @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                    @endforeach
                                    ${{ number_format($total, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 checkout-data">
                    <!-- Card -->
                    <div class="card  mb-4">
                        <!-- Billing address -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h5 class="mb-0">Metodo de pago</h5>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked
                                        required>
                                    <label class="form-check-label" for="credit">Wompi</label>
                                </div>
                            </div>
                            <button class="w-100 btn btn-outline-primary">Continuar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection