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

			$stmt = Conexion::conectar()->prepare("SELECT 
			odet.CodPro,
			odet.ColProv,
			odet.UndPro,
			odet.CanPro,
			odet.PrePro,
			odet.DscPro,
			odet.ImpPro, FROM ocomdet 
			ORDER BY Item DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			odet.CodPro AS id,
			odet.ColProv AS colorprov,
			odet.UndPro AS unidad,
			odet.CanPro AS cantidad,
			odet.PrePro AS precio,
			odet.DscPro AS descuento,
			odet.ImpPro AS total, 
			tbcol.des_larga AS color,
			p.codfab,
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

		$sql="INSERT INTO ocompra(Tip,Ser,Nro,Cod_Local,Cod_Entidad,CodRuc,FecEmi,Obser,FecLlegada,EstOS,EstReg,FecReg,UsuReg,PcReg) VALUES (:Tip,:Ser,:Nro,:Cod_Local,:Cod_Entidad,:CodRuc,:FecEmi,:Obser,:FecLlegada,:EstOS,:EstReg,:FecReg,:UsuReg,:PcReg)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc",$datos["CodRuc"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":Obser",$datos["Obser"],PDO::PARAM_STR);
		$stmt->bindParam(":FecLlegada",$datos["FecLlegada"],PDO::PARAM_STR);
		$stmt->bindParam(":EstOS",$datos["EstOS"],PDO::PARAM_STR);
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

		$sql="INSERT INTO ocomdet(Item,Tip,Ser,Nro,ColProv,Cod_Local,Cod_Entidad,CodRuc,CodPro,CodFab,UndPro,CanPro,CanPro_Ant,PrePro,PrePro_Ant,DscPro,ImpPro,EstOco,CantNI,SalCan,FecEmi,estac,FecReg,UsuReg,PcReg) VALUES (:Item,:Tip,:Ser,:Nro,:ColProv,:Cod_Local,:Cod_Entidad,:CodRuc,:CodPro,:CodFab,:UndPro,:CanPro,:CanPro_Ant,:PrePro,:PrePro_Ant,:DscPro,:ImpPro,:EstOco,:CantNI,:SalCan,:FecEmi,:estac,:FecReg,:UsuReg,:PcReg)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":Item",$datos["Item"],PDO::PARAM_STR);
		$stmt->bindParam(":Tip",$datos["Tip"],PDO::PARAM_STR);
		$stmt->bindParam(":Ser",$datos["Ser"],PDO::PARAM_STR);
		$stmt->bindParam(":Nro",$datos["Nro"],PDO::PARAM_STR);
		$stmt->bindParam(":ColProv",$datos["ColProv"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Local",$datos["Cod_Local"],PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad",$datos["Cod_Entidad"],PDO::PARAM_STR);
		$stmt->bindParam(":CodRuc",$datos["CodRuc"],PDO::PARAM_STR);
		$stmt->bindParam(":CodPro",$datos["CodPro"],PDO::PARAM_STR);
		$stmt->bindParam(":CodFab",$datos["CodFab"],PDO::PARAM_STR);
		$stmt->bindParam(":UndPro",$datos["UndPro"],PDO::PARAM_STR);
		$stmt->bindParam(":CanPro",$datos["CanPro"],PDO::PARAM_STR);
		$stmt->bindParam(":CanPro_Ant",$datos["CanPro_Ant"],PDO::PARAM_STR);
		$stmt->bindParam(":PrePro",$datos["PrePro"],PDO::PARAM_STR);
		$stmt->bindParam(":PrePro_Ant",$datos["PrePro_Ant"],PDO::PARAM_STR);
		$stmt->bindParam(":DscPro",$datos["DscPro"],PDO::PARAM_STR);
		$stmt->bindParam(":ImpPro",$datos["ImpPro"],PDO::PARAM_STR);
		$stmt->bindParam(":EstOco",$datos["EstOco"],PDO::PARAM_STR);
		$stmt->bindParam(":CantNI",$datos["CantNI"],PDO::PARAM_STR);
		$stmt->bindParam(":SalCan",$datos["SalCan"],PDO::PARAM_STR);
		$stmt->bindParam(":FecEmi",$datos["FecEmi"],PDO::PARAM_STR);
		$stmt->bindParam(":estac",$datos["estac"],PDO::PARAM_STR);
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
}
