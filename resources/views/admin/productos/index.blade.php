
@extends('layouts.admin.crud.list')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h1 class="m-0 font-weight-bold text-primary">Gestion de Productos</h1>
                    <button type="button" id="createProducto" class="btn d-block float-right" data-toggle="modal" data-target="#ajaxModal"><i class="fas fa-plus"></i> Crear</button>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="productos-table" class="table table-stripe" >
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Proeedor</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                    
                </div>

            </div>
        </div>
        <br>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="ajaxModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="ajaxModalLabel">Crear Producto</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        Los campos con asteriscos (*) son obligatorios
                    </div>
                    <form id="productoForm" name="productoForm" class="formulario form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id='id'>
                        <div class="form-group">
                            <label for="codigo">Codigo <span class="text-danger">*</span></label>
                            {!! Form::text('codigo', null, array('id' => 'codigo', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="codigo_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            {!! Form::text('nombre', null, array('id' => 'nombre', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="nombre_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion <span class="text-danger">*</span></label>
                            {!! Form::text('descripcion', null, array('id' => 'descripcion', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="descripcion_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio<span class="text-danger">*</span></label>
                            {!! Form::text('precio', null, array('id' => 'precio', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="precio_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="descuento">Descuento <span class="text-danger">*</span></label>
                            {!! Form::text('descuento', null, array('id' => 'descuento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="descuento_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria <span class="text-danger">*</span></label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="0" selected="selected">Selecione...</option>
                                @foreach ($categorias as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                            <span id="categoria_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="proveedor">Proveedor <span class="text-danger">*</span></label>
                            <select name="proveedor" id="proveedor" class="form-control">
                                <option value="0" selected="selected">Selecione...</option>
                                @foreach ($proveedores as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>

                            <span id="proveedor_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stock <span class="text-danger">*</span></label>
                            {!! Form::text('stock', null, array('id' => 'stock', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="stock_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen <span class="text-danger"></span></label>
                            <input type="file" name="imagen" placeholder="Choose image" id="imagen" class="form-control" >
                            @error('image')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror

                            <span id="imagen_error" class="invalid-feedback" role="alert">
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
                        <button id="saveProducto" class="btn btn-primary save">Guardar</button>
                        <button id="updateProducto" class="btn btn-primary save ">Actualizar Informacion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
