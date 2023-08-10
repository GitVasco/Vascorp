/*
 * cargamos la tabla para articulos en pedidos
 */
$(".tablaArticulosPedidos").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    pageLength: 25,
    lengthMenu: [
        [25, 50, 75, -1],
        [25, 50, 75, "Todos"],
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

/*
 * VISUALIZAR DETALLEs QUE SE JALAN DEL PEDIDO
 */

/*
 * BOTON CREAR PEDIDO
 */
$(".btnCrearPedido").click(function () {
    var pedido = $(this).attr("pedido");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;
});

$("#seleccionarCliente").change(function () {
    var cliList = document.getElementById("seleccionarCliente").value;

    var nuevoCodigo = document.getElementById("nuevoCodigo").value;
    console.log("🚀 ~ file: pedidoscv.js:60 ~ nuevoCodigo:", nuevoCodigo);

    var datos = new FormData();
    datos.append("cliList", cliList);

    // Obtener la fecha actual
    var fechaActual = new Date();

    // Verificar si es el 8 de marzo de 2023
    if (
        fechaActual.getDate() === 9 &&
        fechaActual.getMonth() === 2 &&
        fechaActual.getFullYear() === 2023
    ) {
        var precio = "ok";
        //console.log("Hoy es el 8 de marzo de 2023");
    } else {
        var precio = "no";
        //console.log("Hoy no es el 8 de marzo de 2023");
    }

    let pedidos = [
        "572034804",
        "742034851",
        "572034859",
        "742034880",
        "752034899",
        "752034900",
        "572034971",
        "752035090",
        "752035106",
        "752035187",
        "752035189",
        "742035234",
        "752035238",
        "752035253",
        "652035317",
        "742035346",
        "752035360",
        "752035364",
        "752035387",
        "572035707",
        "682035745",
        "572035773",
        "752036206",
        "652036211",
        "742036218",
        "752036238",
        "752036277",
        "692036296",
        "752036299",
        "652036304",
        "752036336",
        "652036338",
        "752036339",
        "652036385",
        "652036476",
        "752036547",
        "752036575",
        "742036648",
        "652036686",
        "752036726",
        "752036736",
        "752036816",
        "752036832",
        "752036883",
        "652036885",
        "742036899",
        "752036928",
        "652036957",
        "752036965",
        "742036972",
        "652037006",
        "752037015",
        "752037017",
        "652037018",
        "752037064",
        "752037071",
        "752037186",
        "652037193",
        "752037211",
        "752037215",
        "752037268",
        "752037272",
        "682037277",
        "752037283",
        "752037285",
        "752037291",
        "742037292",
        "752037297",
        "752037298",
        "752037318",
        "62037323",
        "742037329",
    ];

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDet) {
            if (pedidos.includes(nuevoCodigo)) {
                $("#lista").val(respuestaDet["lista_precios"]);
                console.log("precio normal");
            } else if (
                (respuestaDet["vendedor"] == "08" ||
                    respuestaDet["vendedor"] == "08R") &&
                precio == "ok"
            ) {
                $("#lista").val("precio2");
                console.log("precio especial");
            } else {
                $("#lista").val(respuestaDet["lista_precios"]);
                console.log("precio normal");
            }
        },
    });
});

$("#seleccionarVendedor").change(function () {
    const cliList = $("#seleccionarCliente").val();
    const vendedor = $("#seleccionarVendedor").val();

    console.log("Cliente seleccionado: ", cliList);
    console.log("Vendedor seleccionado: ", vendedor);

    const datos = new FormData();
    datos.append("cliList", cliList);

    // const fechaActual = new Date();

    // const esFechaEspecial =
    //     fechaActual.getDate() === 11 &&
    //     fechaActual.getMonth() === 4 &&
    //     fechaActual.getFullYear() === 2023;

    const pedidos = ["572034804"];

    const vendedoresEspeciales = new Set(["08L"]);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDet) {
            let listaPrecio = respuestaDet["lista_precios"];

            if (
                !pedidos.includes(nuevoCodigo) &&
                vendedoresEspeciales.has(vendedor)
            ) {
                listaPrecio = "precio2";
                console.log("precio especial");
            } else {
                console.log("precio normal");
            }

            $("#lista").val(listaPrecio);
        },
    });
});

/*
 * quitar productos con el boton
 */

$(".formularioPedidoCV").on("click", "button.quitarArtPed", function () {
    //console.log("boton");

    $(this).parent().parent().parent().parent().remove();

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulosPed();
});

/*
 * activar cuando cambien el descuento
 */

$("#descPer").change(function () {
    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulosPed();
});

function cambioDescuento() {
    var bruto = document.getElementById("nuevoSubTotal").value;
    var descuento = document.getElementById("descPer").value;

    var descN = bruto * (descuento / 100);

    var subTotal = bruto - descN;

    var impNuevo = subTotal * 0.18;

    //var impNuevo = 0;

    var total = subTotal + impNuevo;

    $("#descTotal").val(descN.toFixed(2));
    $("#subTotal").val(subTotal.toFixed(2));
    $("#impTotal").val(impNuevo.toFixed(2));
    $("#nuevoTotal").val(total.toFixed(2));

    //console.log(descN);
}

/*
 * nuevos  totales al cambiar la cantidad
 */

$(".formularioPedidoCV").on("change", "input.nuevaCantidadArtPed", function () {
    var precio = $(this)
        .parent()
        .parent()
        .children(".ingresoPrecio")
        .children()
        .children(".nuevoPrecioArticulo");

    //console.log("precio", precio.val());

    var precioFinal = $(this).val() * precio.attr("precioReal");

    precio.val(precioFinal.toFixed(4));

    /* var nuevoArtPed = Number($(this).attr("artPed")) + Number($(this).val());
    console.log(nuevoArtPed);

    $(this).attr("nuevoArtPed", nuevoArtPed); */

    //console.log(precioFinal);

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulosPed();
});

/*
 * SUMAR TODOS LOS TOTALES
 */

function sumarTotalesPreciosA() {
    var precioItem = $(".nuevoPrecioArticulo");

    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }

    //console.log("arraySumaPrecio", arraySumaPrecio);

    function sumaArrayPrecios(total, numero) {
        return total + numero;
    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    //console.log("sumaTotalPrecio", sumaTotalPrecio);

    $("#nuevoSubTotalA").val(sumaTotalPrecio.toFixed(2));
    $("#nuevoSubTotal").val(sumaTotalPrecio.toFixed(2));
}

/*
 * ARRAY CON TODOS LOS ARTICULOS
 */

function listarArticulosPed() {
    var listaArticulos = [];

    var descripcion = $(".nuevaDescripcionArticulo");
    console.log(
        "🚀 ~ file: pedidoscv.js:421 ~ listarArticulos ~ descripcion:",
        descripcion
    );
    var cantidad = $(".nuevaCantidadArtPed");
    var precio = $(".nuevoPrecioArticulo");

    for (var i = 0; i < descripcion.length; i++) {
        listaArticulos.push({
            articulo: $(descripcion[i]).attr("articulo"),
            descripcion: $(descripcion[i]).val(),
            cantidad: $(cantidad[i]).val(),
            precio: $(precio[i]).attr("precioReal"),
            total: $(precio[i]).val(),
        });
    }

    //console.log("listaArticulos", JSON.stringify(listaArticulos));
    //$("#listaProductosPedidos").val(JSON.stringify(listaArticulos));
}

/*
 * AL CAMBIAR LA CONDICION DE VENTA
 */

$("#condicionVenta").change(function () {
    //console.log("si llego")

    sumarTotalesPreciosA();
    //cambioDescuento();
    listarArticulosPed();

    $("#modalito").removeAttr("disabled");
    $("#modalito").removeClass("btn-default");
    $("#modalito").addClass("btn-primary");
});

$("#seleccionarCliente").change(function () {
    //console.log("si llego al cliente")

    //sumarTotalesPreciosA();
    //cambioDescuento();
    //listarArticulosPed();

    var cliente = document.getElementById("seleccionarCliente").value;
    //console.log(cliente);
    $("#codClienteM").val(cliente);

    var datos = new FormData();
    datos.append("codigo", cliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDet) {
            //console.log(respuestaDet);

            $("#nomClienteM").val(respuestaDet["nombre"]);
        },
    });

    /* var nomCliente = document.getElementById("nomCliente").value;
    console.log(nomCliente);
    $("#nomClienteM").val(nomCliente); */

    var vendedor = document.getElementById("seleccionarVendedor").value;
    //console.log(vendedor)
    $("#vendedorM").val(vendedor);
});

$(".crearPedido").click(function () {
    sumarTotalesPreciosA();
    //cambioDescuento();
    listarArticulosPed();

    var codigo = document.getElementById("nuevoCodigo").value;
    $("#codigoM").val(codigo);

    var cliente = document.getElementById("seleccionarCliente").value;
    //console.log(cliente);
    $("#codClienteM").val(cliente);

    var datos = new FormData();
    datos.append("codigo", cliente);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDet) {
            //console.log(respuestaDet);

            $("#nomClienteM").val(respuestaDet["nombre"]);
        },
    });

    var vendedor = document.getElementById("seleccionarVendedor").value;
    $("#vendedorM").val(vendedor);

    var lista = document.getElementById("seleccionarLista").value;

    var opGravada = document.getElementById("nuevoSubTotalA").value;
    $("#opGravadaM").val(opGravada);

    var descuento = document.getElementById("descTotal").value;
    $("#descuentoM").val(descuento);

    var subTotal = document.getElementById("subTotal").value;
    $("#subTotalM").val(subTotal);

    var impuesto = document.getElementById("impTotal").value;
    //console.log(impuesto);
    $("#igvM").val(impuesto);

    var nuevoTotal = Number(opGravada) + Number(impuesto);

    var total = document.getElementById("nuevoTotal").value;

    if (nuevoTotal == total) {
        $("#totalM").val(nuevoTotal);
    } else {
        $("#totalM").val(total);
    }

    var articulos = document.getElementById("listaProductosPedidos").value;
    $("#articulosM").val(articulos);

    var condicionVenta = document.getElementById("condicionVenta").value;
    //console.log(condicionVenta);
    $("#condicionVentaM").val(condicionVenta);

    var agencia = document.getElementById("agencia").value;
    $("#agenciaM").val(agencia);

    var usuario = document.getElementById("idUsuario").value;
    $("#usuarioM").val(usuario);

    //console.log(usuario);
});

/*
 * cargamos la tabla de pedidos
 */
$(".tablaPedidosCV").DataTable({
    ajax: "ajax/facturacion/tabla-pedidosCV.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

/*
 * BOTON REVISAR PEDIDO
 */
$(".box").on("click", ".btnEditarPedidoCV", function () {
    var pedido = $(this).attr("codigo");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;
});

/*
 * BOTON  IMPRIMIR TICKET
 */
$(
    ".tablaPedidosCV, .tablaPedidosGenerados, .tablaPedidosAprobados, .tablaPedidosAPT, .tablaPedidosConfirmados, .tablaPedidosFacturados"
).on("click", ".btnImprimirPedido", function () {
    var codigo = $(this).attr("codigo");
    //console.log(codigo);

    var datos = new FormData();
    datos.append("codPedido", codigo);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("🚀 ~ file: pedidoscv.js:776 ~ respuesta", respuesta);
        },
    });

    window.open(
        "vistas/reportes_ticket/impresion_pedido.php?codigo=" + codigo,
        "_blank"
    );
});

/*
 * BOTON  IMPRIMIR TICKET
 */
$(".tablaPedidosConfirmados, .tablaPedidosGenerados").on(
    "click",
    ".btnCotizarPedido",
    function () {
        var codigo = $(this).attr("codigo");
        //console.log(codigo);

        window.open(
            "vistas/reportes_ticket/pedido_cotizar.php?codigo=" + codigo,
            "_blank"
        );
    }
);

/*
 * AL CAMBIAR EL SELECT DE DOCUMENTO
 */
$("#tdoc").change(function () {
    var documento = document.getElementById("tdoc").value;
    //console.log(documento);

    var tipoDoc = document.getElementById("tipDoc").value;
    //console.log(tipoDoc);

    if (documento == "00") {
        $("#GuiasDiv").removeClass("disable-div");
    } else {
        $("#GuiasDiv").addClass("disable-div");
    }

    if (documento == "01" && tipoDoc == "DNI") {
        document.getElementById("tipDoc").style.background = "#FF6868";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else if (documento == "03" && tipoDoc == "DNI") {
        document.getElementById("tipDoc").style.background = "#52BE80";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else if (documento == "03" && tipoDoc == "RUC") {
        document.getElementById("tipDoc").style.background = "#FF6868";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else if (documento == "01" && tipoDoc == "RUC") {
        document.getElementById("tipDoc").style.background = "#52BE80";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else {
        document.getElementById("tipDoc").style.background = "#52BE80";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    }

    document.getElementById("chkFactura").checked = false;
    document.getElementById("chkBoleta").checked = false;

    if (documento == "00") {
        document.getElementById("chkFactura").disabled = false;
        document.getElementById("chkBoleta").disabled = false;
    } else {
        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkBoleta").disabled = true;

        document.getElementById("chkFactura").checked = false;
        document.getElementById("chkBoleta").checked = false;
    }

    if (documento == "07") {
        $(".campoTipOrigen").removeClass("hidden");
        $(".campoDocOrigen").removeClass("hidden");
        $(".campoFecOrigen").removeClass("hidden");
        $(".campoMotOrigen").removeClass("hidden");
    } else {
        $(".campoTipOrigen").addClass("hidden");
        $(".campoDocOrigen").addClass("hidden");
        $(".campoFecOrigen").addClass("hidden");
        $(".campoMotOrigen").addClass("hidden");
    }

    var serie = $("#serie");
    //console.log(serie);

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({
        url: "ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            //console.log(respuesta);

            // Limpiamos el select
            serie.find("option").remove();

            serie.append('<option value="">Seleccionar Serie</option>');

            for (var id of respuesta) {
                serie.append(
                    '<option value="' +
                        id.numero +
                        '">' +
                        id.numero +
                        "</option>"
                );
                //console.log(serie);
            }
        },
    });

    //*INICIO DE FORMA DE PAGO

    if (documento == "01" || documento == "03") {
        //console.log("aqui", documento);
        //document.getElementById("formaPago").disabled = false;

        var formaPago = $("#formaPago");

        var datos = new FormData();
        datos.append("documento", documento);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                //console.log(respuesta);

                formaPago.find("option").remove();

                formaPago.append(
                    '<option value="">Seleccionar Forma Pago</option>'
                );

                for (var id of respuesta) {
                    formaPago.append(
                        '<option value="' +
                            id.codigo +
                            '">' +
                            id.codigo +
                            " - " +
                            id.cuenta +
                            "</option>"
                    );
                    //console.log(formaPago);
                }
            },
        });
    } else if (documento == "07") {
        //console.log("aqui", documento);
        //document.getElementById("formaPago").disabled = false;

        var formaPago = $("#formaPago");

        var datos = new FormData();
        datos.append("documento", documento);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                //console.log(respuesta);

                formaPago.find("option").remove();

                formaPago.append(
                    '<option value="">Seleccionar Forma Pago</option>'
                );

                for (var id of respuesta) {
                    formaPago.append(
                        '<option value="' +
                            id.codigo +
                            '">' +
                            id.codigo +
                            " - " +
                            id.cuenta +
                            "</option>"
                    );
                    //console.log(formaPago);
                }
            },
        });
    } else {
        //document.getElementById("formaPago").disabled = true;

        var formaPago = $("#formaPago");
        formaPago.find("option").remove();
        formaPago.append('<option value="">Seleccionar Forma Pago</option>');
    }

    //*FIN DE FORMA DE PAGO
});

/*
 * validar el checkbox
 */
$(".chkFactura").change(function () {
    var chkBox = document.getElementById("chkFactura");

    var documento = "01";
    //console.log(documento);

    var serieSeparado = $("#serieSeparado");
    //console.log(serieSeparado);

    var tipoDoc = document.getElementById("tipDoc").value;
    //console.log(tipoDoc);

    if (tipoDoc == "DNI") {
        document.getElementById("tipDoc").style.background = "#FF6868";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else {
        document.getElementById("tipDoc").style.background = "#52BE80";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    }

    if (chkBox.checked == true) {
        document.getElementById("chkBoleta").disabled = true;
        document.getElementById("chkBoleta").checked = false;

        document.getElementById("serieSeparado").disabled = false;
    } else {
        document.getElementById("chkBoleta").disabled = false;
        document.getElementById("serieSeparado").disabled = true;
    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({
        url: "ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            //console.log(respuesta);

            // Limpiamos el select
            serieSeparado.find("option").remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for (var id of respuesta) {
                serieSeparado.append(
                    '<option value="' +
                        id.numero +
                        '">' +
                        id.numero +
                        "</option>"
                );
                //console.log(serieSeparado);
            }
        },
    });
});

$(".chkBoleta").change(function () {
    var chkBox = document.getElementById("chkBoleta");
    //console.log(chkBox.checked);

    var serieSeparado = $("#serieSeparado");
    serieSeparado.find("option").remove();
    //console.log(serieSeparado);

    var documento = "03";

    var tipoDoc = document.getElementById("tipDoc").value;
    //console.log(tipoDoc);

    if (tipoDoc == "RUC") {
        document.getElementById("tipDoc").style.background = "#FF6868";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    } else {
        document.getElementById("tipDoc").style.background = "#52BE80";
        document.getElementById("tipDoc").style.color = "black";
        $("#tipDoc").css("font-weight", "bold");
    }

    if (chkBox.checked == true) {
        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkFactura").checked = false;

        document.getElementById("serieSeparado").disabled = false;
    } else {
        document.getElementById("chkFactura").disabled = false;
        document.getElementById("serieSeparado").disabled = true;
    }

    var datos = new FormData();
    datos.append("documento", documento);

    $.ajax({
        url: "ajax/talonarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            //console.log(respuesta);

            // Limpiamos el select
            serieSeparado.find("option").remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for (var id of respuesta) {
                serieSeparado.append(
                    '<option value="' +
                        id.numero +
                        '">' +
                        id.numero +
                        "</option>"
                );
                //console.log(serieSeparado);
            }
        },
    });
});

/*
 * ACTIVAR MODAL
 */

$(
    ".tablaPedidosCV, .tablaPedidosGenerados, .tablaPedidosAprobados, .tablaPedidosAPT, .tablaPedidosConfirmados, .tablaPedidosFacturados"
).on("click", "button.btnFacturar", function () {
    var codigo = $(this).attr("codigo");
    var cod_cli = $(this).attr("cod_cli");
    var nom_cli = $(this).attr("nom_cli");
    var tip_doc = $(this).attr("tip_doc");
    var nro_doc = $(this).attr("nro_doc");
    var dscto = $(this).attr("dscto");
    var cod_ven = $(this).attr("cod_ven");
    //console.log(nro_doc);

    $("#codPedido").val(codigo);
    $("#codCli").val(cod_cli);
    $("#nomCli").val(nom_cli);
    $("#tipDoc").val(tip_doc);
    $("#nroDoc").val(nro_doc);
    $("#dscto").val(dscto);
    $("#codVen").val(cod_ven);

    var datos = new FormData();
    datos.append("codPedido", codigo);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("🚀 ~ file: pedidoscv.js:776 ~ respuesta", respuesta);
        },
    });
});

/*
 * BOTON REVISAR FACTURA
 */
$(".box").on("click", ".btnEditarFacturaCV", function () {
    var pedido = $(this).attr("codigo");
    //console.log("factura", pedido);

    window.location = "index.php?ruta=crear-facturascv&pedido=" + pedido;
});

/*
 * BOTON IR A PEDIDOS GENERADOS
 */
$(".btnGenerados").click(function () {
    window.location = "pedidos-generados";
});

/*
 * BOTON IR A PEDIDOS APROBADOS
 */
$(".btnAprobados").click(function () {
    window.location = "pedidos-aprobados";
});

/*
 * BOTON IR A PEDIDOS EN APT
 */
$(".btnAPT").click(function () {
    window.location = "pedidos-apt";
});

/*
 * BOTON IR A PEDIDOS CONFIRMADOS
 */
$(".btnConfirmados").click(function () {
    window.location = "pedidos-confirmados";
});

/*
 * BOTON IR A PEDIDOS FACTURADOS
 */
$(".btnFacturados").click(function () {
    window.location = "pedidos-facturados";
});

/*
 * BOTON IR A PEDIDOS INICIO
 */
$(".btnInicioPed").click(function () {
    window.location = "pedidoscv";
});

/*
 * CARGADOS TABLA GENERADOS
 */
$(".tablaPedidosGenerados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-generados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

/*
 * CARGADOS TABLA APROBADOS
 */
$(".tablaPedidosAprobados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-aprobados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

/*
 * CARGADOS TABLA APT
 */
$(".tablaPedidosAPT").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-apt.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

/*
 * CARGADOS TABLA CONFIRMADOS
 */
$(".tablaPedidosConfirmados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-confirmados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

/*
 * CARGADOS TABLA FACTURADOS
 */
$(".tablaPedidosFacturados").DataTable({
    ajax: "ajax/facturacion/tabla-pedidos-facturados.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[9, "desc"]],
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

$(".tablaPedidosGenerados, .tablaPedidosCV").on(
    "click",
    ".btnAprobarPedido",
    function () {
        var codigo = $(this).attr("codigo");
        var estadoPedido = $(this).attr("estadoPedido");
        //Realizamos la activación-desactivación por una petición AJAX
        var datos = new FormData();
        datos.append("activarId", codigo);
        datos.append("activarEstado", estadoPedido);

        $.ajax({
            url: "ajax/facturacion.ajax.php",
            type: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                // console.log(respuesta);
                swal({
                    type: "success",
                    title: "¡Ok!",
                    text: "¡El pedido fue aprobado con éxito!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                }).then((result) => {
                    if (result.value) {
                        window.location = "pedidos-generados";
                    }
                });
            },
        });
    }
);

$(".tablaPedidosAprobados").on("click", ".btnAptear", function () {
    var codigo = $(this).attr("codigo");
    var estadoPedido = $(this).attr("estadoPedido");
    //Realizamos la activación-desactivación por una petición AJAX
    var datos = new FormData();
    datos.append("activarId", codigo);
    datos.append("activarEstado", estadoPedido);

    $.ajax({
        url: "ajax/facturacion.ajax.php",
        type: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            // console.log(respuesta);
            swal({
                type: "success",
                title: "¡Ok!",
                text: "¡El pedido fue dado de apta con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false,
            }).then((result) => {
                if (result.value) {
                    window.location = "pedidos-aprobados";
                }
            });
        },
    });
});

$(".tablaPedidosAPT").on("click", ".btnConfirmar", function () {
    var codigo = $(this).attr("codigo");
    var estadoPedido = $(this).attr("estadoPedido");
    //Realizamos la activación-desactivación por una petición AJAX
    var datos = new FormData();
    datos.append("activarId", codigo);
    datos.append("activarEstado", estadoPedido);

    $.ajax({
        url: "ajax/facturacion.ajax.php",
        type: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            // console.log(respuesta);
            swal({
                type: "success",
                title: "¡Ok!",
                text: "¡El pedido fue confirmado con éxito!",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: false,
            }).then((result) => {
                if (result.value) {
                    window.location = "pedidos-apt";
                }
            });
        },
    });
});

$(".formularioPedidoCV").on("click", ".btnCargarCliente", function () {
    var clienteCuenta = "1";

    var datos = new FormData();
    datos.append("clienteCuenta", clienteCuenta);
    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        xhr: function () {
            var xhr = $.ajaxSettings.xhr();
            xhr.upload.onprogress = function (event) {
                var perc = Math.round((event.loaded / event.total) * 100);
                $("#progressBar1").html("Cargando clientes..");
                $("#progressBar1").css("width", perc + "%");
            };
            return xhr;
        },
        beforeSend: function (xhr) {
            $("#progressBar1").text("0%");
            $("#progressBar1").css("width", "0%");
        },
        success: function (respuesta2) {
            $("#progressBar1").addClass("progress-bar");
            $("#progressBar1").text("100% - Carga realizada");

            $("#seleccionarCliente").find("option").remove();
            $("#seleccionarCliente").append(
                "<option value='' > Seleccionar cliente </option>"
            );
            for (let i = 0; i < respuesta2.length; i++) {
                $("#seleccionarCliente").append(
                    "<option value='" +
                        respuesta2[i]["codigo"] +
                        "'>" +
                        respuesta2[i]["codigo"] +
                        " - " +
                        respuesta2[i]["nombre"] +
                        "</option>"
                );
            }
            $("#seleccionarCliente").selectpicker("refresh");
        },
    });
});

$(".tablaArticulosPedidos").on("click", ".modificarArtPed", function () {
    //console.log("hola mundo");

    var cliente = document.getElementById("seleccionarCliente").value;
    var vendedor = document.getElementById("seleccionarVendedor").value;
    var pedido = document.getElementById("nuevoCodigo").value;
    var modLista = document.getElementById("lista").value;

    console.log(pedido);

    if (modLista == "") {
        var modLista1 = document.getElementById("seleccionarLista").value;
        $("#nLista").val(modLista1);
        var datos = new FormData();
        datos.append("modLista", modLista1);
        //console.log('lista',modLista1);
    } else {
        $("#nLista").val(modLista);
        var datos = new FormData();
        datos.append("modLista", modLista);
        //console.log('lista',modLista);
    }

    //ver para q sirve
    $("#clienteA").val(cliente);
    $("#vendedorA").val(vendedor);

    $("#modeloModalA").val($(this).attr("modelo"));

    /*
     *datos para la cabecera
     */
    var mod = $(this).attr("modelo");
    //console.log(mod);

    //var datos = new FormData();
    datos.append("mod", mod);
    //datos.append("modLista", modLista);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaLista) {
            console.log(
                "🚀 ~ file: pedidoscv.js:1251 ~ respuestaLista",
                respuestaLista
            );

            $("#precioA").val(respuestaLista["precio"]);
        },
    });

    /*
     * datos para la tabla
     */

    var modelo = $(this).attr("modelo");
    //console.log(modelo);

    var datosPedido = new FormData();
    datosPedido.append("modeloA", modelo);
    datosPedido.append("pedido", pedido);
    //console.log(datosPedido);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datosPedido,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaA) {
            // console.log("respuestaA", respuestaA);

            $(".detalleCT").remove();

            for (var id of respuestaA) {
                /* TALLA 1 */
                if (id.t1 == 1) {
                    var talla1 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        1 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        1 +
                        '" value="' +
                        id.v1 +
                        '" min="0"></td>';
                } else {
                    var talla1 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        1 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        1 +
                        '" readonly></td>';
                }

                /* TALLA 2 */
                if (id.t2 == 1) {
                    var talla2 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        2 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        2 +
                        '" value="' +
                        id.v2 +
                        '" min="0"></td>';
                } else {
                    var talla2 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        2 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        2 +
                        '" readonly></td>';
                }

                /* TALLA 3 */
                if (id.t3 == 1) {
                    var talla3 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        3 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        3 +
                        '" value="' +
                        id.v3 +
                        '" min="0"></td>';
                } else {
                    var talla3 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        3 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        3 +
                        '" readonly></td>';
                }

                /* TALLA 4 */
                if (id.t4 == 1) {
                    var talla4 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        4 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        4 +
                        '" value="' +
                        id.v4 +
                        '" min="0"></td>';
                } else {
                    var talla4 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        4 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        4 +
                        '" readonly></td>';
                }

                /* TALLA 5 */
                if (id.t5 == 1) {
                    var talla5 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        5 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        5 +
                        '" value="' +
                        id.v5 +
                        '" min="0"></td>';
                } else {
                    var talla5 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        5 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        5 +
                        '" readonly></td>';
                }

                /* TALLA 6 */
                if (id.t6 == 1) {
                    var talla6 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        6 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        6 +
                        '" value="' +
                        id.v6 +
                        '" min="0"></td>';
                } else {
                    var talla6 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        6 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        6 +
                        '" readonly></td>';
                }

                /* TALLA 7*/
                if (id.t7 == 1) {
                    var talla7 =
                        '<td><input style="width:100%" class="pruebaA" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        7 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        7 +
                        '" value="' +
                        id.v7 +
                        '" min="0"></td>';
                } else {
                    var talla7 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        7 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        7 +
                        '" readonly></td>';
                }

                /* TALLA 8 */
                if (id.t8 == 1) {
                    var talla8 =
                        '<td><input style="width:100%" class="cantidad" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        8 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        8 +
                        '"value="' +
                        id.v8 +
                        '" min="0"></td>';
                } else {
                    var talla8 =
                        '<td><input style="width:100%" type="number" name="' +
                        id.modelo +
                        id.cod_color +
                        8 +
                        '" id="' +
                        id.modelo +
                        id.cod_color +
                        8 +
                        '" readonly></td>';
                }

                var fila =
                    '<tr class="detalleCT">' +
                    "<td>" +
                    id.modelo +
                    " </td>" +
                    "<td>" +
                    id.color +
                    " </td>" +
                    talla1 +
                    talla2 +
                    talla3 +
                    talla4 +
                    talla5 +
                    talla6 +
                    talla7 +
                    talla8 +
                    "</tr>";

                $(".tablaColTal").append(fila);
            }
        },
    });
});

//*OPCION B GENERAR PEDIDO
$(".modificarArtPedB").click(function () {
    var modelo = document.getElementById("modelo").value;
    console.log("🚀 ~ file: pedidoscv.js:1755 ~ modelo:", modelo);

    if (modelo != "") {
        var cliente = document.getElementById("seleccionarCliente").value;
        var vendedor = document.getElementById("seleccionarVendedor").value;
        var pedido = document.getElementById("nuevoCodigo").value;
        var modLista = document.getElementById("lista").value;
        var agencia = document.getElementById("agencia").value;

        if (modLista == "") {
            var modLista1 = document.getElementById("seleccionarLista").value;
            $("#nLista").val(modLista1);
            var datos = new FormData();
            datos.append("modLista", modLista1);
            //console.log('lista',modLista1);
        } else {
            $("#nLista").val(modLista);
            var datos = new FormData();
            datos.append("modLista", modLista);
            //console.log('lista',modLista);
        }

        //ver para q sirve
        $("#clienteA").val(cliente);
        $("#vendedorA").val(vendedor);
        $("#agenciaA").val(agencia);

        //*datos para la cabecera
        //var mod = document.getElementById("modelo").value;
        //var mod = $(this).attr("modelo");
        //console.log(mod);

        $("#modeloModalA").val(modelo);

        //var datos = new FormData();
        datos.append("mod", mod);
        //datos.append("modLista", modLista);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaLista) {
                if (respuestaLista["precio"] <= 0) {
                    Command: toastr["error"]("El modelo no tiene precio");
                }

                $("#modeloModalA").val(respuestaLista["modelo"]);

                $("#precioA").val(respuestaLista["precio"]);
            },
        });

        /*
         * datos para la tabla
         */
        //var modelo = respuestaLista["modelo"];
        var modelo = document.getElementById("modelo").value;
        console.log(modelo);

        var datosPedido = new FormData();
        datosPedido.append("modeloA", modelo);
        datosPedido.append("pedido", pedido);
        // console.log(datosPedido);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datosPedido,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaA) {
                //console.log("respuestaA", respuestaA);

                $(".detalleCT").remove();

                for (var id of respuestaA) {
                    /* TALLA 1 */
                    if (id.t1 == 1) {
                        var talla1 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            1 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            1 +
                            '" value="' +
                            id.v1 +
                            '" min="0"></td>';
                    } else {
                        var talla1 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            1 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            1 +
                            '" readonly></td>';
                    }

                    /* TALLA 2 */
                    if (id.t2 == 1) {
                        var talla2 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            2 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            2 +
                            '" value="' +
                            id.v2 +
                            '" min="0"></td>';
                    } else {
                        var talla2 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            2 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            2 +
                            '" readonly></td>';
                    }

                    /* TALLA 3 */
                    if (id.t3 == 1) {
                        var talla3 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            3 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            3 +
                            '" value="' +
                            id.v3 +
                            '" min="0"></td>';
                    } else {
                        var talla3 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            3 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            3 +
                            '" readonly></td>';
                    }

                    /* TALLA 4 */
                    if (id.t4 == 1) {
                        var talla4 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            4 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            4 +
                            '" value="' +
                            id.v4 +
                            '" min="0" ></td>';
                    } else {
                        var talla4 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            4 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            4 +
                            '" readonly></td>';
                    }

                    /* TALLA 5 */
                    if (id.t5 == 1) {
                        var talla5 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            5 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            5 +
                            '" value="' +
                            id.v5 +
                            '" min="0" ></td>';
                    } else {
                        var talla5 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            5 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            5 +
                            '" readonly></td>';
                    }

                    /* TALLA 6 */
                    if (id.t6 == 1) {
                        var talla6 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            6 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            6 +
                            '" value="' +
                            id.v6 +
                            '" min="0" ></td>';
                    } else {
                        var talla6 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            6 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            6 +
                            '" readonly></td>';
                    }

                    /* TALLA 7*/
                    if (id.t7 == 1) {
                        var talla7 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            7 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            7 +
                            '" value="' +
                            id.v7 +
                            '" min="0" ></td>';
                    } else {
                        var talla7 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            7 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            7 +
                            '" readonly></td>';
                    }

                    /* TALLA 8 */
                    if (id.t8 == 1) {
                        var talla8 =
                            '<td><input style="width:100%" class="pruebaA" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            8 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            8 +
                            '"value="' +
                            id.v8 +
                            '" min="0" ></td>';
                    } else {
                        var talla8 =
                            '<td><input style="width:100%" type="text" name="' +
                            id.modelo +
                            id.cod_color +
                            8 +
                            '" id="' +
                            id.modelo +
                            id.cod_color +
                            8 +
                            '" readonly></td>';
                    }

                    var fila =
                        '<tr class="detalleCT">' +
                        "<td>" +
                        id.modelo +
                        " </td>" +
                        "<td>" +
                        id.color +
                        " </td>" +
                        talla1 +
                        talla2 +
                        talla3 +
                        talla4 +
                        talla5 +
                        talla6 +
                        talla7 +
                        talla8 +
                        "</tr>";

                    $(".tablaColTal").append(fila);
                }

                var inputs = $("form :text"),
                    length = inputs.length,
                    i = 25;
                //console.log(inputs);
                //console.log(length);

                inputs.on("keypress", function (event) {
                    var code = event.keyCode || event.which;
                    if (code == 13) {
                        event.preventDefault();
                        i = i == length - 12 ? 26 : ++i;
                        console.log(i);
                        inputs[i].focus();
                        inputs[i].select();
                    }
                });
            },
        });
    }
});

$(".btnCalCantA").click(function () {
    var totalCantidadA = 0;
    $(".pruebaA").each(function () {
        totalCantidadA += parseInt($(this).val()) || 0;
    });

    var precio = document.getElementById("precioA").value;

    var totalSolesA = totalCantidadA * precio;

    $("#totalCantidadA").val(totalCantidadA);

    $("#totalSolesA").val(totalSolesA);
    $("#totalSolesA").number(true, 2);

    console.log(totalSolesA);
    console.log(totalCantidadA);
});

/*
 * Dividir Pedido
 */

$(".tablaPedidosCV").on("click", "button.btnDividirPed", function () {
    var codigo = $(this).attr("codigo");
    var cod_cli = $(this).attr("cod_cli");
    var nom_cli = $(this).attr("nom_cli");
    var total = $(this).attr("total");

    $("#codPedidoD").val(codigo);
    $("#codCliD").val(cod_cli);
    $("#nomCliD").val(nom_cli);
    $("#totalD").val(total);
});

/*
 *ANULAR PEDIDOS
 */
$(".tablaPedidosAprobados, .tablaPedidosCV, .tablaPedidosGenerados").on(
    "click",
    ".btnAnularPedidoCV",
    function () {
        var codigo = $(this).attr("codigo");
        var estado = $(this).attr("estado");
        //console.log(codigo,estado);

        // Capturamos el id de la orden de compra
        swal({
            title: "¿Está seguro de anular el pedido?",
            text: "¡Si no lo está puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, anular pedido!",
        }).then(function (result) {
            if (result.value) {
                window.location = "index.php?ruta=pedidoscv&codigoP=" + codigo;
            }
        });
    }
);

$(".btnBorrarModelo").click(function () {
    var modeloB = $(this).attr("modelo");
    var pedidoB = $(this).attr("pedido");
    //console.log("modelo", modeloB, "pedido", pedidoB);

    var datos = new FormData();
    datos.append("modeloB", modeloB);
    datos.append("pedidoB", pedidoB);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log("respuesta", respuesta);

            if (respuesta == "ok") {
                Command: toastr["error"]("El modelo fue eliminado");
                $("#updDiv").load(" #updDiv"); //actualizas el div
                //$("#updDivB").load(" #updDivB");//actualizas el div
                $("#updDivC").load(" #updDivC"); //actualizas el div
            }
        },
    });
});

$(".refreshDetalle").click(function () {
    var pedido = $(this).attr("pedido");

    Command: toastr["success"]("Se actualizo los detalles");
    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;
});

/*
 *ANULAR PEDIDOS
 */
$(".tablaPedidosConfirmados, .tablaPedidosGenerados").on(
    "click",
    ".btnDuplicarPedido",
    function () {
        var codDup = $(this).attr("codigo");
        console.log(codDup);

        // Capturamos el id de la orden de compra
        swal({
            title: "¿Está seguro de duplicar el pedido?",
            text: "¡Si no lo está puede cancelar la acción!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, duplicar pedido!",
        }).then(function (result) {
            if (result.value) {
                var datos = new FormData();
                datos.append("codDup", codDup);

                $.ajax({
                    url: "ajax/pedidos.ajax.php",
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (respuesta) {
                        if (respuesta == "ok") {
                            swal({
                                type: "success",
                                title: "Se duplico el pedido",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                            }).then(function (result) {
                                if (result.value) {
                                    window.location = "pedidoscv";
                                }
                            });
                        }
                    },
                });
            }
        });
    }
);

// BUSCAR AGENCIA DE TRANSPORTES
$("#seleccionarCliente").change(function () {
    var codigo = document.getElementById("seleccionarCliente").value;
    //console.log("codigo", codigo);

    var datos = new FormData();
    datos.append("codigo", codigo);

    $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if (respuesta["agencia"] != "")
                $("#agencia").val(respuesta["agencia"]);
            $("#agencia").selectpicker("refresh");
        },
    });
});

// BUSCAR AGENCIA DE TRANSPORTES
$("#serie").change(function () {
    var tipo = document.getElementById("tdoc").value;
    //console.log(tipo);

    var documento = document.getElementById("serie").value;
    console.log("🚀 ~ file: pedidoscv.js:2282 ~ documento:", documento);

    if (tipo == "09") {
        var serie = documento.substring(0, 3);
        var talonario = documento.substr(-7);
        //console.log(serie, Number(talonario));
    } else {
        var serie = documento.substring(0, 4);
        var talonario = documento.substr(-8);
        //console.log(serie, Number(talonario));
    }

    //*validamos si es de factura o boleta
    if (tipo == "01" || tipo == "03" || tipo == "09") {
        //*vemos que número trae
        var datos = new FormData();
        datos.append("serie", serie);
        datos.append("talonario", talonario);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                //console.log(respuesta["talonario"]);
                if (Number(respuesta["talonario"]) == talonario) {
                    document.getElementById("serie").style.background =
                        "#FF6868";
                    document.getElementById("serie").style.color = "black";
                    $("#serie").css("font-weight", "bold");

                    //document.getElementById("btnGenerarDoc").disabled = true;
                } else {
                    //*actualizamos el talonario
                    var datos = new FormData();
                    datos.append("serieA", serie);
                    datos.append("talonarioA", Number(talonario));

                    $.ajax({
                        url: "ajax/pedidos.ajax.php",
                        method: "POST",
                        data: datos,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        success: function (respuesta) {
                            console.log(respuesta);
                        },
                    });
                }
            },
        });
    }
});

$("#modalFacturar").on("hidden.bs.modal", function () {
    var tipo = document.getElementById("tdoc").value;
    console.log(tipo);

    console.log("mundo");

    if (tipo == "01" || tipo == "03" || tipo == "09") {
        //*actualizamos el talonario
        var datos = new FormData();
        datos.append("tipo", tipo);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
            },
        });
    }
});

//VALIDA SI ES RUC O DNI
function ValidarRuc() {
    documento = $("#validarRuc").attr("documento");
    //console.log(documento);

    var datos = new FormData();
    datos.append("nuevoRuc", documento);
    $.ajax({
        type: "POST",
        url: "ajax/proveedor.ajax.php",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (jsonx) {
            var data = jsonx["data"];

            if (data["condicion"] == "HABIDO") {
                Command: toastr["success"]("HABIDO");
            } else {
                Command: toastr["error"]("NO HABIDO");
            }

            if (data["estado"] == "ACTIVO") {
                Command: toastr["success"]("ACTIVO");
            } else {
                Command: toastr["error"]("NO ACTIVO");
            }
            //console.log(data["condicion"]);
        },
    });
}

$("#BGBGG").change(function () {});

//************************************************** */

function updateModLista(modLista = "") {
    return modLista === "" ? $("#seleccionarLista").val() : modLista;
}

function updateFormData(datos, key, value) {
    datos.append(key, value);
}

function getTallaHtml(tallaIndex, id, isEnabled, value) {
    return isEnabled
        ? `<td><input style="width:100%" class="pruebaA" type="text" name="${id.modelo}${id.cod_color}${tallaIndex}" id="${id.modelo}${id.cod_color}${tallaIndex}" value="${value}" min="0" autocomplete="off"></td>`
        : `<td><input style="width:100%" type="text" name="${id.modelo}${id.cod_color}${tallaIndex}" id="${id.modelo}${id.cod_color}${tallaIndex}" readonly autocomplete="off"></td>`;
}

function createFila(id) {
    return (
        '<tr class="detalleCT">' +
        `<td>${id.modelo}</td>` +
        `<td>${id.color}</td>` +
        getTallaHtml(1, id, id.t1 == 1, id.v1) +
        getTallaHtml(2, id, id.t2 == 1, id.v2) +
        getTallaHtml(3, id, id.t3 == 1, id.v3) +
        getTallaHtml(4, id, id.t4 == 1, id.v4) +
        getTallaHtml(5, id, id.t5 == 1, id.v5) +
        getTallaHtml(6, id, id.t6 == 1, id.v6) +
        getTallaHtml(7, id, id.t7 == 1, id.v7) +
        getTallaHtml(8, id, id.t8 == 1, id.v8) +
        "</tr>"
    );
}

$(".modificarArtPedC").click(function () {
    const modelo = $("#modelo").val();

    if (modelo !== "") {
        const cliente = $("#seleccionarCliente").val();
        const vendedor = $("#seleccionarVendedor").val();
        const pedido = $("#nuevoCodigo").val();
        const modLista = $("#lista").val();
        const agencia = $("#agencia").val();
        const listaValue = updateModLista(modLista);

        $("#nLista").val(listaValue);
        $("#clienteA").val(cliente);
        $("#vendedorA").val(vendedor);
        $("#agenciaA").val(agencia);

        const datos = new FormData();
        updateFormData(datos, "modLista", listaValue);
        updateFormData(datos, "mod", modelo);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaLista) {
                if (respuestaLista["precio"] <= 0) {
                    Command: toastr["error"]("El modelo no tiene precio");
                }

                $("#modeloModalA").val(respuestaLista["modelo"]);
                $("#precioA").val(respuestaLista["precio"]);
            },
        });

        const datosPedido = new FormData();
        updateFormData(datosPedido, "modeloA", modelo);
        updateFormData(datosPedido, "pedido", pedido);

        $.ajax({
            url: "ajax/pedidos.ajax.php",
            method: "POST",
            data: datosPedido,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaA) {
                $(".detalleCT").remove();

                for (var id of respuestaA) {
                    const fila = createFila(id);
                    $(".tablaColTal").append(fila);
                }

                const inputs = $("form :text");
                let i = 25;

                inputs.on("keypress", function (event) {
                    const code = event.keyCode || event.which;
                    if (code === 13) {
                        event.preventDefault();
                        i = i === inputs.length - 12 ? 26 : ++i;
                        inputs[i].focus();
                        inputs[i].select();
                    }
                });
            },
        });
    }
});

//*nuevo modelo de guardar modelos por ajax

$("#guardarModelo").click(function () {
    const tableInputsJson = JSON.stringify(getTableInputsData());

    let pedidoN = document.getElementById("pedido").value;
    const nuevoPedidoN = document.getElementById("nuevoCodigo").value;
    const clienteN = document.getElementById("clienteA").value;
    const vendedorN = document.getElementById("vendedorA").value;
    const listaN = document.getElementById("nLista").value;
    const agenciaN = document.getElementById("agenciaA").value;
    const modeloN = document.getElementById("modeloModalA").value;
    const precioN = document.getElementById("precioA").value;

    var datos = new FormData();
    datos.append("pedidoN", pedidoN);
    datos.append("nuevoPedidoN", nuevoPedidoN);
    datos.append("clienteN", clienteN);
    datos.append("vendedorN", vendedorN);
    datos.append("listaN", listaN);
    datos.append("agenciaN", agenciaN);
    datos.append("modeloN", modeloN);
    datos.append("precioN", precioN);
    datos.append("articulosN", tableInputsJson);

    $.ajax({
        url: "ajax/pedidos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuestaDet) {
            if (respuestaDet == "toast") {
                $("#modelo").val("");
                $("#totalCantidadA").val("");
                $("#totalSolesA").val("");

                $(".detalleCT").remove();
                $("#modalModificarClienteP").modal("hide");

                Command: toastr["success"]("El modelo fue registrado");
                $("#updDivB").load(" #updDivB"); //actualizas el div
                $("#updDivC").load(" #updDivC"); //actualizas el div
                $("#updDiv").load(" #updDiv"); //actualizas el div
            } else {
                window.location.href =
                    "index.php?ruta=crear-pedidocv&pedido=" + respuestaDet;

                console.log(
                    "🚀 ~ file: pedidoscv.js:2563 ~ respuestaDet:",
                    respuestaDet
                );
            }
        },
    });
});

// Aquí puedes agregar el código para enviar o guardar el JSON en el lugar que necesites
function getTableInputsData() {
    const tableInputsData = [];
    const tableInputs = $(".tablaColTal input");

    tableInputs.each(function () {
        const inputName = $(this).attr("name");
        const inputValue = $(this).val();

        tableInputsData.push({
            name: inputName,
            value: inputValue,
        });
    });

    return tableInputsData;
}

//* boton cambiar precio
$(".tablaPedidosCV").on("click", ".btnPrecio", function () {
    var pedido = $(this).attr("codigo");
    console.log("🚀 ~ file: pedidoscv.js:2590 ~ pedido:", pedido);

    var numero = window.prompt(
        "Digite el número de la lista de precios para cambiar el pedido " +
            pedido
    );

    var parsedNumero = parseInt(numero);
    if (!isNaN(parsedNumero)) {
        console.log("🚀 ~ file: pedidoscv.js:2592 ~ numero:", parsedNumero);

        const datosPrecio = new FormData();
        updateFormData(datosPrecio, "pedidoL", pedido);
        updateFormData(datosPrecio, "listaL", parsedNumero);
        $.ajax({
            url: "ajax/precios.ajax.php",
            method: "POST",
            data: datosPrecio,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuestaA) {
                if (respuestaA == "ok") {
                    Command: toastr["success"]("Se actualizo los precios");
                }
            },
        });
    }
});
