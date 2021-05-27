<?php

require_once "conexion.php";

class ModeloProveedores{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarProveedor($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Cod_Local,Cod_Entidad,CodRuc,TipPro,RucPro,RazPro,DirPro,UbiPro,TelPro1,TelPro2,TelPro3,FaxPro,ConPro, EmaPro,EmaPro2,WebPro,TieEnt,ForPag,Dia,Banco,Moneda,NroCta,Banco1,Moneda1,NroCta1,EstPro,Observa, FecReg,UsuReg,PcReg) VALUES (:Cod_Local,:Cod_Entidad,:CodRuc,:TipPro,:RucPro,:RazPro,:DirPro,:UbiPro,:TelPro1,:TelPro2,:TelPro3,:FaxPro,:ConPro, :EmaPro,:EmaPro2,:WebPro,:TieEnt,:ForPag,:Dia,:Banco,:Moneda,:NroCta,:Banco1,:Moneda1,:NroCta1,:EstPro,:Observa,:FecReg,:UsuReg,:PcReg)");

		$stmt->bindParam(":Cod_Local", $datos["Cod_Local"], PDO::PARAM_STR);
		$stmt->bindParam(":Cod_Entidad", $datos["Cod_Entidad"], PDO::PARAM_STR);
        $stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":TipPro", $datos["TipPro"], PDO::PARAM_STR);
        $stmt->bindParam(":RucPro", $datos["RucPro"], PDO::PARAM_STR);
        $stmt->bindParam(":RazPro", $datos["RazPro"], PDO::PARAM_STR);
        $stmt->bindParam(":DirPro", $datos["DirPro"], PDO::PARAM_STR);
        $stmt->bindParam(":UbiPro", $datos["UbiPro"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro1", $datos["TelPro1"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro2", $datos["TelPro2"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro3", $datos["TelPro3"], PDO::PARAM_STR);
        $stmt->bindParam(":FaxPro", $datos["FaxPro"], PDO::PARAM_STR);
        $stmt->bindParam(":ConPro", $datos["ConPro"], PDO::PARAM_STR);
        $stmt->bindParam(":EmaPro", $datos["EmaPro"], PDO::PARAM_STR);
        $stmt->bindParam(":EmaPro2", $datos["EmaPro2"], PDO::PARAM_STR);
        $stmt->bindParam(":WebPro", $datos["WebPro"], PDO::PARAM_STR);
        $stmt->bindParam(":TieEnt", $datos["TieEnt"], PDO::PARAM_STR);
        $stmt->bindParam(":ForPag", $datos["ForPag"], PDO::PARAM_STR);
        $stmt->bindParam(":Dia", $datos["Dia"], PDO::PARAM_STR);
        $stmt->bindParam(":Banco", $datos["Banco"], PDO::PARAM_STR);
        $stmt->bindParam(":Moneda", $datos["Moneda"], PDO::PARAM_STR);
        $stmt->bindParam(":NroCta", $datos["NroCta"], PDO::PARAM_STR);
        $stmt->bindParam(":Banco1", $datos["Banco1"], PDO::PARAM_STR);
        $stmt->bindParam(":Moneda1", $datos["Moneda1"], PDO::PARAM_STR);
        $stmt->bindParam(":NroCta1", $datos["NroCta1"], PDO::PARAM_STR);
        $stmt->bindParam(":EstPro", $datos["EstPro"], PDO::PARAM_STR);
        $stmt->bindParam(":Observa", $datos["Observa"], PDO::PARAM_STR);
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
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function mdlMostrarProveedores($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.*,m.Cod_Argumento,m.Des_Larga FROM $tabla p LEFT JOIN tabla_m_detalle m  ON p.Moneda = m.Cod_Argumento WHERE m.Cod_Tabla = 'TMON' AND p.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT CodRuc,RucPro,RazPro,DirPro,TelPro1,EmaPro FROM $tabla WHERE EstPro = '1'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/

	static public function mdlMostrarUltimoCodRuc(){


		$stmt = Conexion::conectar()->prepare("SELECT MAX(CodRuc) AS CodRuc FROM proveedor");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarProveedor($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET CodRuc = :CodRuc,TipPro  = :TipPro,RucPro  = :RucPro,RazPro  = :RazPro,DirPro  = :DirPro,UbiPro = :UbiPro,TelPro1 = :TelPro1,TelPro2 = :TelPro2,TelPro3 = :TelPro3,FaxPro = :FaxPro,ConPro = :ConPro, EmaPro = :EmaPro,EmaPro2 = :EmaPro2,WebPro = :WebPro,TieEnt = :TieEnt,ForPag = :ForPag,Dia = :Dia,Banco = :Banco,Moneda = :Moneda,NroCta = :NroCta,Banco1 = :Banco1,Moneda1 = :Moneda1,NroCta1 = :NroCta1 WHERE CodRuc = :CodRuc");

		$stmt->bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
		$stmt->bindParam(":TipPro", $datos["TipPro"], PDO::PARAM_STR);
        $stmt->bindParam(":RucPro", $datos["RucPro"], PDO::PARAM_STR);
        $stmt->bindParam(":RazPro", $datos["RazPro"], PDO::PARAM_STR);
        $stmt->bindParam(":DirPro", $datos["DirPro"], PDO::PARAM_STR);
        $stmt->bindParam(":UbiPro", $datos["UbiPro"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro1", $datos["TelPro1"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro2", $datos["TelPro2"], PDO::PARAM_STR);
        $stmt->bindParam(":TelPro3", $datos["TelPro3"], PDO::PARAM_STR);
        $stmt->bindParam(":FaxPro", $datos["FaxPro"], PDO::PARAM_STR);
        $stmt->bindParam(":ConPro", $datos["ConPro"], PDO::PARAM_STR);
        $stmt->bindParam(":EmaPro", $datos["EmaPro"], PDO::PARAM_STR);
        $stmt->bindParam(":EmaPro2", $datos["EmaPro2"], PDO::PARAM_STR);
        $stmt->bindParam(":WebPro", $datos["WebPro"], PDO::PARAM_STR);
        $stmt->bindParam(":TieEnt", $datos["TieEnt"], PDO::PARAM_STR);
        $stmt->bindParam(":ForPag", $datos["ForPag"], PDO::PARAM_STR);
        $stmt->bindParam(":Dia", $datos["Dia"], PDO::PARAM_STR);
        $stmt->bindParam(":Banco", $datos["Banco"], PDO::PARAM_STR);
        $stmt->bindParam(":Moneda", $datos["Moneda"], PDO::PARAM_STR);
        $stmt->bindParam(":NroCta", $datos["NroCta"], PDO::PARAM_STR);
        $stmt->bindParam(":Banco1", $datos["Banco1"], PDO::PARAM_STR);
        $stmt->bindParam(":Moneda1", $datos["Moneda1"], PDO::PARAM_STR);
        $stmt->bindParam(":NroCta1", $datos["NroCta1"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR PROVEEDOR
	=============================================*/

	static public function mdlEliminarProveedor($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET UsuAnu = :UsuAnu, PcAnu = :PcAnu ,FecAnu = :FecAnu,EstPro='0' WHERE CodRuc = :CodRuc");

		$stmt -> bindParam(":CodRuc", $datos["CodRuc"], PDO::PARAM_STR);
        $stmt -> bindParam(":UsuAnu", $datos["UsuAnu"], PDO::PARAM_STR);
        $stmt -> bindParam(":PcAnu", $datos["PcAnu"], PDO::PARAM_STR);
        $stmt -> bindParam(":FecAnu", $datos["FecAnu"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

	/*=============================================
	MOSTRAR MONEDAS
	=============================================*/

	static public function mdlMostrarMonedas(){

		$stmt = Conexion::conectar()->prepare("SELECT DISTINCT  * FROM Tabla_M_Detalle WHERE  Cod_Tabla = 'TMON' AND Cod_Argumento NOT LIKE '0'");

		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

    }

}