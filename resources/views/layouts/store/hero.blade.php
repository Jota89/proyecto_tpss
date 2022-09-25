<header class="bg-dark py-5 hero">
    <div class="container px-4 px-lg-4 my-3">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">{{ $title }}</h1>
            <p class="lead fw-normal text-white-50">Categorias {{ count($categorias) }} - Productos {{ count($productos) }}</p>
            <input type="text" name="search" id="search" class="form-control-sm" placeholder="Buscar..." />
        </div>
    </div>
</header>