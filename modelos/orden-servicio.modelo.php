<?php

require_once "conexion.php";

class ModeloOrdenServicio{

    static public function mdlMostrarOrdenServicio($item, $valor){
		if($valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
            Tip,
            Ser,
            Nro,
            oservicio.UsuReg,
            oservicio.CodRuc,
            Proveedor.RazPro,
            DATE(FecEmi) AS FecEmi 
          FROM
            oservicio,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oservicio.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstReg = '1' 
          ORDER BY Nro DESC ");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else{
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
            Tip,
            Ser,
            Nro,
            oservicio.UsuReg,
            oservicio.CodRuc,
            Proveedor.RazPro,
			DesStk,
			ObsOs,
			DATE(FecEnt) AS FecEnt, 
            DATE(FecEmi) AS FecEmi 
          FROM
            oservicio,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oservicio.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstReg = '1' 
            AND $item = :$item 
			ORDER BY Nro DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarDetallesOrdenServicio($item, $valor){
		if($valor == null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
			DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
			DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
			osd.Nro,
			Item,
			CodProOrigen,
			pro.DesPro AS DesProOrigen,
			CantidadIni,
			CodProDestino,
			pro1.DesPro AS Descripcion,
			Saldo,
			Despacho,
			tb1.Des_Larga AS Color,
			tb3.Des_Larga AS Color2,
			tb2.Des_Corta AS Unidad,
			tb4.Des_Larga AS EstadoDet 
		  FROM
			oServicioDet osd 
			INNER JOIN Producto pro 
			  ON osd.CodProOrigen = pro.CodPro 
			INNER JOIN Producto pro1 
			  ON osd.CodProDestino = pro1.CodPro 
			INNER JOIN Tabla_M_Detalle AS tb1 
			  ON pro.ColPro = tb1.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb3 
			  ON pro1.ColPro = tb3.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb2 
			  ON pro.UndPro = tb2.Cod_Argumento 
			LEFT JOIN oServicio os 
			  ON os.Nro = osd.Nro 
			LEFT JOIN Tabla_M_Detalle AS tb4 
			  ON osd.Estos = tb4.Des_Corta 
		  WHERE (
			  tb1.Cod_Tabla = 'TCOL' 
			  OR tb1.Cod_Tabla IS NULL
			) 
			AND (
			  tb2.Cod_Tabla = 'TUND' 
			  OR tb2.Cod_Tabla IS NULL
			) 
			AND (
			  tb3.Cod_Tabla = 'TCOL' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND (
			  tb4.Cod_Tabla = 'EOC1' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND osd.EstReg = '1' 
		  ORDER BY osd.Nro DESC,
			osd.Item ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else{
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
			DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
			DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
			osd.Nro,
			osd.EstOS,
			Item,
			CodProOrigen,
			pro.DesPro AS DesProOrigen,
			CantidadIni,
			CodProDestino,
			pro1.DesPro AS Descripcion,
			Saldo,
			Despacho,
			tb1.Des_Larga AS Color,
			tb3.Des_Larga AS Color2,
			tb2.Des_Corta AS Unidad,
			tb4.Des_Larga AS EstadoDet 
		  FROM
			oServicioDet osd 
			INNER JOIN Producto pro 
			  ON osd.CodProOrigen = pro.CodPro 
			INNER JOIN Producto pro1 
			  ON osd.CodProDestino = pro1.CodPro 
			INNER JOIN Tabla_M_Detalle AS tb1 
			  ON pro.ColPro = tb1.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb3 
			  ON pro1.ColPro = tb3.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb2 
			  ON pro.UndPro = tb2.Cod_Argumento 
			LEFT JOIN oServicio os 
			  ON os.Nro = osd.Nro 
			LEFT JOIN Tabla_M_Detalle AS tb4 
			  ON osd.Estos = tb4.Des_Corta 
		  WHERE (
			  tb1.Cod_Tabla = 'TCOL' 
			  OR tb1.Cod_Tabla IS NULL
			) 
			AND (
			  tb2.Cod_Tabla = 'TUND' 
			  OR tb2.Cod_Tabla IS NULL
			) 
			AND (
			  tb3.Cod_Tabla = 'TCOL' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND (
			  tb4.Cod_Tabla = 'EOC1' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND osd.EstReg = '1' 
		  AND osd.$item = :$item 
		  ORDER BY osd.Item ASC ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt -> close();

		$stmt = null;
	}


    
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasOrdenServicio($fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
            Tip,
            Ser,
            Nro,
            oservicio.UsuReg,
            oservicio.CodRuc,
            Proveedor.RazPro,
            DATE(FecEmi) AS FecEmi 
          FROM
            oservicio,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oservicio.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstReg = '1' 
          ORDER BY Nro DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
            IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
            Tip,
            Ser,
            Nro,
            oservicio.UsuReg,
            oservicio.CodRuc,
            Proveedor.RazPro,
            DATE(FecEmi) AS FecEmi 
          FROM
            oservicio,
            Proveedor,
            Tabla_M_Detalle 
          WHERE Proveedor.CodRuc = oservicio.CodRuc 
            AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
            AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
            AND EstReg = '1' 
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
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
                Tip,
                Ser,
                Nro,
                oservicio.UsuReg,
                oservicio.CodRuc,
                Proveedor.RazPro,
                DATE(FecEmi) AS FecEmi 
              FROM
                oservicio,
                Proveedor,
                Tabla_M_Detalle 
              WHERE Proveedor.CodRuc = oservicio.CodRuc 
                AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
                AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
                AND EstReg = '1' 
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
			  ORDER BY Nro DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                IFNULL(Tabla_M_Detalle.Des_Larga, '') AS EstOS,
                Tip,
                Ser,
                Nro,
                oservicio.UsuReg,
                oservicio.CodRuc,
                Proveedor.RazPro,
                DATE(FecEmi) AS FecEmi 
              FROM
                oservicio,
                Proveedor,
                Tabla_M_Detalle 
              WHERE Proveedor.CodRuc = oservicio.CodRuc 
                AND Tabla_M_Detalle.Des_Corta = oservicio.EstOS 
                AND Tabla_M_Detalle.Cod_tabla = 'EOC1' 
                AND EstReg = '1' 
                AND DATE(FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinal'
			  ORDER BY Nro DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


    // Método para guardar las ordenes de servicios
	static public function mdlGuardarOrdenServicio($datos){

		$sql="INSERT INTO oservicio(Cod_Local,Cod_Entidad,Tip,Ser,Nro,FecEmi,CodRuc,FecEnt,EstOS,DesStk,ObsOs,EstReg,FecReg,UsuReg,PcReg) VALUES (:Cod_Local,:Cod_Entidad,:Tip,:Ser,:Nro,:FecEmi,:CodRuc,:FecEnt,:EstOS,:DesStk,UPPER(:ObsOs),:EstReg,:FecReg,:UsuReg,:PcReg)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc",$datos["CodRuc"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEnt",$datos["FecEnt"],PDO::PARAM_STR);
		$stmt->bindParam(":EstOS",$datos["EstOS"],PDO::PARAM_STR);
		$stmt->bindParam(":DesStk",$datos["DesStk"],PDO::PARAM_STR);
		$stmt->bindParam(":ObsOs",$datos["ObsOs"],PDO::PARAM_STR);
		$stmt->bindParam(":EstReg",$datos["EstReg"],PDO::PARAM_STR);
		$stmt->bindParam(":FecReg",$datos["FecReg"],PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg",$datos["UsuReg"],PDO::PARAM_STR);
		$stmt->bindParam(":PcReg",$datos["PcReg"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}	
	
	// Método para guardar el detalle de orden de servicio
	static public function mdlGuardarDetalleOrdenServicio($datos){

		$sql="INSERT INTO oserviciodet(Cod_Local,Cod_Entidad,Item,Tip,Ser,Nro,FecEmi,CodRuc,CodProOrigen,CantidadIni,CodProDestino,Saldo,Despacho,EstOS,DesStk,EstReg,FecReg,UsuReg,PcReg) VALUES (:Cod_Local,:Cod_Entidad,:Item,:Tip,:Ser,:Nro,:FecEmi,:CodRuc,:CodProOrigen,:CantidadIni,:CodProDestino,:Saldo,:Despacho,:EstOS,:DesStk,:EstReg,:FecReg,:UsuReg,:PcReg)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":Item",$datos["Item"],PDO::PARAM_STR);
		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc",$datos["CodRuc"],PDO::PARAM_STR);
		$stmt->bindParam(":CodProOrigen",$datos["CodProOrigen"],PDO::PARAM_STR);
		$stmt->bindParam(":CantidadIni",$datos["CantidadIni"],PDO::PARAM_STR);
		$stmt->bindParam(":CodProDestino",$datos["CodProDestino"],PDO::PARAM_STR);
		$stmt->bindParam(":Saldo",$datos["Saldo"],PDO::PARAM_STR);
		$stmt->bindParam(":Despacho",$datos["Despacho"],PDO::PARAM_STR);
		$stmt->bindParam(":EstOS",$datos["EstOS"],PDO::PARAM_STR);
		$stmt->bindParam(":DesStk",$datos["DesStk"],PDO::PARAM_STR);
		$stmt->bindParam(":EstReg",$datos["EstReg"],PDO::PARAM_STR);
		$stmt->bindParam(":FecReg",$datos["FecReg"],PDO::PARAM_STR);
		$stmt->bindParam(":UsuReg",$datos["UsuReg"],PDO::PARAM_STR);
		$stmt->bindParam(":PcReg",$datos["PcReg"],PDO::PARAM_STR);
		

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}

	/*=============================================
	MOSTRAR ULTIMO NRO DE ORDEN DE COMPRA
	=============================================*/

	static public function mdlMostrarUltimoNro(){


		$stmt = Conexion::conectar()->prepare("SELECT IFNULL(MAX(Nro),'000001') AS Nro FROM oservicio");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	CERRAR ORDEN DE SERVICIO
	=============================================*/

	static public function mdlCerrarOrdenServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET EstOS = :EstOS , FecMod = :FecMod , UsuMod = :UsuMod, PcMod = :PcMod WHERE Nro = :Nro");

		$stmt -> bindParam(":EstOS", $datos["EstOS"], PDO::PARAM_STR);
		$stmt -> bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt -> bindParam(":FecMod", $datos["FecMod"], PDO::PARAM_STR);
		$stmt -> bindParam(":UsuMod", $datos["UsuMod"], PDO::PARAM_STR);
		$stmt -> bindParam(":PcMod", $datos["PcMod"], PDO::PARAM_STR);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return $stmt->errorInfo();

		}

		$stmt -> close();

		$stmt = null;

	}	


	/*=============================================
	REPORTE FECHAS
	=============================================*/	

	static public function mdlReporteFechasOrdenServicioGeneral($fechaInicial, $fechaFinal){

		if($fechaInicial == "null"){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
			DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
			DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
			osd.Nro,
			Item,
			CodProOrigen,
			pro.DesPro AS DesProOrigen,
			CantidadIni,
			CodProDestino,
			pro1.DesPro AS Descripcion,
			Saldo,
			Despacho,
			tb1.Des_Larga AS Color,
			tb3.Des_Larga AS Color2,
			tb2.Des_Corta AS Unidad,
			tb4.Des_Larga AS EstadoDet 
		  FROM
			oServicioDet osd 
			INNER JOIN Producto pro 
			  ON osd.CodProOrigen = pro.CodPro 
			INNER JOIN Producto pro1 
			  ON osd.CodProDestino = pro1.CodPro 
			INNER JOIN Tabla_M_Detalle AS tb1 
			  ON pro.ColPro = tb1.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb3 
			  ON pro1.ColPro = tb3.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb2 
			  ON pro.UndPro = tb2.Cod_Argumento 
			LEFT JOIN oServicio os 
			  ON os.Nro = osd.Nro 
			LEFT JOIN Tabla_M_Detalle AS tb4 
			  ON osd.Estos = tb4.Des_Corta 
		  WHERE (
			  tb1.Cod_Tabla = 'TCOL' 
			  OR tb1.Cod_Tabla IS NULL
			) 
			AND (
			  tb2.Cod_Tabla = 'TUND' 
			  OR tb2.Cod_Tabla IS NULL
			) 
			AND (
			  tb3.Cod_Tabla = 'TCOL' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND (
			  tb4.Cod_Tabla = 'EOC1' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND osd.EstReg = '1' 
		  ORDER BY osd.Nro DESC,
			osd.Item ASC ");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
			DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
			DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
			osd.Nro,
			Item,
			CodProOrigen,
			pro.DesPro AS DesProOrigen,
			CantidadIni,
			CodProDestino,
			pro1.DesPro AS Descripcion,
			Saldo,
			Despacho,
			tb1.Des_Larga AS Color,
			tb3.Des_Larga AS Color2,
			tb2.Des_Corta AS Unidad,
			tb4.Des_Larga AS EstadoDet 
		  FROM
			oServicioDet osd 
			INNER JOIN Producto pro 
			  ON osd.CodProOrigen = pro.CodPro 
			INNER JOIN Producto pro1 
			  ON osd.CodProDestino = pro1.CodPro 
			INNER JOIN Tabla_M_Detalle AS tb1 
			  ON pro.ColPro = tb1.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb3 
			  ON pro1.ColPro = tb3.Cod_Argumento 
			INNER JOIN Tabla_M_Detalle AS tb2 
			  ON pro.UndPro = tb2.Cod_Argumento 
			LEFT JOIN oServicio os 
			  ON os.Nro = osd.Nro 
			LEFT JOIN Tabla_M_Detalle AS tb4 
			  ON osd.Estos = tb4.Des_Corta 
		  WHERE (
			  tb1.Cod_Tabla = 'TCOL' 
			  OR tb1.Cod_Tabla IS NULL
			) 
			AND (
			  tb2.Cod_Tabla = 'TUND' 
			  OR tb2.Cod_Tabla IS NULL
			) 
			AND (
			  tb3.Cod_Tabla = 'TCOL' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND (
			  tb4.Cod_Tabla = 'EOC1' 
			  OR tb3.Cod_Tabla IS NULL
			) 
			AND osd.EstReg = '1'
            AND DATE(os.FecEmi) like '%$fechaFinal%'  
			ORDER BY osd.Nro DESC,
			osd.Item ASC ");

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
				DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
				DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
				osd.Nro,
				Item,
				CodProOrigen,
				pro.DesPro AS DesProOrigen,
				CantidadIni,
				CodProDestino,
				pro1.DesPro AS Descripcion,
				Saldo,
				Despacho,
				tb1.Des_Larga AS Color,
				tb3.Des_Larga AS Color2,
				tb2.Des_Corta AS Unidad,
				tb4.Des_Larga AS EstadoDet 
			  FROM
				oServicioDet osd 
				INNER JOIN Producto pro 
				  ON osd.CodProOrigen = pro.CodPro 
				INNER JOIN Producto pro1 
				  ON osd.CodProDestino = pro1.CodPro 
				INNER JOIN Tabla_M_Detalle AS tb1 
				  ON pro.ColPro = tb1.Cod_Argumento 
				INNER JOIN Tabla_M_Detalle AS tb3 
				  ON pro1.ColPro = tb3.Cod_Argumento 
				INNER JOIN Tabla_M_Detalle AS tb2 
				  ON pro.UndPro = tb2.Cod_Argumento 
				LEFT JOIN oServicio os 
				  ON os.Nro = osd.Nro 
				LEFT JOIN Tabla_M_Detalle AS tb4 
				  ON osd.Estos = tb4.Des_Corta 
			  WHERE (
				  tb1.Cod_Tabla = 'TCOL' 
				  OR tb1.Cod_Tabla IS NULL
				) 
				AND (
				  tb2.Cod_Tabla = 'TUND' 
				  OR tb2.Cod_Tabla IS NULL
				) 
				AND (
				  tb3.Cod_Tabla = 'TCOL' 
				  OR tb3.Cod_Tabla IS NULL
				) 
				AND (
				  tb4.Cod_Tabla = 'EOC1' 
				  OR tb3.Cod_Tabla IS NULL
				) 
				AND osd.EstReg = '1' 
                AND DATE(os.FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'   
				ORDER BY osd.Nro DESC,
				osd.Item ASC ");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
				DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
				DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada,
				osd.Nro,
				Item,
				CodProOrigen,
				pro.DesPro AS DesProOrigen,
				CantidadIni,
				CodProDestino,
				pro1.DesPro AS Descripcion,
				Saldo,
				Despacho,
				tb1.Des_Larga AS Color,
				tb3.Des_Larga AS Color2,
				tb2.Des_Corta AS Unidad,
				tb4.Des_Larga AS EstadoDet 
			  FROM
				oServicioDet osd 
				INNER JOIN Producto pro 
				  ON osd.CodProOrigen = pro.CodPro 
				INNER JOIN Producto pro1 
				  ON osd.CodProDestino = pro1.CodPro 
				INNER JOIN Tabla_M_Detalle AS tb1 
				  ON pro.ColPro = tb1.Cod_Argumento 
				INNER JOIN Tabla_M_Detalle AS tb3 
				  ON pro1.ColPro = tb3.Cod_Argumento 
				INNER JOIN Tabla_M_Detalle AS tb2 
				  ON pro.UndPro = tb2.Cod_Argumento 
				LEFT JOIN oServicio os 
				  ON os.Nro = osd.Nro 
				LEFT JOIN Tabla_M_Detalle AS tb4 
				  ON osd.Estos = tb4.Des_Corta 
			  WHERE (
				  tb1.Cod_Tabla = 'TCOL' 
				  OR tb1.Cod_Tabla IS NULL
				) 
				AND (
				  tb2.Cod_Tabla = 'TUND' 
				  OR tb2.Cod_Tabla IS NULL
				) 
				AND (
				  tb3.Cod_Tabla = 'TCOL' 
				  OR tb3.Cod_Tabla IS NULL
				) 
				AND (
				  tb4.Cod_Tabla = 'EOC1' 
				  OR tb3.Cod_Tabla IS NULL
				) 
				AND osd.EstReg = '1' 
                AND DATE(os.FecEmi) BETWEEN '$fechaInicial' AND '$fechaFinal'
				ORDER BY osd.Nro DESC,
				osd.Item ASC ");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}



}
