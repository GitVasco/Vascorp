<?php

require_once "conexion.php";

class ModeloOrdenCompra
{

	static public function mdlMostrarOrdenCompra($item, $valor)
	{
		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
			oCompra.CodRuc,
			Mo,
			FecLlegada,
            Tip,
            Ser,
            Nro,
            Proveedor.RazPro,
			Proveedor.Ruc,
            DATE(FecEmi) AS FecEmi
          FROM
            oCompra,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oCompra.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstOco = '03' 
            AND YEAR(FecEmi) IN ('2020', '2021') 
          ORDER BY Nro DESC ");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
			IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
			oCompra.CodRuc,
			Mo,
			DATE(FecLlegada) AS FecLlegada,
            Tip,
            Ser,
            Nro,
			TipPago,
            Proveedor.RazPro,
			Proveedor.RucPro,
			oCompra.Dia,
			oCompra.tCambio,
			oCompra.Obser,
			SubTotal,
			Igv,
			Total,
			NroProforma,
			Centcosto,
            DATE(FecEmi) AS FecEmi
          FROM
            oCompra,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oCompra.CodRuc 
		  	AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstOco = '03' 
            AND $item = :$item 
			ORDER BY Nro DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlMostrarDetallesOrdenCompra($item, $valor)
	{
		if ($valor == null) {

			$stmt = Conexion::conectar()->prepare("SELECT 
			odet.CodPro,
			odet.ColProv,
			odet.UndPro,
			odet.CanPro,
			odet.PrePro,
			odet.DscPro,
			odet.ImpPro, FROM ocomdet 
			ORDER BY Item DESC");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT 
				odet.CodPro AS id,
				odet.ColProv AS colorprov,
				odet.UndPro AS unidad,
				odet.CanPro AS cantidad,
				(odet.canpro - odet.cantni) AS recibido,
				CASE
					WHEN odet.estac = 'CER' 
					THEN 0 
					ELSE odet.cantni 
				END AS pendiente,
				odet.PrePro AS precio,
				odet.DscPro AS descuento,
				odet.ImpPro AS total,
				tbcol.des_larga AS color,
				odet.Nro,
				p.codfab,
				p.despro,
				CASE
					WHEN odet.estac = 'ABI' 
					THEN 'ABIERTA' 
					WHEN odet.estac = 'CER' 
					THEN 'CERRADA' 
					ELSE 'PARCIAL' 
				END AS estado,
				CONCAT(
					(SUBSTRING(p.CodFab, 1, 6)),
					' - ',
					p.DesPro,
					' - ',
					tbcol.des_larga,
					' - ',
					odet.UndPro
				) AS descripcion
		  FROM
			ocomdet odet 
			LEFT JOIN producto p 
			  ON p.CodPro = odet.CodPro 
			INNER JOIN tabla_m_detalle AS tbcol 
			  ON p.ColPro = tbcol.cod_argumento 
			  AND (tbcol.Cod_Tabla = 'TCOL') 
		  WHERE odet.$item = :$item 
		  ORDER BY odet.Item ASC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}



	/*=============================================
	RANGO FECHAS
	=============================================*/

	static public function mdlRangoFechasOrdenCompra($fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == "null") {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
            Tip,
            Ser,
            Nro,
			oCompra.UsuReg,
			oCompra.CodRuc,
            Proveedor.RazPro,
            DATE(FecEmi) AS FecEmi
          FROM
            oCompra,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oCompra.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstOco = '03' 
            AND YEAR(FecEmi) = YEAR(NOW())
          ORDER BY Nro DESC ");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
            Tip,
            Ser,
            Nro,
			oCompra.UsuReg,
            Proveedor.RazPro,
			oCompra.CodRuc,
            DATE(FecEmi) AS FecEmi
          FROM
            oCompra,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oCompra.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstOco = '03' 
            AND DATE(FecEmi) like '%$fechaFinal%'  ORDER BY Nro DESC");

			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
                Tip,
                Ser,
                Nro,
				oCompra.UsuReg,
                Proveedor.RazPro,
				oCompra.CodRuc,
                DATE(FecEmi) AS FecEmi
              FROM
                oCompra,
                Proveedor,
                Tabla_M_Detalle 
              WHERE Proveedor.CodRuc = oCompra.CodRuc 
                AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
                AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
                AND EstOco = '03' 
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
			  ORDER BY Nro DESC");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
                Tip,
                Ser,
                Nro,
				oCompra.UsuReg,
                Proveedor.RazPro,
				oCompra.CodRuc,
                DATE(FecEmi) AS FecEmi
              FROM
                oCompra,
                Proveedor,
                Tabla_M_Detalle 
              WHERE Proveedor.CodRuc = oCompra.CodRuc 
                AND Tabla_M_Detalle.Des_Corta = oCompra.Estac 
                AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
                AND EstOco = '03' 
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  ORDER BY Nro DESC");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}

	/*=============================================
	REPORTE FECHAS
	=============================================*/

	static public function mdlReporteFechasOrdenCompra($fechaInicial, $fechaFinal, $estado, $estac)
	{

		if ($fechaInicial == "null") {

			$stmt = Conexion::conectar()->prepare("SELECT 
			od.nro,
			DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
			DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecprog,
			p.razpro,
			od.codpro,
			od.codfab,
			p.descripcion,
			p.color,
			p.unidad,
			p.stock,
			od.prepro,
			od.canpro AS cantidad_pedida,
			(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
			od.cantni AS saldo,
			:estado AS estado 
		  FROM
			ocomdet od 
			LEFT JOIN ocompra o 
			  ON od.nro = o.nro 
			LEFT JOIN proveedor p 
			  ON od.codruc = p.codruc 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				tb.Des_Larga AS color,
				tb2.Des_Corta AS unidad,
				ROUND(p.CodAlm01, 4) AS stock 
			  FROM
				producto AS p,
				Tabla_M_Detalle AS tb,
				Tabla_M_Detalle AS tb1,
				Tabla_M_Detalle AS tb2 
			  WHERE tb.Cod_Tabla IN ('TCOL') 
				AND tb2.Cod_Tabla IN ('TUND') 
				AND tb1.Cod_Tabla IN ('TSUB') 
				AND tb.Cod_Argumento = p.ColPro 
				AND tb2.Cod_Argumento = p.UndPro 
				AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
				AND p.estpro = '1') AS p 
			  ON od.codpro = p.codpro 
			WHERE o.EstOco = '03' 
			AND od.EstOco = '03' 
			AND od.estac = :estac
			AND YEAR(o.fecemi) = '2022' 
		  ORDER BY o.fecemi ");

			$stmt->bindParam(":estac", $estac, PDO::PARAM_STR);
			$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT 
			od.nro,
			DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
			DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecprog,
			p.razpro,
			od.codpro,
			od.codfab,
			p.descripcion,
			p.color,
			p.unidad,
			p.stock,
			od.prepro,
			od.canpro AS cantidad_pedida,
			(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
			od.cantni AS saldo,
			:estado AS estado 
		  FROM
			ocomdet od 
			LEFT JOIN ocompra o 
			  ON od.nro = o.nro 
			LEFT JOIN proveedor p 
			  ON od.codruc = p.codruc 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				tb.Des_Larga AS color,
				tb2.Des_Corta AS unidad,
				ROUND(p.CodAlm01, 4) AS stock 
			  FROM
				producto AS p,
				Tabla_M_Detalle AS tb,
				Tabla_M_Detalle AS tb1,
				Tabla_M_Detalle AS tb2 
			  WHERE tb.Cod_Tabla IN ('TCOL') 
				AND tb2.Cod_Tabla IN ('TUND') 
				AND tb1.Cod_Tabla IN ('TSUB') 
				AND tb.Cod_Argumento = p.ColPro 
				AND tb2.Cod_Argumento = p.UndPro 
				AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
				AND p.estpro = '1') AS p 
			  ON od.codpro = p.codpro 
			WHERE o.EstOco = '03' 
			AND od.EstOco = '03' 
			AND od.estac = :estac
            AND DATE(o.fecemi) like '%$fechaFinal%' 
			ORDER BY o.fecemi DESC");

			$stmt->bindParam(":estac", $estac, PDO::PARAM_STR);
			$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT 
				od.nro,
				DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
				DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecprog,
				p.razpro,
				od.codpro,
				od.codfab,
				p.descripcion,
				p.color,
				p.unidad,
				p.stock,
				od.prepro,
				od.canpro AS cantidad_pedida,
				(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
				od.cantni AS saldo,
				:estado AS estado 
			  FROM
				ocomdet od 
				LEFT JOIN ocompra o 
				  ON od.nro = o.nro 
				LEFT JOIN proveedor p 
				  ON od.codruc = p.codruc 
				LEFT JOIN 
				  (SELECT DISTINCT 
					p.Codpro AS codpro,
					p.CodFab AS codfab,
					p.DesPro AS descripcion,
					tb.Des_Larga AS color,
					tb2.Des_Corta AS unidad,
					ROUND(p.CodAlm01, 4) AS stock 
				  FROM
					producto AS p,
					Tabla_M_Detalle AS tb,
					Tabla_M_Detalle AS tb1,
					Tabla_M_Detalle AS tb2 
				  WHERE tb.Cod_Tabla IN ('TCOL') 
					AND tb2.Cod_Tabla IN ('TUND') 
					AND tb1.Cod_Tabla IN ('TSUB') 
					AND tb.Cod_Argumento = p.ColPro 
					AND tb2.Cod_Argumento = p.UndPro 
					AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
					AND p.estpro = '1') AS p 
				  ON od.codpro = p.codpro 
				WHERE o.EstOco = '03' 
				AND od.EstOco = '03' 
				AND od.estac = :estac
                AND DATE(o.fecemi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
			  ORDER BY o.fecemi DESC");

				$stmt->bindParam(":estac", $estac, PDO::PARAM_STR);
				$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT 
				od.nro,
				DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
				DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecprog,
				p.razpro,
				od.codpro,
				od.codfab,
				p.descripcion,
				p.color,
				p.unidad,
				p.stock,
				od.prepro,
				od.canpro AS cantidad_pedida,
				(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
				od.cantni AS saldo,
				:estado AS estado 
			  FROM
				ocomdet od 
				LEFT JOIN ocompra o 
				  ON od.nro = o.nro 
				LEFT JOIN proveedor p 
				  ON od.codruc = p.codruc 
				LEFT JOIN 
				  (SELECT DISTINCT 
					p.Codpro AS codpro,
					p.CodFab AS codfab,
					p.DesPro AS descripcion,
					tb.Des_Larga AS color,
					tb2.Des_Corta AS unidad,
					ROUND(p.CodAlm01, 4) AS stock 
				  FROM
					producto AS p,
					Tabla_M_Detalle AS tb,
					Tabla_M_Detalle AS tb1,
					Tabla_M_Detalle AS tb2 
				  WHERE tb.Cod_Tabla IN ('TCOL') 
					AND tb2.Cod_Tabla IN ('TUND') 
					AND tb1.Cod_Tabla IN ('TSUB') 
					AND tb.Cod_Argumento = p.ColPro 
					AND tb2.Cod_Argumento = p.UndPro 
					AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
					AND p.estpro = '1') AS p 
				  ON od.codpro = p.codpro 
				WHERE o.EstOco = '03' 
				AND od.EstOco = '03' 
				AND od.estac = :estac
                AND DATE(o.fecemi) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  ORDER BY o.fecemi DESC");

				$stmt->bindParam(":estac", $estac, PDO::PARAM_STR);
				$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}


	/*=============================================
	REPORTE FECHAS
	=============================================*/

	static public function mdlReporteFechasOrdenCompraGeneral($fechaInicial, $fechaFinal)
	{

		if ($fechaInicial == "null") {

			$stmt = Conexion::conectar()->prepare("SELECT 
			od.nro,
			DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
			DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecllegada,
			p.razpro,
			od.codpro,
			od.codfab,
			p.descripcion,
			p.color,
			p.unidad,
			p.stock,
			od.prepro,
			od.canpro AS cantidad_pedida,
			(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
			od.cantni AS saldo,
			t3.Des_Larga AS estado 
		  FROM
			ocomdet od 
			LEFT JOIN ocompra o 
			  ON od.nro = o.nro 
			LEFT JOIN proveedor p 
			  ON od.codruc = p.codruc 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				tb.Des_Larga AS color,
				tb2.Des_Corta AS unidad,
				ROUND(p.CodAlm01, 4) AS stock 
			  FROM
				producto AS p,
				Tabla_M_Detalle AS tb,
				Tabla_M_Detalle AS tb1,
				Tabla_M_Detalle AS tb2 
			  WHERE tb.Cod_Tabla IN ('TCOL') 
				AND tb2.Cod_Tabla IN ('TUND') 
				AND tb1.Cod_Tabla IN ('TSUB') 
				AND tb.Cod_Argumento = p.ColPro 
				AND tb2.Cod_Argumento = p.UndPro 
				AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
				AND p.estpro = '1') AS p 
			  ON od.codpro = p.codpro 
			LEFT JOIN Tabla_M_Detalle AS t3 
			  ON od.Cod_Local = t3.Cod_Local 
			  AND od.Cod_Entidad = t3.Cod_Entidad 
			  AND od.estac = t3.Des_Corta 
		  WHERE o.estoco = '03' 
			AND od.estoco = '03' 
			AND YEAR(o.fecemi) = '2021' 
			AND (
			  t3.Cod_Tabla = 'EOC1' 
			  OR t3.Cod_Tabla IS NULL
			) 
		  ORDER BY o.fecemi ");

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($fechaInicial == $fechaFinal) {

			$stmt = Conexion::conectar()->prepare("SELECT 
			od.nro,
			DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
			DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecllegada,
			p.razpro,
			od.codpro,
			od.codfab,
			p.descripcion,
			p.color,
			p.unidad,
			p.stock,
			od.prepro,
			od.canpro AS cantidad_pedida,
			(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
			od.cantni AS saldo,
			t3.Des_Larga AS estado 
		  FROM
			ocomdet od 
			LEFT JOIN ocompra o 
			  ON od.nro = o.nro 
			LEFT JOIN proveedor p 
			  ON od.codruc = p.codruc 
			LEFT JOIN 
			  (SELECT DISTINCT 
				p.Codpro AS codpro,
				p.CodFab AS codfab,
				p.DesPro AS descripcion,
				tb.Des_Larga AS color,
				tb2.Des_Corta AS unidad,
				ROUND(p.CodAlm01, 4) AS stock 
			  FROM
				producto AS p,
				Tabla_M_Detalle AS tb,
				Tabla_M_Detalle AS tb1,
				Tabla_M_Detalle AS tb2 
			  WHERE tb.Cod_Tabla IN ('TCOL') 
				AND tb2.Cod_Tabla IN ('TUND') 
				AND tb1.Cod_Tabla IN ('TSUB') 
				AND tb.Cod_Argumento = p.ColPro 
				AND tb2.Cod_Argumento = p.UndPro 
				AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
				AND p.estpro = '1') AS p 
			  ON od.codpro = p.codpro 
			LEFT JOIN Tabla_M_Detalle AS t3 
			  ON od.Cod_Local = t3.Cod_Local 
			  AND od.Cod_Entidad = t3.Cod_Entidad 
			  AND od.estac = t3.Des_Corta 
		  WHERE o.estoco = '03' 
			AND od.estoco = '03' 
			AND (
			  t3.Cod_Tabla = 'EOC1' 
			  OR t3.Cod_Tabla IS NULL
			) 
            AND DATE(o.fecemi) like '%$fechaFinal%'  
			ORDER BY o.fecemi DESC");

			$stmt->bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$fechaActual = new DateTime();
			$fechaActual->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if ($fechaFinalMasUno == $fechaActualMasUno) {

				$stmt = Conexion::conectar()->prepare("SELECT 
				od.nro,
				DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
				DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecllegada,
				p.razpro,
				od.codpro,
				od.codfab,
				p.descripcion,
				p.color,
				p.unidad,
				p.stock,
				od.prepro,
				od.canpro AS cantidad_pedida,
				(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
				od.cantni AS saldo,
				t3.Des_Larga AS estado 
			  FROM
				ocomdet od 
				LEFT JOIN ocompra o 
				  ON od.nro = o.nro 
				LEFT JOIN proveedor p 
				  ON od.codruc = p.codruc 
				LEFT JOIN 
				  (SELECT DISTINCT 
					p.Codpro AS codpro,
					p.CodFab AS codfab,
					p.DesPro AS descripcion,
					tb.Des_Larga AS color,
					tb2.Des_Corta AS unidad,
					ROUND(p.CodAlm01, 4) AS stock 
				  FROM
					producto AS p,
					Tabla_M_Detalle AS tb,
					Tabla_M_Detalle AS tb1,
					Tabla_M_Detalle AS tb2 
				  WHERE tb.Cod_Tabla IN ('TCOL') 
					AND tb2.Cod_Tabla IN ('TUND') 
					AND tb1.Cod_Tabla IN ('TSUB') 
					AND tb.Cod_Argumento = p.ColPro 
					AND tb2.Cod_Argumento = p.UndPro 
					AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
					AND p.estpro = '1') AS p 
				  ON od.codpro = p.codpro 
				LEFT JOIN Tabla_M_Detalle AS t3 
				  ON od.Cod_Local = t3.Cod_Local 
				  AND od.Cod_Entidad = t3.Cod_Entidad 
				  AND od.estac = t3.Des_Corta 
			  WHERE o.estoco = '03' 
				AND od.estoco = '03' 
				AND (
				  t3.Cod_Tabla = 'EOC1' 
				  OR t3.Cod_Tabla IS NULL
				) 
                AND DATE(o.fecemi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
			  ORDER BY o.fecemi DESC");
			} else {


				$stmt = Conexion::conectar()->prepare("SELECT 
				od.nro,
				DATE_FORMAT(o.fecemi, '%d/%m/%Y') AS fecemi,
				DATE_FORMAT(o.fecllegada, '%d/%m/%Y') AS fecllegada,
				p.razpro,
				od.codpro,
				od.codfab,
				p.descripcion,
				p.color,
				p.unidad,
				p.stock,
				od.prepro,
				od.canpro AS cantidad_pedida,
				(od.canpro - od.cantni) + (od.excni) AS cantidad_recibida,
				od.cantni AS saldo,
				t3.Des_Larga AS estado 
			  FROM
				ocomdet od 
				LEFT JOIN ocompra o 
				  ON od.nro = o.nro 
				LEFT JOIN proveedor p 
				  ON od.codruc = p.codruc 
				LEFT JOIN 
				  (SELECT DISTINCT 
					p.Codpro AS codpro,
					p.CodFab AS codfab,
					p.DesPro AS descripcion,
					tb.Des_Larga AS color,
					tb2.Des_Corta AS unidad,
					ROUND(p.CodAlm01, 4) AS stock 
				  FROM
					producto AS p,
					Tabla_M_Detalle AS tb,
					Tabla_M_Detalle AS tb1,
					Tabla_M_Detalle AS tb2 
				  WHERE tb.Cod_Tabla IN ('TCOL') 
					AND tb2.Cod_Tabla IN ('TUND') 
					AND tb1.Cod_Tabla IN ('TSUB') 
					AND tb.Cod_Argumento = p.ColPro 
					AND tb2.Cod_Argumento = p.UndPro 
					AND SUBSTRING(p.CodFab, 4, 3) = tb1.Valor_3 
					AND p.estpro = '1') AS p 
				  ON od.codpro = p.codpro 
				LEFT JOIN Tabla_M_Detalle AS t3 
				  ON od.Cod_Local = t3.Cod_Local 
				  AND od.Cod_Entidad = t3.Cod_Entidad 
				  AND od.estac = t3.Des_Corta 
			  WHERE o.estoco = '03' 
				AND od.estoco = '03' 
				AND (
				  t3.Cod_Tabla = 'EOC1' 
				  OR t3.Cod_Tabla IS NULL
				) 
                AND DATE(o.fecemi) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  ORDER BY o.fecemi DESC");
			}

			$stmt->execute();

			return $stmt->fetchAll();
		}
	}



	/*=============================================
	MOSTRAR DESTINO PARA LA MATERIA EN LA NOTA DE SALIDA
	=============================================*/

	static public function mdlMostrarMateriasCompras($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT   Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv1 AS PrecioSinIgv, Producto.CodAlm01, Proveedor.RazPro , Proveedor.CodRuc, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
    FROM Producto, Tabla_M_Detalle AS Tabla_M_Detalle_2,Tabla_M_Detalle AS Tabla_M_Detalle_4, proveedor, preciomp 
    WHERE Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND (Tabla_M_Detalle_2.Cod_Tabla = 'TUND') 
    AND (Tabla_M_Detalle_4.Cod_Tabla = 'TCOL')
    AND Preciomp.CodPro= Producto.CodPro 
    AND Proveedor.CodRuc= preciomp.CodProv1
    AND Producto.estpro NOT LIKE '2'
    AND Proveedor.CodRuc='$valor'
    UNION ALL
    SELECT DISTINCT  Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv2 AS PrecioSinIgv,  Producto.CodAlm01, Proveedor.RazPro, Proveedor.CodRuc, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
    FROM Producto, Tabla_M_Detalle AS Tabla_M_Detalle_2,Tabla_M_Detalle AS Tabla_M_Detalle_4, proveedor, preciomp 
    WHERE Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND (Tabla_M_Detalle_2.Cod_Tabla = 'TUND') 
    AND (Tabla_M_Detalle_4.Cod_Tabla = 'TCOL') 
    AND Preciomp.CodPro= Producto.CodPro 
    AND Proveedor.CodRuc= preciomp.CodProv2
    AND Producto.estpro NOT LIKE '2'
    AND Proveedor.CodRuc='$valor'
    UNION ALL
    SELECT DISTINCT  Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv3 AS PrecioSinIgv ,  Producto.CodAlm01, Proveedor.RazPro, Proveedor.CodRuc, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
    FROM Producto, Tabla_M_Detalle AS Tabla_M_Detalle_2,Tabla_M_Detalle AS Tabla_M_Detalle_4, proveedor, preciomp 
    WHERE Producto.UndPro = Tabla_M_Detalle_2.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND Producto.ColPro = Tabla_M_Detalle_4.Cod_Argumento 
    AND (Tabla_M_Detalle_2.Cod_Tabla = 'TUND') 
    AND (Tabla_M_Detalle_4.Cod_Tabla = 'TCOL') 
    AND Preciomp.CodPro= Producto.CodPro 
    AND Proveedor.CodRuc= preciomp.CodProv3
    AND Proveedor.CodRuc='$valor'
    AND Producto.estpro NOT LIKE '2'
    ORDER BY CodPro ASC  ");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}

	// Método para guardar la orden de compra
	static public function mdlGuardarOrdenCompra($datos)
	{

		$sql = "INSERT INTO ocompra(Tip,Ser,Nro,Cod_Local,Cod_Entidad,CodRuc,FecEmi,tCambio,Mo,Obser,pIgv,SubTotal,Igv,Total,mtopago,Centcosto,Cantidad,NroProforma,FecLlegada,TipPago,Dia,EstOco,EstReg,FecReg,UsuReg,PcReg,estac) VALUES (:Tip,:Ser,:Nro,:Cod_Local,:Cod_Entidad,:CodRuc,:FecEmi,:tCambio,:Mo,UPPER(:Obser),:pIgv,:SubTotal,:Igv,:Total,:mtopago,:Centcosto,:Cantidad,UPPER(:NroProforma),:FecLlegada,:TipPago,UPPER(:Dia),:EstOco,:EstReg,:FecReg,:UsuReg,:PcReg,:estac)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Tip", $datos["Tip"], PDO::PARAM_STR);
		$stmt->bindParam(":Ser", $datos["Ser"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi", $datos["FecEmi"], PDO::PARAM_STR);
		$stmt->bindParam(":tCambio", $datos["tCambio"], PDO::PARAM_STR);
		$stmt->bindParam(":Mo", $datos["Mo"], PDO::PARAM_STR);
		$stmt->bindParam(":Obser", $datos["Obser"], PDO::PARAM_STR);
		$stmt->bindParam(":pIgv", $datos["pIgv"], PDO::PARAM_STR);
		$stmt->bindParam(":SubTotal", $datos["SubTotal"], PDO::PARAM_STR);
		$stmt->bindParam(":Igv", $datos["Igv"], PDO::PARAM_STR);
		$stmt->bindParam(":Total", $datos["Total"], PDO::PARAM_STR);
		$stmt->bindParam(":mtopago", $datos["mtopago"], PDO::PARAM_STR);
		$stmt->bindParam(":Centcosto", $datos["Centcosto"], PDO::PARAM_STR);
		$stmt->bindParam(":Cantidad", $datos["Cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":NroProforma", $datos["NroProforma"], PDO::PARAM_STR);
		$stmt->bindParam(":FecLlegada", $datos["FecLlegada"], PDO::PARAM_STR);
		$stmt->bindParam(":TipPago", $datos["TipPago"], PDO::PARAM_STR);
		$stmt->bindParam(":Dia", $datos["Dia"], PDO::PARAM_STR);
		$stmt->bindParam(":EstOco", $datos["EstOco"], PDO::PARAM_STR);
		$stmt->bindParam(":EstReg", $datos["EstReg"], PDO::PARAM_STR);
		$stmt->bindParam(":FecReg", $datos["FecReg"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg", $datos["UsuReg"], PDO::PARAM_STR);
		$stmt->bindParam(":PcReg", $datos["PcReg"], PDO::PARAM_STR);
		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	// Método para guardar el detalle de orden de compra
	static public function mdlGuardarDetalleOrdenCompra($datos)
	{

		$sql = "INSERT INTO ocomdet(Item,Tip,Ser,Nro,ColProv,Cod_Local,Cod_Entidad,CodRuc,CodPro,CodFab,UndPro,CanPro,CanPro_Ant,PrePro,PrePro_Ant,DscPro,ImpPro,EstOco,CantNI,SalCan,FecEmi,estac,FecReg,UsuReg,PcReg) VALUES (:Item,:Tip,:Ser,:Nro,:ColProv,:Cod_Local,:Cod_Entidad,:CodRuc,:CodPro,:CodFab,:UndPro,:CanPro,:CanPro_Ant,:PrePro,:PrePro_Ant,:DscPro,:ImpPro,:EstOco,:CantNI,:SalCan,:FecEmi,:estac,:FecReg,:UsuReg,:PcReg)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Item", $datos["Item"], PDO::PARAM_STR);
		$stmt->bindParam(":Tip", $datos["Tip"], PDO::PARAM_STR);
		$stmt->bindParam(":Ser", $datos["Ser"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":ColProv", $datos["ColProv"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodFab", $datos["CodFab"], PDO::PARAM_STR);
		$stmt->bindParam(":UndPro", $datos["UndPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CanPro", $datos["CanPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CanPro_Ant", $datos["CanPro_Ant"], PDO::PARAM_STR);
		$stmt->bindParam(":PrePro", $datos["PrePro"], PDO::PARAM_STR);
		$stmt->bindParam(":PrePro_Ant", $datos["PrePro_Ant"], PDO::PARAM_STR);
		$stmt->bindParam(":DscPro", $datos["DscPro"], PDO::PARAM_STR);
		$stmt->bindParam(":ImpPro", $datos["ImpPro"], PDO::PARAM_STR);
		$stmt->bindParam(":EstOco", $datos["EstOco"], PDO::PARAM_STR);
		$stmt->bindParam(":CantNI", $datos["CantNI"], PDO::PARAM_STR);
		$stmt->bindParam(":SalCan", $datos["SalCan"], PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi", $datos["FecEmi"], PDO::PARAM_STR);
		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);
		$stmt->bindParam(":FecReg", $datos["FecReg"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg", $datos["UsuReg"], PDO::PARAM_STR);
		$stmt->bindParam(":PcReg", $datos["PcReg"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	/*=============================================
	MOSTRAR ULTIMO NRO DE ORDEN DE COMPRA
	=============================================*/

	static public function mdlMostrarUltimoNro()
	{


		$stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX(Nro),'000001') AS Nro FROM ocompra");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	CERRAR ORDEN DE COMPRA
	=============================================*/

	static public function mdlCerrarOrdenCompra($datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE ocompra SET estac = :estac , UsuCer = :UsuCer, FecCer = :FecCer , PcCer = :PcCer WHERE Nro = :Nro");

		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuCer", $datos["UsuCer"], PDO::PARAM_STR);
		$stmt->bindParam(":FecCer", $datos["FecCer"], PDO::PARAM_STR);
		$stmt->bindParam(":PcCer", $datos["PcCer"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	CERRAR DETALLE ORDEN DE COMPRA
	=============================================*/

	static public function mdlCerrarDetalleOrdenCompra($datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE ocomdet SET estac = :estac WHERE Nro = :Nro");

		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	CERRAR DETALLE ORDEN DE COMPRA
	=============================================*/

	static public function mdlCerrarDetalleOrdenCompra2($datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE ocomdet SET estac = :estac WHERE Nro = :Nro AND CodPro = :CodPro");

		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ANULAR ORDEN DE COMPRA
	=============================================*/

	static public function mdlAnularOrdenCompra($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET EstOco = :EstOco , FecAnulacion = :FecAnulacion,FecAnu = :FecAnu, UsuAnu = :UsuAnu, PcAnu = :PcAnu WHERE Nro = :Nro");

		$stmt->bindParam(":EstOco", $datos["EstOco"], PDO::PARAM_STR);
		$stmt->bindParam(":FecAnulacion", $datos["FecAnulacion"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":FecAnu", $datos["FecAnu"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuAnu", $datos["UsuAnu"], PDO::PARAM_STR);
		$stmt->bindParam(":PcAnu", $datos["PcAnu"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	// Método para guardar las ventas
	static public function mdlEditarOrdenCompra($datos)
	{

		$sql = "UPDATE ocompra SET Nro = :Nro,CodRuc = :CodRuc,FecEmi = :FecEmi,Mo = :Mo,Obser = UPPER(:Obser),SubTotal = :SubTotal,Igv = :Igv,Total = :Total,Centcosto = :Centcosto,NroProforma = UPPER(:NroProforma),FecLlegada = :FecLlegada,TipPago = :TipPago,Dia = UPPER(:Dia),FecMod = :FecMod,UsuMod = :UsuMod,PcMod = :PcMod WHERE Nro = :Nro";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi", $datos["FecEmi"], PDO::PARAM_STR);
		$stmt->bindParam(":Mo", $datos["Mo"], PDO::PARAM_STR);
		$stmt->bindParam(":Obser", $datos["Obser"], PDO::PARAM_STR);
		$stmt->bindParam(":SubTotal", $datos["SubTotal"], PDO::PARAM_STR);
		$stmt->bindParam(":Igv", $datos["Igv"], PDO::PARAM_STR);
		$stmt->bindParam(":Total", $datos["Total"], PDO::PARAM_STR);
		$stmt->bindParam(":Centcosto", $datos["Centcosto"], PDO::PARAM_STR);
		$stmt->bindParam(":NroProforma", $datos["NroProforma"], PDO::PARAM_STR);
		$stmt->bindParam(":FecLlegada", $datos["FecLlegada"], PDO::PARAM_STR);
		$stmt->bindParam(":TipPago", $datos["TipPago"], PDO::PARAM_STR);
		$stmt->bindParam(":Dia", $datos["Dia"], PDO::PARAM_STR);
		$stmt->bindParam(":FecMod", $datos["FecMod"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuMod", $datos["UsuMod"], PDO::PARAM_STR);
		$stmt->bindParam(":PcMod", $datos["PcMod"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	// Método para guardar el detalle de orden de compra al editar
	static public function mdlGuardarDetalleOrdenCompra2($datos)
	{

		$sql = "INSERT INTO ocomdet(Item,Tip,Ser,Nro,ColProv,Cod_Local,Cod_Entidad,CodRuc,CodPro,CodFab,UndPro,CanPro,CanPro_Ant,PrePro,PrePro_Ant,DscPro,ImpPro,EstOco,CantNI,SalCan,FecEmi,estac,FecMod,UsuMod,PcMod) VALUES (:Item,:Tip,:Ser,:Nro,:ColProv,:Cod_Local,:Cod_Entidad,:CodRuc,:CodPro,:CodFab,:UndPro,:CanPro,:CanPro_Ant,:PrePro,:PrePro_Ant,:DscPro,:ImpPro,:EstOco,:CantNI,:SalCan,:FecEmi,:estac,:FecMod,:UsuMod,:PcMod)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Item", $datos["Item"], PDO::PARAM_STR);
		$stmt->bindParam(":Tip", $datos["Tip"], PDO::PARAM_STR);
		$stmt->bindParam(":Ser", $datos["Ser"], PDO::PARAM_STR);
		$stmt->bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt->bindParam(":ColProv", $datos["ColProv"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":CodPro", $datos["CodPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CodFab", $datos["CodFab"], PDO::PARAM_STR);
		$stmt->bindParam(":UndPro", $datos["UndPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CanPro", $datos["CanPro"], PDO::PARAM_STR);
		$stmt->bindParam(":CanPro_Ant", $datos["CanPro_Ant"], PDO::PARAM_STR);
		$stmt->bindParam(":PrePro", $datos["PrePro"], PDO::PARAM_STR);
		$stmt->bindParam(":PrePro_Ant", $datos["PrePro_Ant"], PDO::PARAM_STR);
		$stmt->bindParam(":DscPro", $datos["DscPro"], PDO::PARAM_STR);
		$stmt->bindParam(":ImpPro", $datos["ImpPro"], PDO::PARAM_STR);
		$stmt->bindParam(":EstOco", $datos["EstOco"], PDO::PARAM_STR);
		$stmt->bindParam(":CantNI", $datos["CantNI"], PDO::PARAM_STR);
		$stmt->bindParam(":SalCan", $datos["SalCan"], PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi", $datos["FecEmi"], PDO::PARAM_STR);
		$stmt->bindParam(":estac", $datos["estac"], PDO::PARAM_STR);
		$stmt->bindParam(":FecMod", $datos["FecMod"], PDO::PARAM_STR);
		$stmt->bindParam(":UsuMod", $datos["UsuMod"], PDO::PARAM_STR);
		$stmt->bindParam(":PcMod", $datos["PcMod"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	// Método para eliminar un detalle de venta
	static public function mdlEliminarDato($tabla, $item, $valor)
	{

		$sql = "DELETE FROM $tabla WHERE $item=:$item";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	/*=============================================
	MOSTRAR DESTINO PARA LA MATERIA EN LA NOTA DE SALIDA
	=============================================*/

	static public function mdlMpOcPendiente()
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
		ocd.codpro,
		p.codfab AS codfab,
  		p.despro AS despro,
		p.undpro,
		p.colpro,
		(SELECT 
		  des_corta 
		FROM
		  tabla_m_detalle td 
		WHERE cod_tabla = 'TUND' 
		  AND p.undpro = td.cod_argumento) AS unidad,
		(SELECT 
		  des_larga 
		FROM
		  tabla_m_detalle td 
		WHERE cod_tabla = 'TCOL' 
		  AND p.colpro = td.cod_argumento) AS color,
		ocd.PrePro AS precio,
		ocd.cantni,
		ocd.estac,
		ocd.nro,
		prov.RazPro AS proveedor,
		DATE(oc.FecEmi) AS fecemi,
		DATE(oc.Fecllegada) AS fecllegada 
	  FROM
		ocompra oc 
		LEFT JOIN ocomdet ocd 
		  ON oc.nro = ocd.nro 
		LEFT JOIN 
		  (SELECT 
			pro.CodPro,
			pro.CodFab,
			pro.DesPro,
			pro.undpro,
			pro.ColPro 
		  FROM
			producto pro ) AS p 
		  ON ocd.codpro = p.codpro 
		LEFT JOIN proveedor AS prov 
		  ON prov.codruc = ocd.codruc 
	  WHERE ocd.estac IN ('ABI', 'PAR') 
		AND ocd.estoco = '03'");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}
}
