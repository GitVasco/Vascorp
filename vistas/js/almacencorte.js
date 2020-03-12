/* 
* tabla de articulos en ordenes de corte
*/
$('.tablaArticulosAlmacenCorte').DataTable( {
    "ajax": "ajax/tabla-articulosalmacencorte.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}
} );

/* 
* AGREGANDO LOS ARTICULOS DE ORDEN DE CORTE A CORTE
*/

$(".tablaArticulosAlmacenCorte tbody").on("click", "button.agregarArtAC", function () {

    var articuloAC = $(this).attr("articuloAC");
    var ordcorte = $(this).attr("ordcorte");
    var idCorte = $(this).attr("idCorte");
    //console.log("ordcorte", ordcorte);
    //console.log("articuloAC", articuloAC);
    //console.log("idCorte", idCorte);

    $(this).removeClass("btn-primary agregarArt");
    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("articuloAC", articuloAC);

    $.ajax({

        url: "ajax/articulos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            //console.log("respuesta", respuesta);

            var articulo = respuesta["articulo"];
            var packing = respuesta["packing"];
            var alm_corte = respuesta["alm_corte"];

            /* 
            todo: AGREGAR LOS CAMPOS
            */

            $(".nuevoArticuloAC").append(

                '<div class="row" style="padding:5px 15px">' +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-9" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarAC" idCorte="' + idCorte + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevaDescripcionProducto" articuloAC="' + articuloAC + '" ordcorte="' + ordcorte + '" name="agregarAC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Cantidad del Corte -->" +

                    '<div class="col-xs-3">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloAC" name="nuevaCantidadArticuloAC" min="1" value="1" alm_corte="' + alm_corte + '" nuevoOrdCorte="' + Number(alm_corte+1) + '" required>' +

                    "</div>" +
                
                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES



            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON



            // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

                      
        }

    })


});

/* 
* CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
*/
$(".tablaArticulosAlmacenCorte").on("draw.dt", function () {
    /* console.log("tabla"); */

    if (localStorage.getItem("quitarAC") != null) {
        var listaIdArticuloAC = JSON.parse(localStorage.getItem("quitarAC"));

        for (var i = 0; i < listaIdArticuloAC.length; i++) {
            $("button.recuperarBoton[articuloAC='" + listaIdArticuloAC[i]["articuloAC"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloAC='" + listaIdArticuloAC[i]["articuloAC"] + "']").addClass("btn-primary agregarArtAC");
        }
    }
});

/* 
* QUITAR ARTICULO DE CORTE Y RECUPERAR BOTÓN
*/
var idQuitarArticuloAC = [];

localStorage.removeItem("quitarAC");

$(".formularioAlmacenCorte").on("click", "button.quitarAC", function () {

    /* console.log("boton"); */

    $(this).parent().parent().parent().parent().remove();

    var idCorte = $(this).attr("idCorte");

    /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL MATERIA PRIMA A QUITAR
    =============================================*/

    if (localStorage.getItem("quitarAC") == null) {

        idQuitarArticuloAC = [];

    } else {

        idQuitarArticuloAC.concat(localStorage.getItem("quitarAC"))

    }

    idQuitarArticuloAC.push({
        "idCorte": idCorte
    });

    localStorage.setItem("quitarAC", JSON.stringify(idQuitarArticuloAC));

    $("button.recuperarBoton[idCorte='" + idCorte + "']").removeClass('btn-default');

    $("button.recuperarBoton[idCorte='" + idCorte + "']").addClass('btn-primary agregarArt');


    if ($(".nuevoArticuloAC").children().length == 0) {

        $("#nuevoTotalAlmacenCorte").val(0);
        $("#totalAlmacenCorte").val(0);
        $("#nuevoTotalAlmacenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES



            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON




    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioAlmacenCorte").on("change", "input.nuevaCantidadArticuloAC", function() {

    var nuevoStock = Number($(this).attr("stock")) - $(this).val();
  
    $(this).attr("nuevoStock", nuevoStock);
  
    if (Number($(this).val()) > Number($(this).attr("stock"))) {
      /*=============================================
      SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
      =============================================*/
  
      $(this).val(1);
  
      /* $(this).attr("nuevoStock", $(this).attr("stock")); */
  
      var precioFinal = $(this).val() * precio.attr("precioReal");
  
      precio.val(precioFinal);
  
      sumarTotalPrecios();
  
      swal({
        title: "La cantidad supera el Stock",
        text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });
  
      return;
    }
  
    // SUMAR TOTAL DE PRECIOS
  
    sumarTotalPrecios();
  
    // AGREGAR IMPUESTO
  
    agregarImpuesto();
  
    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
    listarProductos();
  });