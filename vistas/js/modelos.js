/* 
* tabla paraa cargar la lista de modelos
*/
$('.tablaModelos').DataTable( {
    "ajax": "ajax/tabla-modelos.ajax.php?perfil="+$("#perfilOculto").val(),
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

// ACTIVANDO-DESACTIVANDO ARTICULO
$(document).on("click",".btnActivar",function(){
	// Capturamos el id del usuario y el estado
	var idModelo=$(this).attr("idModelo");
	var estadoModelo=$(this).attr("estadoModelo");
/* 	console.log("idArticulo", idArticulo);
	console.log("estadoArticulo", estadoArticulo); */
	// Realizamos la activación-desactivación por una petición AJAX
	var datos=new FormData();
	datos.append("activarId",idModelo);
	datos.append("activarEstado",estadoModelo);
	$.ajax({
		url:"ajax/modelos.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		success:function(respuesta){
				swal({
					type: "success",
					title: "¡Ok!",
					text: "¡La información fue actualizada con éxito!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					closeOnConfirm: false
				}).then((result)=>{
					if(result.value){
						window.location="modelosjf";}
				});}
	});
	// Cambiamos el estado del botón físicamente
	if(estadoModelo=='Descontinuado'){
		$(this).removeClass("btn-success");
		$(this).addClass("btn-danger");
		$(this).html("Inactivo");
		$(this).attr("estadoModelo","Activo");}
	else{
		$(this).addClass("btn-success");
		$(this).removeClass("btn-danger");
		$(this).html("Activo");
		$(this).attr("estadoModelo","Descontinuado");}
});


/*=============================================
EDITAR ARTICULO
=============================================*/

$(".tablaModelos tbody").on("click", "button.btnEditarModelo", function(){

	var modelo = $(this).attr("modelo");

	var datos = new FormData();
	datos.append("modelo", modelo);
	
	$.ajax({

		url:"ajax/modelos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			
            $("#editarMarca").val(respuesta["id_marca"]);
			$("#editarMarca").selectpicker('refresh');
			

		

			$("#editarModelo").val(respuesta["modelo"]);

			$("#editarDescripcion").val(respuesta["nombre"]);

			$("#editarTipo").val(respuesta["tipo"]);
			$("#editarTipo").html(respuesta["tipo"]);

			if(respuesta["imagen"] != ""){

				$("#imagenActual").val(respuesta["imagen"]);

				$(".previsualizar").attr("src",  respuesta["imagen"]);

			}

  
   
		}
  
	})	



})

/*=============================================
ELIMINAR MODELO A DESCONTINUADO
=============================================*/

$(".tablaModelos tbody").on("click", "button.btnEliminarModelo", function(){

	var idModelo = $(this).attr("idModelo");
	var modelo = $(this).attr("modelo");
	var imagen = $(this).attr("imagen");

	/* console.log("idArticulo", idArticulo); */

	swal({

		title: '¿Está seguro de eliminar el modelo?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar modelo!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=modelosjf&idModelo="+idModelo+"&imagen="+imagen+"&modelo="+modelo;

        }


	})



})

/*=============================================
VER MODELO
=============================================*/

$(".tablaModelos tbody").on("click", "button.btnVerModelo", function(){

	var modelo2 = $(this).attr("modelo");
	
	var datos = new FormData();
	datos.append("modelo2", modelo2);

	
	
	$.ajax({

		url:"ajax/modelos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$(".detalleMO").remove();

			for(var id of respuesta){

				$('.tablaDetalleModelo').append(

					'<tr class="detalleMO">' +
						'<td class="text-center">' + id.modelo + ' </td>' +
						'<td class="text-center">' + id.nombre + ' </td>' +
						'<td class="text-center">' + id.color + ' </td>' +
						'<td class="text-center">' + id.talla + ' </td>' +
					'</tr>'


				)

			}
			
			

		}
	})	
	//VER MODELO
	var modelo = $(this).attr("modelo");
	var datos2 = new FormData();
	datos2.append("modelo", modelo);
	$.ajax({

		url:"ajax/modelos.ajax.php",
		method: "POST",
		data: datos2,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			$(".titulo").html(respuesta["nombre"]);
			if(respuesta["imagen"] != ""){

				$("#imagenActual").val(respuesta["imagen"]);

				$(".previsualizar").attr("src",  respuesta["imagen"]);

			}else{
				$(".previsualizar").attr("src",  "vistas/img/modelos/default/anonymous.png");
			}
		}
	});
})

/* 
* BOTON REPORTE DE OPERACIONES X MODELO
*/
$(".tablaModelos").on("click", ".btnReporteOM", function () {

    var codigo = $(this).attr("codigo");

    window.location = "vistas/reportes_excel/rpt_operacionesmodelo.php?codigo=" + codigo;
  
})