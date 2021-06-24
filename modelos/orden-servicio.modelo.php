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

		$sql="INSERT INTO oservicio(Cod_Local,Cod_Entidad,Tip,Ser,Nro,FecEmi,CodRuc,FecEnt,EstOS,DesStk,ObsOs,EstReg,FecReg,UsuReg,PcReg) VALUES (:Cod_Local,:Cod_Entidad,:Tip,:Ser,:Nro,:FecEmi,:CodRuc,:FecEnt,:EstOS,:DesStk,:ObsOs,:EstReg,:FecReg,:UsuReg,:PcReg)";

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
	CERRAR ORDEN DE COMPRA
	=============================================*/

	static public function mdlCerrarOrdenServicio($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE oservicio SET EstReg = :EstReg , UsuCer = :UsuCer, FecCer = :FecCer , PcCer = :PcCer WHERE Nro = :Nro");

		$stmt -> bindParam(":EstReg", $datos["EstReg"], PDO::PARAM_STR);
		$stmt -> bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt -> bindParam(":UsuCer", $datos["UsuCer"], PDO::PARAM_STR);
		$stmt -> bindParam(":FecCer", $datos["FecCer"], PDO::PARAM_STR);
		$stmt -> bindParam(":PcCer", $datos["PcCer"], PDO::PARAM_STR);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	

	/*=============================================
	CERRAR DETALLE ORDEN DE COMPRA
	=============================================*/

	static public function mdlCerrarDetalleOrdenServicio($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE oserviciodet SET EstReg = :EstReg WHERE Nro = :Nro");

		$stmt -> bindParam(":EstReg", $datos["EstReg"], PDO::PARAM_STR);
		$stmt -> bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	

	/*=============================================
	ANULAR ORDEN DE SERVICIO
	=============================================*/

	static public function mdlAnularOrdenServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET EstOco = :EstOco , FecAnulacion = :FecAnulacion,FecAnu = :FecAnu, UsuAnu = :UsuAnu, PcAnu = :PcAnu WHERE Nro = :Nro");

		$stmt -> bindParam(":EstOco", $datos["EstOco"], PDO::PARAM_STR);
		$stmt -> bindParam(":FecAnulacion", $datos["FecAnulacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":Nro", $datos["Nro"], PDO::PARAM_STR);
		$stmt -> bindParam(":FecAnu", $datos["FecAnu"], PDO::PARAM_STR);
		$stmt -> bindParam(":UsuAnu", $datos["UsuAnu"], PDO::PARAM_STR);
		$stmt -> bindParam(":PcAnu", $datos["PcAnu"], PDO::PARAM_STR);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}	
}
