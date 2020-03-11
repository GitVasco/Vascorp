$('.tablaOperaciones').DataTable( {
    "ajax": "ajax/tabla-operaciones.ajax.php",
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

// EDITAR OPERACIÓN
$(".tablaOperaciones tbody").on("click","button.btnEditarOperacion",function(){
	var idOperacion =$(this).attr("idOperacion");
	var datos= new FormData();
	datos.append("idOperacion",idOperacion);
	$.ajax({
		url:"ajax/operaciones.ajax.php",
		method:"POST",
		data:datos,
		cache: false,
		contentType:false,
		processData:false,
		dataType: "json",
		success:function(respuesta){
			$("#editarCodigo").val(respuesta["codigo"]);
			$("#editarOperacion").val(respuesta["nombre"]);
			$("#idOperacion").val(respuesta["id"]);
		}
	});
	
});

// ELIMINAR OPERACIÓN
$(".tablaOperaciones tbody").on("click","button.btnEliminarOperacion",function(){
	var idOperacion =$(this).attr("idOperacion");
	//console.log("idOperacion", idOperacion);
	swal({
		title: "¿Está seguro de borrar la operación?",
		text: "¡Si no lo está se puede cancelar la acción!",
		type:"warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "Si, borrar operación!" 
	}).then((result)=>{
		if(result.value){
			window.location = "index.php?ruta=operaciones&idOperacion="+idOperacion;
		}
	})
	
	
});
