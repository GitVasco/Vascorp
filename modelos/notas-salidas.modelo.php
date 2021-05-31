<?php

require_once "conexion.php";

class ModeloNotasSalidas{

    
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasNotasSalidas($fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT 
			vc.tip,
			vc.ser,
			vc.nro,
			DATE(fecemi) AS fecemi,
			c.razcli,
			a.des_larga AS almacen 
		  FROM
			ventas_cab vc 
			LEFT JOIN clientes c 
			  ON vc.ruc = c.ruc 
			LEFT JOIN 
			  (SELECT 
				cod_argumento,
				cod_tabla,
				des_larga,
				des_corta,
				valor_1,
				valor_2,
				valor_3 
			  FROM
				tabla_m_detalle 
			  WHERE cod_tabla = 'talm') a 
			  ON vc.codalm = a.cod_argumento 
		  WHERE YEAR(fecemi) IN ('2020', '2021')");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT 
			vc.tip,
			vc.ser,
			vc.nro,
			DATE(fecemi) AS fecemi,
			c.razcli,
			a.des_larga AS almacen 
		  FROM
			ventas_cab vc 
			LEFT JOIN clientes c 
			  ON vc.ruc = c.ruc 
			LEFT JOIN 
			  (SELECT 
				cod_argumento,
				cod_tabla,
				des_larga,
				des_corta,
				valor_1,
				valor_2,
				valor_3 
			  FROM
				tabla_m_detalle 
			  WHERE cod_tabla = 'talm') a 
			  ON vc.codalm = a.cod_argumento 
		  WHERE DATE(fecemi) like '%$fechaFinal%'");

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
				vc.tip,
				vc.ser,
				vc.nro,
				DATE(fecemi) AS fecemi,
				c.razcli,
				a.des_larga AS almacen 
			  FROM
				ventas_cab vc 
				LEFT JOIN clientes c 
				  ON vc.ruc = c.ruc 
				LEFT JOIN 
				  (SELECT 
					cod_argumento,
					cod_tabla,
					des_larga,
					des_corta,
					valor_1,
					valor_2,
					valor_3 
				  FROM
					tabla_m_detalle 
				  WHERE cod_tabla = 'talm') a 
				  ON vc.codalm = a.cod_argumento 
			  WHERE DATE(fecemi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT 
				vc.tip,
				vc.ser,
				vc.nro,
				DATE(fecemi) AS fecemi,
				c.razcli,
				a.des_larga AS almacen 
			  FROM
				ventas_cab vc 
				LEFT JOIN clientes c 
				  ON vc.ruc = c.ruc 
				LEFT JOIN 
				  (SELECT 
					cod_argumento,
					cod_tabla,
					des_larga,
					des_corta,
					valor_1,
					valor_2,
					valor_3 
				  FROM
					tabla_m_detalle 
				  WHERE cod_tabla = 'talm') a 
				  ON vc.codalm = a.cod_argumento 
			  WHERE DATE(fecemi) BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

}