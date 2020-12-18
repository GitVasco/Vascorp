/*
* cargamos la tabla para guais de remision
*/
$(".tablaGuiasRemision").DataTable({
    ajax: "ajax/tabla-guiasremision.ajax.php",
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
    ajax: "ajax/tabla-facturas.ajax.php",
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
    ajax: "ajax/tabla-boletas.ajax.php",
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

            console.log(respuesta);

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

