<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-text mx-3">Panel Administrativo</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/admin') }}" data-title="Escritorio">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Escritorio</span>
        </a>
        
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/usuarios')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/admin/usuarios') }}" data-title="Usuarios">
            <i class="fas fa-fw fa-users"></i> 
            <span>Usuarios</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/empleados')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/admin/empleados') }}" data-title="Empleados">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Empleados</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/clientes')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/admin/clientes') }}" data-title="Clientes">
            <i class="fas fa-fw fa-user-tag"></i>
            <span>Clientes</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/proveedores')) ? 'active' : '' }} ">
        <a class="nav-link" href="{{ url('/admin/proveedores') }}" data-title="Proveedores">
            <i class="fas fa-fw fa-people-carry"></i>
            <span>Proveedores</span>
        </a>
    </li>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">
     <!-- Nav Item - Dashboard -->
     <li class="nav-item {{ (request()->is('admin/productos')) ? 'active' : '' }} ">
         <a class="nav-link" href="{{ url('/admin/productos') }}" data-title="Productos">
            <i class="fas fa-box-open"></i>
            <span>Productos</span>
         </a>
     </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports"
            aria-expanded="true" aria-controls="collapseReports" >
            <i class="fas fa-fw fa-print"></i>
            <span>Reportes</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="#" data-title="Ventas">Ventas</a>
                <a class="collapse-item" href="#" data-title="Gastos">Gastos</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline" data-title="Cerrar Menu">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
