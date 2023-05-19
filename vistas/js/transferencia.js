//*OPCION B GENERAR PEDIDO
$(".modificarTransf").click(function () {
    var modelo = document.getElementById("modelo").value;
    var pedido = document.getElementById("nuevoCodigo").value;

    var almOri = document.getElementById("almacenOrigen").value;
    var almDes = document.getElementById("almacenDestino").value;

    $("#modeloModalA").val(modelo);
    $("#pedidoCod").val(pedido);

    $("#almOri").val(almOri);
    $("#almDes").val(almDes);

    if (modelo != "") {
        var pedido = document.getElementById("nuevoCodigo").value;

        var mod = document.getElementById("modelo").value;
        datos.append("mod", mod);

        var modelo = document.getElementById("modelo").value;

        var datosPedido = new FormData();
        datosPedido.append("modeloT", modelo);
        datosPedido.append("pedidoT", pedido);
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
                console.log(
                    "🚀 ~ file: transferencia.js:59 ~ respuestaA:",
                    respuestaA
                );

                $(".detalleCT").remove();

                for (var id of respuestaA) {
                    const tallasHtml = [];
                    for (let talla = 1; talla <= 8; talla++) {
                        tallasHtml.push(createCell(talla, id));
                    }

                    const fila = `
                        <tr class="detalleCT">
                            <td>${id.modelo}</td>
                            <td>${id.color}</td>
                            ${tallasHtml.join("")}
                        </tr>
                    `;

                    $(".tablaColTal").append(fila);
                }
            },
        });
    }
});

$(".tablaColTal").on("keydown", "input", navigateWithArrows);
$(".tablaColTal").on("focus", "input", selectInputContent);

function createCell(talla, id) {
    if (id[`t${talla}`] == 1) {
        return `<td><input style="width:100%" class="pruebaA" type="text" name="${
            id.modelo
        }${id.cod_color}${talla}" id="${id.modelo}${
            id.cod_color
        }${talla}" value="${
            id[`v${talla}`]
        }" min="0" tabindex="${talla}"></td>`;
    } else {
        return `<td><input style="width:100%" type="text" name="${id.modelo}${id.cod_color}${talla}" id="${id.modelo}${id.cod_color}${talla}" readonly tabindex="${talla}"></td>`;
    }
}

function navigateWithArrows(event) {
    const key = event.which;
    const arrowKeys = {
        left: 37,
        up: 38,
        right: 39,
        down: 40,
        tab: 9,
        enter: 13,
    };

    if (Object.values(arrowKeys).includes(key)) {
        // Añadir un control para evitar que la tecla Enter se propague cuando no estés enfocado en el botón de enviar
        if (
            key === arrowKeys.enter &&
            $(event.target).is("input[type='submit']")
        ) {
            return;
        }

        event.preventDefault();

        const currentInput = $(event.target);
        const currentCell = currentInput.closest("td");
        let targetCell;

        switch (key) {
            case arrowKeys.left:
                targetCell = currentCell.prev("td");
                break;
            case arrowKeys.right:
            case arrowKeys.tab:
                targetCell = currentCell.next("td");
                break;
            case arrowKeys.up:
                targetCell = currentCell
                    .parent("tr")
                    .prev("tr")
                    .children()
                    .eq(currentCell.index());
                break;
            case arrowKeys.down:
            case arrowKeys.enter:
                targetCell = currentCell
                    .parent("tr")
                    .next("tr")
                    .children()
                    .eq(currentCell.index());
                break;
        }

        if (targetCell.length > 0) {
            targetCell.find("input").focus();
        }
    }
}

function selectInputContent(event) {
    const input = event.target;
    input.select();
}

function selectInputContent(event) {
    const input = event.target;
    input.select();
}

document.addEventListener("DOMContentLoaded", function () {
    const almOri = document.getElementById("almacenOrigen");
    const almDes = document.getElementById("almacenDestino");
    const boton = document.getElementById("botonTrans");

    // Verifica que todos los elementos existan en la página
    if (!almOri || !almDes || !boton) {
        return;
    }

    function verificarSelects() {
        if (
            almOri.value !== "" &&
            almDes.value !== "" &&
            almOri.value !== almDes.value
        ) {
            boton.disabled = false;
        } else {
            boton.disabled = true;
        }
    }

    // Verifica los selects al inicio
    verificarSelects();

    almOri.addEventListener("change", verificarSelects);
    almDes.addEventListener("change", verificarSelects);
});

$(".btnCalTransferencia").click(function () {
    var totalCantidadA = 0;
    $(".pruebaA").each(function () {
        totalCantidadA += parseInt($(this).val()) || 0;
    });

    $("#totalCantidadA").val(totalCantidadA);
});

function listarArticulos() {
    var listaArticulos = [];

    var descripcion = $(".nuevaTransArticulo");
    var cantidad = $(".nuevaCantidadArtTrans");

    for (var i = 0; i < descripcion.length; i++) {
        listaArticulos.push({
            articulo: $(descripcion[i]).attr("articulo"),
            cantidad: $(cantidad[i]).val(),
        });
    }

    console.log("listaArticulos", JSON.stringify(listaArticulos));
    $("#listaArticulosTransferencia").val(JSON.stringify(listaArticulos));
}

$(".formularioTransferencia").on(
    "change",
    "input.nuevaCantidadArtTrans",
    function () {
        listarArticulos();
    }
);

$(".tablaTransferencias").DataTable({
    ajax: "ajax/produccion/tabla-transferencias.ajax.php",
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

$(".tablaTransferencias").on("click", ".btnImprimirTransferencia", function () {
    var codigo = $(this).attr("codigo");

    window.open(
        "vistas/reportes_ticket/impresion_transferencia.php?codigo=" + codigo,
        "_blank"
    );
});

$(".tablaTransferencias").on("click", ".btnTransferirAPT", function () {
    let codigo = $(this).attr("codigo");

    swal({
        title: "¿Está seguro que desea procesar la transferencia?",
        text: "¡Si no lo está puede cancelar la accíón!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, procesar transferencia!",
    }).then(function (result) {
        if (result.value) {
            var datosTransferencia = new FormData();
            datosTransferencia.append("codigo", codigo);
            $.ajax({
                url: "ajax/transferencias.ajax.php",
                method: "POST",
                data: datosTransferencia,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (respuestaA) {
                    if (respuestaA == "ok") {
                        swal({
                            type: "success",
                            title: "Se Genero el documento ",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                        }).then(function (result) {
                            if (result.value) {
                                window.location = "transferencias-apt";
                            }
                        });
                    }
                },
            });
        }
    });
});
