/*=============================================
EDITAR SECTOR
=============================================*/
$(".tablas").on("click", ".btnEditarSector", function () {

    var idSector = $(this).attr("idSector");
    //console.log("idSector", idSector);

    var datos = new FormData();
    datos.append("idSector", idSector);

    $.ajax({

        url: "ajax/sectores.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            console.log("respuesta", respuesta);

            $("#idSector").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["cod_sector"]);
            $("#editarSector").val(respuesta["nom_sector"]);

        }

    })

})


/*=============================================
ELIMINAR COLOR
=============================================*/
$(".tablas").on("click", ".btnEliminarSector", function(){

	var idSector = $(this).attr("idSector");
	
	swal({
        title: '¿Está seguro de borrar el sector?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar sector!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=sectores&idSector="+idSector;
        }

  })

})
//Reporte de Sectores
$(".box").on("click", ".btnReporteSector", function () {
    window.location = "vistas/reportes_excel/rpt_sectores.php";
  
})
