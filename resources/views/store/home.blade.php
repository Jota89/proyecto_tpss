@extends('layouts.store.app')
@section('content')
<main>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/banner_asus.jpeg') }}" alt="Samsumg" srcset="">
                <div class="container">
                    <div class="carousel-caption text-end px-5" style="background-color: rgba(0,0,0,0.5);">
                        <h2 class="featurette-heading mt-3">Celulares a los mejores precios.</h2>
                        <p>Novedosos diseños con funciones y aplicaciones de vanguardia.</p>
                        <p><a class="btn btn-outline-dark-2 mt-auto" href="{{ route('tienda') }}">VER TODOS LOS PRODUCTOS</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner_iphone.jpg') }}" alt="Samsumg" srcset="">
                <div class="container">
                    <div class="carousel-caption text-end px-5" style="background-color: rgba(0,0,0,0.5);">
                        <h2 class="featurette-heading mt-3">Las mejores marcas para tí.</h2>
                        <p>Exclusividad en celulares, las mejores marcas al mejor precio.</p>
                        <p><a class="btn btn-outline-dark-2 mt-auto" href="{{ route('tienda') }}">VER TODOS LOS PRODUCTOS</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/banner_motorola.jpg') }}" alt="Samsumg" srcset="">
                <div class="container">
                    <div class="carousel-caption text-end px-5" style="background-color: rgba(0,0,0,0.5);">
                        <h2 class="featurette-heading mt-3">Actualizate con lo último en tecnología.</h2>
                        <p>Pantallas más amplias y la mejor resolución que puedes encontrar.</p>
                        <p><a class="btn btn-outline-dark-2 mt-auto" href="{{ route('tienda') }}">VER TODOS LOS PRODUCTOS</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Marketing messaging and featurettes
        ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <a class="col-lg-4 mb-5" href="{{ route('showCategory','iphone') }}" title="Ver Categoria">
                <img class="bd-placeholder-img" width="140" src="{{ asset('img/iphone.png') }}" alt="Iphone" srcset="">
            </a>
            <a class="col-lg-4 mb-5" href="{{ route('showCategory','samsung') }}" title="Ver Categoria">
                <img class="bd-placeholder-img" width="140" src="{{ asset('img/samsumg.svg') }}" alt="Samsumg" srcset="">
            </a>
            <a class="col-lg-4 mb-5" href="{{ route('showCategory','motorola') }}" title="Ver Categoria">
                <img class="bd-placeholder-img" width="140" src="{{ asset('img/motorola.png') }}" alt="Motorola" srcset="">
            </a>
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider mt-2">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading">Fotos detalladas gracias al Samsung Galaxy S22+ <span class="text-muted">y su  triple fotosensor de 50+12+10 MP.</span></h2>
                <p class="lead">Incluye un optimizador de escenas, reconocimiento automático de imágenes y encuadre profesional inteligente para ofrecerte la mejor configuración y encuadre para mejorar en gran medida tus fotos.</p>
                    <p><a class="btn btn-outline-info mt-auto" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/img_1.png" href="{{ route('showCategoryProduct',['samsung',1]) }}">{{-- <i class="fas fa-eye fa-sm"></i> --}} Detalles</a></p>
            </div>
            <div class="col-md-5">
                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{ asset('img/productos/Samsung_Galaxy_S22+_1_WhatsApp_Image_2022-09-20_at_15.52.51_(1).jpeg') }}" alt="Samsumg" srcset="">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading">iPhone <span class="text-muted">13 Pro Max.</span></h2>
                <p class="lead">Un sistema de fotografía profesional mejorado como nunca antes. Una pantalla Super Retina XDR de 6.7 pulgadas con tecnología ProMotion para mayor velocidad y capacidad de respuesta. Y el chip Bionic A15 ultrarrápido.</p>
                    <p><a class="btn btn-outline-info mt-auto" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/img_1.png" href="{{ route('showCategoryProduct',['iphone',2]) }}">{{-- <i class="fas fa-eye fa-sm"></i> --}} Detalles</a></p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{ asset('img/productos/Iphone_80iPhone_13_Pro_Max_2_WhatsApp_Image_2022-09-20_at_15.52.51_(8).jpeg') }}" alt="Samsumg" srcset="">

            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                {{--  --}}
                <h2 class="featurette-heading">Motorola Moto Edge 30  <span class="text-muted">Pro 256GB con obsequio.</span></h2>
                <p class="lead">Conoce el celular Motorola Edge 30 Pro 256GB y llevate gratis una Go Pro. Adquiérelo en Kit Amigo y por tu primera recarga de $2000 o más, te darémos un Paquete de Bienvenida.</p>
                    <p><a class="btn btn-outline-info mt-auto" data-id="1" data-name="product 1" data-summary="summary 1" data-price="10" data-quantity="1" data-image="images/img_1.png" href="{{ route('showCategoryProduct',['motorola',1]) }}">{{-- <i class="fas fa-eye fa-sm"></i> --}} Detalles</a></p>
            </div>
            <div class="col-md-5">
                <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{ asset('img/productos/Motorola_Moto_Edge_30_Pro_256GB_3_WhatsApp_Image_2022-09-20_at_15.52.51_(13).jpeg') }}" alt="Samsumg" srcset="">
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2021 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>
</main>

@endsection