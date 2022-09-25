@extends('layouts.store.app')
@section('content')
@include('layouts.store.hero')
<div class="container-fluid">
    <section class="row">
        @include('layouts.store.sidebar')
        <div class="py-5 col-md-9">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                    @foreach ($productos as $item)
                        <div class="col-md-4 mb-5">
                            <div class="card h-100">
                                <!-- Sale badge-->
                                @if ($item->oferta != '' || $item->oferta > 0)
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                @endif                            
                                <!-- Product image-->
                                @if(count($item->imagen)>0)
                                    <img id="{{ $item->imagen['id'] }}" class="card-img-top mb-5 mb-md-0" src="{{ asset($item->imagen['path'].'/'.$item->imagen['name']) }}" alt="{{ $item->imagen['name'] }}" srcset="">
                                @else
                                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                                @endif
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">{{ $item->nombre }}</h5>
                                        <!-- Product reviews-->
                                        <div class="d-flex justify-content-center  text-warning mb-2">
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                            <div class="bi-star-fill"></div>
                                        </div>
                                        <!-- Product price-->
                                        <span class="text-muted text-decoration-line-through">${{ number_format($item->precio, 0, ',', '.') }}</span>
                                        $18.00
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer pb-4 pr-4 pl-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center d-flex justify-content-evenly">
                                        <a class="btn btn-outline-info mt-auto my-cart-btn" href="{{ route('add.to.cart', [$item->id, 1]) }}">
                                            <i class="fa fa-cart-plus" aria-hidden="true"></i> Comprar
                                        </a>
                                        <a class="btn btn-outline-secondary mt-auto" href="{{ route('showCategoryProduct',[strtolower($categoria->nombre),$item->id]) }}">
                                            <i class="fas fa-eye fa-sm"></i> Ver
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
