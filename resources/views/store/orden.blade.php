@extends('layouts.store.app')
@section('content')
    <header class="bg-dark py-4 hero hero-cart">
        <div class="container">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder mt-2">

                    {{-- {{ dd($transaction) }} --}}
                    @if($transaction!=null)
                        @if(session('status')=='APPROVED')
                            Gracias por tu Compra !!!
                        @elseif(session('status')=='DECLINED')
                            Upss !!! Algo salio mal.
                        @else
                            Tu Orden
                        @endif
                    @endif

                </h1>
                @php $cant = 0 @endphp
                @foreach((array) session('cart') as $id => $details)
                    @php $cant += $details['quantity'] @endphp
                @endforeach
            </div>
        </div>
    </header>
    <section class="container mt-0 pt-5">
        <div class="row">
            
            @if($transaction!=null)
                
                    <div class="col-md-12">
                        <div class="p-2 mb-4 bg-light rounded-3 text-center shadow">
                            <div class="container-fluid py-3 text-center">
                                <h5 class="display-6 fw-bold">
                                    @if(session('status')=='APPROVED')
                                        Tu pago ha sido aceptado.
                                    @elseif(session('status')=='DECLINED')
                                        Tu pago ha sido rechazado.
                                    @endif
                                    
                                </h5>
                                <p class="col-md-8 fs-4 text-center mx-auto">
                                    @if(session('status')=='APPROVED')
                                        Tus pedido sera enviado pronto. <br>Revisa tu correo, alli encontraras una copia de tu orden y tu comprobante de pago.
                                    @elseif(session('status')=='DECLINED')
                                        Revisa tu metodo de pago e intenta realizar nuevamente tu pago.
                                    @endif
                                    
                                </p>
                                @if(session('status')=='DECLINED')
                                        
                                        <a class="btn btn-outline-info flex-shrink-0 my-cart-btn" type="button" href="{{ route('checkout') }}"><i class="fa fa-credit-card fa-sm" aria-hidden="true"></i> Pagar
                                        </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Card -->
                        <div class="card  mb-4">
                            <!-- Billing address -->
                            <div class="card-header p-2 d-flex flex-row align-items-center justify-content-between">
                                <strong><h6 class="mb-0">Detalles de tu Pago</h6></strong>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                {{-- {{ dd($transaction) }} --}}
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <i for="firstName" class="form-label ">Id Orden</i>
                                        <p class="mb-0 fs-4">{{ $transaction->reference }}</p>
                                    </div>
        
                                    <div class="col-md-6">
                                        <i for="email" class="form-label">Metodo de Pago</i>
                                        <p class="mb-0 fs-4">WOMPI - {{ $transaction->payment_method_type }}</p>
                                    </div>
        
                                    <div class="col-md-6">
                                        <i for="address" class="form-label">Id Transaccion</i>
                                        <p class="mb-0 fs-4">{{ $transaction->id }}</p>
                                    </div>
        
                                    <div class="col-md-6">
                                        <i for="telefono" class="form-label">Fecha</i>
                                        <p class="mb-0 fs-4">{{ date('m-d-Y', strtotime($transaction->created_at)) }}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
        
                    </div>
                
            @endif


            <div class="col-md-12">
                <!-- Card -->
                <div class="card  mb-4">
                    <!-- Billing address -->
                    <div class="card-header p-2 d-flex flex-row align-items-center justify-content-between">
                        <strong><h6 class="mb-0">Datos de envio</h6></strong>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {{-- {{ dd($orden) }} --}}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <i for="firstName" class="form-label">Nombre</i>
                                <p class="mb-0 fs-4">{{ $orden->nombreCliente }}</p>
                            </div>

                            <div class="col-md-6">
                                <i for="email" class="form-label">Email</i>
                                <p class="mb-0 fs-4">{{ $orden->email }}</p>
                            </div>

                            <div class="col-md-6">
                                <i for="address" class="form-label">Direccion</i>
                                <p class="mb-0 fs-4">{{ $orden->direccion }}</p>
                            </div>

                            <div class="col-md-6">
                                <i for="telefono" class="form-label">Teléfono</i>
                                <p class="mb-0 fs-4">{{ $orden->telefono }}</p>
                            </div>

                            <div class="col-md-6">
                                <i for="ciudad" class="form-label">Ciudad</i>
                                <p class="mb-0 fs-4">{{ $orden->ciudad }}</p>
                            </div>

                            <div class="col-md-6">
                                <i for="state" class="form-label">Departamento</i>
                                <p class="mb-0 fs-4">{{ $orden->depto }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tu Compra -->
            <div class="col-md-12">
                <div class="card  mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-2 d-flex flex-row align-items-center justify-content-between">
                        <strong><h6 class="mb-0">Detalle</h6></strong>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        @if($detalleOrden)
                            <table id="cart" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th class="border-top-0" style="width:55%">Producto</th>
                                        <th class="border-top-0" style="width:15%">Precio</th>
                                        <th class="border-top-0" style="width:8%">Cantidad</th>
                                        <th class="border-top-0 text-center" style="width:20%">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @foreach($detalleOrden as $id => $details)
                                        @php $total += $details->precio * $details->cantidad @endphp
                                        <tr data-id="{{ $id }}">
                                            <td data-th="Product">
                                                <div class="d-flex align-items-center">
                                                    <div class="col-sm-12">
                                                        <span class="nomargin">{{ $details->nombreProducto }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-th="Price">${{ number_format($details->precio, 0, ',', '.') }}</td>
                                            <td data-th="Quantity">
                                                {{ $details->cantidad }}
                                            </td>
                                            <td data-th="Subtotal" class="text-center">${{ number_format($details->precio * $details->cantidad, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <span>Total (COP)</span>
                            <strong>
                                @php $total = 0 @endphp
                                @foreach($detalleOrden as $id => $details)
                                    @php $total += $details->precio * $details->cantidad @endphp
                                @endforeach
                                ${{ number_format($total, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            {{-- {{ dd($currentUser) }} --}}

            @if (session('status')=='BORRADOR' || session('status')=='PENDIENTE')
                <div class="col-md-12">
                    <!-- Card -->
                    <div class="card  mb-4">
                        <!-- Payment -->
                        <!-- Card Body -->
                        <div class="card-body">
                            {{-- {{ dd((int)$orden->total) }} --}}
                                @include('layouts.store.wompi')
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection