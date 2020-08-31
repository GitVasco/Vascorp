$('.tablaMateriaPrima').DataTable( {
    "ajax": "ajax/tabla-materiaprima.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
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
} );

/* 
* tabla paraa cargar la lista de materia - URGENCIA
*/
$('.tablaUrgenciasAMP').DataTable( {
    "ajax": "ajax/tabla-urgenciasamp.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[6, "desc"]],
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
} );


/* 
* EDITAR NOMBRE MATERIA PRIMA
*/
$(".tablaMateriaPrima tbody").on("click", "button.btnEditarMateriaPrima", function(){

	var idMateriaPrima = $(this).attr("idMateriaPrima");

	/* console.log("idMateriaPrima", idMateriaPrima); */

	var datos = new FormData();
	datos.append("idMateriaPrima", idMateriaPrima);
	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            /* console.log("codpro", respuesta["codpro"]); */
			
			$("#editarCodigo").val(respuesta["codpro"]);

			$("#editarDescripcion").val(respuesta["despro"]);
 
		}
  
	})	

})

/* 
* VISUALIZAR DETALLE DE ARTICULOS QUE LLEVAN ESA MATERIA PRIMA
*/
$(".tablaMateriaPrima").on("click", ".btnVisualizarArticulos", function () {

	var articuloMP = $(this).attr("articuloMP");

	/* console.log("articuloMP", articuloMP); */

	var datos = new FormData();
	datos.append("articuloMP", articuloMP);

	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			/* console.log("respuesta", respuesta); */

			$("#codpro").val(respuesta["codpro"]);
			
			$("#codLinea").val(respuesta["codlinea"]);

			$("#linea").val(respuesta["linea"]);

			$("#codfab").val(respuesta["codfab"]);

			$("#descripcion").val(respuesta["descripcion"]);

			$("#unidad").val(respuesta["unidad"]);

			$("#color").val(respuesta["color"]);

			$("#salidasT").val(respuesta["canvta"]);

			$("#prom").val(respuesta["prom"]);

			$("#stock").val(respuesta["stock"]);

			$("#proveedor").val(respuesta["proveedor"]);

		}

	})

	var articuloMPDetalle = $(this).attr("articuloMP");	

	/* console.log("articuloMPDetalle", articuloMPDetalle); */

	var datosDetalle = new FormData();
	datosDetalle.append("articuloMPDetalle", articuloMPDetalle);

	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datosDetalle,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

			/* console.log("respuestaDetalle", respuestaDetalle); */

			$(".detalleMP").remove();

			for(var id of respuestaDetalle){

				$('.tablaDetalleArticulo').append(

					'<tr class="detalleMP">' +
						'<td>' + id.articulo + ' </td>' +
						'<td>' + id.modelo + ' </td>' +
						'<td>' + id.nombre + ' </td>' +
						'<td>' + id.color + ' </td>' +
						'<td>' + id.talla + ' </td>' +
						'<td>' + id.estado + ' </td>' +
						'<td>' + id.consumo + ' </td>' +
						'<td>' + id.tej_princ + ' </td>' +
					'</tr>'


				)

			}

		}

	})
  
})

/* 
* EDITAR COSTO MATERIA PRIMA
*/
$(".tablaMateriaPrima tbody").on("click", "button.btnEditarCosto", function(){

	var materiaPrima = $(this).attr("materiaPrima");

	/* console.log("materiaPrima", materiaPrima); */

	var datosCosto = new FormData();
	datosCosto.append("materiaPrima", materiaPrima);
	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datosCosto,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaCostos){

			/* console.log("codpro", respuestaCostos["Codpro"]); */

			/* console.log("respuestaCostos", respuestaCostos); */
			
			$("#codigo").val(respuestaCostos["codpro"]);

			$("#descripcionMP").val(respuestaCostos["descripcion"]);

			$("#colorMP").val(respuestaCostos["color"]);

			$("#costo").val(respuestaCostos["cospro"]);


 
		}
  
	})	

})

/* 
! PROYECCION DE ORDEN DE CORTE
*/

/* 
* BOTON ACEPTAR
*/
$(".box").on("click", ".btnCargarProyMp", function () {

	$(".tablaProyMp").DataTable().destroy();

	var proyMp = document.getElementById("proyMp").value;
	//console.log(lineaMp);

	localStorage.setItem("proyMp", proyMp);

	cargarTablaProyMp(localStorage.getItem("proyMp"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarProyMp", function () {

	localStorage.removeItem("proyMp");
	localStorage.clear();

	window.location = "proyeccion-mp";
	
})

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("proyMp") != null) {

	cargarTablaProyMp(localStorage.getItem("proyMp"));
	//console.log("lleno");
	
}else{

	cargarTablaProyMp(null);
	//console.log("vacio");

}

/* 
* TABLA MOVIMIENTOS
*/
function cargarTablaProyMp(proyMp) {
	$(".tablaProyMp").DataTable({
		"ajax": "ajax/tabla-proymp.ajax.php?perfil=" + $("#perfilOculto").val() + "&proyMp=" + proyMp,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "asc"]],
		"pageLength": 30,
		"lengthMenu": [[30, 60, 90, -1], [30, 60, 90, 'Todos']],
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "No hay datos disponibles en esta tabla",
			"sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Registros del 0 al 0 de un total de 0",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
}
