<?php
require_once "conexion.php";

class ModeloTalleres{

    /*
	* Método para mostrar talleres en general
	*/
	static public function mdlMostrarTalleresG($valor){

        if($valor == null){

            $stmt = Conexion::conectar()->prepare("SELECT 
                                                            et.id,
                                                            et.sector,
                                                            CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                            et.articulo,
                                                            a.modelo,
                                                            a.nombre,
                                                            a.color,
                                                            a.talla,
                                                            et.cod_operacion,
                                                            o.nombre AS nom_operacion,
                                                            et.trabajador AS cod_trabajador,
                                                            CONCAT(
                                                            t.nom_tra,
                                                            ' ',
                                                            t.ape_pat_tra,
                                                            ' ',
                                                            t.ape_mat_tra
                                                            ) AS trabajador,
                                                            et.cantidad,
                                                            DATE(et.fecha) AS fecha,
                                                            et.estado,
                                                            et.codigo 
                                                        FROM
                                                            entallerjf et 
                                                            LEFT JOIN trabajadorjf t 
                                                            ON et.trabajador = t.cod_tra 
                                                            LEFT JOIN articulojf a 
                                                            ON et.articulo = a.articulo 
                                                            LEFT JOIN operacionesjf o 
                                                            ON et.cod_operacion = o.codigo 
                                                            LEFT JOIN sectorjf s 
                                                            ON et.sector = s.cod_sector");

			$stmt -> execute();

			return $stmt -> fetchAll();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT t.*,
            a.marca,
            a.modelo,
            a.nombre,
            a.color,
            a.talla
        FROM
          entallerjf  t
          LEFT JOIN articulojf a
          ON a.articulo = t.articulo
          WHERE codigo=$valor");

			$stmt->execute();

			return $stmt->fetch();

        }

		$stmt -> close();

		$stmt = null;


    }

    /*
	* Método para mostrar talleres en proceso
	*/
	static public function mdlMostrarTalleresP(){

            $stmt = Conexion::conectar()->prepare("SELECT 
            et.codigo,
            CONCAT(et.sector, '-', s.nom_sector) AS sector,
            CONCAT(
              t.nom_tra,
              ' ',
              t.ape_pat_tra,
              ' ',
              t.ape_mat_tra
            ) AS trabajador,
            CONCAT(et.cod_operacion, ' - ', o.nombre) AS operacion,
            CONCAT(a.modelo, ' - ', a.color, ' -T', a.talla) AS articulo,
            et.cantidad,
            et.estado,
            DATE_FORMAT(et.fecha_proceso, '%H:%i') AS hora_proceso 
          FROM
            entallerjf et 
            LEFT JOIN trabajadorjf t 
              ON et.trabajador = t.cod_tra 
            LEFT JOIN articulojf a 
              ON et.articulo = a.articulo 
            LEFT JOIN operacionesjf o 
              ON et.cod_operacion = o.codigo 
            LEFT JOIN sectorjf s 
              ON et.sector = s.cod_sector 
          WHERE et.estado = 2 
          ORDER BY et.fecha_proceso DESC 
          LIMIT 5");

			$stmt -> execute();

			return $stmt -> fetchAll();

            $stmt -> close();

            $stmt = null;


    }
    
    /*
	* Método para mostrar talleres en terminado
	*/
	static public function mdlMostrarTalleresT(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                        et.codigo,
                                                        CONCAT(et.sector, '-', s.nom_sector) AS sector,
                                                        CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                        ) AS trabajador,
                                                        CONCAT(et.cod_operacion, ' - ', o.nombre) AS operacion,
                                                        CONCAT(a.modelo, ' - ', a.color, ' -T', a.talla) AS articulo,
                                                        et.cantidad,
                                                        et.estado,
                                                        DATE_FORMAT(et.fecha_terminado, '%H:%i') AS hora_termino 
                                                    FROM
                                                        entallerjf et 
                                                        LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                        LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                        LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                        LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.estado = 3 
                                                    ORDER BY et.fecha_terminado DESC 
                                                    LIMIT 5");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

        $stmt = null;


    }

        /*
	* Método para mostrar talleres en terminado
	*/
	static public function mdlMostrarTalleresTerminado(){

    $stmt = Conexion::conectar()->prepare("SELECT 
                                                      et.id,
                                                      et.sector,
                                                      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
                                                      et.articulo,
                                                      a.modelo,
                                                      a.nombre,
                                                      a.color,
                                                      a.talla,
                                                      et.cod_operacion,
                                                      o.nombre AS nom_operacion,
                                                      et.trabajador AS cod_trabajador,
                                                      CONCAT(
                                                        t.nom_tra,
                                                        ' ',
                                                        t.ape_pat_tra,
                                                        ' ',
                                                        t.ape_mat_tra
                                                      ) AS trabajador,
                                                      et.cantidad,
                                                      DATE(et.fecha) AS fecha,
                                                      et.estado,
                                                      et.codigo 
                                                    FROM
                                                      entallerjf et 
                                                      LEFT JOIN trabajadorjf t 
                                                        ON et.trabajador = t.cod_tra 
                                                      LEFT JOIN articulojf a 
                                                        ON et.articulo = a.articulo 
                                                      LEFT JOIN operacionesjf o 
                                                        ON et.cod_operacion = o.codigo 
                                                      LEFT JOIN sectorjf s 
                                                        ON et.sector = s.cod_sector 
                                                    WHERE et.estado = '3'");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;


}
    
    /* 
    *ACTUALIZAR EN PROCESO
    */
	static public function mdlProceso($fecha, $codigo){

		$sql="UPDATE entallerjf SET fecha_proceso='$fecha', estado='2' WHERE codigo=$codigo";

		$stmt=Conexion::conectar()->prepare($sql);

        if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;

    }   
    
    /* 
    *ACTUALIZAR TERMINADO
    */
	static public function mdlTerminado($fecha, $codigo){

		$sql="UPDATE entallerjf SET fecha_terminado='$fecha', estado='3' WHERE codigo=$codigo";

		$stmt=Conexion::conectar()->prepare($sql);

        if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;

  }
  
    /* 
    *ASIGNAR TRABAJADOR
    */
    static public function mdlAsignarTrabajador($codigo, $cod_tra){

      $sql="UPDATE 
                entallerjf 
              SET
                trabajador = $cod_tra 
              WHERE codigo = $codigo";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
          if($stmt->execute()){
  
        return "ok";
      
      }else{
  
        return "error";
      
      }
  
      $stmt=null;
  
    }  

  
	/*=============================================
	ELIMINAR TALLER
	=============================================*/

	static public function mdlEliminarTaller($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

  }    
  
  
	/*=============================================
	CREAR TALLER
	=============================================*/

	static public function mdlIngresarTaller($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO entallerjf (
      id_cabecera,
      articulo,
      cod_operacion,
      cantidad,
      usuario,
      total_precio,
      total_tiempo,
      codigo
  ) 
  (SELECT 
      :codigo,
      a.articulo,
      od.cod_operacion,
      :cantidad,
      :usuario,
      ((od.precio_doc) / 12) * :cantidad,
      ((od.tiempo_stand) / 60) * :cantidad,
      :editarBarra 
  FROM
      articulojf a 
      LEFT JOIN operaciones_detallejf od 
      ON a.modelo = od.modelo 
  WHERE articulo = :articulo AND cod_operacion= :operacion)");

    $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
    $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
    $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
    $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":editarBarra", $datos["editarBarra"], PDO::PARAM_STR);
    $stmt->bindParam(":operacion", $datos["operacion"], PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


	}   

  /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasTalleres($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      CONCAT(
      t.nom_tra,
      ' ',
      t.ape_pat_tra,
      ' ',
      t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo 
  FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
      ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
      ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
      ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
      ON et.sector = s.cod_sector ORDER BY et.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT et.id,
      et.sector,
      CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
      et.articulo,
      a.modelo,
      a.nombre,
      a.color,
      a.talla,
      et.cod_operacion,
      o.nombre AS nom_operacion,
      et.trabajador AS cod_trabajador,
      CONCAT(
      t.nom_tra,
      ' ',
      t.ape_pat_tra,
      ' ',
      t.ape_mat_tra
      ) AS trabajador,
      et.cantidad,
      DATE(et.fecha) AS fecha,
      et.estado,
      et.codigo 
  FROM
      entallerjf et 
      LEFT JOIN trabajadorjf t 
      ON et.trabajador = t.cod_tra 
      LEFT JOIN articulojf a 
      ON et.articulo = a.articulo 
      LEFT JOIN operacionesjf o 
      ON et.cod_operacion = o.codigo 
      LEFT JOIN sectorjf s 
      ON et.sector = s.cod_sector  WHERE et.fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo 
    FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector WHERE et.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT et.id,
        et.sector,
        CONCAT(et.sector, '-', s.nom_sector) AS nom_sector,
        et.articulo,
        a.modelo,
        a.nombre,
        a.color,
        a.talla,
        et.cod_operacion,
        o.nombre AS nom_operacion,
        et.trabajador AS cod_trabajador,
        CONCAT(
        t.nom_tra,
        ' ',
        t.ape_pat_tra,
        ' ',
        t.ape_mat_tra
        ) AS trabajador,
        et.cantidad,
        DATE(et.fecha) AS fecha,
        et.estado,
        et.codigo 
    FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
        ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
        ON et.articulo = a.articulo 
        LEFT JOIN operacionesjf o 
        ON et.cod_operacion = o.codigo 
        LEFT JOIN sectorjf s 
        ON et.sector = s.cod_sector WHERE et.fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}	
    
}