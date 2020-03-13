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
/*=============================================
CAPTURANDO LA ID PARA ASIGNAR CÓDIGO
=============================================*/
// $("#tipoDocumento").change(function(){

// 	var idTrabajador = $(this).val();

// 	var datos = new FormData();
// 	  datos.append("idTrabajador", idTrabajador);

// 	  $.ajax({

// 	  url:"ajax/trabajador.ajax.php",
// 	  method: "POST",
// 	  data: datos,
// 	  cache: false,
// 	  contentType: false,
// 	  processData: false,
// 	  dataType:"json",
// 	  success:function(respuesta){

// 		  if(!respuesta){

// 			  var codigoTrabajador = idTrabajador+"01";
// 			  $("#codigoTrabajador").val(codigoTrabajador);

// 		  }else{

// 			  var codigoTrabajador = Number(respuesta["cod_doc"]) + 1;
// 			  $("#codigoTrabajador").val(codigoTrabajador);

// 		  }
			   
// 	  }

// 	  })

// })
/*=============================================
EDITAR TRABAJADOR
=============================================*/

// $(".tablaTrabajador tbody").on("click", "button.btnEditarTrabajador", function(){

// 	var idTrabajador = $(this).attr("idTrabajador");


// 	console.log("idTrabajador", idTrabajador);

// 	var datos = new FormData();
//     datos.append("idTrabajador", idTrabajador);

//      $.ajax({

//       url:"ajax/trabajador.ajax.php",
//       method: "POST",
//       data: datos,
//       cache: false,
//       contentType: false,
//       processData: false,
//       dataType:"json",
//       success:function(respuesta){
// 			console.log("respuesta", respuesta);
// 	  }

// 	})
         // console.log(respuesta);
		  
		// var datosTrabajador = new FormData();
		// datosTrabajador.append("idTrabajador",respuesta["id_Trabajador"]);

		//  $.ajax({

		// 	url:"ajax/trabajador.ajax.php",
		// 	method: "POST",
		// 	data: datosTrabajador,
		// 	cache: false,
		// 	contentType: false,
		// 	processData: false,
		// 	dataType:"json",
		// 	success:function(respuesta){
				
		// 		console.log(respuesta);
				



		// 	}

		// })

	// 		$("#editarCodigoTrabajador").val(respuesta["cod_tra"]);

	// 		$("#editarNroDocumento").val(respuesta["nro_doc_tra"]);

	// 		$("#editarNombreTrabajador").val(respuesta["nom_tra"]);

	// 		$("#editarApellidoPaterno").val(respuesta["ape_pat_tra"]);

	// 		$("#editarApellidoMaterno").val(respuesta["ape_mat_tra"]);

	// 		$("#editarSueldoMes").val(respuesta["sueldoMes"]);

			
     
    //   }

  //})

//})


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
		confirmButtonText: "Si, borrar operación!" 
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
	//console.log(idTrabajador);
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

	console.log("respuesta", respuesta);

	// 		$("#editarTipoTrabajador").val(respuesta["nom_tip_trabajador"]);
	// 		$("#editarSectorTrabajador").val(respuesta["detalle"]);
	// 		$("#idTipoTrabajador").val(respuesta["cod_tip_tra"]);
		}
	});
	
});
