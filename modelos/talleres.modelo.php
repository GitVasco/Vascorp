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

            $stmt = Conexion::conectar()->prepare("SELECT * from entallerjf WHERE codigo=$valor");

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
                                                            CONCAT(et.cod_operacion, '-', o.nombre) AS operacion,
                                                            CONCAT(a.modelo, '-', a.color, '-', a.talla) AS articulo,
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
                                                        CONCAT(et.cod_operacion, '-', o.nombre) AS operacion,
                                                        CONCAT(a.modelo, '-', a.color, '-', a.talla) AS articulo,
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

}