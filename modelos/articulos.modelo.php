<?php

require_once "conexion.php";

class ModeloArticulos
{

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function mdlMostrarArticulos($valor)
	{


		if ($valor != null) {

			$stmt = Conexion::conectar()->prepare("CALL sp_1036_consulta_articulos_p(:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1037_consulta_articulos()");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function MostrarModCol($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
							* 
						FROM
							articulojf a 
						WHERE a.articulo LIKE '%$valor%'");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}
	/*
	* MOSTRAR CANTIDAD DE PEDIDOS
	*/
	static public function mdlArticulosPedidos()
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1038_pedidos_unidades()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR CANTIDAD DE FALTANTES
	*/
	static public function mdlArticulosFaltantes($tabla)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1039_faltantes_unidades()");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/*
	* MOSTRAR ARTICULOS PENDIENTES DE TARJETAS
	*/
	static public function mdlMostrarSinTarjeta()
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1040_articulos_sin_tarjeta()");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}

	/*
	* REGISTRO DE ARTICULO
	*/
	static public function mdlIngresarArticulo($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1041_insert_articulos_p(:articulo, :id_marca,:marca, :modelo, :nombre, :cod_color, :color, :cod_talla, :talla)");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_marca", $datos["id_marca"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_color", $datos["cod_color"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_talla", $datos["cod_talla"], PDO::PARAM_STR);
		$stmt->bindParam(":talla", $datos["talla"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* Método para activar y desactivar un usuario
	*/
	static public function mdlActualizarArticulo($valor1, $valor2)
	{

		$sql = "CALL sp_1042_update_articulos_estado_p(:estado, :valor)";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":estado", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":valor", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt = null;
	}

	/* 
	* EDITAR ARTICULO
	*/
	static public function mdlEditarArticulo($datos)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1043_update_articulos_p(:nombre, :imagen, :valor)");

		$stmt->bindParam(":nombre", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":valor", $datos["articulo"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* BORRAR ARTICULO
	*/
	static public function mdlEliminarArticulo($datos)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1044_delete_articulos_p(:valor)");

		$stmt->bindParam(":valor", $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/* 
	* Método para actualizar un dato CON EL articulo
	*/
	static public function mdlActualizarUnDato($tabla, $item1, $valor1, $valor2)
	{

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE articulo=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar el  taller en ingresos
	*/
	static public function mdlRecuperarTaller($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						taller = taller + :cantidad
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar un cierre CON EL id
	*/
	static public function mdlActualizarUnCierre($tabla, $item1, $valor1, $valor2)
	{

		$sql = "UPDATE $tabla SET $item1=:$item1 WHERE id=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para recuperar un cierre CON EL id
	*/
	static public function mdlRecuperarUnCierre($tabla, $item1, $valor1, $valor2)
	{

		$sql = "UPDATE $tabla SET cantidad = cantidad + :cantidad WHERE id=:id";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":cantidad", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor2, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* METODO PARA VER LA CONFIGURACION DE LAS URGENCIAS
	*/
	static public function mdlConfiguracion()
	{

		$sql = "CALL sp_1045_consulta_urg_porc()";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/* 
	* CONFIGURAR PORCENTAJE DE URGENCIAS
	*/
	static public function mdlConfigurarUrgencia($dato)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1046_update_urg_porc($dato)");

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/
	static public function mdlMostrarArticulosUrgencia()
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1047_consulta_urgencia_articulos()");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE SERVICIOS O VENTAS
	*/
	static public function mdlMostrarArticulosServicio()
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1069_consulta_servicio_articulos()");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE SERVICIOS O VENTAS
	*/
	static public function mdlMostrarMPOC()
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
		dt.mat_pri,
		p.codfab,
		p.despro,
		p.colpro,
		(SELECT 
		  des_larga 
		FROM
		  tabla_m_detalle t 
		WHERE t.cod_tabla = 'TCOL' 
		  AND p.colpro = t.cod_argumento) AS color,
		p.talpro,
		(SELECT 
		  des_larga 
		FROM
		  tabla_m_detalle t 
		WHERE t.cod_tabla = 'TTAL' 
		  AND p.talpro = t.cod_argumento) AS talla,
		p.undpro,
		SUM(ao.cantidad * dt.consumo) AS consumo,
		p.codalm01 AS stock
	  FROM
		articulosorden ao 
		LEFT JOIN detalles_tarjetajf dt 
		  ON ao.articulo = dt.articulo 
		LEFT JOIN producto p 
		  ON dt.mat_pri = p.codpro 
		  WHERE LEFT(p.codfab, 3) IN (
			'BLO',
			'ELA',
			'SES',
			'TIR',
			'TEL',
			'MET',
			'PLA',
			'ETI'
		) 		  
	  GROUP BY dt.mat_pri ");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA DE ORDENES DE CORTE
	*/
	static public function mdlMostrarArticulosTaller($sectorIngreso)
	{
		if ($sectorIngreso == "T4" || $sectorIngreso == "T6" || $sectorIngreso == "T9" || $sectorIngreso == "T2" || $sectorIngreso == "T8" || $sectorIngreso == "T0" || $sectorIngreso == "TA" || $sectorIngreso == "T7" || $sectorIngreso == "T10" || $sectorIngreso == "TB" || $sectorIngreso == "T11" || $sectorIngreso == "T14") {

			$stmt = Conexion::conectar()->prepare("SELECT 
			a.articulo,
			cd.id,
			c.guia,
			a.modelo,
			a.cod_color,
			a.color,
			a.cod_talla,
			a.talla,
			a.stock,
			cd.cantidad AS taller,
			a.alm_corte,
			a.ord_corte 
			FROM
			  cierres_detallejf cd 
			  LEFT JOIN cierresjf c 
				ON cd.codigo = c.codigo 
			  LEFT JOIN articulojf a 
				ON cd.articulo = a.articulo 
			WHERE c.taller = '" . $sectorIngreso . "' 
			AND cd.cantidad > 0 
			ORDER BY c.guia, a.articulo;");

			$stmt->execute();

			return $stmt->fetchAll();
		} else {
			$stmt = Conexion::conectar()->prepare("SELECT 
			'' as id,
			a.articulo, 
			'' as guia,
			a.modelo,
			a.marca,
			a.nombre,
			a.color,
			a.talla,
			a.stock,
			a.taller,
			a.alm_corte,
			a.ord_corte FROM
			articulojf a 
			WHERE a.taller > 0");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarArticulosCierres($idCierre)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
		a.articulo,
		cd.id,
		c.guia,
		CONCAT(
			  a.modelo,
			  ' - ',
			  a.nombre,
			  ' - ',
			  a.color,
			  ' - ',
			  a.talla
			) AS packing, 
		a.talla,
		a.stock,
		cd.cantidad AS taller,
		a.alm_corte,
		a.ord_corte 
		FROM
			cierres_detallejf cd 
			LEFT JOIN cierresjf c 
			ON cd.codigo = c.codigo 
			LEFT JOIN articulojf a 
			ON cd.articulo = a.articulo 
		WHERE cd.id ='" . $idCierre . "'
		ORDER BY c.guia, a.articulo;");

		$stmt->execute();

		return $stmt->fetch();


		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA URGENCIA
	*/
	static public function mdlMostrarUrgencia($tabla, $valor, $modelo)
	{

		if ($valor == null && $modelo != "null") {

			$stmt = Conexion::conectar()->prepare("CALL sp_1048_cons_urg_art_porc(:modelo)");

			$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else if ($valor == null && $modelo == "null") {

			$stmt = Conexion::conectar()->prepare("SELECT 
			a.articulo,
			a.id_marca,
			m.marca,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			a.cod_talla,
			a.talla,
			a.servicio,
			a.estado,
			a.urgencia,
			a.mp_faltante,
			ROUND(
			  (
				IFNULL(a.ult_mes, 0) * a.urgencia / 100
			  ),
			  0
			) AS configuracion,
			CASE
			  WHEN a.stock < 0 
			  THEN 0 
			  ELSE a.stock 
			END AS stock,
			(a.stock - a.pedidos) AS stockB,
			a.pedidos,
			a.taller,
			a.alm_corte,
			a.ord_corte,
			a.proyeccion,
			IFNULL(a.prod, 0) AS prod,
			IFNULL(
			  ROUND(
				(IFNULL(a.prod, 0) / a.proyeccion) * 100,
				2
			  ),
			  0
			) AS avance,
			IFNULL(a.ult_mes, 0) AS ult_mes 
		  FROM
			articulojf a 
			LEFT JOIN marcasjf m 
			  ON a.id_marca = m.id 
		  WHERE ROUND(
			  (
				IFNULL(a.ult_mes, 0) * a.urgencia / 100
			  ),
			  0
			) > (a.stock - a.pedidos) 
			AND a.estado = 'Activo'");

			$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("CALL sp_1036_consulta_articulos_p(:valor)");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		}

		$stmt->close();
		$stmt = null;
	}


	/* 
	* MOSTRAR ARTICULOS PARA LA TABLA SEGUIMIENTO
	*/
	static public function mdlMostrarSeguimiento($valor)
	{

		if ($valor == "null") {

			$stmt = Conexion::conectar()->prepare("SELECT 
			a.articulo,
			a.marca,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			a.talla,
			a.proyeccion,
			ROUND(IFNULL(a.prod, 0), 0) AS prod,
			IFNULL(
			  ROUND(
				((ROUND(a.prod, 0) / a.proyeccion) * 100),
				2
			  ),
			  0
			) AS avance,
			a.stock,
			a.pedidos,
			(a.stock - a.pedidos) AS stockB,
			a.ord_corte,
			a.alm_corte,
			a.taller,
			a.servicio,
			IFNULL(ROUND(a.ult_mes, 0), 0) AS ventas,
			a.urgencia,
			ROUND(
			  (
				(
				  IFNULL((a.stock - a.pedidos) / a.ult_mes, 0)
				) * 100
			  ),
			  2
			) AS xprog,
			ROUND(
			  (
				IFNULL(a.ult_mes, 0) * a.urgencia / 100
			  ),
			  0
			) AS configuracion,
			a.mes,
			ROUND(
				((a.ult_mes * a.urgencia / 100) * 3) - (
				(a.stock - a.pedidos) + a.alm_corte + a.servicio + a.taller
				),
				0
			) AS faltantes,
			ROUND(
				(
				(a.stock - a.pedidos) + a.taller + servicio + a.alm_corte
				) / (a.ult_mes * a.urgencia / 100),
				1
			) AS dura_tc,
			a.mp_faltante,
			a.ult_mes,
			a.estado,
			a.alerta  
		  FROM
			articulojf a 
		  WHERE a.estado = 'ACTIVO' 
			AND a.marca IN ('JACKYFORM', 'VASCO', 'GUAPITAS','ROSALINDA','ROSITAS','JOSXX')
		  ORDER BY a.articulo ASC");

			$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT 
			a.articulo,
			a.marca,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			a.talla,
			a.proyeccion,
			ROUND(IFNULL(a.prod, 0), 0) AS prod,
			IFNULL(
			  ROUND(
				((ROUND(a.prod, 0) / a.proyeccion) * 100),
				2
			  ),
			  0
			) AS avance,
			a.stock,
			a.pedidos,
			(a.stock - a.pedidos) AS stockB,
			a.ord_corte,
			a.alm_corte,
			a.taller,
			a.servicio,
			IFNULL(ROUND(a.ult_mes, 0), 0) AS ventas,
			a.urgencia,
			ROUND(
			  (
				(
				  IFNULL((a.stock - a.pedidos) / a.ult_mes, 0)
				) * 100
			  ),
			  2
			) AS xprog,
			ROUND(
			  (
				IFNULL(a.ult_mes, 0) * a.urgencia / 100
			  ),
			  0
			) AS configuracion,
			a.mes,
			ROUND(
				((a.ult_mes * a.urgencia / 100) * 3) - (
				(a.stock - a.pedidos) + a.alm_corte + a.servicio + a.taller
				),
				0
			) AS faltantes,
			ROUND(
				(
				(a.stock - a.pedidos) + a.taller + servicio + a.alm_corte
				) / (a.ult_mes * a.urgencia / 100),
				1
			) AS dura_tc,
			a.mp_faltante,
			a.ult_mes,
			a.estado,
			a.alerta  
		  FROM
			articulojf a 
		  WHERE a.estado = 'ACTIVO' 
			AND a.marca IN ('JACKYFORM', 'VASCO', 'GUAPITAS','ROSALINDA','ROSITAS','JOSXX')
			AND a.modelo = :valor
		  ORDER BY a.articulo ASC");

			$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	/* 
	* MOSTRAR EL DETALLE DE LAS URGENCIAS
	*/
	static public function mdlVisualizarUrgenciasDetalle($valor)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1049_detalle_mp_articulo_urg_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA PEDIDOS
	*/
	static public function mdlListaArticulosPedidos()
	{

		$sql = "CALL sp_1050_mod_color_talla()";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/* 
	* MOSTRAR COLORES
	*/
	static public function mdlVerColores($valor)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1051_mod_cant_col_tal_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/* 
	* MOSTRAR COLORES Y CANTIDADES
	*/
	static public function mdlVerColoresCantidades($pedido, $modelo)
	{

		if ($pedido != null) {

			$sql = "SELECT 
		a.modelo,
		a.cod_color,
		a.color,
		SUM(
		  CASE
			WHEN a.cod_talla = '1' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t1,
		SUM(
		  CASE
			WHEN a.cod_talla = '2' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t2,
		SUM(
		  CASE
			WHEN a.cod_talla = '3' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t3,
		SUM(
		  CASE
			WHEN a.cod_talla = '4' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t4,
		SUM(
		  CASE
			WHEN a.cod_talla = '5' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t5,
		SUM(
		  CASE
			WHEN a.cod_talla = '6' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t6,
		SUM(
		  CASE
			WHEN a.cod_talla = '7' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t7,
		SUM(
		  CASE
			WHEN a.cod_talla = '8' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t8,
		SUM(
		  CASE
			WHEN a.cod_talla = '1' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v1,
		SUM(
		  CASE
			WHEN a.cod_talla = '2' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v2,
		SUM(
		  CASE
			WHEN a.cod_talla = '3' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v3,
		SUM(
		  CASE
			WHEN a.cod_talla = '4' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v4,
		SUM(
		  CASE
			WHEN a.cod_talla = '5' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v5,
		SUM(
		  CASE
			WHEN a.cod_talla = '6' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v6,
		SUM(
		  CASE
			WHEN a.cod_talla = '7' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v7,
		SUM(
		  CASE
			WHEN a.cod_talla = '8' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v8 
	  FROM
		articulojf a 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			detalle_temporal t 
		  WHERE codigo = :pedido) AS t 
		  ON a.articulo = t.articulo 
	  WHERE a.modelo LIKE '%" . $modelo . "%'
		/* AND a.estado = 'activo'  */
	  GROUP BY a.modelo,
		a.cod_color,
		a.color";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->bindParam(":pedido", $pedido, PDO::PARAM_STR);
			//$stmt->bindParam(":modelo",$modelo,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$sql = "SELECT 
			a.modelo,
			a.cod_color,
			a.color,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t8,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v8 
		  FROM
			articulojf a 
		  WHERE a.modelo LIKE '%" . $modelo . "%'
			/* AND a.estado = 'activo' */ 
		  GROUP BY a.modelo,
			a.cod_color,
			a.color";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		}


		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA PEDIDOS
	*/
	static public function mdlVerArticulos($valor)
	{

		$stmt = Conexion::conectar()->prepare("CALL sp_1052_mod_articulos_p(:valor)");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS PARA PEDIDOS
	*/
	static public function mdlVerArticulosB($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
						a.modelo,
						a.articulo 
					FROM
						articulojf a 
					WHERE a.modelo = :valor
						/* AND a.estado = 'Activo' */");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;
	}

	/* 
	* MOSTRAR PRECIOS
	*/
	static public function mdlVerPrecios($modelo, $lista)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
											id,
											modelo,
											$lista as precio
										FROM
											preciojf where modelo like '%$modelo%' ");

		$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt = null;
	}

	/* 
	* Método para actualizar el corte y taller
	*/
	static public function mdlActualizarTallerCorte($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						taller = taller + :cantidad,
						alm_corte = alm_corte - :cantidad 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar el corte y taller
	*/
	static public function mdlActualizarServicioCorte($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						servicio = servicio + :cantidad,
						alm_corte = alm_corte - :cantidad 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar el corte y taller
	*/
	static public function mdlActualizarTallerEliminado($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						taller = taller - :cantidad,
						alm_corte = alm_corte + :cantidad 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar el corte y servicio
	*/
	static public function mdlActualizarServicioEliminado($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						servicio = servicio - :cantidad,
						alm_corte = alm_corte + :cantidad 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* MOSTRAR PRODUCCION
	*/
	static public function mdlMostrarProduccion($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
													m.articulo,
													SUM(m.cantidad) AS prod 
												FROM
													movimientosjf m 
												WHERE m.tipo IN ('E20') 
													AND m.fecha > '2020-08-13'
													AND m.articulo = :valor 
												GROUP BY m.articulo");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt = null;
	}

	/* 
	* MOSTRAR VENTAS
	*/
	static public function mdlMostrarVentas($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
													m.articulo,
													SUM(m.cantidad) AS vtas
												FROM
													movimientosjf m 
												WHERE m.tipo IN ('S02', 'S03', 'S70') 
													AND DATEDIFF(DATE(NOW()), m.fecha) <= 31 
													AND m.articulo = :valor
												GROUP BY m.articulo");

		$stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS - SIMPLE
	*/
	static public function mdlMostrarArticulosSimple($orden)
	{


		$stmt = Conexion::conectar()->prepare("SELECT 
			a.articulo,
			CONCAT(
			  a.articulo,
			  ' - ',
			  a.nombre,
			  ' - ',
			  a.color,
			  ' - ',
			  a.talla
			) AS packing 
		  FROM
			articulojf a 
		  WHERE a.articulo NOT IN 
			(SELECT 
			  articulo 
			FROM
			  detalles_ordencortejf o 
			WHERE o.ordencorte = :orden) 
			AND a.estado = 'Activo' 
			AND id_marca IN ('1', '2', '3','10','11','12') ");

		$stmt->bindParam(":orden", $orden, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();

		$stmt = null;
	}

	/* 
	* Método para actualizar la cantidad de orden de corte
	*/
	static public function mdlActualizarOrdenCorte($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						ord_corte = ord_corte + (:cantidad) 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/* 
	* Método para actualizar la cantidad de ord_corte
	*/
	static public function mdlSumOc($articulo, $cantidad)
	{

		$sql = "UPDATE 
						articulojf 
					SET
						ord_corte = ord_corte + :cantidad 
					WHERE articulo = :articulo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

		$stmt->execute();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE PEDIDOS DEL ARTICULO
	*/
	static public function mdlActualizarCantPedidos($articulo, $pedidos)
	{

		$sql = "UPDATE
						articulojf
					SET
						pedidos = :pedidos
					WHERE articulo = :articulo";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":pedidos", $pedidos, PDO::PARAM_STR);

		$stmt->execute();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE STOCK DEL ARTICULO
	*/
	static public function mdlActualizarStock($datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													stock = stock - :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE STOCK DEL ARTICULO
	*/
	static public function mdlActualizarPedido($datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													pedidos = pedidos - :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE STOCK DEL ARTICULO
	*/
	static public function mdlActualizarStockIngreso($valor1, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													stock = stock + :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE TALLER DEL ARTICULO
	*/
	static public function mdlActualizarTallerIngreso($valor1, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													taller = taller + :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* ACTUALIZAR LA CANTIDAD DE SERVICOP DE ARTICULO
	*/
	static public function mdlActualizarArticuloServicio($valor1, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													servicio = servicio - :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* ACTUALIZAR ESTADO CORTE
	*/
	static public function mdlCorteIncompleto($codigo, $estado)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													alerta = :estado
												WHERE articulo = :codigo");

		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
		$stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* * RECUPERAMOS LA CANTIDAD DE SERVICOP DE ARTICULO
	*/
	static public function mdlRecuperarArticuloServicio($valor1, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE
													articulojf
												SET
													servicio = servicio + :cantidad
												WHERE articulo = :articulo");

		$stmt->bindParam(":articulo", $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}


	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function mdlMostrarArticulosTallerP()
	{



		$stmt = Conexion::conectar()->prepare("SELECT 
												et.articulo,
												a.modelo,
												a.cod_color,
												a.color,
												a.cod_talla,
												a.talla 
											FROM
												entallerjf et 
												LEFT JOIN articulojf a 
												ON et.articulo = a.articulo 
											WHERE et.estado = 1
											AND et.total_precio > 0 
											GROUP BY et.articulo");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}

	/* 
	* MOSTRAR ARTICULOS
	*/
	static public function mdlMostrarArticulosTicket()
	{



		$stmt = Conexion::conectar()->prepare("SELECT 
												articulo,
												modelo,
												color,
												talla
											FROM
												articulojf
										 	WHERE estado = 'Activo'");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}

	/*
	* CONFIGURAR MP FALTANTE
	*/
	static public function mdlMpFaltante($modelo, $faltante)
	{

		$sql = "UPDATE
					articulojf
				SET
					mp_faltante = :faltante
				WHERE articulo LIKE :modelo ";

		$stmt = Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":modelo", $modelo, PDO::PARAM_STR);
		$stmt->bindParam(":faltante", $faltante, PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/* 
	* MOSTRAR COLORES Y CANTIDADES
	*/
	static public function mdlVerColoresCantidades2($salida, $modelo)
	{

		if ($salida != null) {

			$sql = "SELECT 
		a.modelo,
		a.cod_color,
		a.color,
		SUM(
		  CASE
			WHEN a.cod_talla = '1' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t1,
		SUM(
		  CASE
			WHEN a.cod_talla = '2' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t2,
		SUM(
		  CASE
			WHEN a.cod_talla = '3' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t3,
		SUM(
		  CASE
			WHEN a.cod_talla = '4' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t4,
		SUM(
		  CASE
			WHEN a.cod_talla = '5' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t5,
		SUM(
		  CASE
			WHEN a.cod_talla = '6' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t6,
		SUM(
		  CASE
			WHEN a.cod_talla = '7' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t7,
		SUM(
		  CASE
			WHEN a.cod_talla = '8' 
			THEN '1' 
			ELSE '0' 
		  END
		) AS t8,
		SUM(
		  CASE
			WHEN a.cod_talla = '1' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v1,
		SUM(
		  CASE
			WHEN a.cod_talla = '2' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v2,
		SUM(
		  CASE
			WHEN a.cod_talla = '3' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v3,
		SUM(
		  CASE
			WHEN a.cod_talla = '4' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v4,
		SUM(
		  CASE
			WHEN a.cod_talla = '5' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v5,
		SUM(
		  CASE
			WHEN a.cod_talla = '6' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v6,
		SUM(
		  CASE
			WHEN a.cod_talla = '7' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v7,
		SUM(
		  CASE
			WHEN a.cod_talla = '8' 
			THEN t.cantidad 
			ELSE '0' 
		  END
		) AS v8 
	  FROM
		articulojf a 
		LEFT JOIN 
		  (SELECT 
			* 
		  FROM
			detalle_ing_sal t 
		  WHERE codigo = $salida) AS t 
		  ON a.articulo = t.articulo 
	  WHERE a.modelo = '" . $modelo . "'
	  GROUP BY a.modelo,
		a.cod_color,
		a.color";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$sql = "SELECT 
			a.modelo,
			a.cod_color,
			a.color,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN '1' 
				ELSE '0' 
			  END
			) AS t8,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN '0' 
				ELSE '0' 
			  END
			) AS v8 
		  FROM
			articulojf a 
		  WHERE a.modelo = '" . $modelo . "' 
		  GROUP BY a.modelo,
			a.cod_color,
			a.color";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt = null;
	}

	/*
	* BAJAR EL STOCK y CANT EN PEDIDO
	*/
	static public function mdlActualizarStockPedido($codigo)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE 
									articulojf a 
									LEFT JOIN 
									(SELECT 
										articulo,
										cantidad 
									FROM
										detalle_temporal 
									WHERE codigo = :codigo) AS dt 
									ON a.articulo = dt.articulo SET a.stock = a.stock - dt.cantidad,
									a.pedidos = a.pedidos - dt.cantidad WHERE dt.articulo IS NOT NULL");

		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*
	* SUBIR EL STOCK y CANT EN PEDIDO
	*/
	static public function mdlActualizarStockPedidoB($codigo)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE 
									articulojf a 
									LEFT JOIN 
									(SELECT 
										articulo,
										cantidad 
									FROM
										detalle_temporal 
									WHERE codigo = :codigo) AS dt 
									ON a.articulo = dt.articulo SET a.stock = a.stock + dt.cantidad,
									a.pedidos = a.pedidos - dt.cantidad WHERE dt.articulo IS NOT NULL");

		$stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	//* BAJAR SERVICIO
	static public function mdlBajarServicio($articulo, $saldo)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE 
													articulojf 
												SET
													servicio = servicio - :saldo 
												WHERE articulo = :articulo ");

		$stmt->bindParam(":articulo", $articulo, PDO::PARAM_STR);
		$stmt->bindParam(":saldo", $saldo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return $stmt->errorInfo();
		}

		$stmt->close();

		$stmt = null;
	}


	/* 
	* MOSTRAR ARTICULOS EN URGENCIA
	*/
	static public function mdlArticulosUrgencia()
	{

		$stmt = Conexion::conectar()->prepare("SELECT 
					'a' AS inicio,
					'T3 - TRUSAS' AS nom_taller,
					a.articulo,
					a.id_marca,
					a.marca,
					a.modelo,
					a.nombre,
					a.cod_color,
					a.color,
					a.cod_talla,
					a.talla,
					a.estado,
					a.urgencia,
					a.mp_faltante,
					a.alerta,
					ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) AS configuracion,
					CASE
					WHEN a.stock < 0 
					THEN 0 
					ELSE a.stock 
					END AS stock,
					(a.stock - a.pedidos) AS stockB,
					a.pedidos,
					(a.taller + a.servicio) AS taller,
					a.alm_corte,
					CASE
					WHEN a.alerta = '0' 
					THEN a.alm_corte 
					ELSE CONCAT('I-', a.alm_corte) 
					END alm_corteA,
					a.ord_corte,
					a.proyeccion,
					IFNULL(a.prod, 0) AS prod,
					IFNULL(
					ROUND(
						(IFNULL(a.prod, 0) / a.proyeccion) * 100,
						2
					),
					0
					) AS avance,
					IFNULL(a.ult_mes, 0) AS ult_mes 
				FROM
					articulojf a 
					LEFT JOIN modelojf m 
					ON a.modelo = m.modelo 
				WHERE ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) > (a.stock - a.pedidos) 
					AND a.estado = 'Activo' 
					AND LEFT(a.modelo, 1) NOT IN ('D') 
					AND m.tipo NOT IN ('BRASIER') 
				UNION
				SELECT 
					'b' AS inicio,
					CONCAT(
					CASE
						WHEN sd.taller IS NULL 
						THEN cd.taller 
						WHEN cd.taller IS NULL 
						THEN sd.taller 
						WHEN sd.taller = cd.taller 
						THEN sd.taller 
						WHEN sd.taller <> cd.taller 
						THEN sd.taller 
					END,
					' - ',
					(SELECT 
						nom_sector 
					FROM
						sectorjf s 
					WHERE s.cod_sector = 
						CASE
						WHEN sd.taller IS NULL 
						THEN cd.taller 
						WHEN cd.taller IS NULL 
						THEN sd.taller 
						WHEN sd.taller = cd.taller 
						THEN sd.taller 
						WHEN sd.taller <> cd.taller 
						THEN sd.taller 
						END)
					) AS nom_sector,
					a.articulo,
					a.id_marca,
					a.marca,
					a.modelo,
					a.nombre,
					a.cod_color,
					a.color,
					a.cod_talla,
					a.talla,
					a.estado,
					a.urgencia,
					a.mp_faltante,
					a.alerta,
					ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) AS configuracion,
					CASE
					WHEN a.stock < 0 
					THEN 0 
					ELSE a.stock 
					END AS stock,
					(a.stock - a.pedidos) AS stockB,
					a.pedidos,
					CASE
					WHEN sd.taller IS NULL 
					THEN cd.cantidad 
					WHEN cd.taller IS NULL 
					THEN sd.saldo 
					WHEN sd.taller = cd.taller 
					THEN sd.saldo + cd.cantidad 
					WHEN sd.taller <> cd.taller 
					THEN sd.saldo 
					END AS taller,
					a.alm_corte,
					CASE
					WHEN a.alerta = '0' 
					THEN a.alm_corte 
					ELSE CONCAT('I-', a.alm_corte) 
					END alm_corteA,
					a.ord_corte,
					a.proyeccion,
					IFNULL(a.prod, 0) AS prod,
					IFNULL(
					ROUND(
						(IFNULL(a.prod, 0) / a.proyeccion) * 100,
						2
					),
					0
					) AS avance,
					IFNULL(a.ult_mes, 0) AS ult_mes 
				FROM
					articulojf a 
					LEFT JOIN 
					(SELECT 
						LEFT(sd.codigo, 2) AS taller,
						sd.articulo,
						SUM(sd.saldo) AS saldo 
					FROM
						servicios_detallejf sd 
					WHERE sd.saldo > 0 
						AND sd.cerrar = 0 
					GROUP BY LEFT(sd.codigo, 2),
						sd.articulo) AS sd 
					ON a.articulo = sd.articulo 
					LEFT JOIN 
					(SELECT 
						LEFT(cd.codigo, 2) AS taller,
						cd.articulo,
						SUM(cd.cantidad) AS cantidad 
					FROM
						cierres_detallejf cd 
					WHERE cd.cantidad > 0 
					GROUP BY LEFT(cd.codigo, 2),
						cd.articulo) AS cd 
					ON a.articulo = cd.articulo 
				WHERE a.estado = 'ACTIVO' 
					AND servicio > 0 
					AND ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) > (a.stock - a.pedidos) 
				GROUP BY a.articulo,
					sd.taller 
				UNION
				SELECT 
					'c' AS inicio,
					'T1 - BRASIER' AS nom_taller,
					a.articulo,
					a.id_marca,
					a.marca,
					a.modelo,
					a.nombre,
					a.cod_color,
					a.color,
					a.cod_talla,
					a.talla,
					a.estado,
					a.urgencia,
					a.mp_faltante,
					a.alerta,
					ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) AS configuracion,
					CASE
					WHEN a.stock < 0 
					THEN 0 
					ELSE a.stock 
					END AS stock,
					(a.stock - a.pedidos) AS stockB,
					a.pedidos,
					(a.taller + a.servicio) AS taller,
					a.alm_corte,
					CASE
					WHEN a.alerta = '0' 
					THEN a.alm_corte 
					ELSE CONCAT('I-', a.alm_corte) 
					END alm_corteA,
					a.ord_corte,
					a.proyeccion,
					IFNULL(a.prod, 0) AS prod,
					IFNULL(
					ROUND(
						(IFNULL(a.prod, 0) / a.proyeccion) * 100,
						2
					),
					0
					) AS avance,
					IFNULL(a.ult_mes, 0) AS ult_mes 
				FROM
					articulojf a 
					LEFT JOIN modelojf m 
					ON a.modelo = m.modelo 
				WHERE ROUND(
					(
						IFNULL(a.ult_mes, 0) * a.urgencia / 100
					),
					0
					) > (a.stock - a.pedidos) 
					AND a.estado = 'Activo' 
					AND LEFT(a.modelo, 1) NOT IN ('D') 
					AND m.tipo IN ('BRASIER','TOP') 
				ORDER BY inicio,
					nom_taller,
					articulo");

		$stmt->execute();

		return $stmt->fetchAll();


		$stmt->close();

		$stmt = null;
	}
}
