/*
* cargamos la tabla para guais de remision
*/
$(".tablaGuiasRemision").DataTable({
    ajax: "ajax/facturacion/tabla-guiasremision.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "order": [[1, "desc"]],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* cargamos la tabla para FACTURAS
*/
$(".tablaFacturas").DataTable({
    ajax: "ajax/facturacion/tabla-facturas.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "order": [[1, "desc"]],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});

/*
* cargamos la tabla para FACTURAS
*/
$(".tablaBoletas").DataTable({
    ajax: "ajax/facturacion/tabla-boletas.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    "order": [[1, "desc"]],
    language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior"
        },
        oAria: {
            sSortAscending: ": Activar para ordenar la columna de manera ascendente",
            sSortDescending: ": Activar para ordenar la columna de manera descendente"
        }
    }
});
/*
* ACTIVAR MODAL A
*/

$(".tablaGuiasRemision tbody").on("click", "button.btnFacturarA", function(){

    var codigo = $(this).attr("documento");
    var cod_cli = $(this).attr("cod_cli");
    var nom_cli = $(this).attr("nom_cli");
    var tip_doc = $(this).attr("tip_doc");
    var nro_doc = $(this).attr("nro_doc");
    var cod_ven = $(this).attr("cod_ven");

    var serie_dest = $(this).attr("serie_dest");
    var nro_dest = $(this).attr("nro_dest");
    //console.log(dscto);

    $("#codPedido").val(codigo);
    $("#codCli").val(cod_cli);
    $("#nomCli").val(nom_cli);
    $("#tipDoc").val(tip_doc);
    $("#nroDoc").val(nro_doc);
    $("#codVen").val(cod_ven);

    $("#serieDest").val(serie_dest);
    $("#docDest").val(nro_dest);

})

/*
* ACTIVAR MODAL B
*/

$(".tablaGuiasRemision tbody").on("click", "button.btnFacturarB", function(){

    var codigo = $(this).attr("documento");
    var cod_cli = $(this).attr("cod_cli");
    var nom_cli = $(this).attr("nom_cli");
    var tip_doc = $(this).attr("tip_doc");
    var nro_doc = $(this).attr("nro_doc");
    var cod_ven = $(this).attr("cod_ven");

    //console.log(codigo);

    $("#codPedidoB").val(codigo);
    $("#codCliB").val(cod_cli);
    $("#nomCliB").val(nom_cli);
    $("#tipDocB").val(tip_doc);
    $("#nroDocB").val(nro_doc);
    $("#codVenB").val(cod_ven);

})

/*
* validar el checkbox
*/
$(".chkFacturaB").change(function(){

    var chkBox = document.getElementById('chkFacturaB');
    //console.log(chkBox);
    var documento = "01";
    //console.log(documento);
    var serieSeparadoB = $("#serieSeparadoB");
    //console.log(serieSeparadoB);

    if(chkBox.checked == true){

        document.getElementById("chkBoletaB").disabled = true;
        document.getElementById("chkBoletaB").checked = false;

        document.getElementById("serieSeparadoB").disabled = false;

    }else{

        document.getElementById("chkBoletaB").disabled = false;

        document.getElementById("serieSeparadoB").disabled = true;

    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({

        url:"ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            // Limpiamos el select
            serieSeparadoB.find('option').remove();

            serieSeparadoB.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparadoB.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparadoB);
            }

        }

    })

})


$(".chkBoletaB").change(function(){

    var chkBox = document.getElementById('chkBoletaB');
    //console.log(chkBox.checked);

    var serieSeparadoB = $("#serieSeparadoB");
    serieSeparadoB.find('option').remove();
    //console.log(serieSeparadoB);


    var documento = "03";

    if(chkBox.checked == true){

        document.getElementById("chkFacturaB").disabled = true;
        document.getElementById("chkFacturaB").checked = false;

        document.getElementById("serieSeparadoB").disabled = false;

    }else{

        document.getElementById("chkFacturaB").disabled = false;

        document.getElementById("serieSeparadoB").disabled = true;

    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({

        url:"ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            //console.log(respuesta);

            // Limpiamos el select
            serieSeparadoB.find('option').remove();

            serieSeparadoB.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparadoB.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparadoB);
            }

        }

    })

})
$(".box").on("change", ".optNotas1", function () {
    var nota = $(this).val();
    
    var serie = $("#tipoNotaSerie");
    var documento = $("#tipoNotaDocumento");
    if(nota== "credito"){
        var datos = new FormData();
        datos.append("notaCredito", nota);
    
        $.ajax({
    
            url:"ajax/talonarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
    
            //    console.log(respuesta);
                serie.find('option').remove();

                serie.append('<option value="">Seleccionar Serie</option>');
    
                for(var id of respuesta){
                    serie.append('<option value="' + id.serie_nc + '">' + id.serie_nc + '</option>');
                    //console.log(serie);
                }
                serie.selectpicker("refresh");
                documento.val("0");
                $("#radioCtaCte").prop("disabled", true);
                $("#radioCtaCte").prop("checked", false);
            }
    
        })
    }else{
        var datos = new FormData();
        datos.append("notaDebito", nota);

        $.ajax({

            url:"ajax/talonarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                // console.log(respuesta);
                serie.find('option').remove();

                serie.append('<option value="">Seleccionar Serie</option>');
    
                for(var id of respuesta){
                    serie.append('<option value="' + id.serie_nd + '">' + id.serie_nd + '</option>');
                    //console.log(serie);
                }
            
                serie.selectpicker("refresh");
                documento.val("0");
                $("#radioCtaCte").prop("disabled", false);
                $("#radioCtaCte").prop("checked", true);
                
                // document.getElementById("radioCtaCte").checked = false;
            }

        })
    }
        
  
  })

/* 
* AL CAMBIAR EL SELECT DE DOCUMENTO
*/
$("#tipoNotaSerie").change(function(){
    var nota = $('input[name=optNotas1]:checked').val();
    // console.log(nota);
    var serie = document.getElementById("tipoNotaSerie").value;
    
    var documento = $("#tipoNotaDocumento");

    if(nota == "credito"){
        var datos = new FormData();
        datos.append("serie", serie);
    
        $.ajax({
    
            url:"ajax/talonarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                var numero = Number(respuesta["nota_credito"])+Number(1);
                documento.val(serie+("0000000"+numero).slice(-8));
    
    
            }
    
        })
    }else{
        var datos = new FormData();
        datos.append("serieDebito", serie);
    
        $.ajax({
    
            url:"ajax/talonarios.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(respuesta){
                var numero = Number(respuesta["nota_debito"])+Number(1);
                documento.val(serie+("0000000"+numero).slice(-8));
    
    
            }
    
        })
    }
	

    

})

/* 
* AL CAMBIAR EL SELECT DE DOCUMENTO
*/
$("#notaSubTotal").change(function(){
    var subtotal= $(this).val();

    var igv=subtotal*0.18;

    $("#notaIGV").val(igv.toFixed(2));

    var descuento= $("#notaDsctos").val();
    var flete= $("#notaFlete").val();
    var otros= $("#notaOtros").val();
    var noAfecto= $("#notaNoAfecto").val();
    var total = Number(subtotal)+Number(igv)+Number(descuento)+Number(flete)+Number(otros)+Number(noAfecto);
    $("#notaTotal").val(total.toFixed(2));
});

$("#notaDsctos").change(function(){
    var descuento= $(this).val();
    var subtotal= $("#notaSubTotal").val();
    var igv=subtotal*0.18;
    var flete= $("#notaFlete").val();
    var otros= $("#notaOtros").val();
    var noAfecto= $("#notaNoAfecto").val();
    var total = Number(subtotal)+Number(igv)+Number(descuento)+Number(flete)+Number(otros)+Number(noAfecto);
    $("#notaTotal").val(total.toFixed(2));
});

$("#notaFlete").change(function(){
    var flete= $(this).val();
    var subtotal= $("#notaSubTotal").val();
    var igv=subtotal*0.18;
    var descuento= $("#notaDsctos").val();
    var otros= $("#notaOtros").val();
    var noAfecto= $("#notaNoAfecto").val();
    var total = Number(subtotal)+Number(igv)+Number(descuento)+Number(flete)+Number(otros)+Number(noAfecto);
    $("#notaTotal").val(total.toFixed(2));
});

$("#notaOtros").change(function(){
    var otros= $(this).val();
    var subtotal= $("#notaSubTotal").val();
    var igv=subtotal*0.18;
    var descuento= $("#notaDsctos").val();
    var flete= $("#notaFlete").val();
    var noAfecto= $("#notaNoAfecto").val();
    var total = Number(subtotal)+Number(igv)+Number(descuento)+Number(flete)+Number(otros)+Number(noAfecto);
    $("#notaTotal").val(total.toFixed(2));
});

$("#notaNoAfecto").change(function(){
    var noAfecto= $(this).val();
    var subtotal= $("#notaSubTotal").val();
    var igv=subtotal*0.18;
    var descuento= $("#notaDsctos").val();
    var flete= $("#notaFlete").val();
    var otros= $("#notaOtros").val();
    var total = Number(subtotal)+Number(igv)+Number(descuento)+Number(flete)+Number(otros)+Number(noAfecto);
    $("#notaTotal").val(total.toFixed(2));
});

$(".btnGuardarNotaCredito").click(function(){
    var nota = $('input[name=optNotas1]:checked').val();
    var chkCuenta = document.getElementById("radioCtaCte");
    if(nota == 'credito'){
        var documento =$("#tipoNotaDocumento").val();
            var existe = new FormData();
            existe.append("documentoCredito", documento);
            var cliente=$("#selectNotaCliente").val();
            var vendedor=$("#selectNotaVendedor").val();
            var neto = $("#notaSubTotal").val();
            var igv = $("#notaIGV").val();
            var monto=$("#notaTotal").val();
            var fecha=$("#notaFecha").val();
            var usuario=$("#notaUsuario").val();
            //datos de notas cd
            var origen_venta = $("#notaNroFactura").val();
            var tip_nota = $("#selectNotaDocumento").val();
            var fecha_origen=$("#notaFechaFactura").val();
            var motivo=$("#notaMotivo").val();
            var tip_cont=$("#notaTipoCont").val();
            var observacion=$("#notaTexto").val();
            
            var datos = new Array();
            
            $.ajax({
                url: "ajax/facturacion.ajax.php",
                type: "POST",
                data: existe,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);
                    if (respuesta) {
                        datos.push({
                            'tipo_doc':'08',
                            'tipo_venta':'E05',
                            'num_cta' : documento,
                            'cliente':cliente,
                            'vendedor':vendedor,
                            'neto':neto,
                            'igv':igv,
                            'monto':monto,
                            'saldo':monto,
                            'fecha':fecha,
                            'estado':'PENDIENTE',
                            'notas':'Nro doc '+documento+'/'+documento,
                            'renovacion':0,
                            'protesta':0,
                            'tip_mon':'Soles',
                            'cod_pago':'08',
                            'doc_origen':documento,
                            'usuario': usuario,
                            'origen_venta':origen_venta,
                            'tip_nota':tip_nota,
                            'fecha_origen':fecha_origen,
                            'motivo':motivo,
                            'tip_cont':tip_cont,
                            'observacion':observacion
                        });
                        var cuenta = {"datosCuenta" : datos}
                        
                        var jsonCuenta2= {"jsonCuenta2":JSON.stringify(cuenta)};
                        $.ajax({
                            url:"ajax/facturacion.ajax.php",
                            method: "POST",
                            data: jsonCuenta2,
                            cache: false,
                            success:function(respuesta2){
                                
                                Command:toastr["success"]("Editado de venta exitosamente!");
                                Command:toastr["success"]("Editado  de detalle nota exitosamente!");
                            }
    
                        })
                    }else{
                        datos.push({
                            'tipo_doc':'08',
                            'tipo_venta':'E05',
                            'num_cta' : documento,
                            'cliente':cliente,
                            'vendedor':vendedor,
                            'neto':neto,
                            'igv':igv,
                            'monto':monto,
                            'saldo':monto,
                            'fecha':fecha,
                            'estado':'PENDIENTE',
                            'notas':'Nro doc '+documento+'/'+documento,
                            'renovacion':0,
                            'protesta':0,
                            'tip_mon':'Soles',
                            'cod_pago':'08',
                            'doc_origen':documento,
                            'usuario': usuario,
                            'tip_doc_venta':'NC',
                            'origen_venta':origen_venta,
                            'tip_nota':tip_nota,
                            'fecha_origen':fecha_origen,
                            'motivo':motivo,
                            'tip_cont':tip_cont,
                            'observacion':observacion
                        });
                        var cuenta = {"datosCuenta" : datos}
                        
                        var jsonCuenta= {"jsonCuenta":JSON.stringify(cuenta)};
                        $.ajax({
                            url:"ajax/facturacion.ajax.php",
                            method: "POST",
                            data: jsonCuenta,
                            cache: false,
                            success:function(respuesta2){
                                
                                Command:toastr["success"]("Registrado de venta exitosamente!");

                                Command:toastr["success"]("Registrado  de detalle nota exitosamente!");
    
                            }
    
                        })
                    }
                
                }
            });

    }else{
        if(chkCuenta.checked == true){

            var documento =$("#tipoNotaDocumento").val();
            var existe = new FormData();
            existe.append("documento", documento);
            var cliente=$("#selectNotaCliente").val();
            var vendedor=$("#selectNotaVendedor").val();
            var neto = $("#notaSubTotal").val();
            var igv = $("#notaIGV").val();
            var monto=$("#notaTotal").val();
            var fecha=$("#notaFecha").val();
            var usuario=$("#notaUsuario").val();

            var origen_venta = $("#notaNroFactura").val();
            var tip_nota = $("#selectNotaDocumento").val();
            var fecha_origen=$("#notaFechaFactura").val();
            var motivo=$("#notaMotivo").val();
            var tip_cont=$("#notaTipoCont").val();
            var observacion=$("#notaTexto").val();
            var datos = new Array();
            
            $.ajax({
                url: "ajax/cuentas.ajax.php",
                type: "POST",
                data: existe,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta) {
                    // console.log(respuesta);
                    if (respuesta) {
                        datos.push({
                            'id':respuesta["id"],
                            'tipo_doc':'08',
                            'tipo_venta':'E23',
                            'num_cta' : documento,
                            'cliente':cliente,
                            'vendedor':vendedor,
                            'neto':neto,
                            'igv':igv,
                            'monto':monto,
                            'saldo':monto,
                            'fecha':fecha,
                            'estado':'PENDIENTE',
                            'notas':'Nro doc '+documento+'/'+documento,
                            'renovacion':0,
                            'protesta':0,
                            'tip_mon':'Soles',
                            'cod_pago':'08',
                            'doc_origen':documento,
                            'usuario': usuario,
                            'tip_doc_venta':'ND',
                            'origen_venta':origen_venta,
                            'tip_nota':tip_nota,
                            'fecha_origen':fecha_origen,
                            'motivo':motivo,
                            'tip_cont':tip_cont,
                            'observacion':observacion
                        });
                        var cuenta = {"datosCuenta" : datos}
                        
                        var jsonCuenta2= {"jsonCuenta2":JSON.stringify(cuenta)};
                        $.ajax({
                            url:"ajax/cuentas.ajax.php",
                            method: "POST",
                            data: jsonCuenta2,
                            cache: false,
                            success:function(respuesta2){
                                var existe = new FormData();
                                existe.append("documentoDebito", documento);
                                $.ajax({
                                    url: "ajax/facturacion.ajax.php",
                                    type: "POST",
                                    data: existe,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function (respuesta3) {
                                        // console.log(respuesta);
                                        if (respuesta3) {
                                            
                                            $.ajax({
                                                url:"ajax/facturacion.ajax.php",
                                                method: "POST",
                                                data: jsonCuenta2,
                                                cache: false,
                                                success:function(respuesta4){
                                                    
                                                    Command:toastr["success"]("Editado  de venta exitosamente!");

                                                    Command:toastr["success"]("Editado  de detalle nota exitosamente!");
                        
                                                }
                        
                                            })
                                        }else{
                                            
                                            var jsonCuenta= {"jsonCuenta":JSON.stringify(cuenta)};
                                            $.ajax({
                                                url:"ajax/facturacion.ajax.php",
                                                method: "POST",
                                                data: jsonCuenta,
                                                cache: false,
                                                success:function(respuesta4){
                                                    
                                                    Command:toastr["success"]("Registrado  de venta exitosamente!");

                                                    Command:toastr["success"]("Registrado  de detalle nota exitosamente!");
                        
                                                }
                        
                                            })
                                        }

                                        Command:toastr["success"]("Editado de cuenta exitosamente!");
                                    }
                                });
    
                            }
    
                        })
                    }else{
                        datos.push({
                            'tipo_doc':'08',
                            'tipo_venta':'E23',
                            'num_cta' : documento,
                            'cliente':cliente,
                            'vendedor':vendedor,
                            'neto':neto,
                            'igv':igv,
                            'monto':monto,
                            'saldo':monto,
                            'fecha':fecha,
                            'estado':'PENDIENTE',
                            'notas':'Nro doc '+documento+'/'+documento,
                            'renovacion':0,
                            'protesta':0,
                            'tip_mon':'Soles',
                            'cod_pago':'08',
                            'doc_origen':documento,
                            'usuario': usuario,
                            'tip_mov':'+',
                            'tip_doc_venta':'ND',
                            'origen_venta':origen_venta,
                            'tip_nota':tip_nota,
                            'fecha_origen':fecha_origen,
                            'motivo':motivo,
                            'tip_cont':tip_cont,
                            'observacion':observacion
                        });
                        var cuenta = {"datosCuenta" : datos}
                        
                        //CREAR CUENTA
                        var jsonCuenta= {"jsonCuenta":JSON.stringify(cuenta)};
                        $.ajax({
                            url:"ajax/cuentas.ajax.php",
                            method: "POST",
                            data: jsonCuenta,
                            cache: false,
                            success:function(respuesta2){

                                //PASAR LOS DATOS POR AJAX PARA REGISTRAR LA VENTA
                                var existe = new FormData();
                                existe.append("documentoDebito", documento);
                                $.ajax({
                                    url: "ajax/facturacion.ajax.php",
                                    type: "POST",
                                    data: existe,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    dataType: "json",
                                    success: function (respuesta3) {
                                        // console.log(respuesta);
                                        if (respuesta3) {
                                            var jsonCuenta2= {"jsonCuenta2":JSON.stringify(cuenta)};
                                            $.ajax({
                                                url:"ajax/facturacion.ajax.php",
                                                method: "POST",
                                                data: jsonCuenta2,
                                                cache: false,
                                                success:function(respuesta4){
                                                    
                                                    Command:toastr["success"]("Editado  de venta exitosamente!");
                                                    Command:toastr["success"]("Editado  de detalle nota exitosamente!");
                        
                                                }
                        
                                            })
                                        }else{
                                            
                                            
                                            $.ajax({
                                                url:"ajax/facturacion.ajax.php",
                                                method: "POST",
                                                data: jsonCuenta,
                                                cache: false,
                                                success:function(respuesta4){
                                                    
                                                    Command:toastr["success"]("Registrado  de venta exitosamente!");

                                                    Command:toastr["success"]("Registrado  de detalle nota exitosamente!");
                        
                                                }
                        
                                            })
                                        }

                                        Command:toastr["success"]("Registrado de cuenta exitosamente!");
                                    }
                                });
    
                            }
    
                        })
                    }
                }
                });
            
            
        }else{
            //PASAR LOS DATOS POR AJAX PARA REGISTRAR LA VENTA
            var documento =$("#tipoNotaDocumento").val();
            var cliente=$("#selectNotaCliente").val();
            var vendedor=$("#selectNotaVendedor").val();
            var neto = $("#notaSubTotal").val();
            var igv = $("#notaIGV").val();
            var monto=$("#notaTotal").val();
            var fecha=$("#notaFecha").val();
            var usuario=$("#notaUsuario").val();

            var origen_venta = $("#notaNroFactura").val();
            var tip_nota = $("#selectNotaDocumento").val();
            var fecha_origen=$("#notaFechaFactura").val();
            var motivo=$("#notaMotivo").val();
            var tip_cont=$("#notaTipoCont").val();
            var observacion=$("#notaTexto").val();

            var datos = new Array();
            datos.push({
                'tipo_doc':'08',
                'tipo_venta':'E23',
                'num_cta' : documento,
                'cliente':cliente,
                'vendedor':vendedor,
                'neto':neto,
                'igv':igv,
                'monto':monto,
                'saldo':monto,
                'fecha':fecha,
                'estado':'PENDIENTE',
                'notas':'Nro doc '+documento+'/'+documento,
                'renovacion':0,
                'protesta':0,
                'tip_mon':'Soles',
                'cod_pago':'08',
                'doc_origen':documento,
                'usuario': usuario,
                'tip_mov':'+',
                'tip_doc_venta':'ND',
                'origen_venta':origen_venta,
                'tip_nota':tip_nota,
                'fecha_origen':fecha_origen,
                'motivo':motivo,
                'tip_cont':tip_cont,
                'observacion':observacion
            });
            var cuenta = {"datosCuenta" : datos}
            
            //CREAR CUENTA
            var jsonCuenta= {"jsonCuenta":JSON.stringify(cuenta)};

            var existe = new FormData();
            existe.append("documentoDebito", documento);
            $.ajax({
                url: "ajax/facturacion.ajax.php",
                type: "POST",
                data: existe,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuesta3) {
                    // console.log(respuesta);
                    if (respuesta3) {
                        var jsonCuenta2= {"jsonCuenta2":JSON.stringify(cuenta)};
                        $.ajax({
                            url:"ajax/facturacion.ajax.php",
                            method: "POST",
                            data: jsonCuenta2,
                            cache: false,
                            success:function(respuesta4){
                                
                                Command:toastr["success"]("Editado  de venta exitosamente!");
    
                            }
    
                        })
                    }else{
                        
                        
                        $.ajax({
                            url:"ajax/facturacion.ajax.php",
                            method: "POST",
                            data: jsonCuenta,
                            cache: false,
                            success:function(respuesta4){
                                
                                Command:toastr["success"]("Registrado  de venta exitosamente!");

                                Command:toastr["success"]("Registrado  de detalle nota exitosamente!");
    
                            }
    
                        })
                    }
                }
            });
        }
    }
    
    
    
});


if (localStorage.getItem("capturarRango23") != null) {
	$("#daterange-btnNotasCD span").html(localStorage.getItem("capturarRango23"));
	cargarTablaNotaCD(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnNotasCD span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaNotaCD(null, null);
}

/* 
* TABLA PARA PRODUCCION TRUSAS
*/
function cargarTablaNotaCD(fechaInicial,fechaFinal) {
	$('.tablaNotaCredito').DataTable( {
		"ajax": "ajax/facturacion/tabla-notacreditocd.ajax.php?perfil="+$("#perfilOculto").val() +"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[1, "desc"]],
		"pageLength": 20,
		"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
		"language": {

				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}

		}
	} );
}


/*=============================================
RANGO DE FECHAS
=============================================*/


$("#daterange-btnNotasCD").daterangepicker(
    {
      cancelClass: "CancelarNotasCD",
      locale:{
		"daysOfWeek": [
			"Dom",
			"Lun",
			"Mar",
			"Mie",
			"Jue",
			"Vie",
			"Sab"
		],
		"monthNames": [
			"Enero",
			"Febrero",
			"Marzo",
			"Abril",
			"Mayo",
			"Junio",
			"Julio",
			"Agosto",
			"Septiembre",
			"Octubre",
			"Noviembre",
			"Diciembre"
		],
	  },
      ranges: {
        Hoy: [moment(), moment()],
        Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
        "Últimos 7 días": [moment().subtract(6, "days"), moment()],
        "Últimos 30 días": [moment().subtract(29, "days"), moment()],
        "Este mes": [moment().startOf("month"), moment().endOf("month")],
        "Último mes": [
          moment()
            .subtract(1, "month")
            .startOf("month"),
          moment()
            .subtract(1, "month")
            .endOf("month")
        ]
      },
      
      startDate: moment(),
      endDate: moment()
    },
    function(start, end) {
      $("#daterange-btnNotasCD span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango23 = $("#daterange-btnNotasCD span").html();
  
	  localStorage.setItem("capturarRango23", capturarRango23);
      localStorage.setItem("fechaInicial", fechaInicial);
	  localStorage.setItem("fechaFinal", fechaFinal);
	  
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaNotaCredito").DataTable().destroy();
      cargarTablaNotaCD(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarNotasCD").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango23");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "ver-nota-credito";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
  
    if (textoHoy == "Hoy") {
      var d = new Date();
  
      var dia = d.getDate();
      var mes = d.getMonth() + 1;
      var año = d.getFullYear();
  
      dia = ("0" + dia).slice(-2);
      mes = ("0" + mes).slice(-2);
  
      var fechaInicial = año + "-" + mes + "-" + dia;
      var fechaFinal = año + "-" + mes + "-" + dia;
  
      localStorage.setItem("capturarRango23", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
	  localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaNotaCredito").DataTable().destroy();
      cargarTablaNotaCD(fechaInicial, fechaFinal);
    }
  });


$(".tablaNotaCredito").on("click", ".btnEditarNotaCD", function () {
    var tipo = $(this).attr("tipo");
    var documento = $(this).attr("documento");

    window.location = "index.php?ruta=editar-nota-credito&tipo="+tipo+"&documento="+documento;
})