<?php

require_once "conexion.php";

class ModeloProcedimientos{

	/*=============================================
	CREAR SUBLIMADO
	=============================================*/

	static public function mdlIngresarSublimado($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(modelo,color_modelo,cantidad, materia_prima, fecha_inicio, fecha_fin,tiempo_utilizado,cod_corte,usuario) VALUES (:modelo,:color_modelo,:cantidad, :materia_prima, :fecha_inicio, :fecha_fin,:tiempo_utilizado, :cod_corte, :usuario)");

		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":color_modelo", $datos["color_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":materia_prima", $datos["materia_prima"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_utilizado", $datos["tiempo_utilizado"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_corte", $datos["cod_corte"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR SUBLIMADOS
	=============================================*/

	static public function mdlMostrarSublimados($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
      s.id,
      s.modelo,
      m.nombre,
      s.color_modelo,
      c.nom_color,
      s.cantidad,
      s.materia_prima,
      m.descripcion,
      m.color, 
      s.fecha_inicio,
      s.fecha_fin,
      s.tiempo_utilizado,
      s.cod_corte,
      u.nombre as nom_user
    FROM
      sublimado_jf s 
      LEFT JOIN modelojf m 
        ON s.modelo = m.modelo 
      LEFT JOIN colorjf c 
        ON s.color_modelo = c.cod_color 
      LEFT JOIN 
        (SELECT DISTINCT 
          p.codpro,
          tblin.des_larga AS linea,
          SUBSTRING(p.codfab, 1, 6) AS codlinea,
          p.codfab,
          p.despro AS despro,
          CONCAT(
            (SUBSTRING(p.CodFab, 1, 6)),
            ' - ',
            p.DesPro
          ) AS descripcion,
          p.codalm01 AS stock,
          tbund.des_corta AS unidad,
          tbcol.des_larga AS color,
          p.cospro 
        FROM
          producto p 
          INNER JOIN tabla_m_detalle AS tbund 
            ON p.undpro = tbund.cod_argumento 
            AND (tbund.Cod_Tabla = 'TUND') 
          INNER JOIN tabla_m_detalle AS tbcol 
            ON p.ColPro = tbcol.cod_argumento 
            AND (tbcol.Cod_Tabla = 'TCOL') 
          INNER JOIN tabla_m_detalle AS tblin 
            ON LEFT(p.codfab, 3) = tblin.des_corta 
            AND (tblin.cod_tabla = 'Tlin') 
        WHERE p.estpro = '1') m 
        ON s.materia_prima = m.codpro 
      LEFT JOIN usuariosjf u 
        ON s.usuario = u.id
      WHERE  s.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
      s.id,
      s.modelo,
      m.nombre,
      s.color_modelo,
      c.nom_color,
      s.cantidad,
      s.materia_prima,
      m.descripcion,
      m.color,
      s.fecha_inicio,
      s.fecha_fin,
      s.tiempo_utilizado,
      s.cod_corte,
      u.nombre as nom_user
    FROM
      sublimado_jf s 
      LEFT JOIN modelojf m 
        ON s.modelo = m.modelo 
      LEFT JOIN colorjf c 
        ON s.color_modelo = c.cod_color 
      LEFT JOIN 
        (SELECT DISTINCT 
          p.codpro,
          tblin.des_larga AS linea,
          SUBSTRING(p.codfab, 1, 6) AS codlinea,
          p.codfab,
          p.despro AS despro,
          CONCAT(
            (SUBSTRING(p.CodFab, 1, 6)),
            ' - ',
            p.DesPro
          ) AS descripcion,
          p.codalm01 AS stock,
          tbund.des_corta AS unidad,
          tbcol.des_larga AS color,
          p.cospro 
        FROM
          producto p 
          INNER JOIN tabla_m_detalle AS tbund 
            ON p.undpro = tbund.cod_argumento 
            AND (tbund.Cod_Tabla = 'TUND') 
          INNER JOIN tabla_m_detalle AS tbcol 
            ON p.ColPro = tbcol.cod_argumento 
            AND (tbcol.Cod_Tabla = 'TCOL') 
          INNER JOIN tabla_m_detalle AS tblin 
            ON LEFT(p.codfab, 3) = tblin.des_corta 
            AND (tblin.cod_tabla = 'Tlin') 
        WHERE p.estpro = '1') m 
        ON s.materia_prima = m.codpro 
      LEFT JOIN usuariosjf u 
        ON s.usuario = u.id");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR SUBLIMADO
	=============================================*/

	static public function mdlEditarSublimado($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET modelo = :modelo, color_modelo = :color_modelo, cantidad = :cantidad, materia_prima = :materia_prima,fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin,tiempo_utilizado = :tiempo_utilizado, cod_corte = :cod_corte, usuario = :usuario WHERE id = :id");
        
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":color_modelo", $datos["color_modelo"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":materia_prima", $datos["materia_prima"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":tiempo_utilizado", $datos["tiempo_utilizado"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_corte", $datos["cod_corte"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR SUBLIMADO
	=============================================*/

	static public function mdlEliminarSublimado($tabla,$datos){

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
	RANGO FECHAS SUBLIMADOS
	=============================================*/	

	static public function mdlRangoFechasSublimados($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
            s.id,
            s.modelo,
            m.nombre,
            s.color_modelo,
            c.nom_color,
            s.cantidad,
            s.materia_prima,
            m.descripcion,
            m.color,
            DATE_FORMAT(s.fecha_inicio,'%d-%m-%Y %H:%i') AS fecha_inicio,
            DATE_FORMAT(s.fecha_fin,'%d-%m-%Y %H:%i') AS fecha_fin,
            s.tiempo_utilizado,
            s.cod_corte,
            u.nombre as nom_user
          FROM
            sublimado_jf s 
            LEFT JOIN modelojf m 
              ON s.modelo = m.modelo 
            LEFT JOIN colorjf c 
              ON s.color_modelo = c.cod_color 
            LEFT JOIN 
              (SELECT DISTINCT 
                p.codpro,
                tblin.des_larga AS linea,
                SUBSTRING(p.codfab, 1, 6) AS codlinea,
                p.codfab,
                p.despro AS despro,
                CONCAT(
                  (SUBSTRING(p.CodFab, 1, 6)),
                  ' - ',
                  p.DesPro
                ) AS descripcion,
                p.codalm01 AS stock,
                tbund.des_corta AS unidad,
                tbcol.des_larga AS color,
                p.cospro 
              FROM
                producto p 
                INNER JOIN tabla_m_detalle AS tbund 
                  ON p.undpro = tbund.cod_argumento 
                  AND (tbund.Cod_Tabla = 'TUND') 
                INNER JOIN tabla_m_detalle AS tbcol 
                  ON p.ColPro = tbcol.cod_argumento 
                  AND (tbcol.Cod_Tabla = 'TCOL') 
                INNER JOIN tabla_m_detalle AS tblin 
                  ON LEFT(p.codfab, 3) = tblin.des_corta 
                  AND (tblin.cod_tabla = 'Tlin') 
              WHERE p.estpro = '1') m 
              ON s.materia_prima = m.codpro 
            LEFT JOIN usuariosjf u 
              ON s.usuario = u.id");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
            s.id,
            s.modelo,
            m.nombre,
            s.color_modelo,
            c.nom_color,
            s.cantidad,
            s.materia_prima,
            m.descripcion,
            m.color,
            DATE_FORMAT(s.fecha_inicio,'%d-%m-%Y %H:%i') AS fecha_inicio,
            DATE_FORMAT(s.fecha_fin,'%d-%m-%Y %H:%i') AS fecha_fin,
            s.tiempo_utilizado,
            s.cod_corte,
            u.nombre as nom_user
          FROM
            sublimado_jf s 
            LEFT JOIN modelojf m 
              ON s.modelo = m.modelo 
            LEFT JOIN colorjf c 
              ON s.color_modelo = c.cod_color 
            LEFT JOIN 
              (SELECT DISTINCT 
                p.codpro,
                tblin.des_larga AS linea,
                SUBSTRING(p.codfab, 1, 6) AS codlinea,
                p.codfab,
                p.despro AS despro,
                CONCAT(
                  (SUBSTRING(p.CodFab, 1, 6)),
                  ' - ',
                  p.DesPro
                ) AS descripcion,
                p.codalm01 AS stock,
                tbund.des_corta AS unidad,
                tbcol.des_larga AS color,
                p.cospro 
              FROM
                producto p 
                INNER JOIN tabla_m_detalle AS tbund 
                  ON p.undpro = tbund.cod_argumento 
                  AND (tbund.Cod_Tabla = 'TUND') 
                INNER JOIN tabla_m_detalle AS tbcol 
                  ON p.ColPro = tbcol.cod_argumento 
                  AND (tbcol.Cod_Tabla = 'TCOL') 
                INNER JOIN tabla_m_detalle AS tblin 
                  ON LEFT(p.codfab, 3) = tblin.des_corta 
                  AND (tblin.cod_tabla = 'Tlin') 
              WHERE p.estpro = '1') m 
              ON s.materia_prima = m.codpro 
            LEFT JOIN usuariosjf u 
              ON s.usuario = u.id
            WHERE DATE(s.fecha_inicio) like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT 
                s.id,
                s.modelo,
                m.nombre,
                s.color_modelo,
                c.nom_color,
                s.cantidad,
                s.materia_prima,
                m.descripcion,
                m.color,
                DATE_FORMAT(s.fecha_inicio,'%d-%m-%Y %H:%i') AS fecha_inicio,
                DATE_FORMAT(s.fecha_fin,'%d-%m-%Y %H:%i') AS fecha_fin,
                s.tiempo_utilizado,
                s.cod_corte,
                u.nombre as nom_user
              FROM
                sublimado_jf s 
                LEFT JOIN modelojf m 
                  ON s.modelo = m.modelo 
                LEFT JOIN colorjf c 
                  ON s.color_modelo = c.cod_color 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    p.codpro,
                    tblin.des_larga AS linea,
                    SUBSTRING(p.codfab, 1, 6) AS codlinea,
                    p.codfab,
                    p.despro AS despro,
                    CONCAT(
                      (SUBSTRING(p.CodFab, 1, 6)),
                      ' - ',
                      p.DesPro
                    ) AS descripcion,
                    p.codalm01 AS stock,
                    tbund.des_corta AS unidad,
                    tbcol.des_larga AS color,
                    p.cospro 
                  FROM
                    producto p 
                    INNER JOIN tabla_m_detalle AS tbund 
                      ON p.undpro = tbund.cod_argumento 
                      AND (tbund.Cod_Tabla = 'TUND') 
                    INNER JOIN tabla_m_detalle AS tbcol 
                      ON p.ColPro = tbcol.cod_argumento 
                      AND (tbcol.Cod_Tabla = 'TCOL') 
                    INNER JOIN tabla_m_detalle AS tblin 
                      ON LEFT(p.codfab, 3) = tblin.des_corta 
                      AND (tblin.cod_tabla = 'Tlin') 
                  WHERE p.estpro = '1') m 
                  ON s.materia_prima = m.codpro 
                LEFT JOIN usuariosjf u 
                  ON s.usuario = u.id
                WHERE DATE(s.fecha_inicio) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
                s.id,
                s.modelo,
                m.nombre,
                s.color_modelo,
                c.nom_color,
                s.cantidad,
                s.materia_prima,
                m.descripcion,
                m.color,
                DATE_FORMAT(s.fecha_inicio,'%d-%m-%Y %H:%i') AS fecha_inicio,
                DATE_FORMAT(s.fecha_fin,'%d-%m-%Y %H:%i') AS fecha_fin,
                s.tiempo_utilizado,
                s.cod_corte,
                u.nombre as nom_user
              FROM
                sublimado_jf s 
                LEFT JOIN modelojf m 
                  ON s.modelo = m.modelo 
                LEFT JOIN colorjf c 
                  ON s.color_modelo = c.cod_color 
                LEFT JOIN 
                  (SELECT DISTINCT 
                    p.codpro,
                    tblin.des_larga AS linea,
                    SUBSTRING(p.codfab, 1, 6) AS codlinea,
                    p.codfab,
                    p.despro AS despro,
                    CONCAT(
                      (SUBSTRING(p.CodFab, 1, 6)),
                      ' - ',
                      p.DesPro
                    ) AS descripcion,
                    p.codalm01 AS stock,
                    tbund.des_corta AS unidad,
                    tbcol.des_larga AS color,
                    p.cospro 
                  FROM
                    producto p 
                    INNER JOIN tabla_m_detalle AS tbund 
                      ON p.undpro = tbund.cod_argumento 
                      AND (tbund.Cod_Tabla = 'TUND') 
                    INNER JOIN tabla_m_detalle AS tbcol 
                      ON p.ColPro = tbcol.cod_argumento 
                      AND (tbcol.Cod_Tabla = 'TCOL') 
                    INNER JOIN tabla_m_detalle AS tblin 
                      ON LEFT(p.codfab, 3) = tblin.des_corta 
                      AND (tblin.cod_tabla = 'Tlin') 
                  WHERE p.estpro = '1') m 
                  ON s.materia_prima = m.codpro 
                LEFT JOIN usuariosjf u 
                  ON s.usuario = u.id
                WHERE DATE(s.fecha_inicio) BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


}