/*
 * CARGAR TABLA ALMACEN DE CORTE
 */
if (localStorage.getItem("modeloCorte") != null) {
    $("#selectModeloCorte").val(localStorage.getItem("modeloCorte"));
    $("#selectModeloCorte").selectpicker("refresh");

    cargarTablaEnCortes(localStorage.getItem("modeloCorte"));
    // console.log("lleno");
} else {
    cargarTablaEnCortes(null);
    // console.log("vacio");
}

function cargarTablaEnCortes(modeloCorte) {
    $(".tablaCortes").DataTable({
        ajax:
            "ajax/produccion/tabla-cortes.ajax.php?perfil=" +
            $("#perfilOculto").val() +
            "&modeloCorte=" +
            modeloCorte,
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
}

/*
 * CARGAR TABLA ENVIADOS A TALLER
 */

$("#selectModeloTaller").change(function () {
    $(".tablaEnvTaller").DataTable().destroy();
    var modeloTaller = $(this).val();
    localStorage.setItem("modeloTaller", modeloTaller);
    cargarTablaEnTaller(localStorage.getItem("modeloTaller"));
});

$(".box").on("click", ".btnLimpiarModeloTaller", function () {
    localStorage.removeItem("modeloTaller");
    localStorage.clear();
    window.location = "enviados-taller";
});

if (localStorage.getItem("modeloTaller") != null) {
    $("#selectModeloTaller").val(localStorage.getItem("modeloTaller"));
    $("#selectModeloTaller").selectpicker("refresh");

    cargarTablaEnTaller(localStorage.getItem("modeloTaller"));
    // console.log("lleno");
} else {
    cargarTablaEnTaller(null);
    // console.log("vacio");
}

function cargarTablaEnTaller(modeloTaller) {
    $(".tablaEnvTaller").DataTable({
        ajax:
            "ajax/produccion/tabla-enviados-taller.ajax.php?perfil=" +
            $("#perfilOculto").val() +
            "&modeloTaller=" +
            modeloTaller,
        deferRender: true,
        retrieve: true,
        processing: true,
        order: [[0, "desc"]],
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
}

/*
 * MANDAR A TALLER
 */
$(".tablaCortes tbody").on("click", "button.btnMandarTaller", function () {
    var articulo = $(this).attr("articulo");
    //console.log("articulo", articulo);

    var datos = new FormData();
    datos.append("articulo", articulo);

    $.ajax({
        url: "ajax/cortes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            /* para sacar la marca */
            //console.log("respuesta", respuesta);

            $("#nuevoArticulo").val(respuesta["articulo"]);
            $("#nuevoNombre").val(respuesta["nombre"]);
            $("#nuevoModelo").val(respuesta["modelo"]);
            $("#nuevoColor").val(respuesta["color"]);
            $("#nuevaTalla").val(respuesta["talla"]);
            $("#almCorte").val(respuesta["alm_corte"]);
            $("#nuevoAlmCorte").val(respuesta["alm_corte"]);
            $("#nuevoAlmCorte").attr("max", respuesta["alm_corte"]);
            $("#precio_doc").val(respuesta["precio_doc"]);
            $("#tiempo_stand").val(respuesta["tiempo_stand"]);
        },
    });
});

/*
 * MANDAR A TALLER
 */
$(".tablaCortes tbody").on("click", "button.btnMandarTallerTotal", function () {
    $(".borrameAC").remove();

    var modelo = $(this).attr("modelo");
    var color = $(this).attr("color");

    var modcol = $(this).attr("modcol");
    $("#nuevoModeloT").val(modelo);
    $("#nuevoColorT").val(color);

    var datos = new FormData();
    datos.append("modcol", modcol);

    $.ajax({
        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            for (let i = 0; i < respuesta.length; i++) {
                $(".nuevasTallas").append(
                    '<div class="row borrameAC" style="padding:5px 15px" id="borrameAC">' +
                        "<!-- TALLAS -->" +
                        '<div class="col-xs-6" style="padding-right:0px">' +
                        '<input type="text" class="form-control nuevaDescripcionTalla input-sm" name="" value="' +
                        respuesta[i]["cod_color"] +
                        " - " +
                        respuesta[i]["color"] +
                        '" articulo="' +
                        respuesta[i]["articulo"] +
                        '" readonly required>' +
                        "</div>" +
                        "<!-- Cantidad -->" +
                        '<div class="col-xs-3">' +
                        '<input type="number" class="form-control nuevaCantidad input-sm" name="nuevaCantidad" id="nuevaCantidad" min="1" max="' +
                        respuesta[i]["alm_corte"] +
                        '" required>' +
                        "</div>" +
                        "<!-- Saldo -->" +
                        '<div class="col-xs-3 ingresarSaldo">' +
                        '<input type="number" class="form-control nuevoSaldo input-sm" name="nuevoSaldo" id="nuevoSaldo" min="0" value="' +
                        respuesta[i]["alm_corte"] +
                        '" saldoReal="' +
                        respuesta[i]["alm_corte"] +
                        '" readonly required>' +
                        "</div>" +
                        "</div>"
                );
            }
        },
    });
});

$("#imprimirTicketTotal").change(function () {
    if (this.checked == false) {
        $(".campoSectorTotal").removeClass("hidden");
    } else {
        $(".campoSectorTotal").addClass("hidden");
    }
});

$(".formularioAlmacenCorteTotal").on(
    "change",
    "input.nuevaCantidad",
    function () {
        var saldoA = $(this)
            .parent()
            .parent()
            .children(".ingresarSaldo")
            .children(".nuevoSaldo");

        var saldoReal = saldoA.attr("saldoReal");

        var saldoFinal = saldoReal - $(this).val();

        saldoA.val(saldoFinal);

        listarTallas();
    }
);

function listarTallas() {
    var listaTallas = [];

    var articulo = $(".nuevaDescripcionTalla");
    var cantidad = $(".nuevaCantidad");

    for (var i = 0; i < articulo.length; i++) {
        listaTallas.push({
            articulo: $(articulo[i]).attr("articulo"),
            nuevaCantidad: $(cantidad[i]).val(),
        });
    }

    //console.log("listaTallas", JSON.stringify(listaTallas));

    $("#listaTallas").val(JSON.stringify(listaTallas));
}

/*
 * calcular totales
 */
function cancularTotales() {
    var realCorte = document.getElementById("almCorte").value;
    var corte = document.getElementById("nuevoAlmCorte").value;
    var precio_doc = document.getElementById("precio_doc").value;
    var tiempo_stand = document.getElementById("tiempo_stand").value;

    var precio_total = (precio_doc / 12) * corte;
    //console.log("precio_total", precio_total);

    var tiempo_total = (tiempo_stand / 60) * corte;
    //console.log("tiempo_total", tiempo_total);

    var nuevoCorte = realCorte - corte;
    //console.log("nuevoCorte", nuevoCorte);

    $("#precio_total").val(precio_total);
    $("#tiempo_total").val(tiempo_total);
    $("#nuevoCorte").val(nuevoCorte);
}

$("#nuevoTaller").change(function () {
    cancularTotales();
});

$("#nuevoTrabajador").change(function () {
    cancularTotales();
});

$("#nuevoAlmCorte").change(function () {
    cancularTotales();
});

$("#selectModeloCorte").change(function () {
    $(".tablaCortes").DataTable().destroy();
    var modeloCorte = $(this).val();
    localStorage.setItem("modeloCorte", modeloCorte);
    cargarTablaEnCortes(localStorage.getItem("modeloCorte"));
});

/*
 * BOTON LIMPIAR MODELO CORTE
 */
$(".box").on("click", ".btnLimpiarModeloCorte", function () {
    localStorage.removeItem("modeloCorte");
    localStorage.clear();
    window.location = "en-cortes";
});

$("#imprimirTicket").change(function () {
    if (this.checked == false) {
        $(".campoSector").removeClass("hidden");
    } else {
        $(".campoSector").addClass("hidden");
    }
});

//* Generar la lista de articulos del corte con ajax, se activa al seleccionar el cortes en el select
$("#cortesEstampado").change(function () {
    $("#articulosCorte").html("");
    $("#articulosCorte").selectpicker("refresh");

    const corte = $(this).val();
    const datos = new FormData();
    datos.append("corte", corte);

    $.ajax({
        url: "ajax/cortes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            let contenido = "";
            respuesta.forEach((articulo) => {
                contenido += `<option value="${articulo.id}">${articulo.modelo} - ${articulo.nombre} - ${articulo.color} - ${articulo.talla}</option>`;
            });
            $("#articulosCorte").html(contenido);
            $("#articulosCorte").selectpicker("refresh");

            //en el input cantidadOrigen ponemos la cantidad del corte del primer articulo
            $("#cantidadOrigen").val(respuesta[0].cantidad);

            // en el input id_articulo debemos poner id_articulo para poder guardarlo en la bd
            $("#id_articulo").val(respuesta[0].id);
            $("#articulo").val(respuesta[0].articulo);
        },
    });
});

$("#articulosCorte").change(function () {
    const id_articulo = $(this).val();
    const datos = new FormData();
    datos.append("id_articulo", id_articulo);
    $.ajax({
        url: "ajax/cortes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#cantidadOrigen").val(respuesta.cantidad);

            $("#id_articulo").val(id_articulo);
            $("#articulo").val(respuesta.articulo);
        },
    });
});

$("#cantidadEstampado").change(function () {
    const cantidadEstampado = $(this).val();
    const cantidadOrigen = $("#cantidadOrigen").val();
    if (cantidadEstampado > cantidadOrigen) {
        Command: toastr["error"](
            "La cantidad estampada no puede ser mayor a la cantidad original"
        );

        $(this).val("");
        $("#cantidadSaldo").val("");
    } else {
        const cantidadSaldo = cantidadOrigen - cantidadEstampado;
        $("#cantidadSaldo").val(cantidadSaldo);
    }
});

$("#cantidadMerma").change(function () {
    const cantidadMerma = $(this).val();
    const cantidadEstampado = $("#cantidadEstampado").val();
    const cantidadOrigen = $("#cantidadOrigen").val();

    const cantidadEstampadoFinal =
        parseInt(cantidadEstampado) + parseInt(cantidadMerma);
    const cantidadSaldo = cantidadOrigen - cantidadEstampadoFinal;
    if (cantidadSaldo < 0) {
        Command: toastr["error"](
            "La cantidad estampada no puede ser mayor a la cantidad original"
        );

        $(this).val("");
        $("#cantidadSaldo").val("");
        $("#cantidadEstampado").val("");
    } else {
        $("#cantidadEstampado").val(cantidadEstampadoFinal);
        $("#cantidadSaldo").val(cantidadSaldo);
    }
});

$(".tablaEstampado").DataTable({
    ajax: "ajax/produccion/tabla-estampado.ajax.php",
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

$(".tablaEstampado tbody").on(
    "click",
    "button.btnEditarEstampado",
    function () {
        const estampado = $(this).attr("idEstampado");
        const datos = new FormData();
        datos.append("estampado", estampado);

        $.ajax({
            url: "ajax/cortes.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                $("#cortesEstampado").val(respuesta.corte);
                $("#cortesEstampado").selectpicker("refresh");

                $("#cortesEstampado").attr("disabled", true);

                const datos = new FormData();
                datos.append("id_articulo", respuesta.almacencorte);
                $.ajax({
                    url: "ajax/cortes.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        const contenido = `<option value="${respuesta.id}">${respuesta.modelo} - ${respuesta.nombre} - ${respuesta.color} - ${respuesta.talla}</option>`;

                        $("#articulosCorte").html(contenido);
                        $("#articulosCorte").selectpicker("refresh");
                    },
                });

                $("#cantidadOrigen").val(respuesta.cantorigen);

                $("#cantidadEstampado").val(respuesta.cantestampado);

                $("#cantidadMerma").val(respuesta.cantmerma);

                $("#cantidadSaldo").val(respuesta.cantsaldo);

                $("#id_articulo").val(respuesta.almacencorte);
                $("#articulo").val(respuesta.articulo);
                $("#estampado").val(respuesta.id);

                $("#fechaEstampado").val(respuesta.fecha);

                $("#operarioEstampado").val(respuesta.operario);
                $("#operarioEstampado").selectpicker("refresh");

                $("#cerrarCorte").val(respuesta.cerrar);
                $("#cerrarCorte").selectpicker("refresh");

                $("#inicioPreparacion").val(respuesta.iniprep);
                $("#finPreparacion").val(respuesta.finprep);
                $("#inicioProduccion").val(respuesta.iniprod);
                $("#finProduccion").val(respuesta.finprod);
            },
        });

        // Obtener referencia a los botones
        const btnGuardar = document.getElementById("btnGuardarEstampado");
        const btnActualizar = document.getElementById("btnActualizarEstampado");

        // Ocultar btnGuardar
        btnGuardar.style.display = "none";

        // Mostrar btnActualizar
        btnActualizar.style.display = "inline";
    }
);

$("#btnActualizarEstampado").click(function () {
    const datos = new FormData();
    datos.append("upd_id", $("#estampado").val());
    datos.append("upd_corte", $("#cortesEstampado").val());
    datos.append("upd_articulo", $("#articulo").val());
    datos.append("upd_id_articulo", $("#id_articulo").val());
    datos.append("upd_cantidadOrigen", $("#cantidadOrigen").val());
    datos.append("upd_cantidadEstampado", $("#cantidadEstampado").val());
    datos.append("upd_cantidadMerma", $("#cantidadMerma").val());
    datos.append("upd_cantidadSaldo", $("#cantidadSaldo").val());
    datos.append("upd_fecha", $("#fechaEstampado").val());
    datos.append("upd_operario", $("#operarioEstampado").val());
    datos.append("upd_cerrar", $("#cerrarCorte").val());
    datos.append("upd_inicioPreparacion", $("#inicioPreparacion").val());
    datos.append("upd_finPreparacion", $("#finPreparacion").val());
    datos.append("upd_inicioProduccion", $("#inicioProduccion").val());
    datos.append("upd_finProduccion", $("#finProduccion").val());

    $.ajax({
        url: "ajax/cortes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta == "ok") {
                Command: toastr["success"](
                    "El registro ha sido actualizado correctamente"
                );

                $(".tablaEstampado").DataTable().ajax.reload();

                $("#formEstampado")[0].reset();

                // Ocultar btnActualizar
                btnActualizar.style.display = "none";

                // Mostrar btnGuardar
                btnGuardar.style.display = "inline";
            }
        },
    });
});

$(".tablaEstampado tbody").on(
    "click",
    "button.btnEliminarEstampado",
    function () {
        const estampado = $(this).attr("idEstampado");
        swal({
            title: "¿Está seguro de borrar el registro?",
            text: "¡Si no lo está puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, borrar color!",
        }).then(function (result) {
            if (result.value) {
                const datos = new FormData();
                datos.append("eliminarEstampado", estampado);
                $.ajax({
                    url: "ajax/cortes.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        if (respuesta == "ok") {
                            Command: toastr["success"](
                                "El registro ha sido eliminado correctamente"
                            );
                            $(".tablaEstampado").DataTable().ajax.reload();
                        }
                    },
                });
            }
        });
    }
);
