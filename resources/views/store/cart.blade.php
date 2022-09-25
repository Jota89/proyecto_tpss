@extends('layouts.store.app')
@section('content')
<header class="bg-dark py-4 hero hero-cart">
    <div class="container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder mt-2">Carrito de Compras</h1>
            @php $cant = 0 @endphp
            @foreach((array) session('cart') as $id => $details)
                @php $cant += $details['quantity'] @endphp
            @endforeach
        </div>
    </div>
</header>
<div class="container">
        <section class="py-5 ">
            <div class="container px-4 px-lg-5 mt-0">
                <div class="row ">
                    <div class="col-md-12">

                        @if(session('cart'))
                            <table id="cart" class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th style="width:45%">Producto</th>
                                        <th style="width:15%">Precio</th>
                                        <th style="width:8%">Cantidad</th>
                                        <th style="width:20%" class="text-center">Subtotal</th>
                                        <th style="width:10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if(session('cart'))
                                        @foreach(session('cart') as $id => $details)
                                            @php $total += $details['price'] * $details['quantity'] @endphp
                                            <tr data-id="{{ $id }}">
                                                <td data-th="Product">
                                                    <div class="d-flex align-items-center">
                                                        <div class="col-sm-3 hidden-xs">
                                                            @php $imagen = $details['image']['name'] @endphp
                                                            <img class="card-img-top mb-5 mb-md-0"  src="{{URL::asset('/img/productos/'.$imagen)}}" />
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <span class="nomargin">{{ $details['name'] }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="Price">${{ number_format($details['price'], 0, ',', '.') }}</td>
                                                <td data-th="Quantity">
                                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                                                </td>
                                                <td data-th="Subtotal" class="text-center">${{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                                <td class="actions" data-th="">
                                                    <button class="btn remove-from-cart"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right"><h5><strong>Total ${{ number_format($total, 0, ',', '.') }}</strong></h5></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <a href="{{ route('tienda') }}" class="btn btn-outline-secondary flex-shrink-0 my-cart-btn"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                                            <a href="{{ route('checkout') }}" class="btn btn-outline-info flex-shrink-0 my-cart-btn">Pagar</a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="p-5 mb-4 bg-light rounded-3 text-center shadow">
                                <div class="container-fluid py-5 text-center">
                                    <h2 class="display-5 fw-bold">Uppps!!!</h2>
                                    <p class="col-md-8 fs-4 text-center mx-auto">No tienes ningun produto en tu carrito de compras. <br>Te invitamos a que visites nuestra tienda y elijas alguno de nuestros productos</p>
                                    <a href="{{ route('tienda') }}" class="btn btn-outline-secondary flex-shrink-0 my-cart-btn"><i class="fa fa-angle-left"></i> Continuar comprando</a>
                                </div>
                            </div>
                        @endif

                        




                    </div>

                </div>
            </div>
        </section>
</div>
@endsection
