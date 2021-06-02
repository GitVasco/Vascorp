/* 
* TABLA MAESTRA CABECERAS
*/
$('.TablaMaestraCabecera').DataTable({
    "ajax": "ajax/maestros/tabla-maestracabecera.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[1, "asc"]],
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
  });

/* 
* ACTIVAR SUB LINEA
*/  
if (localStorage.getItem("codigoSubLinea") != null) {

	cargarTablaMaestraDetalle(localStorage.getItem("codigoSubLinea"));
	// console.log("lleno");
	
}else{

	cargarTablaMaestraDetalle(null);
	// console.log("vacio");

}

$(".TablaMaestraCabecera tbody").on("click", "button.btnActivarSubLinea", function () {

	$(".TablaMaestraDetalle").DataTable().destroy();

	var codigoSubLinea = $(this).attr("codigo");
	//console.log("codigo", codigoSubLinea);

	localStorage.setItem("codigoSubLinea", codigoSubLinea);
	cargarTablaMaestraDetalle(localStorage.getItem("codigoSubLinea"));
	
})

/* 
* TABLA MAESTRA DETALLES
*/
function cargarTablaMaestraDetalle(codigoSubLinea){
  $('.TablaMaestraDetalle').DataTable({
    "ajax": "ajax/maestros/tabla-maestradetalle.ajax.php?perfil="+$("#perfilOculto").val()+ "&codigoSubLinea=" + codigoSubLinea,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[1, "asc"]],
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
  });  

}

/*=============================================
AGREGAR SUBLINEA
=============================================*/
$(".TablaMaestraCabecera").on("click", ".btnCrearSubLinea", function () {

	$("#nuevoVal3").val("");
	document.getElementById("nuevoVal3").readOnly = false;

	/* $(".TablaMaestraDetalle").DataTable().destroy();

	var codigoSubLinea = $(this).attr("codigo");
	//console.log("codigo", codigoSubLinea);

	localStorage.setItem("codigoSubLinea", codigoSubLinea);
	cargarTablaMaestraDetalle(localStorage.getItem("codigoSubLinea")); */

    var subLinea = $(this).attr("codigo");
	var descripcion = $(this).attr("descripcion");
	//console.log(subLinea);

	$("#nuevoCodTabla").val(subLinea);
	$("#nuevaDescripcion").val(descripcion);

    var datos = new FormData();
    datos.append("subLinea", subLinea);

    $.ajax({

        url: "ajax/tablamaestra.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			//console.log(respuesta);

            $("#nuevoCorrelativo").val(respuesta["correlativo"]);

        }

    })

	if(subLinea == 'TSUB'){

		$(".campoSubLineaA").addClass("hidden");
		$(".campoSubLineaB").removeClass("hidden");

	}else{

		$(".campoSubLineaB").addClass("hidden");
		$(".campoSubLineaA").removeClass("hidden");

	}
})

$("#nuevaDescCortaSelect").change(function(){

	var des_corta = $(this).val();
	//console.log("des_corta", des_corta);

    var datos = new FormData();
    datos.append("des_corta", des_corta);

    $.ajax({

        url: "ajax/tablamaestra.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			//console.log(respuesta);

            $("#nuevoVal3").val(respuesta["correlativo"]);
			document.getElementById("nuevoVal3").readOnly = true;

        }

    })	
	
})

/*=============================================
EDITAR SUBLINEA
=============================================*/
$(".TablaMaestraDetalle").on("click", ".btnEditarSubLinea", function () {

	var codigo = $(this).attr("codigo");
	var argumento = $(this).attr("argumento");
	//console.log(codigo, argumento);

	$("#editarCodTabla").val(codigo);
	$("#editarCorrelativo").val(argumento);

    var datos = new FormData();
    datos.append("codigo", codigo);
	datos.append("argumento", argumento);

    $.ajax({

        url: "ajax/tablamaestra.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
			//console.log(respuesta);

            $("#editarDescCorta").val(respuesta["des_corta"]);
			$("#editarDescLarga").val(respuesta["des_larga"]);
			$("#editarVal1").val(respuesta["valor_1"]);
			$("#editarVal2").val(respuesta["valor_2"]);
			
			$("#editarVal4").val(respuesta["valor_4"]);
			$("#editarVal5").val(respuesta["valor_5"]);

			if(codigo == 'TSUB'){

				$("#editarVal3").val(respuesta["valor_3"]);
				document.getElementById("editarVal3").readOnly = true;

			}else{

				$("#editarVal3").val(respuesta["valor_3"]);
				document.getElementById("editarVal3").readOnly = false;

			}

        }

    })	

})