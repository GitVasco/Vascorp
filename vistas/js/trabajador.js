$('.tablaTrabajador').DataTable( {
    "ajax": "ajax/tabla-trabajador.ajax.php",
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



// ELIMINAR OPERACIÓN
$(".tablaTrabajador tbody").on("click","button.btnEliminarTrabajador",function(){
	var idTrabajador =$(this).attr("idTrabajador");
	//console.log("idTrabajador", idTrabajador);
	swal({
		title: "¿Está seguro de borrar al trabajador?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar trabajador!" 
	}).then((result)=>{
		if(result.value){

			//console.log("result", result);
			 window.location = "index.php?ruta=trabajador&idTrabajador="+idTrabajador;
		}
	})
	
	
});

// EDITAR TRABAJADOR
$(".tablaTrabajador tbody").on("click","button.btnEditarTrabajador",function(){
	var idTrabajador =$(this).attr("idTrabajador");
	// console.log("idTrabajador", idTrabajador);
	var datos= new FormData();
	datos.append("idTrabajador",idTrabajador);
	$.ajax({
		url:"ajax/trabajador.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){

			var datosTipoDocumento = new FormData();
			datosTipoDocumento.append("idTipoDocumento",respuesta["cod_doc"]);
			$.ajax({
				url:"ajax/tipoDocumento.ajax.php",
				method:"POST",
				data:datosTipoDocumento,
				cache: false,
				contentType:false,
				processData:false,
				dataType: "json",
				success:function(respuesta){
				console.log("respuesta", respuesta);
				$("#editarTipoDocumento").val(respuesta["cod_doc"]);
				$("#editarTipoDocumento").selectpicker('refresh');

				}
	
			})


			var datosTipoTrabajador = new FormData();
			datosTipoTrabajador.append("idTipoTrabajador",respuesta["cod_tip_tra"]);
			$.ajax({
				url:"ajax/tipoTrabajador.ajax.php",
				method:"POST",
				data:datosTipoTrabajador,
				cache: false,
				contentType:false,
				processData:false,
				dataType: "json",
				success:function(respuesta){
					console.log("respuesta", respuesta);
				$("#editarTipoTrabajador").val(respuesta["cod_tip_tra"]);
				$("#editarTipoTrabajador").selectpicker('refresh');
					
				}
	
			})


	//console.log("respuesta", respuesta);
				
					
	 		$("#editarCodigoTrabajador").val(respuesta["cod_tra"]);

	// 		$("#editarTipoDocumento").val(respuesta["cod_doc"]);
			
	 		$("#editarNroDocumento").val(respuesta["nro_doc_tra"]);

	 		$("#editarNombreTrabajador").val(respuesta["nom_tra"]);

	 		$("#editarApellidoPaterno").val(respuesta["ape_pat_tra"]);

	 		$("#editarApellidoMaterno").val(respuesta["ape_mat_tra"]);

	// 		$("#editarTipoTrabajador").val(respuesta["cod_tip_tra"]);

	 		$("#editarSueldoMes").val(respuesta["sueldo_total"]);
				

		}
	})
	
})

// ACTIVANDO-DESACTIVANDO TRABAJADOR
$(".tablaTrabajador").on("click",".btnActivarTrabajador",function(){
	// Capturamos el id del usuario y el estado
	var idTrabajador=$(this).attr("idTrabajador");
	var estadoTrabajador=$(this).attr("estadoTrabajador");
	console.log("idTrabajador", idTrabajador);
	console.log("estadoTrabajador", estadoTrabajador); 
	// Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarTrabajador",idTrabajador);
	datos.append("activarEstadoTrabajador",estadoTrabajador);
	$.ajax({
		url:"ajax/trabajador.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
			console.log(respuesta);
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location="trabajador";}
				});}
	});

	// Cambiamos el estado del botón físicamente
	if(estadoTrabajador=='Inactivo'){
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Inactivo");
		$(this).attr("estadoTrabajador","Activo");}
	else{
		$(this).addClass("btn-success");
		$(this).removeClass("btn-danger");
		$(this).html("Activo");
		$(this).attr("estadoTrabajador","Inactivo");}
});
//Reporte de Trabajador
$(".box").on("click", ".btnReporteTra", function () {
    window.location = "vistas/reportes_excel/rpt_trabajador.php";
  
})