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
    var saldo = $(this).attr("saldo");
    //console.log("ordcorte", ordcorte);
    //console.log("articuloAC", articuloAC);
    //console.log("idCorte", idCorte);
    //console.log("saldo", saldo);

    $(this).removeClass("btn-primary agregarArtAC");
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

                    "<!-- Numero de OC y quitar -->" +

                    '<div class="col-xs-3" style="padding-right:0px">' +

                        '<div class="input-group">' +
                        
                            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarAC" idCorte="' + idCorte + '"><i class="fa fa-times"></i></button></span>' +

                            '<input type="text" class="form-control nuevoAlmacenCorte"   name="nrooc" value="N° - ' + ordcorte + '" idCorte="' + idCorte + '" ordcorte="' + ordcorte + '" readonly required>' +

                        "</div>" +

                    "</div>" +

                    "<!-- Descripción del Articulo -->" +

                    '<div class="col-xs-5" style="padding-right:0px">' +                        

                            '<input type="text" class="form-control nuevaDescripcionProducto" articuloAC="' + articuloAC + '" name="agregarAC" value="' + packing + '" codigoAC="' + articulo + '" readonly required>' +                        

                    "</div>" +

                    "<!-- Cantidad del Corte -->" +

                    '<div class="col-xs-2">' +

                        '<input type="number" class="form-control nuevaCantidadArticuloAC" name="nuevaCantidadArticuloAC" min="1" value="1" ordcorte="' + ordcorte + '" saldo="' + saldo + '" nuevoSaldo="' + (Number(saldo)-1) + '" alm_corte="' + alm_corte + '" nuevoAlmCorte="' + (Number(alm_corte)+1) + '" required>' +

                    "</div>" +

                    "<!-- Cantidad del SALDO -->" +

                    '<div class="col-xs-2 ingresoSaldo">' +

                        '<input type="number" class="form-control nuevaCantidadSaldo" name="nuevaCantidadSaldo" saldoReal="' + saldo + '" nuevoSaldoP="' + (Number(saldo)-1) + '" value="' +  (Number(saldo)-1) + '" readonly required>' +

                    "</div>" +                    
                
                "</div>"

            );

            // SUMAR TOTAL DE UNIDADES

            sumarTotalAC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosAC();
            listArticulo();

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
            $("button.recuperarBoton[articuloAC='" + listaIdArticuloAC[i]["idCorte"] + "']").removeClass("btn-default");

            $("button.recuperarBoton[articuloAC='" + listaIdArticuloAC[i]["idCorte"] + "']").addClass("btn-primary agregarArtAC");
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

    $("button.recuperarBoton[idCorte='" + idCorte + "']").addClass('btn-primary agregarArtAC');


    if ($(".nuevoArticuloAC").children().length == 0) {

        $("#nuevoTotalAlmacenCorte").val(0);
        $("#totalAlmacenCorte").val(0);
        $("#nuevoTotalAlmacenCorte").attr("total", 0);

    } else {

            // SUMAR TOTAL DE UNIDADES

            sumarTotalAC();

            // AGREGAR IMPUESTO

            

            // AGRUPAR PRODUCTOS EN FORMATO JSON

            listarArticulosAC();
            listArticulo();

    }

})

/* 
* MODIFICAR LA CANTIDAD
*/
$(".formularioAlmacenCorte").on("change", "input.nuevaCantidadArticuloAC", function() {

    var saldoA = $(this)
    .parent()
    .parent()
    .children(".ingresoSaldo")
    .children(".nuevaCantidadSaldo");
    //console.log("saldoA", saldoA.val());

    var saldoFinal = saldoA.attr("saldoReal") - $(this).val() ;
    //console.log("saldoFinal", saldoFinal);

    saldoA.val(saldoFinal);

    var nuevoAlmCorte = Number($(this).attr("alm_corte")) + Number($(this).val());
    var nuevoSaldo = Number($(this).attr("saldo")) - Number($(this).val());
    var oc = $(this).attr("ordcorte");
    //console.log("oc", oc);
  
    $(this).attr("nuevoAlmCorte", Number(nuevoAlmCorte));
    $(this).attr("nuevoSaldo", Number(nuevoSaldo));


    if (Number($(this).val()) > Number($(this).attr("saldo"))) {

        /*  
        * mostrar mensaje si se pide mas que la cantidad de saldo
        */
    
        $(this).val(1);

        saldoA.val(Number($(this).attr("saldo"))-1);

        sumarTotalAC();
    
        swal({
          title: "La cantidad supera el Saldo de la Orden de Corte N° - " + oc +" ",
          text: "¡Sólo hay " + $(this).attr("saldo") + " unidades!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });
    
        return;
      }
  
  
    // SUMAR TOTAL DE UNIDADES
  
        sumarTotalAC()
    
    // AGREGAR IMPUESTO
  

  
    // AGRUPAR PRODUCTOS EN FORMATO JSON
  
        listarArticulosAC();
        listArticulo();


  });

  /* 
* SUMAR EL TOTAL DE LOS CORTES
*/
  
function sumarTotalAC() {

    var cantidadAc = $(".nuevaCantidadArticuloAC");  
    //console.log("cantidadAc", cantidadAc);

    var arraySumarCantidades = [];

    for (var i = 0; i < cantidadAc.length; i++){

        arraySumarCantidades.push(Number($(cantidadAc[i]).val()));

    }
        //console.log("arraySumarCantidades", arraySumarCantidades);
  
    function sumaArrayCantidades(total, numero) {

        return total + numero;

    }

    var sumarTotal = arraySumarCantidades.reduce(sumaArrayCantidades);

    //console.log("sumarTotal", sumarTotal);

    $("#nuevoTotalAlmacenCorte").val(sumarTotal);
    $("#totalAlmacenCorte").val(sumarTotal);
    $("#nuevoTotalAlmacenCorte").attr("total", sumarTotal);

}

/* 
*formato al total
*/
$("#nuevoTotalAlmacenCorte").number(true, 0);


/* 
* LISTAR TODOS LOS ARTICULOS DEL DETALLE
*/
function listarArticulosAC() {

    var listaArticulos = [];
  
    var ordencorte = $(".nuevoAlmacenCorte");

    var articulo = $(".nuevaDescripcionProducto");
  
    var cantidad = $(".nuevaCantidadArticuloAC");
    
    var saldo = $(".nuevaCantidadSaldo");
    
    for (var i = 0; i < ordencorte.length; i++) {

      listaArticulos.push({

        ordencorte: $(ordencorte[i]).attr("ordcorte"),
        idocd: $(ordencorte[i]).attr("idCorte"),
        articulo: $(articulo[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).val(),
        saldo: $(saldo[i]).val()

      });
    }
  
    //console.log("listaArticulos", JSON.stringify(listaArticulos));
  
    $("#listaArticulosAC").val(JSON.stringify(listaArticulos));
    
}

/* 
* LISTAR TODOS LOS ARTICULOS
*/
function listArticulo() {

    var listArticulo = [];

    var articulo = $(".nuevaDescripcionProducto");
    var cantidad = $(".nuevaCantidadArticuloAC");

    
    for (var i = 0; i < articulo.length; i++) {

        listArticulo.push({

        articulo: $(articulo[i]).attr("codigoAC"),
        cantidad: $(cantidad[i]).attr("nuevoAlmCorte")

      });
    }
  
    //console.log("listArticulo", JSON.stringify(listArticulo));
    //console.log("listArticulo", listArticulo);
  
    $("#listArticulo").val(JSON.stringify(listArticulo));
    
}



/* 
*FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL ARTICULO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
*/
function quitarAgregarArticuloAC() {

	//Capturamos todos los id de productos que fueron elegidos en la venta
    var articuloAC = $(".quitarAC");
    //console.log("articuloAC", articuloAC);

	//Capturamos todos los botones de agregar que aparecen en la tabla
    var botonesTablaAC = $(".tablaArticulosAlmacenCorte tbody button.agregarArtAC");
    //console.log("botonesTablaAC", botonesTablaAC);

	//Recorremos en un ciclo para obtener los diferentes articuloAC que fueron agregados a la venta
	for (var i = 0; i < articuloAC.length; i++) {

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(articuloAC[i]).attr("articuloAC");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTablaAC.length; j++) {

			if ($(botonesTablaAC[j]).attr("articuloAC") == boton) {

				$(botonesTablaAC[j]).removeClass("btn-primary agregarArtAC");
				$(botonesTablaAC[j]).addClass("btn-default");

			}
		}

	}

}

/* 
* CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
*/
$(".tablaArticulosAlmacenCorte").on("draw.dt", function() {
    quitarAgregarArticuloAC();
});
  