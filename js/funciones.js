$(document).ready(function(){

    //ELIMINAR USUARIO
    $('.del_usuario').click(function(e){
        e.preventDefault();
        var usuario = $(this).attr('product');
        var action = 'infousuario';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,usuario:usuario},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);
                //$('#producto_id').val(info.codproducto);
                //$('.namePorducto').html(info.descripcion);

                $('.bodyModal').html('<form action="" method="POST" name="form_del_usuario" id="form_del_product" onsubmit="event.preventDefault(); delusuario();">'+
                                        '<i class="fas fa-user-times fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px; font-size: 75pt;"></i> <br>'+
                                        '<h2>¿Esta seguro de eliminar el siguiente registro?</h2><br>'+
                                        '<h3 style="margin-bottom: 5px;" class="usuario">Usuario: <span>'+info.usuario+'</span></h3>'+
                                        '<h3 style="margin-bottom: 5px;" class="nombre">Nombre: <span>'+info.nombre+'</span></h3>'+
                                        '<h3 style="margin-bottom: 5px;" class="correo">Correo: <span>'+info.correo+'</span></h3>'+
                                        '<input type="hidden" name="idusuario" id="idusuario" value="'+info.idusuario+'" required>'+
                                        '<input type="hidden" id="alert" name="action" value="delusuario" required>'+
                                        '<div class="alert alertAddProduct"></div>'+
                                        '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
                                        '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+  
                                    '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    //ELIMINAR CLIENTE
    $('.del_cliente').click(function(e){
        e.preventDefault();
        var cliente = $(this).attr('product');
        var action = 'infocliente';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,cliente:cliente},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);
                //console.log(info);
                //$('#producto_id').val(info.codproducto);
                //$('.namePorducto').html(info.descripcion);

                $('.bodyModal').html('<form action="" method="POST" name="form_del_usuario" id="form_del_product" onsubmit="event.preventDefault(); delcliente();">'+
                                     '<i class="fas fa-user-times fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px; font-size: 75pt;"></i><br>'+
                                     '<h2>Esta seguro de eliminar el siguiente registro?</h2><br>'+
                                     '<h3 style="margin-bottom: 5px;" class="cedula">Cedula: <span>'+info.cedula+'</span></h3>'+
                                     '<h3 style="margin-bottom: 5px;" class="nombre">Nombre: <span>'+info.nombre+'</span></h3>'+
                                     '<h3 style="margin-bottom: 5px;" class="direccion">Direccion: <span>'+info.direccion+'</span></h3>'+
                                     '<input type="hidden" name="idcliente" id="idcliente" value="'+info.idcliente+'" required>'+
                                     '<input type="hidden" id="alert" name="action" value="delusuario" required>'+
                                     '<div class="alert alertAddProduct"></div>'+
                                     '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
                                     '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+  
                                 '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    //ELIMINAR PROVEEDOR
    $('.del_proveedor').click(function(e){
        e.preventDefault();
        var proveedor = $(this).attr('product');
        var action = 'infoproveedor';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,proveedor:proveedor},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);
                //console.log(info);
                //$('#producto_id').val(info.codproducto);
                //$('.namePorducto').html(info.descripcion);

                $('.bodyModal').html('<form action="" method="POST" name="form_del_usuario" id="form_del_product" onsubmit="event.preventDefault(); delproveedor();">'+
                                     '<i class="fas fa-building fa-7x" style="color: #f26b6b; align-content: center; margin-bottom: 10px; font-size: 75pt;"></i><br>'+
                                     '<h2>Esta seguro de eliminar el siguiente registro?</h2><br>'+
                                     '<h3 style="margin-bottom: 5px;" class="proveedor">Proveedor: <span>'+info.proveedor+'</span></h3>'+
                                     '<h3 style="margin-bottom: 5px;" class="contacto">Contacto: <span>'+info.contacto+'</span></h3>'+
                                     '<h3 style="margin-bottom: 5px;" class="telefono">Telefono: <span>'+info.telefono+'</span></h3>'+
                                     '<h3 style="margin-bottom: 5px;" class="direccion">Direccion: <span>'+info.direccion+'</span></h3>'+
                                     '<input type="hidden" name="codproveedor" id="codproveedor" value="'+info.codproveedor+'" required>'+
                                     '<input type="hidden" id="alert" name="action" value="delusuario" required>'+
                                     '<div class="alert alertAddProduct"></div>'+
                                     '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
                                     '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+  
                                 '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    //MENU DESLIZANTE
    $('.btnmenu').click(function(e){
        e.preventDefault();
        if ($('nav').hasClass('viewMenu')) 
        {
            $('nav').removeClass('viewMenu');
        }else{
            $('nav').addClass('viewMenu');
        }
    });

    $('nav ul li').click(function(){
        $('nav ul li ul').slideUp();
        $(this).children('ul').slideToggle();
    });

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
    	var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
              	alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
    	$('#foto').val('');
    	$(".delPhoto").addClass('notBlock');
    	$("#img").remove();

        if ($('#foto_actual') && $('#foto_remove')) 
        {
            $('#foto_remove').val('user.png');
        }
    });

    // MODAL FORM ADD PRODUCTO
    $('.add_product').click(function(e){
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,producto:producto},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);

                //$('#producto_id').val(info.codproducto);
                //$('.namePorducto').html(info.descripcion);

                $('.bodyModal').html('<form action="" method="POST" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">'+
                                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i> <br> Agregar Producto</h1>'+
                                        '<h2 class="namePorducto">'+info.descripcion+'</h2><br>'+
                                        '<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto" required><br>'+
                                        '<input type="text" name="precio" id="precio" placeholder="Precio del producto" required>'+
                                        '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
                                        '<input type="hidden" name="action" value="addProduct" required>'+
                                        '<div class="alert alertAddProduct"></div>'+
                                        '<button type="submit" class="btn_cancel"><i class="fas fa-plus"></i> Agregar</button>'+
                                        '<a href="#" class="btn_ok closeModal" onclick="coloseModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
                                    '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    // ELIMINAR PRODUCTO
    $('.del_product').click(function(e){
        e.preventDefault();
        var producto = $(this).attr('product');
        var action = 'infoProducto';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,producto:producto},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);

                //$('#producto_id').val(info.codproducto);
                //$('.namePorducto').html(info.descripcion);

                $('.bodyModal').html('<form action="" method="POST" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct();">'+
                                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i> <br> Eliminar Producto</h1>'+
                                        '<p>¿Esta seguro de eliminar el siguiente registro?</p>'+
                                        '<h2 class="namePorducto">'+info.descripcion+'</h2><br>'+
                                        '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
                                        '<input type="hidden" id="alert" name="action" value="delProduct" required>'+
                                        '<div class="alert alertAddProduct"></div>'+
                                        '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
                                        '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+  
                                    '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    $('#search_proveedor').change(function(e){
        e.preventDefault();

        var sistema = getUrl();
        location.href = sistema+'buscar_productos.php?proveedor='+$(this).val();
    });

    //ACTIVAR CAMPO PARA REGISTRAR CLIENTE
    $('.btn_new_cliente').click(function(e){
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown();
    });

    //BUSCAR CLIENTE VENTA
    $('#cedula_cliente').keyup(function(e){
        e.preventDefault();

        var cl = $(this).val();
        var action = 'searchCliente';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,cliente:cl},

            success:function(response)
            {
                console.log(response);
                if (response == 0) 
                {
                    $('#idcliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    //mostrar boton de agregar
                    $('.btn_new_cliente').slideDown();
                }else{
                    var data =  $.parseJSON(response);
                    $('#idcliente').val(data.idcliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    //Ocultar boton agregar
                    $('.btn_new_cliente').slideUp();

                    //Bloquear campos
                    $('#nom_cliente').attr('disabled','disabled');
                    $('#tel_cliente').attr('disabled','disabled');
                    $('#dir_cliente').attr('disabled','disabled');

                    //Ocultar boton guardar
                    $('#div_registro_cliente').slideUp();
                }
            },
            error:function(error)
            {
                console.log(error);
            },
        });

    });

    //CREAR CLIENTE - VENTAS
    $('#form_new_cliente_venta').submit(function(e){
        e.preventDefault();

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: $('#form_new_cliente_venta').serialize(),

            success:function(response)
            {
                if (response != 'error')
                {
                    //Agregar id a input hiden
                    $('#idcliente').val(response);
                    //blouear campos
                    $('#nom_cliente').attr('disabled','disabled');
                    $('#tel_cliente').attr('disabled','disabled');
                    $('#dir_cliente').attr('disabled','disabled');
                    //ocultar boton de agregar
                    $('.btn_new_cliente').slideUp();
                    //ocultar boton guardar
                    $('#div_registro_cliente').slideUp();
                }
                
            },
            error:function(error)
            {
                console.log(error);
            },
        });
    });

    //BUSCAR PRODUCTO
    $('#txt_cod_producto').keyup(function(e){
        e.preventDefault();

        var producto = $(this).val();
        var action = 'infoProducto';

        if (producto != '') 
        {
            $.ajax({
                url:'../ajax/ajax.php',
                type: 'POST',
                async: true,
                data: {action:action,producto:producto},

                success:function(response)
                {
                    if (response != 'error') 
                    {
                        var info = JSON.parse(response);
                        $('#txt_descripcion').html(info.descripcion);
                        $('#txt_existencia').html(info.existencia);
                        $('#txt_cant_producto').val('1');
                        $('#txt_precio').html(info.precio);
                        $('#txt_precio_total').html(info.precio);

                        //activar cantidad
                        $('#txt_cant_producto').removeAttr('disabled');

                        //mostrar boton de agregar
                        $('#add_product_venta').slideDown();
                    }else{
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('0');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');

                        //bloquear cantidad
                        $('#txt_cant_producto').attr('disabled','disabled');

                        //ocultar boton de agregar
                        $('#add_product_venta').slideUp();
                    }
                },
                error:function(error)
                {
                    console.log(error);
                },
            });
        }    
    });

    //VALIDAR CANTIDAD DEL PRODUCTO ANTES DE AGREGAR
    $('#txt_cant_producto').keyup(function(e){
        e.preventDefault();

        var precio_total = $(this).val() * $('#txt_precio').html();
        var existencia = parseInt($('#txt_existencia').html());
        $('#txt_precio_total').html(precio_total);

        //ocultar el boton agregar si la cantidad es menor que 1
        if ( ($(this).val() < 1 || isNaN($(this).val())) || $(this).val() > existencia) 
        {
            $('#add_product_venta').slideUp();
            $('#txt_precio_total').html('0.00');
        }else{
            $('#add_product_venta').slideDown();
        }

    });

    //AGREGAR PRODUCTO AL DETALLE
    $('#add_product_venta').click(function(e){
        e.preventDefault();

        if ($('#txt_cant_producto').val() > 0) 
        {
            var codproducto = $('#txt_cod_producto').val();
            var cantidad = $('#txt_cant_producto').val();
            var action = 'addProductoDetalle';

            $.ajax({
                url:'../ajax/ajax.php',
                type: 'POST',
                async: true,
                data: {action:action,codproducto:codproducto,cantidad:cantidad},

                success:function(response)
                {
                    if (response != 'error') 
                    {
                        var info = JSON.parse(response);
                        $('#detalle_venta').html(info.detalle);
                        $('#detalleTotales').html(info.totales);

                        $('#txt_cod_producto').val('');
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_cant_producto').val('');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');

                        //bloquear cantidad
                        $('#txt_cant_producto').attr('disabled','disabled');

                        //ocultar boton de agregar
                        $('#add_product_venta').slideUp();

                    }else{
                        console.log('No Data');
                    }
                    viewProcesar();
                },
                error:function(error)
                {
                    console.log(error);
                },
            });
        }
    });

    //ANULAR VENTA
    $('#btn_anular_venta').click(function(e)
    {
        e.preventDefault();

        var rows = $('#detalle_venta tr').length;
        if (rows > 0) 
        {
            var action = 'anularVenta';

            $.ajax({

                url:'../ajax/ajax.php',
                type: 'POST',
                async: true,
                data: {action:action},

                success:function(response)
                {
                    console.log(response);
                    if (response != 'error') 
                    {
                        location.reload();
                    }
                },
                error:function(error)
                {
                   console.log(error);
                },
            });
        }
    });

    $('#btn_facturar_venta').click(function(e)
    {
        e.preventDefault();

        var rows =$('#detalle_venta tr').length;
        if (rows > 0) 
        {
            var action = 'procesarVenta';
            var codcliente = $('#idcliente').val();

            $.ajax({
                url: '../ajax/ajax.php',
                type: "POST",
                async: true,
                data: {action:action,codcliente:codcliente},

                success: function(response){

                    if (response != 'error') 
                    {   
                        var info = JSON.parse(response);
                        //console.log(info);
                        
                        generarPDF(info.codcliente,info.nofactura);
                        location.reload();
                    }else{
                        console.log('no data');
                    }
                    
                },
                error: function(error){
                    console.log(error);
                }
            });
        }
    });
    
    // Modal form anular factura
    $('.anular_factura').click(function(e){
        e.preventDefault();
        var nofactura = $(this).attr('fac');
        var action = 'infoFactura';

        $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,nofactura:nofactura},

        success:function(response){
            if (response != 'error') 
            {
                var info = JSON.parse(response);

                $('.bodyModal').html('<form action="" method="POST" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">'+
                                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i> <br> Anular Factura</h1><br>'+
                                        '<p>¿Realmente desea anular la factura?</p>'+
                                        
                                        '<p><strong>No. '+info.nofactura+'</strong></p>'+
                                        '<p><strong>Monto. '+info.totalfactura+' BsS.</strong></p>'+
                                        '<p><strong>Fecha. '+info.fecha+'</strong></p>'+
                                        '<input type="hidden" name="action" value="anularFactura">'+
                                        '<input type="hidden" name="no_factura" id="no_factura" value="'+info.nofactura+'" required>'+

                                        '<div class="alert alertAddProduct"></div>'+
                                        '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Anular</button>'+  
                                        '<a href="#" class="btn_cancel" onclick="coloseModal();"> <i class="fas fa-ban"></i>Cerrar</a>'+
                                    '</form>');


            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
        $('.modal').fadeIn();
    });

    //VER FACTURA
    $('.view_factura').click(function(e) 
    {
        e.preventDefault();
        var codcliente = $(this).attr('cl');
        var nofactura = $(this).attr('f');

        generarPDF(codcliente,nofactura);
    });

    //CAMBIAR CLAVE
    $('.newPass').keyup(function(){
        validPass();
    });

    //FORMULARIO CAMBIAR CONTRASEÑA
    $('#frmChangePass').submit(function(e){
        e.preventDefault();
        var passActual = $('#txtPassUser').val();
        var passNuevo = $('#txtNewPassUser').val();
        var confirmPassNuevo = $('#txtPassConfirm').val();
        var action = 'changePassword';

         if (passNuevo != confirmPassNuevo) 
        {
            $('.alertChangePass').html('<p style="color: red;">Las contraseñas no son iguales.</p>');
            $('.alertChangePass').slideDown();
            return false;
        }

        if (passNuevo.length < 5) 
        {
            $('.alertChangePass').html('<p style="color: red;">La nueva contraseña debe ser de 5 caracteres como minimo.</p>');
            $('.alertChangePass').slideDown();
            return false;
        }

        $.ajax({
            url: '../ajax/ajax.php',
            type: "POST",
            async: true,
            data: {action:action,passActual:passActual,passNuevo:passNuevo,confirmPassNuevo:confirmPassNuevo},

            success: function(response)
            {
                if (response != 'error') 
                {
                    var info = JSON.parse(response);
                    if (info.cod == '00') 
                    {
                        $('.alertChangePass').html(info.msg);
                        $('#frmChangePass')[0].reset();
                    }else{
                        $('.alertChangePass').html(info.msg);
                    }
                    $('.alertChangePass').slideDown();
                }
             },
            error: function(error)
            {
                console.log(error);
            }
        });


    });

    //ACTUALIZAR DATOS DE EMPRESA
    $('#frmEmpresa').submit(function(e){
        e.preventDefault();

        var registro = $('#txtEmpRegistro').val();
        var nombre = $('#txtEmpNombre').val();
        var razon_social = $('#txtRSocial').val();
        var telefono = $('#txtEmpTelefono').val();
        var email = $('#txtEmpEmail').val();
        var direccion = $('#txtEmpDireccion').val();
        var iva = $('#txtEmpIva').val();

        if (registro == '' || nombre == '' || razon_social == '' || telefono == '' || email == '' || direccion == '' || iva == '') 
        {
            $('.alertFormEmpresa').html('<p style="color: red;">Todos los campos son obligatorios.</p>');
            $('.alertFormEmpresa').slideDown();
            return false;
        }

         $.ajax({
            url: '../ajax/ajax.php',
            type: "POST",
            async: true,
            data: $('#frmEmpresa').serialize(),
            beforeSend: function(){
                $('.alertFormEmpresa').slideUp();
                $('.alertFormEmpresa').html('');
                $('#frmEmpresa input').attr('disabled', 'disabled');
            },
            success: function(response)
            {
                var info = JSON.parse(response);
                    if (info.cod == '00') 
                    {
                        $('.alertFormEmpresa').html('<p style="color: #23922d;">Datos actualizados correctamente.</p>');
                        $('.alertFormEmpresa').slideDown();
                    }else{
                        $('.alertFormEmpresa').html('<p style="color: red;">'+info.msg+'</p>');
                    }
                    $('.alertFormEmpresa').slideDown();
                    $('#frmEmpresa input').removeAttr('disabled');
             },
            error: function(error)
            {
                console.log(error);
            }
        });

    });



}); //FIN DEL READY 

function validPass(){
    var passNuevo = $('#txtNewPassUser').val();
    var confirmPassNuevo = $('#txtPassConfirm').val();
    if (passNuevo != confirmPassNuevo) 
    {
        $('.alertChangePass').html('<p style="color: red;">Las contraseñas no son iguales.</p>');
        $('.alertChangePass').slideDown();
        return false;
    }

    if (passNuevo.length < 5) 
    {
        $('.alertChangePass').html('<p style="color: red;">La nueva contraseña debe ser de 5 caracteres como minimo.</p>');
        $('.alertChangePass').slideDown();
        return false;
    }
    
    $('.alertChangePass').html();
    $('.alertChangePass').slideUp();
}

function anularFactura()
{
    var nofactura = $('#no_factura').val();
    var action = 'anularFactura';

    $.ajax({
        url:'../ajax/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,nofactura:nofactura},

        success:function(response)
        {
            if (response == 'error') 
            {
                $('.alertAddProduct').html('<p style="color: red;">Error al anular la factura. </p>');
            }else{
                $('#row_'+nofactura+' .estado').html('<span class="anulada">Anulada</span>');
                $('#form_anular_factura .btn_ok').remove();
                $('#row_'+nofactura+' .div_factura').html('<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button>');
                $('.alertAddProduct').html('<p>Factura anulada.</p>');
            }
        },
        error:function(error)
        {
            console.log(error);
        },
    });
}

function generarPDF(cliente,factura)
{
    var ancho = 1000;
    var alto = 800;
    //Calcular posicion x,y para centrar la ventana
    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url= 'factura/generaFactura.php?cl='+cliente+'&f='+factura;
    window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}


function del_product_detalle(correlativo) {

    var action = 'delPorductoDetalle';
    var id_detalle = correlativo;

    $.ajax({
        url:'../ajax/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,id_detalle:id_detalle},

        success:function(response)
        {
            if (response != 'error') 
            {
                var info = JSON.parse(response);

                $('#detalle_venta').html(info.detalle);
                $('#detalleTotales').html(info.totales);

                $('#txt_cod_producto').val('');
                $('#txt_descripcion').html('-');
                $('#txt_existencia').html('-');
                $('#txt_cant_producto').val('');
                $('#txt_precio').html('0.00');
                $('#txt_precio_total').html('0.00');

                //bloquear cantidad
                $('#txt_cant_producto').attr('disabled','disabled');

                //ocultar boton de agregar
                $('#add_product_venta').slideUp();

            }else{

                $('#detalle_venta').html('');
                $('#detalleTotales').html('');
            }
            viewProcesar();
        },
        error:function(error)
        {
            console.log(error);
        },
    });
}

//mostrar/ocultar boton procesar
function viewProcesar(){
    if ($('#detalle_venta tr').length > 0) 
    {
        $('#btn_facturar_venta').show();
    }else{
        $('#btn_facturar_venta').hide();
    }
}

function serchforDetalle(id) {

    var action = 'serchforDetalle';
    var user = id;

    $.ajax({
        url:'../ajax/ajax.php',
        type: 'POST',
        async: true,
        data: {action:action,user:user},

        success:function(response)
        {
            if (response != 'error') 
            {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalleTotales').html(info.totales);

            }else{
                console.log('No Data');
            }
            viewProcesar();
        },
        error:function(error)
        {
            console.log(error);
        },
    });
}

function getUrl() {
    var loc = window.location;
    var pathName= loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function sendDataProduct(){
    
    $('.alertAddProduct').html('');
    var cantidad = $('#cantidad').val();
    var precio = $('#precio').val();
    var codproducto = $('#producto_id').val();
    var action = 'insertardatos';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,cantidad:cantidad,precio:precio,codproducto:codproducto},

        success:function(response){
            if (response == 'error') 
            {
                $('.alertAddProduct').html('<p style="color: red;">Error al agregar el producto.</p>');
            }else{

                var info = JSON.parse(response);
                $('.row'+info.codproducto+' .celprecio').html(info.nuevo_precio);
                $('.row'+info.codproducto+' .celexistencia').html(info.nueva_existencia);
                $('#cantidad').val('');
                $('#precio').val('');
                $('.alertAddProduct').html('<p style="color: green;">Producto agregado correctamente.</p>')
            }
            
        },
        error:function(error){
            console.log(error);
        },
        });
}

function coloseModal(){
    $('.alertAddProduct').html('');
    $('#cantidad').val('');
    $('#precio').val('');
    $('.modal').fadeOut();
}

//ELIMINAR PRODUCTO
function delProduct(){
    
    $('.alertAddProduct').html('');
    var codproducto = $('#producto_id').val();
    var alert = $('#alert').val();
    var action = 'eliminarproducto';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,codproducto:codproducto,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el producto.</p>');
            }else{

                $('.row'+info.codproducto).slideUp();
                $('#form_del_product .btn_ok').slideUp();
                $('.alertAddProduct').html('<p style="color: green;">Producto Eliminado correctamente.</p>');
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}

//ELIMINAR USUARIO
function delusuario(){
    
    $('.alertAddProduct').html('');
    var idusuario = $('#idusuario').val();
    var alert = $('#alert').val();
    var action = 'eliminarusuario';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,idusuario:idusuario,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el Usuario.</p>');
            }else{

                $('.row'+info.idusuario).slideUp();
                $('#form_del_product .btn_ok').slideUp();
                $('.alertAddProduct').html('<p style="color: green;">Usuario Eliminado correctamente.</p>');
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}

//ELIMINAR CLIENTE
function delcliente(){
    
    $('.alertAddProduct').html('');
    var idcliente = $('#idcliente').val();
    var alert = $('#alert').val();
    var action = 'eliminarcliente';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,idcliente:idcliente,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el Cliente.</p>');
            }else{

                $('.row'+info.idcliente).slideUp();
                $('#form_del_product .btn_ok').slideUp();
                $('.alertAddProduct').html('<p style="color: green;">Cliente Eliminado correctamente.</p>');
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}

//ELIMINAR PROVEEDOR
function delproveedor(){
    
    $('.alertAddProduct').html('');
    var codproveedor = $('#codproveedor').val();
    var alert = $('#alert').val();
    var action = 'eliminarproveedor';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,codproveedor:codproveedor,alert:alert},

        success:function(response){
           var info = JSON.parse(response);
           console.log(info);

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al eliminar el Proveedor.</p>');
            }else{

                $('.row'+info.codproveedor).slideUp();
                $('#form_del_product .btn_ok').slideUp();
                $('.alertAddProduct').html('<p style="color: green;">Proveedor Eliminado correctamente.</p>');
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}

//RESPALDO
function respaldo(){
    
    $('.alertAddProduct').html('');
    var alert = $('#alert').val();
    var action = 'respaldo';

    $.ajax({
            url:'../ajax/ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,alert:alert},

        success:function(response){

            if (response == 'error') {
                 $('.alertAddProduct').html('<p style="color: red;">Error al respaldar el sistema.</p>');
            }else{
                $('.alertAddProduct').html('<p style="color: green;">Respaldo Exitoso!</p>');
                console.log(response);
            }
                
            
           
        },
        error:function(error){
             console.log(error);
        },
        });
}

//REPORTE VENTAS
function generar_reporte_ventas()
{
    var ancho = 1000;
    var alto = 800;
    //Calcular posicion x,y para centrar la ventana
    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url= 'factura/generar_reporte_ventas.php';
    window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}

