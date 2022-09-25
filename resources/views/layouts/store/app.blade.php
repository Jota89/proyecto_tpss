<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NovaPlus') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('css/store.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.store.header')
        <main class="">
            @yield('content')
        </main>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#app">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('layouts.store.carrito')
    <!-- Logout Modal-->
    @include('layouts.admin.logoutmodal')
    <!-- Sccrips JS-->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}" ></script>
    @include('layouts.admin.script.core')
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/typeahead.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}" ></script>
    <script type="text/javascript">
        $(function () {
            updateCart();
            removeFromCart();
            updateCant();
        });

        function updateCart() {
            $(".update-cart").change(function (e) {
                e.preventDefault();

                var ele = $(this);
                if(ele.parents("tr").find(".quantity").val()>0){
                    Swal.fire({
                            text: "Estas seguro que deseas actualizar la cantidad?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, deseo actualizar!',
                            cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('update.cart') }}',
                                method: "patch",
                                data: {
                                    _token: '{{ csrf_token() }}', 
                                    id: ele.parents("tr").attr("data-id"), 
                                    quantity: ele.parents("tr").find(".quantity").val()
                                },
                                success: function (response) {
                                window.location.reload();
                                }
                            });                            
                        }
                    })

                } else{
                    Swal.fire({
                            text: "Estas seguro que deseas eliminar el producto?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si, deseo eliminarlo!',
                            cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('remove.from.cart') }}',
                                method: "DELETE",
                                data: {
                                    _token: '{{ csrf_token() }}', 
                                    id: ele.parents("tr").attr("data-id")
                                },
                                success: function (response) {
                                    window.location.reload();
                                }
                            });
                        }
                    })




                }


            });
        }

        function removeFromCart() {
            $(".remove-from-cart").click(function (e) {
                e.preventDefault();
        
                var ele = $(this);
        
                if(confirm("Are you sure want to remove?")) {
                    $.ajax({
                        url: '{{ route('remove.from.cart') }}',
                        method: "DELETE",
                        data: {
                            _token: '{{ csrf_token() }}', 
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        }

        function updateCant() {
            $("#inputQuantity").change(function(e){
                var cant = $(this).val();
                console.log(cant);
            });
        }

    </script>

</body>
</html>
