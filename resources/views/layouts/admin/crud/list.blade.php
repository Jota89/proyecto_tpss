@include('layouts.admin.head')
@include('layouts.admin.crud.datatablecss')
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layouts.admin.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('layouts.admin.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('layouts.admin.logoutmodal')

    <!-- Sccrips JS-->
    @include('layouts.admin.script.core')
    {{-- Popper JS --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>
    {{-- Data Tables --}}
    <script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}" defer></script>
    {{-- Sweet Alert --}}
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @include('layouts.admin.crud.usuariosjs')
    @include('layouts.admin.crud.empleadosjs')
    @include('layouts.admin.crud.clientesjs')
    @include('layouts.admin.crud.proveedoresjs')
    @include('layouts.admin.crud.productosjs')
    
</body>

</html>