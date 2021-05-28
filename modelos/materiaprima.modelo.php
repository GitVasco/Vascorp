<?php

require_once "conexion.php";

class ModeloMateriaPrima{

	/* 
	* MOSTRAR DATOS DE LA MATERIA PRIMA
	*/
	static public function mdlMostrarMateriaPrima($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("CALL sp_1029_consulta_mp()");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }    
    
	
	/* 
	* Método para vizualizar detalle de la materia prima
	*/
	static public function mdlVisualizarMateriaPrimaDetalle($valor){

		$sql="CALL sp_1031_articulos_x_mp_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* EDITAR COSTO DE LA MATERIA PRIMA
	*/
	static public function mdlEditarMateriaPrimaCosto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("CALL sp_1032_update_mp_costo_p(:cospro,:valor)");

		$stmt->bindParam(":cospro", $datos["cospro"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["codpro"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}
	
	/* 
	* MOSTRAR MATERIA PRIMA PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgenciaAMP($valor){

		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1033_mp_urgencias()");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1028_consulta_mp_p($valor)");

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleOC($valor){

		$sql="CALL sp_1034_mp_en_oc_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}
	
	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS TABLA ORDEN DE COMPRA
	*/
	static public function mdlVisualizarUrgenciasAMPDetalleART($valor){

		$sql="CALL sp_1035_art_mp_urg_p($valor)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}	

   // Método para mostrar el Rango de Fechas de Ventas
	static public function mdlProyMp($mp){

		if($mp=="null"){

			$sql="SELECT 
						mp.linea,
						mp.codsublinea,
						mp.codpro,
						mp.codfab,
						mp.descripcion,
						mp.color,
						mp.unidad,
						mp.stock,
						SUM(doc.saldo * dt.consumo) AS requerimiento,
						IFNULL(oc.saldo, 0) AS saldo_oc,
						IFNULL(os.saldo, 0) AS saldo_os,
						IFNULL(pr.cons_total, 0) AS cons_total,
						IFNULL(i.ing,0) AS ingresos,
						IFNULL(
						(
						IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
						) * 100,
						0
						) AS avance  
					FROM
						ordencortejf o 
						LEFT JOIN detalles_ordencortejf doc 
						ON o.codigo = doc.ordencorte 
						LEFT JOIN detalles_tarjetajf dt 
						ON doc.articulo = dt.articulo 
						LEFT JOIN 
						(SELECT DISTINCT 
							p.Codpro AS codpro,
							SUBSTRING(p.CodFab, 1, 3) AS codlinea,
							Tb4.Des_larga AS linea,
							SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
							Tb1.Des_larga AS sublinea,
							p.CodFab AS codfab,
							p.DesPro AS descripcion,
							p.CodAlm01 AS stock,
							Tabla_M_Detalle.Des_Larga AS color,
							Tb2.Des_Corta AS unidad 
						FROM
							producto p,
							Tabla_M_Detalle,
							Tabla_M_Detalle AS Tb1,
							Tabla_M_Detalle AS Tb2,
							Tabla_M_Detalle AS Tb4 
						WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
							AND Tb2.Cod_Tabla IN ('TUND') 
							AND tB4.Cod_Tabla IN ('TLIN') 
							AND Tb1.Cod_Tabla IN ('TSUB') 
							AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
							AND Tb2.Cod_Argumento = p.UndPro 
							AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
							AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
							AND Tb4.Des_Corta = Tb1.Des_Corta 
						ORDER BY p.CodPro ASC) AS mp 
						ON dt.mat_pri = mp.codpro 
						LEFT JOIN 
						(SELECT 
							ocd.codpro,
							ocd.nro,
							DATE(oc.fecemi) AS emision,
							DATE(oc.fecllegada) AS llegada,
							p.razpro,
							ocd.canpro AS cantidad_pedida,
							ocd.cantni AS saldo,
							oc.estac 
						FROM
							ocomdet ocd 
							LEFT JOIN ocompra oc 
							ON ocd.nro = oc.nro 
							LEFT JOIN proveedor p 
							ON oc.codruc = p.codruc 
						WHERE oc.estac IN ('ABI', 'PAR') 
							AND ocd.estac IN ('ABI', 'PAR') 
							AND oc.estoco = '03' 
							AND ocd.estoco = '03' 
							AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
						ON dt.mat_pri = oc.codpro 
						LEFT JOIN 
						(SELECT 
							osd.CodProOrigen,
							osd.CodProDestino AS codpro,
							osd.Saldo 
						FROM
							oserviciodet osd 
							LEFT JOIN oservicio os 
							ON os.Nro = osd.Nro 
						WHERE osd.EstReg = '1' 
							AND osd.EstOS IN ('ABI', 'PAR') 
							AND YEAR(os.fecent) = YEAR(NOW())) AS os 
						ON dt.mat_pri = os.codpro 
						LEFT JOIN 
						(SELECT 
							dt.mat_pri,
							dt.consumo,
							a.proyeccion,
							SUM(dt.consumo * a.proyeccion) AS cons_total 
						FROM
							detalles_tarjetajf dt 
							LEFT JOIN articulojf a 
							ON dt.articulo = a.articulo 
						WHERE a.proyeccion > 0 
						GROUP BY dt.mat_pri) AS pr 
						ON dt.mat_pri = pr.mat_pri 
						LEFT JOIN 
						(SELECT 
							nd.codpro,
							SUM(nd.cansol) AS ing 
						FROM
							neadet nd 
						WHERE nd.fecemi > '2020-07-31' 
						GROUP BY nd.codpro) AS i 
						ON dt.mat_pri = i.codpro 
					WHERE o.estado NOT IN ('Cerrado') 
					GROUP BY mp.codpro 
					ORDER BY mp.linea";
			
			$stmt=Conexion::conectar()->prepare($sql);

			$stmt->execute();
			
			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
			return $stmt->fetchAll();

      	}else{

			$sql="SELECT 
			mp.linea,
			mp.codsublinea,
			mp.codpro,
			mp.codfab,
			mp.descripcion,
			mp.color,
			mp.unidad,
			mp.stock,
			SUM(doc.saldo * dt.consumo) AS requerimiento,
			IFNULL(oc.saldo, 0) AS saldo_oc,
			IFNULL(os.saldo, 0) AS saldo_os,
			IFNULL(pr.cons_total, 0) AS cons_total,
			IFNULL(i.ing, 0) AS ingresos,
			IFNULL(
			  (
				IFNULL(i.ing, 0) / IFNULL(pr.cons_total, 0)
			  ) * 100,
			  0
			) AS avance 
		  FROM
			ordencortejf o 
			LEFT JOIN detalles_ordencortejf doc 
			  ON o.codigo = doc.ordencorte 
			LEFT JOIN detalles_tarjetajf dt 
			  ON doc.articulo = dt.articulo 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				SUBSTRING(p.CodFab, 1, 3) AS codlinea,
				Tb4.Des_larga AS linea,
				SUBSTRING(p.CodFab, 1, 6) AS codsublinea,
				Tb1.Des_larga AS sublinea,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				p.CodAlm01 AS stock,
				Tabla_M_Detalle.Des_Larga AS color,
				Tb2.Des_Corta AS unidad 
			  FROM
				producto p,
				Tabla_M_Detalle,
				Tabla_M_Detalle AS Tb1,
				Tabla_M_Detalle AS Tb2,
				Tabla_M_Detalle AS Tb4 
			  WHERE Tabla_M_Detalle.Cod_Tabla IN ('TCOL') 
				AND Tb2.Cod_Tabla IN ('TUND') 
				AND tB4.Cod_Tabla IN ('TLIN') 
				AND Tb1.Cod_Tabla IN ('TSUB') 
				AND Tabla_M_Detalle.Cod_Argumento = p.ColPro 
				AND Tb2.Cod_Argumento = p.UndPro 
				AND LEFT(p.CodFab, 3) = Tb4.Des_Corta 
				AND SUBSTRING(p.CodFab, 4, 3) = Tb1.Valor_3 
				AND Tb4.Des_Corta = Tb1.Des_Corta 
			  ORDER BY p.CodPro ASC) AS mp 
			  ON dt.mat_pri = mp.codpro 
			LEFT JOIN 
			  (SELECT 
				ocd.codpro,
				ocd.nro,
				DATE(oc.fecemi) AS emision,
				DATE(oc.fecllegada) AS llegada,
				p.razpro,
				ocd.canpro AS cantidad_pedida,
				ocd.cantni AS saldo,
				oc.estac 
			  FROM
				ocomdet ocd 
				LEFT JOIN ocompra oc 
				  ON ocd.nro = oc.nro 
				LEFT JOIN proveedor p 
				  ON oc.codruc = p.codruc 
			  WHERE oc.estac IN ('ABI', 'PAR') 
				AND ocd.estac IN ('ABI', 'PAR') 
				AND oc.estoco = '03' 
				AND ocd.estoco = '03' 
				AND YEAR(oc.fecemi) = YEAR(NOW())) AS oc 
			  ON dt.mat_pri = oc.codpro 
			LEFT JOIN 
			  (SELECT 
				osd.CodProOrigen,
				osd.CodProDestino AS codpro,
				osd.Saldo 
			  FROM
				oserviciodet osd 
				LEFT JOIN oservicio os 
				  ON os.Nro = osd.Nro 
			  WHERE osd.EstReg = '1' 
				AND osd.EstOS IN ('ABI', 'PAR') 
				AND YEAR(os.fecent) = YEAR(NOW())) AS os 
			  ON dt.mat_pri = os.codpro 
			LEFT JOIN 
			  (SELECT 
				dt.mat_pri,
				dt.consumo,
				a.proyeccion,
				SUM(dt.consumo * a.proyeccion) AS cons_total 
			  FROM
				detalles_tarjetajf dt 
				LEFT JOIN articulojf a 
				  ON dt.articulo = a.articulo 
			  WHERE a.proyeccion > 0 
			  GROUP BY dt.mat_pri) AS pr 
			  ON dt.mat_pri = pr.mat_pri 
			LEFT JOIN 
			  (SELECT 
				nd.codpro,
				SUM(nd.cansol) AS ing 
			  FROM
				neadet nd 
			  WHERE nd.fecemi > '2020-07-31' 
			  GROUP BY nd.codpro) AS i 
			  ON dt.mat_pri = i.codpro 
		  WHERE o.estado NOT IN ('Cerrado') 
			AND o.codigo = :mp
		  GROUP BY mp.codpro 
		  ORDER BY mp.linea";

			$stmt=Conexion::conectar()->prepare($sql);
			
			$stmt->bindParam(":mp", $mp, PDO::PARAM_STR);

			$stmt->execute();

			# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
			return $stmt->fetchAll();
         
      	}
      
		$stmt=null;
   }      	

   /* 
	* MOSTRAR MATERIA PRIMA POR ARTICULO
	*/
	static public function mdlMostrarMateriaArticulo($valor){

		$sql="SELECT DISTINCT 
		dt.mat_pri,
		mp.descripcion,
		mp.unidad,
		ROUND(dt.consumo, 6) AS consumo,
		CASE
		  WHEN dt.tej_princ = 'no' 
		  THEN '' 
		  ELSE 'SI' 
		END AS tej_princ,
		ROUND(dt.precio_mp, 6) AS precio_mp,
		ROUND(dt.total_detalle, 6) AS total_detalle 
	  FROM
		detalles_tarjetajf dt 
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
			  p.DesPro,
			  ' - ',
			  tbcol.des_larga
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
		  WHERE p.estpro = '1' 
			AND tblin.des_larga IN ('BLONDA', 'ELASTICO', 'TELA')) AS mp 
		  ON dt.mat_pri = mp.codpro 
	  WHERE dt.articulo LIKE '%".$valor."%' 
		AND mp.descripcion IS NOT NULL ";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	/*=============================================
	MOSTRAR LINEAS
	=============================================*/

	static public function mdlMostrarLineas(){

		$stmt = Conexion::conectar()->prepare("SELECT distinct * FROM Tabla_M_Detalle WHERE  Cod_Tabla = 'TLIN' and Cod_Argumento not like '000'");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR SUBLINEAS
	=============================================*/

	static public function mdlMostrarSubLineas($valor){
		if($valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT * FROM Tabla_M_Detalle WHERE Cod_Tabla = 'TSUB' ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT * FROM Tabla_M_Detalle WHERE Cod_Tabla = 'TSUB' AND Des_Corta = '".$valor."' ");

			$stmt -> execute();
	
			return $stmt -> fetchAll();
		}

		


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR TALLAS
	=============================================*/

	static public function mdlMostrarTallas(){

		$stmt = Conexion::conectar()->prepare("SELECT  distinct * FROM Tabla_M_Detalle WHERE  Cod_Tabla = 'TTAL'");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function mdlMostrarColores(){

		$stmt = Conexion::conectar()->prepare("SELECT  distinct * FROM Tabla_M_Detalle WHERE  Cod_Tabla = 'TCOL' and Cod_Argumento not like '0000' ");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR COLORES
	=============================================*/

	static public function mdlMostrarUndMedida(){

		$stmt = Conexion::conectar()->prepare("SELECT distinct * FROM Tabla_M_Detalle WHERE  Cod_Tabla = 'TUND' and Cod_Argumento not like '000'  ");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	CREAR PRECIO DE MATERIA PRIMA
	=============================================*/

	static public function mdlIngresarPrecioMP($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Cod_Local,Cod_Entidad,CodPro, CodProv1, PreProv1,MonProv1,ObsProv1,CodProv2, PreProv2,MonProv2,ObsProv2,CodProv3,PreProv3,MonProv3,ObsProv3,FecReg,UsuReg,PcReg) VALUES (:Cod_Local,:Cod_Entidad,:CodPro,:CodProv1, :PreProv1,:MonProv1,UPPER(:ObsProv1),:CodProv2,:PreProv2,:MonProv2,UPPER(:ObsProv2),:CodProv3,:PreProv3,:MonProv3,UPPER(:ObsProv3),:FecReg,UPPER(:UsuReg),UPPER(:PcReg))");

		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodProv1", $datos["CodProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv1", $datos["PreProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv1", $datos["MonProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv1", $datos["ObsProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":CodProv2", $datos["CodProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv2", $datos["PreProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv2", $datos["MonProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv2", $datos["ObsProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":CodProv3", $datos["CodProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv3", $datos["PreProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv3", $datos["MonProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv3", $datos["ObsProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":FecReg", $datos["FecReg"], PDO::PARAM_STR);
        $stmt->bindParam(":PcReg", $datos["PcReg"], PDO::PARAM_STR);
        $stmt->bindParam(":UsuReg", $datos["UsuReg"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    


	/*=============================================
	CREAR MATERIA PRIMA
	=============================================*/

	static public function mdlIngresarMateriaPrima($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(CodAlt,Cod_Local,Cod_Entidad,CodPro,CodFab,DesPro,ColPro,UndPro,Mo,PaiPro,PrePro,PreFob,CosPro,Por_AdVal,Por_Seg,PesPro,Stk_Act,Stk_Min,Stk_Max,EstPro,TalPro,FamPro, Proveedor, CodAlm01, FecReg, UsuReg, PcReg) VALUES (:CodAlt,:Cod_Local,:Cod_Entidad,:CodPro,:CodFab,UPPER(:DesPro),:ColPro,:UndPro,:Mo,:PaiPro,:PrePro,:PreFob,:CosPro,:Por_AdVal,:Por_Seg,:PesPro,:Stk_Act,:Stk_Min,:Stk_Max,:EstPro,:TalPro,:FamPro,:Proveedor,:CodAlm01,:FecReg,UPPER(:UsuReg),UPPER(:PcReg))");

		$stmt->bindParam(":CodAlt", $datos["CodAlt"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodFab", $datos["CodFab"], PDO::PARAM_STR);
        $stmt->bindParam(":DesPro", $datos["DesPro"], PDO::PARAM_STR);
        $stmt->bindParam(":ColPro", $datos["ColPro"], PDO::PARAM_STR);
        $stmt->bindParam(":UndPro", $datos["UndPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Mo", $datos["Mo"], PDO::PARAM_STR);
        $stmt->bindParam(":PaiPro", $datos["PaiPro"], PDO::PARAM_STR);
        $stmt->bindParam(":PrePro", $datos["PrePro"], PDO::PARAM_STR);
        $stmt->bindParam(":PreFob", $datos["PreFob"], PDO::PARAM_STR);
        $stmt->bindParam(":CosPro", $datos["CosPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Por_AdVal", $datos["Por_AdVal"], PDO::PARAM_STR);
        $stmt->bindParam(":Por_Seg", $datos["Por_Seg"], PDO::PARAM_STR);
        $stmt->bindParam(":PesPro", $datos["PesPro"], PDO::PARAM_STR);
		$stmt->bindParam(":Stk_Act", $datos["Stk_Act"], PDO::PARAM_STR);
        $stmt->bindParam(":Stk_Min", $datos["Stk_Min"], PDO::PARAM_STR);
        $stmt->bindParam(":Stk_Max", $datos["Stk_Max"], PDO::PARAM_STR);
        $stmt->bindParam(":EstPro", $datos["EstPro"], PDO::PARAM_STR);
        $stmt->bindParam(":TalPro", $datos["TalPro"], PDO::PARAM_STR);
		$stmt->bindParam(":FamPro", $datos["FamPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Proveedor", $datos["Proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":CodAlm01", $datos["CodAlm01"], PDO::PARAM_STR);
        $stmt->bindParam(":FecReg", $datos["FecReg"], PDO::PARAM_STR);
        $stmt->bindParam(":PcReg", $datos["PcReg"], PDO::PARAM_STR);
        $stmt->bindParam(":UsuReg", $datos["UsuReg"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    


	/*=============================================
	VALIDAR CODIGO DE FABRICA MATERIA PRIMA
	=============================================*/

	static public function mdlMostrarMateriaFabrica($valor){

		$stmt = Conexion::conectar()->prepare("SELECT  * FROM producto WHERE  CodFab = '".$valor."'");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR ULTIMO CODIGOPRO DE MATERIA PRIMA
	=============================================*/

	static public function mdlMostrarUltimoCodPro(){


		$stmt = Conexion::conectar()->prepare("SELECT MAX(CodPro) AS CodPro FROM producto");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }


	/*=============================================
	EDITAR PRECIO DE MATERIA PRIMA
	=============================================*/

	static public function mdlEditarPrecioMP($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE preciomp SET CodProv1=:CodProv1,MonProv1=:MonProv1,PreProv1=:PreProv1, ObsProv1=UPPER(:ObsProv1),CodProv2=:CodProv2,MonProv2=:MonProv2,PreProv2=:PreProv2,ObsProv2=UPPER(:ObsProv2),CodProv3=:CodProv3,MonProv3=:MonProv3,PreProv3=:PreProv3,ObsProv3=UPPER(:ObsProv3),UsuMod=UPPER(:UsuMod),FecMod=:FecMod,PcMod=UPPER(:PcMod) WHERE CodPro = :CodPro");

        $stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodProv1", $datos["CodProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv1", $datos["PreProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv1", $datos["MonProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv1", $datos["ObsProv1"], PDO::PARAM_STR);
        $stmt->bindParam(":CodProv2", $datos["CodProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv2", $datos["PreProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv2", $datos["MonProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv2", $datos["ObsProv2"], PDO::PARAM_STR);
        $stmt->bindParam(":CodProv3", $datos["CodProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":PreProv3", $datos["PreProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":MonProv3", $datos["MonProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":ObsProv3", $datos["ObsProv3"], PDO::PARAM_STR);
        $stmt->bindParam(":FecMod", $datos["FecMod"], PDO::PARAM_STR);
        $stmt->bindParam(":PcMod", $datos["PcMod"], PDO::PARAM_STR);
        $stmt->bindParam(":UsuMod", $datos["UsuMod"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	EDITAR MATERIA PRIMA
	=============================================*/
	static public function mdlEditarMateriaPrima($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE producto SET CodAlt=UPPER(:CodAlt),DesPro=UPPER(:DesPro),UndPro=UPPER(:UndPro),Por_AdVal=:Por_AdVal,Por_Seg=:Por_Seg,PesPro=:PesPro,Stk_Min=:Stk_Min,Stk_Max=:Stk_Max,UsuMod=UPPER(:UsuMod),FecMod=:FecMod,PcMod=UPPER(:PcMod) WHERE CodPro = :CodPro");

		$stmt->bindParam(":CodAlt", $datos["CodAlt"], PDO::PARAM_STR);
        $stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
        $stmt->bindParam(":DesPro", $datos["DesPro"], PDO::PARAM_STR);
        $stmt->bindParam(":UndPro", $datos["UndPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Por_AdVal", $datos["Por_AdVal"], PDO::PARAM_STR);
        $stmt->bindParam(":Por_Seg", $datos["Por_Seg"], PDO::PARAM_STR);
        $stmt->bindParam(":PesPro", $datos["PesPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Stk_Min", $datos["Stk_Min"], PDO::PARAM_STR);
        $stmt->bindParam(":Stk_Max", $datos["Stk_Max"], PDO::PARAM_STR);
        $stmt->bindParam(":FecMod", $datos["FecMod"], PDO::PARAM_STR);
        $stmt->bindParam(":PcMod", $datos["PcMod"], PDO::PARAM_STR);
        $stmt->bindParam(":UsuMod", $datos["UsuMod"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();
		$stmt = null;

	}


	/*=============================================
	MOSTRAR ULTIMO CODIGOPRO DE MATERIA PRIMA
	=============================================*/

	static public function mdlMostrarExisteMateria($valor){


		$stmt = Conexion::conectar()->prepare("SELECT CodPro FROM producto WHERE CodFab = '".$valor."'");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	ANULAR MATERIA PRIMA
	=============================================*/

	static public function mdlAnularMateriaPrima($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE producto SET EstPro=:EstPro,UsuAnu=UPPER(:UsuAnu),FecAnu=:FecAnu,PcAnu=UPPER(:PcAnu) WHERE CodPro = :CodPro");

        $stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":EstPro", $datos["EstPro"], PDO::PARAM_STR);
        $stmt->bindParam(":FecAnu", $datos["FecAnu"], PDO::PARAM_STR);
        $stmt->bindParam(":PcAnu", $datos["PcAnu"], PDO::PARAM_STR);
        $stmt->bindParam(":UsuAnu", $datos["UsuAnu"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

}