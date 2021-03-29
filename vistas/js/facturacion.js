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
    var chkCuenta = document.getElementById("radioCtaCte");
    if(chkCuenta.checked == true){

        var documento =$("#tipoNotaDocumento").val();
        var existe = new FormData();
        existe.append("documento", documento);

        var cliente=$("#selectNotaCliente").val();
        var vendedor=$("#selectNotaVendedor").val();
        var monto=$("#notaTotal").val();
        var fecha=$("#notaFecha").val();
        var usuario=$("#notaUsuario").val();
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
                        'num_cta' : documento,
                        'cliente':cliente,
                        'vendedor':vendedor,
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
                        'usuario': usuario
                    });
                    var cuenta = {"datosCuenta" : datos}
                    
                    var jsonCuenta2= {"jsonCuenta2":JSON.stringify(cuenta)};
                    $.ajax({
                        url:"ajax/cuentas.ajax.php",
                        method: "POST",
                        data: jsonCuenta2,
                        cache: false,
                        success:function(respuesta2){
                            
                            Command:toastr["success"]("Editado exitosamente!");

                        }

                    })
                }else{
                    datos.push({
                        'tipo_doc':'08',
                        'num_cta' : documento,
                        'cliente':cliente,
                        'vendedor':vendedor,
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
                        'tip_mov':'+'
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
                            
                            Command:toastr["success"]("Registrado exitosamente!");

                        }

                    })
                }
            }
            });
        
        
    }else{
        console.log("error");
    }
    
});