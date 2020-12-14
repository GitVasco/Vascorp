/*
* cargamos la tabla para articulos en pedidos
*/
$(".tablaArticulosPedidos").DataTable({
    ajax: "ajax/tabla-pedidos.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
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
* VISUALIZAR DETALLEs QUE SE JALAN DEL PEDIDO
*/
$(".tablaArticulosPedidos").on("click", ".agregarArtPed", function () {

    var cliente = document.getElementById("seleccionarCliente").value;
    var vendedor = document.getElementById("seleccionarVendedor").value;
    //var usuario = document.getElementById("idUsuario").value;
    var modLista = document.getElementById("lista").value;

    //var agencia = document.getElementById("seleccionarAgencia").value;

    //console.log(usuario);

    if(modLista == ''){

        var modLista1 = document.getElementById("seleccionarLista").value;
        $("#nLista").val(modLista1);
        var datos = new FormData();
        datos.append("modLista", modLista1);
        //console.log(modLista1);

    }else{

        $("#nLista").val(modLista);
        var datos = new FormData();
        datos.append("modLista", modLista);

    }

    //console.log(cliente);
    $("#cliente").val(cliente);
    $("#vendedor").val(vendedor);
    //$("#agencia").val(agencia);
    //$("#usuario").val(usuario);

    /*
    *datos para la cabecera
    */
    var mod = $(this).attr("modelo");
    //console.log(mod);

    //var datos = new FormData();
    datos.append("mod", mod);
    //datos.append("modLista", modLista);

    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaLista){

            //console.log("respuesta",respuestaLista["precio"]);

            $("#precio").val(respuestaLista["precio"]);

		}

	})


    /*
    * datos para la tabla
    */

    var modelo = $(this).attr("modelo");

	var datosColor = new FormData();
	datosColor.append("modelo", modelo);

	$.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datosColor,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){ 

            //console.log("respuesta", respuesta);

            $("#modeloModal").val(modelo);

            $(".detalleCT").remove();

			for(var id of respuesta){

                /* TALLA 1 */
                if(id.t1 == 1){

                    var talla1 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" value=0 min="0"></td>'

                }else{

                    var talla1 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +1 +'" id="'+ id.modelo + id.cod_color +1 +'" readonly></td>'

                }

                /* TALLA 2 */
                if(id.t2 == 1){

                    var talla2 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" value=0 min="0"></td>'

                }else{

                    var talla2 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +2 +'" id="'+ id.modelo + id.cod_color +2 +'" readonly></td>'

                }

                /* TALLA 3 */
                if(id.t3 == 1){

                    var talla3 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" value=0 min="0"></td>'

                }else{

                    var talla3 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +3 +'" id="'+ id.modelo + id.cod_color +3 +'" readonly></td>'

                }

                /* TALLA 4 */
                if(id.t4 == 1){

                    var talla4 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" value=0 min="0"></td>'

                }else{

                    var talla4 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +4 +'" id="'+ id.modelo + id.cod_color +4 +'" readonly></td>'

                }

                /* TALLA 5 */
                if(id.t5 == 1){

                    var talla5 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" value=0 min="0"></td>'

                }else{

                    var talla5 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +5 +'" id="'+ id.modelo + id.cod_color +5 +'" readonly></td>'

                }

                /* TALLA 6 */
                if(id.t6 == 1){

                    var talla6 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" value=0 min="0"></td>'

                }else{

                    var talla6 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +6 +'" id="'+ id.modelo + id.cod_color +6 +'" readonly></td>'

                }

                /* TALLA 7*/
                if(id.t7 == 1){

                    var talla7 = '<td><input style="width:100%" class="prueba" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" value=0 min="0"></td>'

                }else{

                    var talla7 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +7 +'" id="'+ id.modelo + id.cod_color +7 +'" readonly></td>'

                }

                /* TALLA 8 */
                if(id.t8 == 1){

                    var talla8 = '<td><input style="width:100%" class="cantidad" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'" value=0 min="0"></td>'

                }else{

                    var talla8 = '<td><input style="width:100%" type="number" name="'+ id.modelo + id.cod_color +8 +'" id="'+ id.modelo + id.cod_color +8 +'" readonly></td>'

                }

                var fila ='<tr class="detalleCT">' +
                                '<td>' + id.modelo + ' </td>' +
                                '<td>' + id.color + ' </td>' +
                                talla1 +
                                talla2 +
                                talla3 +
                                talla4 +
                                talla5 +
                                talla6 +
                                talla7 +
                                talla8 +

                            '</tr>'

				$('.tablaColTal').append(

                    fila


                )

			}

		}

    })

})

/*
* BOTON CREAR PEDIDO
*/
$(".btnCrearPedido").click(function () {

    var pedido = $(this).attr("pedido");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;

})


$(".btnCalCant").click(function () {

    var totalCantidad=0;
    $(".prueba").each(function(){

        totalCantidad+=parseInt($(this).val()) || 0;

    });

    var precio=document.getElementById("precio").value;

    var totalSoles = (totalCantidad * precio)

    $("#totalCantidad").val(totalCantidad);

    $("#totalSoles").val(totalSoles);
    $("#totalSoles").number(true, 2);

    //console.log(totalSoles);
    //console.log(totalCantidad);

})

$("#seleccionarCliente").change(function(){

    var cliList = document.getElementById("seleccionarCliente").value;
    //console.log(cliList);

    var datos = new FormData();
    datos.append("cliList", cliList);

    $.ajax({

		url:"ajax/pedidos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDet){

            //console.log(respuestaDet);

            $("#lista").val(respuestaDet["lista_precios"]);

		}

	})

})

/*
* quitar productos con el boton
*/

$(".formularioPedidoCV").on("click", "button.quitarArtPed", function() {

    //console.log("boton");

    $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();


});

/* 
* activar cuando cambien el descuento
*/

$("#descPer").change(function(){

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();


})

function cambioDescuento(){

    var bruto = document.getElementById("nuevoSubTotal").value;
    var descuento = document.getElementById("descPer").value;

    var descN = bruto * (descuento / 100);

    var subTotal = bruto - descN;

    var impNuevo = subTotal * 0.18;

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

$(".formularioPedidoCV").on("change", "input.nuevaCantidadArtPed", function() {

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
    listarArticulos();


});

/*
* SUMAR TODOS LOS TOTALES
*/

function sumarTotalesPreciosA(){

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

function listarArticulos() {

    var listaArticulos = [];

    var descripcion = $(".nuevaDescripcionArticulo");
    var cantidad = $(".nuevaCantidadArtPed");
    var precio = $(".nuevoPrecioArticulo");

    for (var i = 0; i < descripcion.length; i++) {
        listaArticulos.push({

            articulo: $(descripcion[i]).attr("articulo"),
            descripcion: $(descripcion[i]).val(),
            cantidad: $(cantidad[i]).val(),
            precio: $(precio[i]).attr("precioReal"),
            total: $(precio[i]).val()
        });
    }

    //console.log("listaArticulos", JSON.stringify(listaArticulos));

    $("#listaProductosPedidos").val(JSON.stringify(listaArticulos));

}

/* 
* AL CAMBIAR LA CONDICION DE VENTA
*/

$("#condicionVenta").change(function(){

    console.log("si llego")

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();

    $('#modalito').removeAttr('disabled');
    $('#modalito').removeClass('btn-default');
    $('#modalito').addClass('btn-primary');

})

$(".crearPedido").click(function () {

    sumarTotalesPreciosA();
    cambioDescuento();
    listarArticulos();

    var codigo = document.getElementById("nuevoCodigo").value;
    $("#codigoM").val(codigo);

    var cliente = document.getElementById("codCliente").value;
    $("#codClienteM").val(cliente);

    var nomCliente = document.getElementById("seleccionarCliente").value;
    $("#nomClienteM").val(nomCliente);

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
    $("#igvM").val(impuesto);

    var total = document.getElementById("nuevoTotal").value;
    $("#totalM").val(total);

    var articulos = document.getElementById("listaProductosPedidos").value;
    $("#articulosM").val(articulos);

    var condicionVenta = document.getElementById("condicionVenta").value;
    $("#condicionVentaM").val(condicionVenta);

    var agencia = document.getElementById("agencia").value;
    $("#agenciaM").val(agencia);

    var usuario = document.getElementById("idUsuario").value;
    $("#usuarioM").val(usuario);

    //console.log(usuario);

})

/*
* cargamos la tabla de pedidos
*/
$(".tablaPedidosCV").DataTable({
    ajax: "ajax/tabla-pedidosCV.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
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
* BOTON REVISAR PEDIDO
*/
$(".box").on("click", ".btnEditarPedidoCV", function () {

    var pedido = $(this).attr("codigo");
    //console.log("pedido", pedido);

    window.location = "index.php?ruta=crear-pedidocv&pedido=" + pedido;

})

/* 
* BOTON  IMPRIMIR TICKET
*/
$(".tablaPedidosCV").on("click", ".btnImprimirPedido", function () {

    var codigo = $(this).attr("codigo");
    //console.log(codigo);


	window.open("vistas/reportes_ticket/impresion_pedido.php?codigo=" +codigo,"_blank");

})

/* 
* AL CAMBIAR EL SELECT DE DOCUMENTO
*/
$("#tdoc").change(function(){

	var documento = document.getElementById("tdoc").value;
    //console.log(documento);

    document.getElementById("chkFactura").checked = false;
    document.getElementById("chkBoleta").checked = false;

    if(documento == "00"){

        document.getElementById("chkFactura").disabled = false;
        document.getElementById("chkBoleta").disabled = false;

    }else{

        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkBoleta").disabled = true;

        document.getElementById("chkFactura").checked = false;
        document.getElementById("chkBoleta").checked = false;

    }

    var serie = $("#serie");
    //console.log(serie);

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
            serie.find('option').remove();

            serie.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serie.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serie);
            }

        }

    })

})

/*
* validar el checkbox
*/
$(".chkFactura").change(function(){

    var chkBox = document.getElementById('chkFactura');

    var documento = "01";
    //console.log(documento);

    var serieSeparado = $("#serieSeparado");
    //console.log(serieSeparado);


    if(chkBox.checked == true){

        document.getElementById("chkBoleta").disabled = true;
        document.getElementById("chkBoleta").checked = false;

        document.getElementById("serieSeparado").disabled = false;

    }else{

        document.getElementById("chkBoleta").disabled = false;
        document.getElementById("serieSeparado").disabled = true;

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
            serieSeparado.find('option').remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparado.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparado);
            }

        }

    })

})

$(".chkBoleta").change(function(){

    var chkBox = document.getElementById('chkBoleta');
    //console.log(chkBox.checked);

    var serieSeparado = $("#serieSeparado");
    serieSeparado.find('option').remove();
    //console.log(serieSeparado);


    var documento = "03";

    if(chkBox.checked == true){

        document.getElementById("chkFactura").disabled = true;
        document.getElementById("chkFactura").checked = false;

        document.getElementById("serieSeparado").disabled = false;

    }else{

        document.getElementById("chkFactura").disabled = false;
        document.getElementById("serieSeparado").disabled = true;

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
            serieSeparado.find('option').remove();

            serieSeparado.append('<option value="">Seleccionar Serie</option>');

            for(var id of respuesta){
                serieSeparado.append('<option value="' + id.numero + '">' + id.numero + '</option>');
                //console.log(serieSeparado);
            }

        }

    })

})


/*
* ACTIVAR MODAL
*/

$(".tablaPedidosCV tbody").on("click", "button.btnFacturar", function(){

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

})
