<?php

require_once "conexion.php";

class ModeloProduccion
{

	/* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarQuincenas($valor){

		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            q.id,
                                                            q.ano,
                                                            m.mes,
                                                            q.mes AS nmes,
                                                            q.quincena AS nquincena,
                                                            CASE
                                                            WHEN q.quincena = '1' 
                                                            THEN '1ra Quincena' 
                                                            ELSE '2da Quincena' 
                                                            END AS quincena,
                                                            q.inicio,
                                                            q.fin,
                                                            u.nombre,
                                                            q.fecha_creacion 
                                                        FROM
                                                            quincenasjf q 
                                                            LEFT JOIN usuariosjf u 
                                                            ON q.usuario = u.id 
                                                            LEFT JOIN 
                                                            (SELECT DISTINCT 
                                                                codigo,
                                                                descripcion AS mes 
                                                            FROM
                                                                meses) AS m 
                                                            ON q.mes = m.codigo 
                                                        WHERE q.id = :valor");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
                                            q.id,
                                            q.ano,
                                            CASE
                                              WHEN q.mes = '1' 
                                              THEN 'Enero' 
                                              WHEN q.mes = '2' 
                                              THEN 'Febrero' 
                                              WHEN q.mes = '3' 
                                              THEN 'Marzo' 
                                              WHEN q.mes = '4' 
                                              THEN 'Abril' 
                                              WHEN q.mes = '5' 
                                              THEN 'Mayo' 
                                              WHEN q.mes = '6' 
                                              THEN 'Junio' 
                                              WHEN q.mes = '7' 
                                              THEN 'Julio' 
                                              WHEN q.mes = '8' 
                                              THEN 'Agosto' 
                                              WHEN q.mes = '9' 
                                              THEN 'Septiembre' 
                                              WHEN q.mes = '10' 
                                              THEN 'Octubre' 
                                              WHEN q.mes = '11' 
                                              THEN 'Noviembre' 
                                              ELSE 'Diciembre' 
                                            END AS mes,
                                            q.mes AS nmes,
                                            q.quincena AS nquincena,
                                            CASE
                                              WHEN q.quincena = '1' 
                                              THEN '1ra Quincena' 
                                              ELSE '2da Quincena' 
                                            END AS quincena,
                                            q.inicio,
                                            q.fin,
                                            u.nombre,
                                            q.fecha_creacion 
                                          FROM
                                            quincenasjf q 
                                            LEFT JOIN usuariosjf u 
                                              ON q.usuario = u.id");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
    }

	/*
	* CREAR QUINCENA
	*/
	static public function mdlCrearQuincenas($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO quincenasjf (
                                                ano,
                                                mes,
                                                quincena,
                                                inicio,
                                                fin,
                                                usuario
                                            ) 
                                            VALUES
                                                (
                                                :ano,
                                                :mes,
                                                :quincena,
                                                :inicio,
                                                :fin,
                                                :usuario
                                                )");

		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
		$stmt->bindParam(":quincena", $datos["quincena"], PDO::PARAM_STR);
		$stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
    }
    
	static public function mdlEditarQuincenas($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    quincenasjf 
                                                SET
                                                    ano = :ano,
                                                    mes = :mes,
                                                    quincena = :quincena,
                                                    inicio = :inicio,
                                                    fin = :fin,
                                                    usuario = :usuario 
                                                WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":ano", $datos["ano"], PDO::PARAM_STR);
        $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
        $stmt->bindParam(":quincena", $datos["quincena"], PDO::PARAM_STR);
        $stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }    

  /*
	* Método para la eficiencia por mes
	*/
	static public function mdlMostrarEficiencia($inicio, $fin, $nquincena, $id,$sector){
      if($sector != "null"){

        if($nquincena == "1"){
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '2' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d2,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '3' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d3,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '4' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d4,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '5' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d5,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '6' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d6,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '7' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d7,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '8' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d8,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '9' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d9,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '10' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d10,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '11' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d11,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
          LEFT JOIN 
            (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
            ON et.trabajador = asi.trabajador 
            AND DATE(fecha_terminado) = asi.fecha 
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio
          AND :fin
        AND t.sector = '".$sector."'
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);

          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else{
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '17' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d17,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '18' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d18,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '19' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d19,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '20' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d20,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '21' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d21,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '22' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d22,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '23' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d23,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '24' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d24,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '25' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d25,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '26' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d26,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
          LEFT JOIN 
            (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
            ON et.trabajador = asi.trabajador 
            AND DATE(fecha_terminado) = asi.fecha 
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
          AND :fin 
        AND t.sector = '".$sector."'
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
          $stmt->execute();
          
          return $stmt->fetchAll();
    
        }
      }else{

        if($nquincena == "1"){
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '2' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d2,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '3' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d3,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '4' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d4,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '5' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d5,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '6' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d6,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '7' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d7,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '8' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d8,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '9' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d9,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '10' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d10,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '11' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d11,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
          LEFT JOIN 
            (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
            ON et.trabajador = asi.trabajador 
            AND DATE(fecha_terminado) = asi.fecha 
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio
          AND :fin
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);

          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else{
    
          $sql="SELECT 
          et.trabajador,
          CONCAT(t.nom_tra,' ', t.ape_pat_tra) AS nom_tra,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '1' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d1,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '12' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d12,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '13' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d13,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '14' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d14,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '15' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d15,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '16' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d16,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '17' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d17,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '18' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d18,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '19' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d19,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '20' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d20,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '21' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d21,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '22' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d22,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '23' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d23,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '24' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d24,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '25' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d25,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '26' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d26,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '27' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d27,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '28' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d28,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '29' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d29,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '30' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d30,
          SUM(
            CASE
              WHEN DAY(fecha_terminado) = '31' 
              THEN et.total_tiempo / asi.minutos * 100 
              ELSE 0 
            END
          ) AS d31 
        FROM
          entallerjf et 
          LEFT JOIN 
            (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
            ON et.trabajador = asi.trabajador 
            AND DATE(fecha_terminado) = asi.fecha 
          LEFT JOIN trabajadorjf t 
            ON et.trabajador = t.cod_tra,
          (SELECT 
            inicio,
            fin 
          FROM
            quincenasjf q 
          WHERE q.id = :id) AS q 
        WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
          AND :fin 
        GROUP BY et.trabajador";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
          $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
          $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    
          $stmt->execute();
          
          return $stmt->fetchAll();
    
        }

      }
    
          $stmt=null;
    
      }
      
  /*
	* Método para los pagos por mes
	*/
	static public function mdlMostrarPagos($inicio, $fin, $nquincena, $id,$sector){
    if($sector != "null"){
      if($nquincena == "1"){

        $sql="SELECT 
              et.trabajador,
              CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '1' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d1,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '2' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d2,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '3' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d3,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '4' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d4,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '5' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d5,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '6' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d6,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '7' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d7,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '8' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d8,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '9' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d9,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '10' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d10,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '11' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d11,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '12' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d12,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '13' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d13,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '14' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d14,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '15' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d15,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '16' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d16,
              SUM(
              CASE
                WHEN DAY(fecha_terminado) = '27' 
                THEN et.total_precio 
                ELSE 0 
              END
              ) AS d27,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '28' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d28,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '29' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d29,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '30' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d30,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '31' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d31,
              SUM(et.total_precio) AS total,
              (t.sueldo_total/2) as sueldo_total
            FROM
              entallerjf et 
              LEFT JOIN 
                (SELECT DISTINCT 
                  et.trabajador,
                  DATE(a.fecha) AS fecha,
                  a.minutos 
                FROM
                  asistenciasjf a 
                  LEFT JOIN entallerjf et 
                    ON a.id_trabajador = et.trabajador 
                    AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                WHERE et.trabajador IS NOT NULL 
                AND (a.fecha BETWEEN :inicio
                  AND :fin
                )) AS asi 
                ON et.trabajador = asi.trabajador 
                AND DATE(fecha_terminado) = asi.fecha 
              LEFT JOIN trabajadorjf t 
                ON et.trabajador = t.cod_tra,
              (SELECT 
                inicio,
                fin 
              FROM
                quincenasjf q 
              WHERE q.id = :id) AS q 
            WHERE DATE(et.fecha_terminado) BETWEEN :inicio
              AND :fin
            AND t.sector = '".$sector."'
            GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        
        $stmt->execute();
  
        return $stmt->fetchAll();
  
      }else{
  
        $sql="SELECT 
                et.trabajador,
                CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '1' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d1,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '12' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d12,                
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '13' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d13,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '14' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d14,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '15' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d15,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '16' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d16,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '17' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d17,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '18' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d18,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '19' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d19,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '20' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d20,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '21' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d21,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '22' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d22,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '23' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d23,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '24' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d24,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '25' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d25,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '26' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d26,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '27' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d27,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '28' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d28,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '29' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d29,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '30' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d30,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '31' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d31,
                SUM(et.total_precio) AS total,
                (t.sueldo_total/2) as sueldo_total
              FROM
                entallerjf et 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra,
                (SELECT 
                  inicio,
                  fin 
                FROM
                  quincenasjf q 
                WHERE q.id = :id) AS q 
              WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
                AND :fin 
              AND t.sector = '".$sector."'
              GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  
        $stmt->execute();
        
        return $stmt->fetchAll();
  
      }
    }else{
      if($nquincena == "1"){

        $sql="SELECT 
              et.trabajador,
              CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '1' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d1,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '2' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d2,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '3' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d3,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '4' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d4,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '5' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d5,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '6' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d6,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '7' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d7,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '8' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d8,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '9' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d9,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '10' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d10,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '11' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d11,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '12' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d12,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '13' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d13,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '14' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d14,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '15' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d15,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '16' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d16,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '27' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d27,              
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '28' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d28,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '29' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d29,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '30' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d30,
              SUM(
                CASE
                  WHEN DAY(fecha_terminado) = '31' 
                  THEN et.total_precio 
                  ELSE 0 
                END
              ) AS d31,
              SUM(et.total_precio) AS total,
              (t.sueldo_total/2) as sueldo_total
            FROM
              entallerjf et 
              LEFT JOIN 
                (SELECT DISTINCT 
                  et.trabajador,
                  DATE(a.fecha) AS fecha,
                  a.minutos 
                FROM
                  asistenciasjf a 
                  LEFT JOIN entallerjf et 
                    ON a.id_trabajador = et.trabajador 
                    AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                WHERE et.trabajador IS NOT NULL
                AND (a.fecha BETWEEN :inicio
                  AND :fin
                )) AS asi 
                ON et.trabajador = asi.trabajador 
                AND DATE(fecha_terminado) = asi.fecha 
              LEFT JOIN trabajadorjf t 
                ON et.trabajador = t.cod_tra,
              (SELECT 
                inicio,
                fin 
              FROM
                quincenasjf q 
              WHERE q.id = :id) AS q 
            WHERE DATE(et.fecha_terminado) BETWEEN :inicio
              AND :fin
            GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        
        $stmt->execute();
  
        return $stmt->fetchAll();
  
      }else{
  
        $sql="SELECT 
                et.trabajador,
                CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nom_tra,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '1' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d1,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '12' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d12,                
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '13' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d13,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '14' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d14,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '15' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d15,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '16' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d16,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '17' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d17,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '18' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d18,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '19' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d19,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '20' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d20,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '21' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d21,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '22' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d22,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '23' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d23,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '24' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d24,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '25' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d25,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '26' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d26,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '27' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d27,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '28' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d28,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '29' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d29,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '30' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d30,
                SUM(
                  CASE
                    WHEN DAY(fecha_terminado) = '31' 
                    THEN et.total_precio 
                    ELSE 0 
                  END
                ) AS d31,
                SUM(et.total_precio) AS total,
                (t.sueldo_total/2) as sueldo_total
              FROM
                entallerjf et 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    et.trabajador,
                    DATE(a.fecha) AS fecha,
                    a.minutos 
                  FROM
                    asistenciasjf a 
                    LEFT JOIN entallerjf et 
                      ON a.id_trabajador = et.trabajador 
                      AND DATE(a.fecha) = DATE(et.fecha_terminado) 
                  WHERE et.trabajador IS NOT NULL
                  AND (a.fecha BETWEEN :inicio
                  AND :fin
                  )) AS asi 
                  ON et.trabajador = asi.trabajador 
                  AND DATE(fecha_terminado) = asi.fecha 
                LEFT JOIN trabajadorjf t 
                  ON et.trabajador = t.cod_tra,
                (SELECT 
                  inicio,
                  fin 
                FROM
                  quincenasjf q 
                WHERE q.id = :id) AS q 
              WHERE DATE(et.fecha_terminado) BETWEEN :inicio 
                AND :fin 
              GROUP BY et.trabajador";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
        $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
  
        $stmt->execute();
        
        return $stmt->fetchAll();
  
      }

    }
    

      $stmt=null;

  }      

	/* 
	* BORRAR QUINCENA
	*/
	static public function mdlEliminarQuincena($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM quincenasjf WHERE id = :id ");

		$stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if ($stmt->execute()) {

      return "ok";
      
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}  
    
  /* 
	* ACTUALIZAR QUINCENA
	*/
	static public function mdlActualizarPrecioTiempo($inicio,$fin){

		$stmt = Conexion::conectar()->prepare("UPDATE 
    entallerjf e 
    LEFT JOIN articulojf a 
      ON e.articulo = a.articulo 
    LEFT JOIN operaciones_detallejf od 
      ON e.cod_operacion = od.cod_operacion 
      AND a.modelo = od.modelo SET e.total_precio = (e.cantidad / 12) * precio_doc 
  WHERE DATE(e.fecha_terminado) BETWEEN :inicio
    AND :fin ");

		$stmt->bindParam(":inicio", $inicio, PDO::PARAM_STR);
    $stmt->bindParam(":fin", $fin, PDO::PARAM_STR);

		if ($stmt->execute()) {

      return "ok";
      
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}  


  	/* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarAvances($inicio,$fin){

    $stmt = Conexion::conectar()->prepare("SELECT 
    a.id_trabajador,
    CONCAT(t.nom_tra, ' ', t.ape_pat_tra) AS nombre,
    FORMAT(ROUND(et.produccion, 2), 2) AS produccion,
    FORMAT(ROUND(et.sueldo_quincena, 2), 2) AS sueldo,
    FORMAT(ROUND(et.diferencia, 2), 2) AS diferencia,
    FORMAT(ROUND(et.incentivo, 2), 2) AS incentivo,
    FORMAT(
      CASE
        WHEN et.produccion > et.sueldo_quincena 
        THEN ROUND(et.produccion + et.incentivo, 2) 
        ELSE ROUND(et.sueldo_quincena, 2) 
      END,
      2
    ) AS total 
  FROM
    asistenciasjf a 
    LEFT JOIN 
      (SELECT 
        et.trabajador,
        SUM(total_precio) AS produccion,
        (t.sueldo_total / 2) AS sueldo_quincena,
        CASE
          WHEN SUM(total_precio) >= 600 
          THEN 'A' 
          WHEN SUM(total_precio) >= 550 
          AND SUM(total_precio) < 600 
          THEN 'B' 
          WHEN SUM(total_precio) >= 501 
          AND SUM(total_precio) < 550 
          THEN 'C' 
          WHEN SUM(total_precio) >= 475 
          AND SUM(total_precio) <= 500 
          THEN 'D' 
          WHEN SUM(total_precio) >= 450 
          AND SUM(total_precio) < 475 
          THEN 'E' 
          WHEN SUM(total_precio) >= 0 
          AND SUM(total_precio) < 450 
          THEN 'F' 
        END AS categoria,
        CASE
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          THEN 0 
          WHEN SUM(total_precio) < (t.sueldo_total / 2) 
          THEN ROUND(
            SUM(total_precio) - (t.sueldo_total / 2),
            2
          ) 
        END AS diferencia,
        CASE
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (SUM(total_precio) >= 600) 
          THEN 110 
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (
            SUM(total_precio) >= 550 
            AND SUM(total_precio) < 600
          ) 
          THEN 110 
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (
            SUM(total_precio) >= 500 
            AND SUM(total_precio) < 550
          ) 
          THEN 100 
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (
            SUM(total_precio) >= 475 
            AND SUM(total_precio) < 500
          ) 
          THEN 85 
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (
            SUM(total_precio) >= 450 
            AND SUM(total_precio) < 475
          ) 
          THEN 70 
          WHEN SUM(total_precio) > (t.sueldo_total / 2) 
          AND (
            SUM(total_precio) >= 0 
            AND SUM(total_precio) < 450
          ) 
          THEN 55 
          ELSE 0 
        END AS incentivo 
      FROM
        entallerjf et 
        LEFT JOIN trabajadorjf t 
          ON et.trabajador = t.cod_tra 
        LEFT JOIN articulojf a 
          ON et.articulo = a.articulo 
        LEFT JOIN modelojf m 
          ON a.modelo = m.modelo 
      WHERE (
          DATE(et.fecha_terminado) BETWEEN '".$inicio."' 
      AND '".$fin."'
        ) 
        AND m.tipo NOT IN ('BRASIER') 
      GROUP BY et.trabajador) AS et 
      ON a.id_trabajador = et.trabajador 
    LEFT JOIN trabajadorjf t 
      ON a.id_trabajador = t.cod_tra 
    LEFT JOIN tipo_trabajadorjf tt 
      ON t.cod_tip_tra = tt.cod_tip_tra 
  WHERE (
      DATE(a.fecha) BETWEEN '".$inicio."' 
      AND '".$fin."'
    ) 
    AND tt.cod_tip_tra = '1' 
    AND et.produccion > 0 
    AND a.estado = 'asistio' 
  GROUP BY a.id_trabajador 
  ORDER BY 
    CASE
      WHEN et.produccion > et.sueldo_quincena 
      THEN ROUND(et.produccion + et.incentivo, 2) 
      ELSE ROUND(et.sueldo_quincena, 2) 
    END DESC");


    $stmt->execute();

    return $stmt->fetchAll();
		

		$stmt->close();

		$stmt = null;
    }
}