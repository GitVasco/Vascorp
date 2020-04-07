<?php

require_once "conexion.php";

class ModeloTrabajador{
/*=============================================
	MOSTRAR TRABAJADOR
	=============================================*/

	static public function mdlMostrarTrabajador($tabla,$item,$valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                            cod_tra,
                                                            d.tipo_doc,
                                                            nro_doc_tra,
                                                            nom_tra,
                                                            ape_pat_tra,
                                                            ape_mat_tra,
                                                            tt.nom_tip_trabajador,
															estado,
                                                            sueldo_total
															
                                                        FROM
                                                            $tabla t,
                                                            tipo_documentojf d,
                                                            tipo_trabajadorjf tt 
                                                        WHERE d.cod_doc = t.cod_doc 
                                                            AND tt.cod_tip_tra = t.cod_tip_tra");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    /*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarTrabajador($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla( cod_doc, nro_doc_tra, nom_tra, ape_pat_tra, ape_mat_tra, cod_tip_tra, sueldo_total) VALUES ( :cod_doc, :nro_doc_tra, :nom_tra, :ape_pat_tra, :ape_mat_tra, :cod_tip_tra, :sueldo_total)");

		//$stmt->bindParam(":cod_tra", $datos["cod_tra"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_doc", $datos["cod_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_doc_tra", $datos["nro_doc_tra"], PDO::PARAM_STR);
		$stmt->bindParam(":nom_tra", $datos["nom_tra"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_pat_tra", $datos["ape_pat_tra"], PDO::PARAM_STR);
        $stmt->bindParam(":ape_mat_tra", $datos["ape_mat_tra"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_tip_tra", $datos["cod_tip_tra"], PDO::PARAM_STR);

		$stmt->bindParam(":sueldo_total", $datos["sueldo_total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

    /*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarTrabajador($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  cod_doc = :cod_doc , nro_doc_tra = :nro_doc_tra, nom_tra = :nom_tra, ape_pat_tra = :ape_pat_tra, ape_mat_tra = :ape_mat_tra, cod_tip_tra = :cod_tip_tra, sueldo_total = :sueldo_total WHERE cod_tra = :cod_tra");


		
        $stmt->bindParam(":cod_doc", $datos["cod_doc"], PDO::PARAM_INT);
        $stmt->bindParam(":nro_doc_tra", $datos["nro_doc_tra"], PDO::PARAM_INT);
		$stmt->bindParam(":nom_tra", $datos["nom_tra"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_pat_tra", $datos["ape_pat_tra"], PDO::PARAM_STR);
		$stmt->bindParam(":ape_mat_tra", $datos["ape_mat_tra"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_tip_tra", $datos["cod_tip_tra"], PDO::PARAM_INT);
		$stmt->bindParam(":sueldo_total", $datos["sueldo_total"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_tra", $datos["cod_tra"], PDO::PARAM_INT);
        
       

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}	


    /*=============================================
	ELIMINAR OPERACION
	=============================================*/

	static public function mdlEliminarTrabajador($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cod_tra = :cod_tra");

		$stmt -> bindParam(":cod_tra", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	} 
	
	
	/*
	* MOSTRAR TRABAJADORES ACTIVOS
	*/

	static public function mdlMostrarTrabajadorActivo(){

		$stmt = Conexion::conectar()->prepare("SELECT 
		cod_tra,
		d.tipo_doc,
		nro_doc_tra,
		nom_tra,
		ape_pat_tra,
		ape_mat_tra,
		tt.nom_tip_trabajador,
		estado,
		sueldo_total
	FROM
		trabajadorjf t,
		tipo_documentojf d,
		tipo_trabajadorjf tt
	WHERE
		d.cod_doc = t.cod_doc
			AND tt.cod_tip_tra = t.cod_tip_tra
			AND t.estado = 'activo'");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

    }


}