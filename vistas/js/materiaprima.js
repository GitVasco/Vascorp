$('.tablaMateriaPrima').DataTable( {
    "ajax": "ajax/materiaprima/tabla-materiaprima.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
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
} );

/* 
* tabla paraa cargar la lista de materia - URGENCIA
*/
$('.tablaUrgenciasAMP').DataTable( {
    "ajax": "ajax/maestros/tabla-urgenciasamp.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[6, "desc"]],
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
			// console.log(respuesta);
			var linea = respuesta["FamPro"].substr(0,3);
			var sublinea = respuesta["FamPro"].substr(3,6);
			var fecha = respuesta["FecReg"].substr(0,10);
			// console.log(linea);
			// console.log(sublinea);

			var datos2 = new FormData();
			datos2.append("linea2", linea);
			datos2.append("sublinea", sublinea);
			
			$.ajax({

				url:"ajax/materiaprima.ajax.php",
				method: "POST",
				data: datos2,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta2){
					
					$("#editarSubLinea2").val(respuesta2["Valor_3"] +" - " + respuesta2["Des_Larga"]);
					$("#editarSubLinea").val(respuesta2["Valor_3"]);
					}
				})
			$("#editarCodigoPro").val(respuesta["codpro"]);
			$("#editarCodigoFab").val(respuesta["codfab"]);
			$("#editarCodigoAlt").val(respuesta["CodAlt"]);
			$("#editarFechaEmision").val(fecha);
			$("#editarLinea").val(linea);
			$("#editarUsuarioReg").val(respuesta["UsuReg"]);
			$("#editarLinea").selectpicker("refresh");
			$("#editarColorMateria").val(respuesta["ColPro"]);
			$("#editarColorMateria").selectpicker("refresh");
			$("#editarTallaMateria").val(respuesta["TalPro"]);
			$("#editarTallaMateria").selectpicker("refresh");
			$("#editarUnidadMedida").val(respuesta["UndPro"]);
			$("#editarUnidadMedida").selectpicker("refresh");
			$("#editarPeso").val(respuesta["PesPro"]);
			$("#editarAdVal").val(respuesta["Por_Adval"]);
			$("#editarSeguro").val(respuesta["Por_Seg"]);
			$("#editarStockActual").val(respuesta["Stk_Act"]);
			$("#editarStockMinimo").val(respuesta["Stk_Min"]);
			$("#editarStockMaximo").val(respuesta["Stk_Max"]);
			$("#editarDescripcion").val(respuesta["despro"]);
			$("#editarProveedor").val(respuesta["CodProv1"]);
			$("#editarProveedor").selectpicker("refresh");
			$("#editarMoneda").val(respuesta["MonProv1"]);
			$("#editarMoneda").selectpicker("refresh");
			$("#editarPrecioSIGV").val(respuesta["PreProv1"]);
			$("#editarProveedor1").val(respuesta["CodProv2"]);
			$("#editarProveedor1").selectpicker("refresh");
			$("#editarMoneda1").val(respuesta["MonProv2"]);
			$("#editarMoneda1").selectpicker("refresh");
			$("#editarPrecioSIGV1").val(respuesta["PreProv2"]);
			$("#editarProveedor2").val(respuesta["CodProv3"]);
			$("#editarProveedor2").selectpicker("refresh");
			$("#editarMoneda2").val(respuesta["MonProv3"]);
			$("#editarMoneda2").selectpicker("refresh");
			$("#editarPrecioSIGV2").val(respuesta["PreProv3"]);
			$("#editarObservacion1").val(respuesta["ObsProv1"]);
			$("#editarObservacion2").val(respuesta["ObsProv2"]);
			$("#editarObservacion3").val(respuesta["ObsProv3"]);
 
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
$("#proyMp").change(function(){

	$(".tablaProyMp").DataTable().destroy();

	var proyMp = $(this).val();
	//console.log(lineaMp);
	$(".btnReporteProyeccion").attr("corte",proyMp);
	localStorage.setItem("proyMp", proyMp);

	cargarTablaProyMp(localStorage.getItem("proyMp"));
	
})


/* 
* BOTON LIMPIAR
*/
$(".box").on("click", ".btnLimpiarProyMp", function () {

	localStorage.removeItem("proyMp");
	localStorage.clear();
	$(".btnReporteProyeccion").attr("corte","");
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
		"ajax": "ajax/maestros/tabla-proymp.ajax.php?perfil=" + $("#perfilOculto").val() + "&proyMp=" + proyMp,
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

//Reporte de Salidas
$(".box").on("click", ".btnReporteProyeccion", function () {
	var corte = $(this).attr("corte");
    window.location = "vistas/reportes_excel/rpt_proyeccion_mp.php?corte="+corte;
  
})

//Reporte de Marca
$(".box").on("click", ".btnReporteMateria", function () {
    window.location = "vistas/reportes_excel/rpt_materiaprima.php";
  
})

// GENERAR CODIGO AL CREAR MATERIA PRIMA  Y CARGAMOS EL SELECT DE SUBLINEA

$("#nuevaLinea").change(function(){
	var linea = $(this).val();
	var talla = $("#nuevaTallaMateria").val();
	var color = $("#nuevoColorMateria").val();
	$("#nuevoCodigoFab").val(linea+color+talla);

	var datos = new FormData();

	datos.append("linea", linea);
	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#nuevaSubLinea").find('option').remove();
			$("#nuevaSubLinea").append("<option value='' > SELECCIONAR SUBLINEA </option>");
			for (let i = 0; i < respuesta.length; i++) {
				
				$("#nuevaSubLinea").append("<option value='"+respuesta[i]["Valor_3"]+"'>"+respuesta[i]["Valor_3"]+" - "+respuesta[i]["Des_Larga"]+"</option>");
				
			}
			$("#nuevaSubLinea").selectpicker("refresh");
 
		}
  
	})	
})

// GENERAR CODIGO AL CREAR MATERIA PRIMA 

$("#nuevaSubLinea").change(function(){

	var sublinea = $(this).val();
	var linea = $("#nuevaLinea").val();
	var talla = $("#nuevaTallaMateria").val();
	var color = $("#nuevoColorMateria").val();
	$("#nuevoCodigoFab").val(linea+sublinea+color+talla);
	var texto = $(this).find('option:selected').text();
	var descripcion = texto.substr(6);
	$("#nuevaDescripcionMat").val(descripcion);

});

// GENERAR CODIGO AL CREAR MATERIA PRIMA 
$("#nuevoColorMateria").change(function(){

	var color = $(this).val();
	var linea = $("#nuevaLinea").val();
	var sublinea = $("#nuevaSubLinea").val();
	var talla = $("#nuevaTallaMateria").val();
	$("#nuevoCodigoFab").val(linea+sublinea+color+talla);

});

// GENERAR CODIGO AL CREAR MATERIA PRIMA  Y VALIDAMOS SI EXISTE EN LA TABLA PRODUCTO

$("#nuevaTallaMateria").change(function(){

	var talla = $(this).val();
	var color = $("#nuevoColorMateria").val();
	var linea = $("#nuevaLinea").val();
	var sublinea = $("#nuevaSubLinea").val();
	$("#nuevoCodigoFab").val(linea+sublinea+color+talla);

	var CodigoFab = linea+sublinea+color+talla;
	var datos = new FormData();
	datos.append("CodigoFab", CodigoFab);
	$.ajax({
		url: "ajax/materiaprima.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			console.log(respuesta.length);
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#alertaCodigoFab").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El Cod. Fab. ya existe en la Base de Datos, por favor verifique.' +
						'</div>');
					$("#nuevoCodigoFab").val(linea+sublinea+color);
					$("#nuevaTallaMateria").val("");
					$("#nuevaTallaMateria").focus("");
					$("#nuevaTallaMateria").selectpicker("refresh");
				}
				
			} else {
				$(".msgError").remove();
			}
		}
	});

});

//SELECT PARA CARGAR MONEDA DEL PROVEEDOR 1 AL CREAR MATERIA PRIMA
$("#nuevoProveedor").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#nuevaMoneda").val(respuesta["Des_Larga"]);
 
		}
  
	})	
})

//SELECT PARA CARGAR MONEDA DEL PROVEEDOR 2 AL CREAR MATERIA PRIMA
$("#nuevoProveedor1").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#nuevaMoneda1").val(respuesta["Des_Larga"]);
 
		}
  
	})	
})

//SELECT PARA CARGAR MONEDA DEL PROVEEDOR 3 AL CREAR MATERIA PRIMA
$("#nuevoProveedor2").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#nuevaMoneda2").val(respuesta["Des_Larga"]);
 
		}
  
	})	
})

//EDITAR MATERIA PRIMA PROVEEDOR CON SELECT DE MONEDA
$("#editarProveedor").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#editarMoneda").val(respuesta["Des_Larga"]);
			$("#editarMoneda").selectpicker("refresh");
 
		}
  
	})	
})

//EDITAR MATERIA PRIMA PROVEEDOR CON SELECT DE MONEDA
$("#editarProveedor1").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#editarMoneda1").val(respuesta["Des_Larga"]);
			$("#editarMoneda1").selectpicker("refresh");
 
		}
  
	})	
})

//EDITAR MATERIA PRIMA PROVEEDOR CON SELECT DE MONEDA
$("#editarProveedor2").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#editarMoneda2").val(respuesta["Des_Larga"]);
			$("#editarMoneda2").selectpicker("refresh");
 
		}
  
	})	
})

//Botones para limpiar la fila de proveedores 1 al editar materia prima
$("#btnLimpiarProveedor1").click(function(){
	$("#editarProveedor").val("");
	$("#editarProveedor").selectpicker("refresh");
	$("#editarMoneda").val("");
	$("#editarMoneda").selectpicker("refresh");
	$("#editarPrecioSIGV").val("0.00");
	
})
//Botones para limpiar la fila de proveedores 2 al editar materia prima
$("#btnLimpiarProveedor2").click(function(){
	$("#editarProveedor1").val("");
	$("#editarProveedor1").selectpicker("refresh");
	$("#editarMoneda1").val("");
	$("#editarMoneda1").selectpicker("refresh");
	$("#editarPrecioSIGV1").val("0.00");
	
})
//Botones para limpiar la fila de proveedores 3 al editar materia prima
$("#btnLimpiarProveedor3").click(function(){
	$("#editarProveedor2").val("");
	$("#editarProveedor2").selectpicker("refresh");
	$("#editarMoneda2").val("");
	$("#editarMoneda2").selectpicker("refresh");
	$("#editarPrecioSIGV2").val("0.00");
	
})

/* 
* DUPLICAR MATERIA PRIMA
*/
$(".tablaMateriaPrima tbody").on("click", "button.btnDuplicarMateriaPrima", function(){

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
			// console.log(respuesta);
			var linea = respuesta["FamPro"].substr(0,3);
			var sublinea = respuesta["FamPro"].substr(3,6);
			var datos2 = new FormData();
			datos2.append("linea2", linea);
			datos2.append("sublinea", sublinea);

			$.ajax({

				url:"ajax/materiaprima.ajax.php",
				method: "POST",
				data: datos2,
				cache: false,
				contentType: false,
				processData: false,
				dataType:"json",
				success:function(respuesta2){
					
					$("#duplicarSubLinea2").val(respuesta2["Valor_3"] +" - " + respuesta2["Des_Larga"]);
					$("#duplicarSubLinea").val(respuesta2["Valor_3"]);
					}
				})
			$("#duplicarCodigoPro").val(respuesta["codpro"]);
			$("#duplicarCodigoFab").val(respuesta["codfab"]);
			$("#duplicarCodigoAlt").val(respuesta["CodAlt"]);
			$("#duplicarLinea").val(linea);
			$("#duplicarLinea").selectpicker("refresh");
			$("#duplicarColorMateria").val(respuesta["ColPro"]);
			$("#duplicarFamPro").val(respuesta["FamPro"]);
			$("#duplicarColorMateria").selectpicker("refresh");
			$("#duplicarTallaMateria").val(respuesta["TalPro"]);
			$("#duplicarTallaMateria").selectpicker("refresh");
			$("#duplicarUnidadMedida").val(respuesta["UndPro"]);
			$("#duplicarUnidadMedida").selectpicker("refresh");
			$("#duplicarPeso").val(respuesta["PesPro"]);
			$("#duplicarAdVal").val(respuesta["Por_Adval"]);
			$("#duplicarSeguro").val(respuesta["Por_Seg"]);
			$("#duplicarStockActual").val(respuesta["Stk_Act"]);
			$("#duplicarStockMinimo").val(respuesta["Stk_Min"]);
			$("#duplicarStockMaximo").val(respuesta["Stk_Max"]);
			$("#duplicarDescripcion").val(respuesta["despro"]);
			$("#duplicarProveedor").val(respuesta["CodProv1"]);
			$("#duplicarProveedor").selectpicker("refresh");
			$("#duplicarMoneda").val(respuesta["MonProv1"]);
			$("#duplicarMoneda").selectpicker("refresh");
			$("#duplicarPrecioSIGV").val(respuesta["PreProv1"]);
			$("#duplicarProveedor1").val(respuesta["CodProv2"]);
			$("#duplicarProveedor1").selectpicker("refresh");
			$("#duplicarMoneda1").val(respuesta["MonProv2"]);
			$("#duplicarMoneda1").selectpicker("refresh");
			$("#duplicarPrecioSIGV1").val(respuesta["PreProv2"]);
			$("#duplicarProveedor2").val(respuesta["CodProv3"]);
			$("#duplicarProveedor2").selectpicker("refresh");
			$("#duplicarMoneda2").val(respuesta["MonProv3"]);
			$("#duplicarMoneda2").selectpicker("refresh");
			$("#duplicarPrecioSIGV2").val(respuesta["PreProv3"]);
			$("#duplicarObservacion1").val(respuesta["ObsProv1"]);
			$("#duplicarObservacion2").val(respuesta["ObsProv2"]);
			$("#duplicarObservacion3").val(respuesta["ObsProv3"]);
 
		}
  
	})	

})

// GENERAR CODIGO AL CREAR NUEVO COLOR MEDIANTE EL BOTON

$("#duplicarColorMateria").change(function(){

	var color = $(this).val();
	var linea = $("#duplicarLinea").val();
	var sublinea = $("#duplicarSubLinea").val();
	var talla = $("#duplicarTallaMateria").val();
	$("#duplicarCodigoFab").val(linea+sublinea+color+talla);

});

// GENERAR CODIGO AL CREAR NUEVO COLOR MEDIANTE EL BOTON Y VALIDAR SI EXISTE EL CODIGO DE FABRICA EN LA TABLA PRODUCTO

$("#duplicarTallaMateria").change(function(){

	var talla = $(this).val();
	var color = $("#duplicarColorMateria").val();
	var linea = $("#duplicarLinea").val();
	var sublinea = $("#duplicarSubLinea").val();
	$("#duplicarCodigoFab").val(linea+sublinea+color+talla);

	var CodigoFab = linea+sublinea+color+talla;
	var datos = new FormData();
	datos.append("CodigoFab", CodigoFab);
	$.ajax({
		url: "ajax/materiaprima.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			// console.log(respuesta);
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#alertaCodigoFab2").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El Cod. Fab. ya existe en la Base de Datos, por favor verifique.' +
						'</div>');

					$("#duplicarCodigoFab").val(linea+sublinea+color);
					$("#duplicarTallaMateria").val("");
					$("#duplicarTallaMateria").focus("");
					$("#duplicarTallaMateria").selectpicker("refresh");
				}
				
			} else {
				$(".msgError").remove();
			}
		}
	});

});

//DUPLICAR MATERIA PRIMA PROVEEDOR 1 CON SELECT DE MONEDA
$("#duplicarProveedor").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#duplicarMoneda").val(respuesta["Des_Larga"]);
			$("#duplicarMoneda").selectpicker("refresh");
 
		}
  
	})	
})

//DUPLICAR MATERIA PRIMA PROVEEDOR  2 CON SELECT DE MONEDA
$("#duplicarProveedor1").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#duplicarMoneda1").val(respuesta["Des_Larga"]);
			$("#duplicarMoneda1").selectpicker("refresh");
 
		}
  
	})	
})

//DUPLICAR MATERIA PRIMA PROVEEDOR 3 CON SELECT DE MONEDA
$("#editarProveedor2").change(function(){
	var CodRuc = $(this).val();
	var datos = new FormData();
	datos.append("CodRuc", CodRuc);
	
	$.ajax({

		url:"ajax/proveedor.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			// console.log(respuesta);
			$("#duplicarMoneda2").val(respuesta["Des_Larga"]);
			$("#duplicarMoneda2").selectpicker("refresh");
 
		}
  
	})	
})

/*=============================================
ANULAR MATERIA PRIMA
=============================================*/
$(".tablaMateriaPrima").on("click", ".btnAnularMateriaPrima", function(){

    var idMateriaPrima = $(this).attr("idMateriaPrima");

    swal({
        title: '¿Está seguro de anular la materia prima?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular materia prima!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=materiaprima&idMateriaPrima="+idMateriaPrima;

        }

    })

})

/*=============================================
GUARDAR CAMBIOS DE MATERIA PRIMA
=============================================*/
$("#formularioEditarMateria").on("click", ".btnEditarCambiosMateria", function(){
	//datos de materia prima
	var codpro = $("#editarCodigoPro").val();
	var codalt = $("#editarCodigoAlt").val();
	var despro = $("#editarDescripcion").val();
	var undpro = $("#editarUnidadMedida").val();
	var padval = $("#editarAdVal").val();
	var pseg = $("#editarSeguro").val();
	var pespro = $("#editarPeso").val();
	var stkmin = $("#editarStockMinimo").val();
	var stkmax = $("#editarStockMaximo").val();


	//datos de precio mp
	var codprov1 = $("#editarProveedor").val();
	var preprov1 = $("#editarPrecioSIGV").val();
	var monprov1 = $("#editarMoneda").val();
	var obsprov1 = $("#editarObservacion1").val();
	var codprov2 = $("#editarProveedor1").val();
	var preprov2 = $("#editarPrecioSIGV1").val();
	var monprov2 = $("#editarMoneda1").val();
	var obsprov2 = $("#editarObservacion2").val();
	var codprov3 = $("#editarProveedor2").val();
	var preprov3 = $("#editarPrecioSIGV2").val();
	var monprov3 = $("#editarMoneda2").val();
	var obsprov3 = $("#editarObservacion3").val();
	
	var datos = new Array();
	
	
	datos.push({
		'codpro':codpro,
		'codalt':codalt,
		'despro':despro,
		'undpro':undpro,
		'padval':padval,
		'pseg':pseg,
		'pespro':pespro,
		'stkmin':stkmin,
		'stkmax':stkmax,
		'codprov1':codprov1,
		'preprov1':preprov1,
		'monprov1':monprov1,
		'obsprov1':obsprov1,
		'codprov2':codprov2,
		'preprov2':preprov2,
		'monprov2':monprov2,
		'obsprov2':obsprov2,
		'codprov3':codprov3,
		'preprov3':preprov3,
		'monprov3':monprov3,
		'obsprov3':obsprov3
	});
	var materiaprima = {"datosMateria" : datos}
	
	var jsonMateria= {"jsonMateria":JSON.stringify(materiaprima)};
	
	$.ajax({
		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: jsonMateria,
		cache: false,
		success:function(respuesta){
			console.log(respuesta);
			if(respuesta== "ok"){
		
				$("#modalEditarMateriaPrima").modal('hide');
				Command:toastr["success"]("Editado de materia prima exitosamente!");
			}	
			
		}

	})
});

