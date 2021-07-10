/* 
* TABLA MAESTRA CABECERAS - PRODUCCION
*/
$('.TablaProdCabecera').DataTable({
    "ajax": "ajax/materiaprima/tabla-prodcabecera.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 20,
    "bLengthChange": false,	
    "language": {
			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Del _START_ al _END_ de _TOTAL_",
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
			"sNext":     ">>>",
			"sPrevious": "<<<"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
    }    
});

/* 
* ACTIVAR MAESTRA
*/  
if (localStorage.getItem("docPro") != null) {

	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
	// console.log("lleno");
	
}else{

	cargarTablaProduccionDetalle(null, null);
	// console.log("vacio");

}

$(".TablaProdCabecera tbody").on("click", "button.ActivarDetalle", function () {

	$(".TablaProdDetalle").DataTable().destroy();

	var docPro = $(this).attr("documento");
    var tipPro = $(this).attr("tipo");
	//console.log("codigo", docPro);

	localStorage.setItem("docPro", docPro);
    localStorage.setItem("tipPro", tipPro);
	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
	
})

function cargarTablaProduccionDetalle(docPro, tipPro){

    $('.TablaProdDetalle').DataTable({
        "ajax": "ajax/materiaprima/tabla-proddetalle.ajax.php?perfil="+$("#perfilOculto").val()+ "&docPro=" + docPro + "&tipPro=" + tipPro,
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

$(".TablaProdCabecera tbody").on("click", "button.btnEditarProd", function() {

    var docPro = $(this).attr("documento");
    var tipPro = $(this).attr("tipo");
	console.log("docPro", docPro, "tipPro", tipPro);

	localStorage.setItem("docPro", docPro);
    localStorage.setItem("tipPro", tipPro);
	cargarTablaProduccionDetalle(localStorage.getItem("docPro"),localStorage.getItem("tipPro"));
  
    window.location = "index.php?ruta=editar-cuadros-prod&docPro=" + docPro+ "&tipPro="+ tipPro;
  });

$(".TablaProdDetalle tbody").on("click", "button.btnEditarMP", function() {

    var documento = $(this).attr("documento");
    var tipo = $(this).attr("tipo");
    var codpro = $(this).attr("codpro");
    var despro = $(this).attr("despro");
    var canpro = $(this).attr("canpro");
    var color = $(this).attr("color");
    var talla = $(this).attr("talla");
    var codfab = $(this).attr("codfab");
    var unidad = $(this).attr("unidad");
    
    $("#editarTipo").val(tipo);
    $("#editarDocumento").val(documento);
    $("#editarCodigo").val(codpro);
    $("#editarDescripcion").val(despro);
    $("#editarColor").val(color);
    $("#editarTalla").val(talla);
    $("#editarCodFab").val(codfab);
    $("#editarUnidad").val(unidad);
    $("#editarCantidadMP").val(canpro);
    $("#editarCantidadAntigua").val(canpro);
    
})


$('#formularioEditarDetalleMP').submit(function(e){                         
    e.preventDefault(); 
	//datos de materia prima
	var tipo = $("#editarTipo").val();
	var codigo = $("#editarCodigo").val();
	var documento = $("#editarDocumento").val();
    var cantidad = $("#editarCantidadMP").val();
    var cantidadAnt = $("#editarCantidadAntigua").val();

	var datos = new Array();
	
	
	datos.push({
		'tipo':tipo,
		'codigo':codigo,
		'documento':documento,
		'cantidad':cantidad,
        'cantidadAnt':cantidadAnt
	});
    // console.log(datos);
	var materiaprima = {"datosdetalleMP" : datos}
	
	var jsonDetalleMP= {"jsonDetalleMP":JSON.stringify(materiaprima)};
	
	$.ajax({
		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: jsonDetalleMP,
		cache: false,
		success:function(respuesta){
			// console.log(respuesta);
			if(respuesta== "ok"){
				$(".TablaProdDetalle").DataTable().ajax.reload(null,false);
				$("#modalEditarMP").modal('hide');
				Command:toastr["success"]("Se edito el detalle MP exitosamente!");
			}
			
		}

	})

});


$(".TablaProdDetalle tbody").on("click", "button.btnEliminarMP", function() {

    var documento = $(this).attr("documento");
    var tipo = $(this).attr("tipo");
    var codigo = $(this).attr("codigo");

    var datos = new FormData();
    datos.append("eliminarDoc", documento);
    datos.append("eliminarTipo",tipo);
    datos.append("eliminarCod",codigo);

    swal({
        title: '¿Está seguro de borrar el Item ?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Item!'
    }).then(function (result) {

        if (result.value) {
            
            $.ajax({
                url:"ajax/materiaprima.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){
                    // console.log(respuesta);
                    if(respuesta== "ok"){

                        //reiniciamos por ajax la tabla cabecera
                        $(".TablaProdCabecera").DataTable().ajax.reload(null,false);

                        //reiniciamos por ajax la tabla detalle
                        $(".TablaProdDetalle").DataTable().ajax.reload(null,false);

                        //enviamos la alerta por toastr
                        Command:toastr["success"]("Se elimino el item exitosamente!");
                    }
                    
                }
        
            })

        }

    })
})

$(".TablaProdCabecera tbody").on("click", "button.btnAgregarProd", function() {

    var documento = $(this).attr("documento");
    var tipo = $(this).attr("tipo");
    
    $("#nuevoTipo").val(tipo);
    $("#nuevoDocumento").val(documento);

    var datos = new FormData();
	datos.append("selectTipo", tipo);
    datos.append("selectDocumento", documento);


	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            var texto="";
            
            if(tipo == 'PCOP'){
                texto="copa";
                $("#nuevaMateriaMP").find('option').remove();
                $("#nuevaMateriaMP").append('<option value="">Seleccionar '+texto+' </option>');
                for (let i = 0; i < respuesta.length; i++) {
                    
                    $("#nuevaMateriaMP").append("<option value='"+respuesta[i]["codpro"]+"' cuadro='"+respuesta[i]["cuadro"]+"'>"+respuesta[i]["codpro"]+" - "+respuesta[i]["despro"]+ " - "+respuesta[i]["color"]+" - T"+respuesta[i]["talla"]+"</option>");
                    
                }
                $("#nuevaMateriaMP").selectpicker("refresh");
            }else{
                texto="cuadro";
                $("#nuevaMateriaMP").find('option').remove();
                $("#nuevaMateriaMP").append('<option value="">Seleccionar '+texto+' </option>');
                for (let i = 0; i < respuesta.length; i++) {
                    
                    $("#nuevaMateriaMP").append("<option value='"+respuesta[i]["codpro"]+"' cuadro='"+respuesta[i]["cuadro"]+"'>"+respuesta[i]["codpro"]+" - "+respuesta[i]["despro"]+ " - "+respuesta[i]["color"]+"</option>");
                    
                }
                $("#nuevaMateriaMP").selectpicker("refresh");
            }

            

        }
    });
    
})

$("#nuevaMateriaMP").change(function(){
    var cuadro = $('option:selected', this).attr("cuadro");
    $("#cuadroMP").val(cuadro);

});

$('#formularioNuevoProdMP').submit(function(e){                         
    e.preventDefault(); 
	//datos de materia prima
	var tipo = $("#nuevoTipo").val();
	var codigo = $("#nuevaMateriaMP").val();
	var documento = $("#nuevoDocumento").val();
    var cantidad = $("#nuevaCantidadMP").val();
    var cuadro = $("#cuadroMP").val();

	var datos = new Array();
	
	
	datos.push({
		'tipo':tipo,
		'codigo':codigo,
		'documento':documento,
		'cantidad':cantidad,
        'cuadro':cuadro
	});
    // console.log(datos);
	var materiaprima = {"datosProdMP" : datos}
	
	var jsonProdMP= {"jsonProdMP":JSON.stringify(materiaprima)};
	
	$.ajax({
		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: jsonProdMP,
		cache: false,
		success:function(respuesta){
			// console.log(respuesta);
			if(respuesta== "ok"){
                //reiniciamos por ajax la tabla cabecera
                $(".TablaProdCabecera").DataTable().ajax.reload(null,false);
				$(".TablaProdDetalle").DataTable().ajax.reload(null,false);

				$("#modalAgregarProd").modal('hide');
				Command:toastr["success"]("Se agrego el detalle MP exitosamente!");
			}
			
		}

	})

});

$(".tablaAlmacen01").on("click","button.btnEditarCopaCuadro",function(){
    var codigo = $(this).attr("codigo");
    var descripcion = $(this).attr("descripcion");
    var talla = $(this).attr("talla");
    var color = $(this).attr("color");
    var cuadro = $(this).attr("cuadro");
    var unidad =$(this).attr("unidad");

    $("#editarUnidad").val(unidad);
    $("#editarDescripcion").val(descripcion);
    $("#editarTalla").val(talla);
    $("#editarColor").val(color);
    
    $("#editarCodigo").val(codigo);

    var datos = new FormData();
	datos.append("tipoAlmacen01", 'CUA');


	
	$.ajax({

		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

            $("#editarCuadroMP").find('option').remove();
			$("#editarCuadroMP").append('<option value="">Seleccionar cuadro </option>');
            for (let i = 0; i < respuesta.length; i++) {
                
                $("#editarCuadroMP").append("<option value='"+respuesta[i]["codpro"]+"'>"+respuesta[i]["codpro"]+" - "+respuesta[i]["despro"]+ " - "+respuesta[i]["color"]+"</option>");
                
            }
            $("#editarCuadroMP").val(cuadro);
            $("#editarCuadroMP").selectpicker("refresh");

        }
    });
})


$('#formularioEditarCopaCuadro').submit(function(e){                         
    e.preventDefault(); 
    //datos de materia prima
	var codigo = $("#editarCodigo").val();
    var cuadro = $("#editarCuadroMP").val();

	var datos = new Array();
	
	
	datos.push({
		'codigo':codigo,
        'cuadro':cuadro
	});
    // console.log(datos);
	var materiaprima = {"datosEditarCopa" : datos}
	
	var jsonEditarCopa= {"jsonEditarCopa":JSON.stringify(materiaprima)};
	
	$.ajax({
		url:"ajax/materiaprima.ajax.php",
		method: "POST",
		data: jsonEditarCopa,
		cache: false,
		success:function(respuesta){
			// console.log(respuesta);
			if(respuesta== "ok"){
                //reiniciamos por ajax la tabla cabecera
                $(".tablaAlmacen01").DataTable().ajax.reload(null,false);

				$("#modalEditarCopaCuadro").modal('hide');
				Command:toastr["success"]("Se edito la copa exitosamente!");
			}
			
		}

	})

});