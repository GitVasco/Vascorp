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

  // Método para guardar las ventas
	static public function mdlGuardarOrdenCompra($datos){

		$sql="INSERT INTO ocompra(Tip,Ser,Nro,Cod_Local,Cod_Entidad,CodRuc,FecEmi,tCambio,Mo,Obser,pIgv,SubTotal,Igv,Total,mtopago,Centcosto,Cantidad,NroProforma,FecLlegada,TipPago,Dia,EstOco,EstReg,FecReg,UsuReg,PcReg,estac) VALUES (:Tip,:Ser,:Nro,:Cod_Local,:Cod_Entidad,:CodRuc,:FecEmi,:tCambio,:Mo,:Obser,:pIgv,:SubTotal,:Igv,:Total,:mtopago,:Centcosto,:Cantidad,:NroProforma,:FecLlegada,:TipPago,:Dia,:EstOco,:EstReg,:FecReg,:UsuReg,:PcReg,:estac)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc",$datos["CodRuc"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":tCambio",$datos["tCambio"],PDO::PARAM_STR);
		$stmt->bindParam(":Mo",$datos["Mo"],PDO::PARAM_STR);
		$stmt->bindParam(":Obser",$datos["Obser"],PDO::PARAM_STR);
		$stmt->bindParam(":pIgv",$datos["pIgv"],PDO::PARAM_STR);
		$stmt->bindParam(":SubTotal",$datos["SubTotal"],PDO::PARAM_STR);
		$stmt->bindParam(":Igv",$datos["Igv"],PDO::PARAM_STR);
		$stmt->bindParam(":Total",$datos["Total"],PDO::PARAM_STR);
		$stmt->bindParam(":mtopago",$datos["mtopago"],PDO::PARAM_STR);
		$stmt->bindParam(":Centcosto",$datos["Centcosto"],PDO::PARAM_STR);
		$stmt->bindParam(":Cantidad",$datos["Cantidad"],PDO::PARAM_STR);
		$stmt->bindParam(":NroProforma",$datos["NroProforma"],PDO::PARAM_STR);
		$stmt->bindParam(":FecLlegada",$datos["FecLlegada"],PDO::PARAM_STR);
		$stmt->bindParam(":TipPago",$datos["TipPago"],PDO::PARAM_STR);
		$stmt->bindParam(":Dia",$datos["Dia"],PDO::PARAM_STR);
		$stmt->bindParam(":EstOco",$datos["EstOco"],PDO::PARAM_STR);
		$stmt->bindParam(":EstReg",$datos["EstReg"],PDO::PARAM_STR);
		$stmt->bindParam(":FecReg",$datos["FecReg"],PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg",$datos["UsuReg"],PDO::PARAM_STR);
    $stmt->bindParam(":PcReg",$datos["PcReg"],PDO::PARAM_STR);
    $stmt->bindParam(":estac",$datos["estac"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}	
	
	// Método para guardar las ventas
	static public function mdlGuardarDetalleOrdenCompra($datos){

		$sql="INSERT INTO ocomdet(Item,Tip,Ser,Nro,ColProv,Cod_Local,Cod_Entidad,CodRuc,CodPro,CodFab,UndPro,CanPro,CanPro_Ant,SugVta,EstVta,pcosto,CenCosto,FecReg,PcReg,UsuReg,SalVta) VALUES (:Item,:Tip,:Ser,:Nro,:ColProv,:Cod_Local,:Cod_Entidad,:CodRuc,:CodPro,:CodFab,:UndPro,:CanPro,:CanPro_Ant,:SugVta,:EstVta,:pcosto,:CenCosto,:FecReg,:PcReg,:UsuReg,:CanVta)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Item",$datos["Item"],PDO::PARAM_STR);
		$stmt->bindParam(":CanVta",$datos["CanVta"],PDO::PARAM_STR);
		$stmt->bindParam(":PreVta",$datos["PreVta"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":DscVta",$datos["DscVta"],PDO::PARAM_STR);
		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":Ruc",$datos["Ruc"],PDO::PARAM_STR);
		$stmt->bindParam(":CodPro",$datos["CodPro"],PDO::PARAM_STR);
		$stmt->bindParam(":SugVta",$datos["SugVta"],PDO::PARAM_STR);
		$stmt->bindParam(":EstVta",$datos["EstVta"],PDO::PARAM_STR);
		$stmt->bindParam(":pcosto",$datos["pcosto"],PDO::PARAM_STR);
		$stmt->bindParam(":CenCosto",$datos["CenCosto"],PDO::PARAM_STR);
		$stmt->bindParam(":FecReg",$datos["FecReg"],PDO::PARAM_STR);
		$stmt->bindParam(":PcReg",$datos["PcReg"],PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg",$datos["UsuReg"],PDO::PARAM_STR);
		

		$stmt->execute();

		$stmt=null;
	}

}