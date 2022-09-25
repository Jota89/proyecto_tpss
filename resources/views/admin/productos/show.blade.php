
@extends('layouts.admin.crud.list')
@section('content')
    <div class="row">
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h1 class="m-0 font-weight-bold text-primary">{{ $producto->nombre }}</h1>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        Los campos con asteriscos (*) son obligatorios
                    </div>
                    <form id="productoForm" name="productoForm" class="formulario form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id='id' value="{{ $producto->id }}">
                        <div class="form-group">
                            <label for="codigo">Codigo <span class="text-danger">*</span></label>
                            {!! Form::text('codigo', $producto->codigo, array('id' => 'codigo', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="codigo_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            {!! Form::text('nombre', old('nombre',$producto->nombre), array('id' => 'nombre', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="nombre_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
                            {!! Form::text('descripcion', old('ddescripcion',$producto->descripcion), array('id' => 'descripcion', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="descripcion_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio<span class="text-danger">*</span></label>
                            {!! Form::text('precio', old('precio',$producto->precio), array('id' => 'precio', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="precio_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="descuento">Descuento <span class="text-danger">*</span></label>
                            {!! Form::text('descuento', old('descuento',$producto->descuento), array('id' => 'descuento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="descuento_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria <span class="text-danger">*</span></label>
                            <select name="categoria" id="categoria" class="form-control">
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}" {{ old('categoria_id', $item->id) == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span id="categoria_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor <span class="text-danger">*</span></label>
                            <select name="proveedor" id="proveedor" class="form-control">
                                @foreach ($proveedores as $item)
                                    <option value="{{ $item->id }}" {{ old('proveedor_id', $item->id) == $item->id ? 'selected' : '' }}>{{ $item->nombre }}</option>
                                @endforeach
                            </select>

                            <span id="proveedor_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            {!! Form::text('stock', old('stock',$producto->stock), array('id' => 'stock', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="stock_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado <span class="text-danger">*</span></label>
                            {!! Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'), '1', array('id' => 'estado', 'class' => 'form-control', 'required' => 'required' )) !!}
                            <span id="estado_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <button id="updateProducto" class="btn btn-primary save ">Actualizar Informacion</button>
                    </form> 
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Imagenes</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form id="uploadForm" name="uploadForm" class=" form-horizontal"  method="POST" enctype="multipart/form-data" action="{{ route('productos.imagenUp') }}">
                        @csrf
                        <input type="hidden" name="id" id='id' value="{{ $producto->id }}">
                        <input type="hidden" name="nombreP" value="{{ $producto->nombre }}">
                        <div class="form-group">
                            <label for="imagen">Cargar Imagen <span class="text-danger"></span></label>
                            <input type="file" name="imagen" placeholder="Choose image" id="imagen" class="form-control" accept=".jpg,.png,.jpeg,.webp" required>
                            <span id="imagen_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <button id="cargarImagen" class="btn btn-primary">Cargar Imagen</button>
                    </form>

                </div>
                <div class="card-footer">
                    <div class="row mt-4">
                        @foreach ($imagenes as $item)
                            <div class="col-sm-12 col-md-6 mb-4">
                                <div class="card border-left-primary shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="dropdown no-arrow float-right">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                <div class="dropdown-header">Acciones:</div>
                                                <div class="dropdown-divider"></div>
                                                <a id="{{ $item->id }}" href="#" class="dropdown-item borrarImagen" {{-- onclick="event.preventDefault(); document.getElementById('delete-imagen-{{ $item->id }}-form').submit();" --}}>
                                                    {{ __("Eliminar") }}
                                                </a>
                                                <form id="delete-imagen-{{ $item->id }}-form" action="{{ route("productos.imagenDel", ["id" => $item->id]) }}" method="POST" class="hidden">
                                                    @method("DELETE")
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                        <div class="row no-gutters align-items-center justify-content-center">
                                            <img id="{{ $item->id }}" class="carsd-img-top img-flluid" height="80" width="auto" src="{{ asset($item->path.'/'.$item->name) }}" alt="" srcset="">
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
