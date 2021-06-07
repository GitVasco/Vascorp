<?php

require_once "conexion.php";

class ModeloOrdenCompra{

    
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasOrdenCompra($fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
            Tip,
            Ser,
            Nro,
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
            AND YEAR(FecEmi) IN ('2020', '2021') 
          ORDER BY Nro DESC ");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
            Tip,
            Ser,
            Nro,
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
            AND DATE(FecEmi) like '%$fechaFinal%'  ORDER BY Nro DESC");

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

				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
                Tip,
                Ser,
                Nro,
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
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
			  ORDER BY Nro DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS Estac,
                Tip,
                Ser,
                Nro,
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
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  ORDER BY Nro DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


  /*=============================================
	MOSTRAR DESTINO PARA LA MATERIA EN LA NOTA DE SALIDA
	=============================================*/

	static public function mdlMostrarMateriasCompras($valor){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT   Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv1 AS PrecioSinIgv, Producto.CodAlm01, Proveedor.RazPro, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
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
    SELECT DISTINCT  Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv2 AS PrecioSinIgv,  Producto.CodAlm01, Proveedor.RazPro, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
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
    SELECT DISTINCT  Producto.CodFab, Producto.DesPro, Producto.CodPro, preciomp.PreProv3 AS PrecioSinIgv ,  Producto.CodAlm01, Proveedor.RazPro, Tabla_M_Detalle_2.Des_Corta AS Unidad,Tabla_M_Detalle_4.Des_Larga AS Color
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

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}
}