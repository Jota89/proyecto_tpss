{{-- Productos Script --}}
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
            var tablaProductos = jQuery('#productos-table')
            
            var table;
            if(tablaProductos.length){
                table = tablaProductos.DataTable({
                    responsive: true,
                    autoWidth: false,
                    serveside:true,
                    processing:true,
                    ajax:"{{route('productos.index')}}",
                    columns:[
                        {data:'id', name:'id'},
                        {data:'codigo', name:'codigo'},
                        {data:'nombre', name:'nombre'},
                        {data:'precio', name:'precio'},
                        {data:'categoria_id', name:'categoria'},
                        {data:'proveedor_id', name:'proveedor'},
                        {data:'stock', name:'stock'},
                        {data:'estado', name:'estado'},
                        {data:'accciones', name:'accciones'}
                    ],
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
                //$.fn.dataTable.tables( { visible: true, api: true } ).columns.adjust().responsive.recalc();
                table.columns.adjust().draw();  
            }

            /**
             * Crear Registros
             */
            $('#createProducto').click(function(){
                $('#id').val();
                $('#formulario').trigger("reset");
                $('#ajaxModal #updateProducto').hide();
                $('#ajaxModal #saveProducto').show();
                $('#ajaxModal').modal('show');
            });

            /**
             * Guardar Registros
             */
            $('#saveProducto').click(function(e){
                e.preventDefault();
                //Validar que no esten en blanco
                if($('#codigo').val() == ''){
                    $('#codigo_error strong').html('Por favor completa el campo Codigo')
                    $('#codigo_error').show();
                    $('#codigo').focus();
                    $('#codigo_error').fadeOut(6000,"linear");

                } else if($('#nombre').val() == ''){
                    $('#nombre_error strong').html('Por favor completa el campo Nombres')
                    $('#nombre_error').show();
                    $('#nombre').focus();
                    $('#nombre_error').fadeOut(6000,"linear");

                } else if($('#descripcion').val() == ''){
                    $('#descripcion_error strong').html('Por favor completa el campo Descripcion')
                    $('#descripcion_error').show();
                    $('#descripcion').focus();
                    $('#descripcion_error').fadeOut(6000,"linear");

                } else if($('#precio').val() == ''){
                    $('#precio_error strong').html('Por favor completa el campo Precio de Producto')
                    $('#precio_error').show();
                    $('#precio').focus();
                    $('#precio_error').fadeOut(6000,"linear");

                } else if($('#descuento').val() == ''){
                    $('#descuento_error strong').html('Por favor completa el campo Descuento')
                    $('#descuento_error').show();
                    $('#descuento').focus();
                    $('#descuento_error').fadeOut(6000,"linear");

                } else if($('#categoria').val() == 0){
                    $('#categoria_error strong').html('Por favor completa el campo Categoria')
                    $('#categoria_error').show();
                    $('#categoria').focus();
                    $('#categoria_error').fadeOut(6000,"linear");

                } else if($('#proveedor').val() == 0){
                    $('#proveedor_error strong').html('Por favor completa el campo Proveedor')
                    $('#proveedor_error').show();
                    $('#proveedor').focus();
                    $('#proveedor_error').fadeOut(6000,"linear");

                } else if($('#stock').val() == 0){
                    $('#stock_error strong').html('Por favor completa el campo Stock')
                    $('#stock_error').show();
                    $('#stock').focus();
                    $('#stock_error').fadeOut(6000,"linear");

                } else if($('#imagen').val() == ''){
                    $('#imagen_error strong').html('Por favor completa el campo Imagen')
                    $('#imagen_error').show();
                    $('#imagen').focus();
                    $('#imagen_error').fadeOut(6000,"linear");

                } /* else if($('#galeria').val() == ''){
                    $('#galeria_error strong').html('Por favor completa el campo Galeria')
                    $('#galeria_error').show();
                    $('#galeria').focus();
                    $('#galeria_error').fadeOut(6000,"linear");

                } */ else if($('#estado').val() == '') {
                    $('#estado_error strong').html('Por favor completa el campo Estado')
                    $('#estado_error').show();
                    $('#estado').focus();
                    $('#estado_error').fadeOut(6000,"linear");

                } 
                // Guardar registros despues de validar
                else{
                    $.ajax({
                        data: new FormData($('#productoForm')[0]),
                        url: "{{route('productos.store')}}",
                        type:"POST",
                        dataType:'json',
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#productoForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            table.ajax.reload();
                            table.columns.adjust().draw();
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                text: 'Producto Creado Exitosamente!',
                            })
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log('Error:', errorThrown);
                        }
                    });
                }



            });

            /**
             * Borrar Registros
             */
            $('body').on('click','#deleteProducto', function(){
                var id = $(this).data("id");

                Swal.fire({
                        //title: 'Hey!!!',
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
                            type:"DELETE",
                            url: "{{route('productos.store')}}"+'/'+id,
                            success:function(data){
                                table.ajax.reload();
                                Swal.fire(
                                    'Eliminado!',
                                    'El producto ha sido eliminado.',
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
            $('body').on('click','#editProducto', function(){
                var id = $(this).data("id");
                $.get("{{route('productos.index')}}"+"/"+id+"/edit",function(data){
                    $('#id').val(data.producto.id);
                    $('#codigo').val(data.producto.codigo);
                    $('#nombre').val(data.producto.nombre);
                    $('#descripcion').val(data.producto.descripcion);
                    $('#precio').val(data.producto.precio);
                    $('#descuento').val(data.producto.descuento);
                    $('#categoria').val(data.producto.categoria_id);
                    $('#proveedor').val(data.producto.proveedor_id);
                    $('#stock').val(data.producto.stock);
                    //$('#imagen').val(data.producto.imagen);
                    $('#galeria').val(data.producto.galeria);
                    $('#estado').val(data.producto.estado);
                    $('#ajaxModalLabel').html('Actualizar Producto');
                    $('#ajaxModal #updateProducto').show();
                    $('#ajaxModal #saveProducto').hide();
                    $('#ajaxModal').modal('show');
                });
            });

            $('#updateProducto').click(function(e){
                var id = $("#id").val()
                e.preventDefault();
                if($('#codigo').val() == ''){
                    $('#codigo_error strong').html('Por favor completa el campo Codigo')
                    $('#codigo_error').show();
                    $('#codigo').focus();
                    $('#codigo_error').fadeOut(6000,"linear");

                } else if($('#nombre').val() == ''){
                    $('#nombre_error strong').html('Por favor completa el campo Nombres')
                    $('#nombre_error').show();
                    $('#nombre').focus();
                    $('#nombre_error').fadeOut(6000,"linear");

                } else if($('#descripcion').val() == ''){
                    $('#descripcion_error strong').html('Por favor completa el campo Descripcion')
                    $('#descripcion_error').show();
                    $('#descripcion').focus();
                    $('#descripcion_error').fadeOut(6000,"linear");

                } else if($('#precio').val() == ''){
                    $('#precio_error strong').html('Por favor completa el campo Precio de Producto')
                    $('#precio_error').show();
                    $('#precio').focus();
                    $('#precio_error').fadeOut(6000,"linear");

                } else if($('#descuento').val() == ''){
                    $('#descuento_error strong').html('Por favor completa el campo Descuento')
                    $('#descuento_error').show();
                    $('#descuento').focus();
                    $('#descuento_error').fadeOut(6000,"linear");

                } else if($('#categoria').val() == 0){
                    $('#categoria_error strong').html('Por favor completa el campo Categoria')
                    $('#categoria_error').show();
                    $('#categoria').focus();
                    $('#categoria_error').fadeOut(6000,"linear");

                } else if($('#proveedor').val() == 0){
                    $('#proveedor_error strong').html('Por favor completa el campo Proveedor')
                    $('#proveedor_error').show();
                    $('#proveedor').focus();
                    $('#proveedor_error').fadeOut(6000,"linear");

                } else if($('#stock').val() == 0){
                    $('#stock_error strong').html('Por favor completa el campo Stock')
                    $('#stock_error').show();
                    $('#stock').focus();
                    $('#stock_error').fadeOut(6000,"linear");

                } /* else if($('#imagen').val() == ''){
                    $('#imagen_error strong').html('Por favor completa el campo Imagen')
                    $('#imagen_error').show();
                    $('#imagen').focus();
                    $('#imagen_error').fadeOut(6000,"linear");

                }  *//* else if($('#galeria').val() == ''){
                    $('#galeria_error strong').html('Por favor completa el campo Galeria')
                    $('#galeria_error').show();
                    $('#galeria').focus();
                    $('#galeria_error').fadeOut(6000,"linear");

                } */ else if($('#estado').val() == '') {
                    $('#estado_error strong').html('Por favor completa el campo Estado')
                    $('#estado_error').show();
                    $('#estado').focus();
                    $('#estado_error').fadeOut(6000,"linear");

                } else{
                    $.ajax({
                        data:$("#productoForm").serialize(),
                        url: "{{route('productos.index')}}"+"/"+id,
                        type:"PUT",
                        dataType:'json',
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#productoForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                text: 'Producto Actualizado Exitosamente!',
                            })
                            if(table){
                                table.ajax.reload();
                            } else{
                                window.scrollTo({ top: 0, behavior: 'smooth' });
                                location.reload()
                            }
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log('Error:', errorThrown);
                        }
                    });
                }



            });

            $('#upLoadImage').click(function(e){
                
                var id = $("#id").val()
                e.preventDefault();
                if($('#imagen').val() == ''){
                    $('#imagen_error strong').html('Por favor completa el campo Imagen')
                    $('#imagen_error').show();
                    $('#imagen').focus();
                    $('#imagen_error').fadeOut(6000,"linear");

                }  else{
                    var fileInputElement = $("#imagen")

                    //formData.append("username", "Groucho");
                    //formData.append("accountnum", 123456); // number 123456 is immediately converted to string "123456"
                    // HTML file input user's choice...
                    
                    //console.log(fileInputElement.prop('files'));
                    console.log(new FormData($('#uploadForm')[0]));
                    console.log($("#uploadForm").serialize())
                    var formData = new FormData($("#uploadForm")[0]); 
                    console.log(formData);
                    //return;

                    $.ajax({
                        data: new FormData($('#uploadForm')[0]),
                        url: "{{route('productos.index')}}"+"/"+id+"/edit",
                        type:"GET",
                        dataType:'json',
                        processData: false,  // tell jQuery not to process the data
                        contentType: false,  // tell jQuery not to set contentType
                        cache: false,
                        crossDomain: false,
                        success:function(data){
                            $('#uploadForm').trigger("reset");
                            //$('#ajaxModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                text: 'Producto Actualizado Exitosamente!',
                            })
                            window.scrollTo({ top: 0, behavior: 'smooth' });
                            //  location.reload()
                        },
                        error:function(XMLHttpRequest, textStatus, errorThrown){
                            console.log('Error:', errorThrown);
                        }
                    });
                }



            });

            $('#imagen').on('change',function(){
                for(var i=0; i< $(this).get(0).files.length; ++i){
                    var file1 = $(this).get(0).files[i].size;
                    if(file1){
                        var file_size = $(this).get(0).files[i].size;
                        if(file_size > 600000){   //  max  600KB    
                            $('#imagen_error strong').html('El peso de la imagen no puede superar los 600 KB')
                            $('#imagen_error').fadeIn(500,"linear");
                            $('#imagen').focus();
                            $('#cargarImagen').attr('disabled',true)
                            //$('#imagen_error').fadeOut(6000,"linear");
                        }else{
                            $('#imagen_error').fadeOut(500,"linear");
                            $('#cargarImagen').attr('disabled',false)
                        }
                    }
                }
            });

            $('body').on('click','.borrarImagen', function(e){
                e.preventDefault();
                Swal.fire({
                        //title: 'Hey!!!',
                        text: "Estas seguro que deseas eliminar la imagen?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, deseo eliminarla!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-imagen-'+$(this).attr('id')+'-form').submit();
                    }
                })



                
                //console.log($(this).attr('id'))
                
            });


            $(".borrarImagen").click(function (e) {

            })

      

            /**
             * Resetear el formulario
             */
            $('#ajaxModal').on('hidden.bs.modal', function (e) {
                $('.formulario').trigger("reset");
            })
        })
    });


</script>