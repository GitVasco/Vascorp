<div class="content-wrapper">
    <h2>Ejemplo: Leer Archivos Excel con PHP</h2>   
      <div class="content-header">
        <h3 class="panel-title">Resultados de archivo de Excel.</h3>
      </div>
      <section class="content">
        <div class="box">
          <div class="box-body">
            
<?php
include "/Excel/reader.php";
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read($_FILES["archivoxlsmovimiento"]["name"]);
$conexion = mysql_connect("192.168.1.3", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
mysql_select_db("new_vasco", $conexion);

echo("<table class='table table-bordered'>");
for ($i = 2; $i <= 2; $i++) {
	echo("<tr>");
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
    // if(strlen($data->sheets[0]['cells'][$i][1])==7){
      echo("<td>".$data->sheets[0]['cells'][$i][$j]."</td>");
      
    // }else {
    //   $sqlDetalle = mysql_query("UPDATE articulojf SET stock=".$data->sheets[0]['cells'][$i][11].
    //   " WHERE articulo="."B".$data->sheets[0]['cells'][$i][1]) or die(mysql_error());
      
    // }
	}
	echo("</tr>");

}
echo("</table>");

// echo'<script>

// 					swal({
// 						  type: "success",
// 						  title: "Los articulo han sido actualizados correctamente",
// 						  showConfirmButton: true,
// 						  confirmButtonText: "Cerrar"
// 						  }).then(function(result){
// 									if (result.value) {

// 									window.location = "cargas-automaticas";

// 									}
// 								})

// 					</script>';
?>

  </div>  
 </section>   
</div>