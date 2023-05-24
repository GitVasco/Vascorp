$(".tablaAgencias").DataTable({
    ajax:
        "ajax/maestros/tabla-agencias.ajax.php?perfil=" +
        $("#perfilOculto").val(),
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[0, "asc"]],
    pageLength: 20,
    lengthMenu: [
        [20, 40, 60, -1],
        [20, 40, 60, "Todos"],
    ],
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
            sPrevious: "Anterior",
        },
        oAria: {
            sSortAscending:
                ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
                ": Activar para ordenar la columna de manera descendente",
        },
    },
});
/*=============================================
EDITAR AGENCIA
=============================================*/
$(".tablaAgencias").on("click", ".btnEditarAgencia", function () {
    var idAgencia = $(this).attr("idAgencia");

    var datos = new FormData();
    datos.append("idAgencia", idAgencia);

    $.ajax({
        url: "ajax/agencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#idAgencia").val(respuesta["id"]);
            $("#editarCodAgencia").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["nombre"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarUbigeo").val(respuesta["ubigeo"]);
            $("#editarUbigeo").selectpicker("refresh");
            $("#editarRUC").val(respuesta["ruc"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarMtc").val(respuesta["mtc"]);
        },
    });
});

/*=============================================
ELIMINAR AGENCIA
=============================================*/
$(".tablaAgencias").on("click", ".btnEliminarAgencia", function () {
    var idAgencia = $(this).attr("idAgencia");

    swal({
        title: "¿Está seguro de borrar la agencia?",
        text: "¡Si no lo está puede cancelar la acción!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, borrar agencia!",
    }).then(function (result) {
        if (result.value) {
            window.location = "index.php?ruta=agencias&idAgencia=" + idAgencia;
        }
    });
});
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";

// })

//VALIDA SI ES RUC O DNI
function ObtenerDatosClienteAgencia() {
    toastr["success"]("Buscando la información");

    var nuevoRuc = $("#nuevoRUC").val();
    var datos = new FormData();
    datos.append("nuevoRuc", nuevoRuc);
    $.ajax({
        type: "POST",
        url: "ajax/proveedor.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (jsonx) {
            console.log(
                "🚀 ~ file: agencias.js:115 ~ ObtenerDatosClienteAgencia ~ jsonx:",
                jsonx
            );

            if (jsonx["success"] == false) {
                toastr["error"]("Sin Datos");

                $("#nuevaDescripcion").val("");
                $("#nuevaDireccion").val("");
                $("#nuevoUbigeo").val("");
                $("#nuevoUbigeo").selectpicker("refresh");
            } else {
                var data = jsonx["data"];

                $("#nuevaDescripcion").val(data["nombre_o_razon_social"]);
                $("#nuevaDireccion").val(data["direccion"]);
                $("#nuevoUbigeo").val(data["ubigeo"][2]);
                $("#nuevoUbigeo").selectpicker("refresh");
            }
        },
    });
}
