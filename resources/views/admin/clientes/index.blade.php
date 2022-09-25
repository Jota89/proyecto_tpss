
@extends('layouts.admin.crud.list')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h1 class="m-0 font-weight-bold text-primary">Gestion de Clientes</h1>
                    <button type="button" id="createCliente" class="btn d-block float-right" data-toggle="modal" data-target="#ajaxModal"><i class="fas fa-user-plus"></i> Crear</button>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="clientes-table" class="table table-stripe">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col"> Apellido</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo</th>
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
                    <h2 class="modal-title" id="ajaxModalLabel">Crear Clientes</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary" role="alert">
                        Los campos con asteriscos (*) son obligatorios
                    </div>
                    <form id="clienteForm" name="clienteForm" class="formulario form-horizontal" >
                        @csrf
                        <input type="hidden" name="id" id='id'>
                        <div class="form-group">
                            <label for="nombre">Nombre <span class="text-danger">*</span></label>
                            {!! Form::text('nombre', null, array('id' => 'nombre', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="nombre_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="apellido">Apellidos <span class="text-danger">*</span></label>
                            {!! Form::text('apellido', null, array('id' => 'apellido', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="apellido_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="tipo_doc">Tipo de Documento <span class="text-danger">*</span></label>
                            {!! Form::select('tipo_doc', array('0' => 'Selecione...', 'cc' => 'Cedula', 'pp' => 'Pasaporte', 'ce' => 'Cedula Extranjeria'), '0', array('id' => 'tipo_doc', 'class' => 'form-control', 'required' => 'required' )) !!}
                            <span id="tipo_doc_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="documento">Numero Documento <span class="text-danger">*</span></label>
                            {!! Form::number('documento', null, array('id' => 'documento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="documento_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            {!! Form::date('fecha_nacimiento', null, array('id' => 'fecha_nacimiento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required', 'max' => $max )) !!}
                            
                            <span id="fecha_nacimiento_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo <span class="text-danger">*</span></label>
                            {!! Form::select('sexo', array('0' => 'Selecione...', 'm' => 'Masculino', 'f' => 'Femenino'), '0', array('id' => 'sexo', 'class' => 'form-control', 'required' => 'required' )) !!}
                            <span id="sexo_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección <span class="text-danger">*</span></label>
                            {!! Form::text('direccion', null, array('id' => 'direccion', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="direccion_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad <span class="text-danger">*</span></label>
                            {!! Form::text('ciudad', null, array('id' => 'ciudad', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="ciudad_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="departamento">Departamento <span class="text-danger">*</span></label>
                            {!! Form::text('departamento', null, array('id' => 'departamento', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="departamento_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Telefono <span class="text-danger">*</span></label>
                            {!! Form::text('telefono', null, array('id' => 'telefono', 'class' => 'form-control', 'placeholder' => '', 'required' => 'required' )) !!}
                            <span id="telefono_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                            {!! Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo electrónico', 'required' => 'required' )) !!}
                            <span id="email_error" class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            {!! Form::password('password', array('id' => 'password', 'class' => 'form-control', "autocomplete" => 'off', 'required' => 'required' )) !!}
                            <span id="password_error" class="invalid-feedback" role="alert">
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
                        <button id="saveCliente" class="btn btn-primary save">Guardar</button>
                        <button id="updateCliente" class="btn btn-primary save ">Actualizar Informacion</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
