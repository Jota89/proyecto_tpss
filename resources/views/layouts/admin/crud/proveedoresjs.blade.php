{{-- Custom Script --}}
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            /**
             * Inicializacion de Tablas
             */
            var tablaProveedores = jQuery('#proveedores-table')
            var table;
            //
            if(tablaProveedores.length){
                table = tablaProveedores.DataTable({
                    serveside:true,
                    processing:true,
                    ajax:"{{route('proveedores.index')}}",
                    columns:[
                        {data:'id', name:'id'},
                        {data:'nombre', name:'nombre'},
                        {data:'apellido', name:'apellido'},
                        {data:'documento', name:'documento'},
                        {data:'telefono', name:'telefono'},
                        {data:'email', name:'email'},
                        {data:'estado', name:'estado'},
                        {data:'acciones', name:'acciones'}
                    ],
                    responsive: true,
                    "language": {
                        "decimal":        "",
                        "emptyTable":     "No hay datos",
                        "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
                        "infoFiltered":   "(Filtrando de _MAX_ total de registros)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing":     "Procesando...",
                        "search":         "Buscar:",
                        "zeroRecords":    "No se encontratron registros",
                        "paginate": {
                            "first":      "Primero",
                            "last":       "Ultimo",
                            "next":       "Siguiente",
                            "previous":   "Anterior"
                        },
                        "aria": {
                        "sortAscending":  ": activar para ordenar la columna ascendente",
                        "sortDescending": ": activar para ordenar la columna descendente"
                        }
                    }
                });
            } 

            /**
             * Crear Registros
             */
            $('#createProveedor').click(function(){
                $('#id').val();
                $('#proveedorForm').trigger("reset");
                $('#ajaxModal #updateProveedor').hide();
                $('#ajaxModal #saveProveedor').show();
                $('#ajaxModal').modal('show');
            });

            /**
             * Guardar Registros
             */
            $('#saveProveedor').click(function(e){
                e.preventDefault();
                //Validar que no esten en blancp
                if($('#nombre').val() == ''){
                    $('#nombre_error strong').html('Por favor completa el campo Nombre')
                    $('#nombre_error').show();
                    $('#nombre').focus();
                    $('#nombre_error').fadeOut(6000,"linear");

                } else if($('#apellido').val() == ''){
                    $('#apellido_error strong').html('Por favor completa el campo Apellidos')
                    $('#apellido_error').show();
                    $('#apellido').focus();
                    $('#apellido_error').fadeOut(6000,"linear");

                } else if($('#tipo_doc').val() == 0){
                    $('#tipo_doc_error strong').html('Por favor completa el campo Tipo Documento')
                    $('#tipo_doc_error').show();
                    $('#tipo_doc').focus();
                    $('#tipo_doc_error').fadeOut(6000,"linear");

                } else if($('#documento').val() == ''){
                    $('#documento_error strong').html('Por favor completa el campo Numero Documento')
                    $('#documento_error').show();
                    $('#documento').focus();
                    $('#documento_error').fadeOut(6000,"linear");

                } else if($('#fecha_nacimiento').val() == ''){
                    $('#fecha_nacimiento_error strong').html('Por favor completa el campo Fecha de Nacimiento')
                    $('#fecha_nacimiento_error').show();
                    $('#fecha_nacimiento').focus();
                    $('#fecha_nacimiento_error').fadeOut(6000,"linear");

                } else if($('#sexo').val() == 0){
                    $('#sexo_error strong').html('Por favor completa el campo Sexo')
                    $('#sexo_error').show();
                    $('#sexo').focus();
                    $('#sexo_error').fadeOut(6000,"linear");

                } else if($('#direccion').val() == ''){
                    $('#direccion_error strong').html('Por favor completa el campo Dirección')
                    $('#direccion_error').show();
                    $('#direccion').focus();
                    $('#direccion_error').fadeOut(6000,"linear");

                } else if($('#ciudad').val() == ''){
                    $('#ciudad_error strong').html('Por favor completa el campo Ciudad')
                    $('#ciudad_error').show();
                    $('#ciudad').focus();
                    $('#ciudad_error').fadeOut(6000,"linear");

                } else if($('#departamento').val() == ''){
                    $('#departamento_error strong').html('Por favor completa el campo Departamento')
                    $('#departamento_error').show();
                    $('#departamento').focus();
                    $('#departamento_error').fadeOut(6000,"linear");

                } else if($('#telefono').val() == ''){
                    $('#telefono_error strong').html('Por favor completa el campo Telefono')
                    $('#telefono_error').show();
                    $('#telefono').focus();
                    $('#telefono_error').fadeOut(6000,"linear");

                } else if($('#email').val() == ''){
                    $('#email_error strong').html('Por favor completa el campo Correo Electronico')
                    $('#email_error').show();
                    $('#email').focus();
                    $('#email_error').fadeOut(6000,"linear");

                } else if($('#password').val() == '') {
                    $('#password_error strong').html('Por favor completa el campo Password')
                    $('#password_error').show();
                    $('#password').focus();
                    $('#password_error').fadeOut(6000,"linear");

                } else if($('#estado').val() == '') {
                    $('#estado_error strong').html('Por favor completa el campo Estado')
                    $('#estado_error').show();
                    $('#estado').focus();
                    $('#estado_error').fadeOut(6000,"linear");

                } 
                // Guardar registros despues de validar
                else{
                    $(this).html('Guardar');
                    $.ajax({
                        data:$("#proveedorForm").serialize(),
                        url: "{{route('proveedores.store')}}",
                        type:"POST",
                        dataType:'json',
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#proveedorForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                text: 'Proveedores Creado Exitosamente!',
                            })
                        },
                        error:function(data){
                            console.log('Error:', data);
                            $("#saveProveedores").html('Guardar');
                        }
                    });
                }



            });

            /**
             * Borrar Registros
             */
            $('body').on('click','#deleteProveedor', function(){
                var id = $(this).data("id");

                Swal.fire({
                        //title: 'Hey!!!',
                        text: "Estas seguro que deseas eliminar el proveedor?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, deseo eliminarlo!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type:"DELETE",
                            url: "{{route('proveedores.store')}}"+'/'+id,
                            success:function(data){
                                table.ajax.reload();
                                Swal.fire(
                                    'Eliminado!',
                                    'El proveedor ha sido eliminado.',
                                    'success'
                                )
                            },
                            error:function(data){
                                console.log('Error:', data)
                            }
                        })
                        
                    }
                })

            });

            /**
             * Editar Registros
             */
            $('body').on('click','#editProveedor', function(){
                var id = $(this).data("id");
                $.get("{{route('proveedores.index')}}"+"/"+id+"/edit",function(data){
                    //console.log(data.roles);
                    //$('#ajaxModalLabel').html('Editar Cliente')
                    $('#id').val(data.proveedor.id);
                    $('#nombre').val(data.proveedor.nombre);
                    $('#apellido').val(data.proveedor.apellido);
                    $('#tipo_doc').val(data.proveedor.tipo_doc);
                    $('#documento').val(data.proveedor.documento);
                    $('#fecha_nacimiento').val(data.proveedor.fecha_nacimiento);
                    $('#sexo').val(data.proveedor.sexo);
                    $('#direccion').val(data.proveedor.direccion);
                    $('#ciudad').val(data.proveedor.ciudad);
                    $('#departamento').val(data.proveedor.departamento);
                    $('#telefono').val(data.proveedor.telefono);
                    $('#email').val(data.proveedor.email);
                    $('#password').attr('required',false);
                    $('#password').val(data.proveedor.password);
                    $('#estado').val(data.proveedor.estado);
                    $('#ajaxModalLabel').html('Actualizar Proveedor');
                    $('#ajaxModal #updateProveedor').show();
                    $('#ajaxModal #saveProveedor').hide();
                    $('#ajaxModal').modal('show');
                });
            });
            $('#updateProveedor').click(function(e){
                var id = $("#id").val()
                e.preventDefault();
                if($('#nombre').val() == ''){
                    $('#nombre_error strong').html('Por favor completa el campo Nombre')
                    $('#nombre_error').show();
                    $('#nombre').focus();
                    $('#nombre_error').fadeOut(6000,"linear");

                } else if($('#apellido').val() == ''){
                    $('#apellido_error strong').html('Por favor completa el campo Apellidos')
                    $('#apellido_error').show();
                    $('#apellido').focus();
                    $('#apellido_error').fadeOut(6000,"linear");

                } else if($('#tipo_doc').val() == 0){
                    $('#tipo_doc_error strong').html('Por favor completa el campo Tipo Documento')
                    $('#tipo_doc_error').show();
                    $('#tipo_doc').focus();
                    $('#tipo_doc_error').fadeOut(6000,"linear");

                } else if($('#documento').val() == ''){
                    $('#documento_error strong').html('Por favor completa el campo Numero Documento')
                    $('#documento_error').show();
                    $('#documento').focus();
                    $('#documento_error').fadeOut(6000,"linear");

                } else if($('#fecha_nacimiento').val() == ''){
                    $('#fecha_nacimiento_error strong').html('Por favor completa el campo Fecha de Nacimiento')
                    $('#fecha_nacimiento_error').show();
                    $('#fecha_nacimiento').focus();
                    $('#fecha_nacimiento_error').fadeOut(6000,"linear");

                } else if($('#sexo').val() == 0){
                    $('#sexo_error strong').html('Por favor completa el campo Sexo')
                    $('#sexo_error').show();
                    $('#sexo').focus();
                    $('#sexo_error').fadeOut(6000,"linear");

                } else if($('#direccion').val() == ''){
                    $('#direccion_error strong').html('Por favor completa el campo Dirección')
                    $('#direccion_error').show();
                    $('#direccion').focus();
                    $('#direccion_error').fadeOut(6000,"linear");

                } else if($('#ciudad').val() == ''){
                    $('#ciudad_error strong').html('Por favor completa el campo Ciudad')
                    $('#ciudad_error').show();
                    $('#ciudad').focus();
                    $('#ciudad_error').fadeOut(6000,"linear");

                } else if($('#departamento').val() == ''){
                    $('#departamento_error strong').html('Por favor completa el campo Departamento')
                    $('#departamento_error').show();
                    $('#departamento').focus();
                    $('#departamento_error').fadeOut(6000,"linear");

                } else if($('#telefono').val() == ''){
                    $('#telefono_error strong').html('Por favor completa el campo Telefono')
                    $('#telefono_error').show();
                    $('#telefono').focus();
                    $('#telefono_error').fadeOut(6000,"linear");

                } else if($('#email').val() == ''){
                    $('#email_error strong').html('Por favor completa el campo Correo Electronico')
                    $('#email_error').show();
                    $('#email').focus();
                    $('#email_error').fadeOut(6000,"linear");

                } else if($('#password').val() == '') {
                    $('#password_error strong').html('Por favor completa el campo Password')
                    $('#password_error').show();
                    $('#password').focus();
                    $('#password_error').fadeOut(6000,"linear");

                } else if($('#rol').val() == 0) {
                    $('#rol_error strong').html('Por favor completa el campo Estado')
                    $('#rol_error').show();
                    $('#rol').focus();
                    $('#rol_error').fadeOut(6000,"linear");

                } else if($('#estado').val() == '') {
                    $('#estado_error strong').html('Por favor completa el campo Estado')
                    $('#estado_error').show();
                    $('#estado').focus();
                    $('#estado_error').fadeOut(6000,"linear");

                } else{
                    $.ajax({
                        data:$("#proveedorForm").serialize(),
                        url: "{{route('proveedores.index')}}"+"/"+id,
                        type:"PUT",
                        dataType:'json',
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#proveedorForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                text: 'Proveedor Actualizado Exitosamente!',
                            })
                        },
                        error:function(data){
                            console.log('Error:', data);
                        }
                    });
                }



            });

            /**
             * Resetear el formulario
             */
            $('#ajaxModal').on('hidden.bs.modal', function (e) {
                $('.formulario').trigger("reset");
            })
        })
    });
</script>
