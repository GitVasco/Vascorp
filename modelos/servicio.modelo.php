<?php

require_once "conexion.php";

class ModeloServicios{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarServicios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector WHERE se.$item = :$item ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT se.*, s.nom_sector FROM  $tabla se LEFT JOIN sectorjf s on se.taller = s.cod_sector  ORDER BY se.id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	// Método para Mostrar los detalles de servicios
	static public function mdlMostraDetallesServicios($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt=null;

	}

	static public function mdlMostraDetallesServicioUnico($tabla,$item,$valor){

		$sql="SELECT * FROM $tabla WHERE $item=:$item ORDER BY id ASC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;

	}


	
	// Método para guardar los servicios
	static public function mdlGuardarServicios($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,usuario,taller,total,fecha,estado) VALUES (:codigo,:usuario,:taller,:total,:fecha,:estado)";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_INT);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estado"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt=null;
	}	
	
	// Método para guardar las ventas
	static public function mdlGuardarDetallesServicios($tabla,$datos){

		$sql="INSERT INTO $tabla(codigo,articulo,cantidad,saldo) VALUES (:codigo,:articulo,:cantidad,:saldo)";

		$stmt=Conexion::conectar()->prepare($sql);
		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$datos["articulo"],PDO::PARAM_STR);
		$stmt->bindParam(":cantidad",$datos["cantidad"],PDO::PARAM_INT);
		$stmt->bindParam(":saldo",$datos["saldo"],PDO::PARAM_INT);
		
		$stmt->execute();

		$stmt=null;
	}

	// Método para editar las ventas
	static public function mdlEditarServicios($tabla,$datos){

		$sql="UPDATE $tabla SET codigo=:codigo,usuario=:usuario,taller=:taller,total=:total,fecha=:fecha WHERE codigo=:codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
		$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
		$stmt->bindParam(":taller",$datos["taller"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		}

		$stmt=null;
	}
	// Método para editar los detalles de ventas - NO ES NECESARIO
	static public function mdlEditarDetallesServicios($tabla,$datos){

		$sql="UPDATE $tabla SET impuesto=:impuesto,neto=:neto,total=:total,metodo_pago=:metodo_pago WHERE codigo=:codigo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_INT);
		$stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
		$stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
		$stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago",$datos["metodo_pago"],PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		$stmt=null;
	}

	/*=============================================
	ELIMINAR SERVICIO
	=============================================*/

	static public function mdlEliminarServicio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
	
	// Método para actualizar un dato CON EL ID
	static public function mdlActualizarUnDato($tabla,$item1,$valor1,$valor2){

		$sql="UPDATE $tabla SET $item1=:$item1 WHERE articulo=:articulo";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":articulo",$valor2,PDO::PARAM_STR);

		$stmt->execute();

		$stmt=null;

	}

	// Método para actualizar un dato con el PRODUCTO_CODIGO
	static public function mdlActualizarUnDatoArticulo($tabla,$item1,$valor1,$valor2){

		$sql="UPDATE $tabla SET $item1=:$item1 WHERE codigo=:id";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":id",$valor2,PDO::PARAM_INT);

		$stmt->execute();

		$stmt=null;

	}
	

	
	// Método para pedir último Id de venta
	static public function mdlUltimoId($tabla,$cliente,$vendedor){
		$sql="SELECT * FROM $tabla WHERE id_cliente=:id_cliente AND id_vendedor=:id_vendedor ORDER BY fecha DESC";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":id_cliente",$cliente,PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor",$vendedor,PDO::PARAM_STR);

		$stmt->execute();

		# Retornamos un fetchAll por ser más de una línea la que necesitamos devolver
		return $stmt->fetchAll();

		$stmt=null;
	}



	// Método para eliminar un detalle de venta
	static public function mdlEliminarDato($tabla,$item,$valor){

		$sql="DELETE FROM $tabla WHERE $item=:$item";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";
		
		}else{

			return "error";
		
		}

		$stmt=null;
	}
	
	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalServicios($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlUltimoServicio($tabla){

		$sql="SELECT COUNT(codigo) + 1 AS ultimo_codigo FROM $tabla";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetch();

		$stmt=null;


	}

	/*=============================================
	CREAR PRECIO SERVICIO
	=============================================*/

	static public function mdlIngresarPrecioServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(taller,modelo,precio_doc) VALUES (:taller,:modelo,:precio_doc)");

		$stmt->bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}    

	/*=============================================
	MOSTRAR PRECIO SERVICIO
	=============================================*/

	static public function mdlMostrarPrecioServicios($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT pd.*,m.nombre FROM $tabla pd LEFT JOIN modelojf  m ON pd.modelo = m.modelo WHERE pd.$item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT pd.*,m.nombre FROM $tabla pd LEFT JOIN modelojf  m ON pd.modelo = m.modelo ORDER BY pd.id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }
    
	/*=============================================
	EDITAR PRECIO SERVICIO
	=============================================*/

	static public function mdlEditarPrecioServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET taller = :taller, modelo = :modelo, precio_doc=:precio_doc WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":taller", $datos["taller"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datos["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_doc", $datos["precio_doc"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
	
	
	/*=============================================
	ELIMINAR PRECIO SERVICIO
	=============================================*/

	static public function mdlEliminarPrecioServicio($tabla,$datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}    

	//VISUALIZAR DETALLE SERVICIO
	static public function mdlVisualizarServicioDetalle($valor){

		if($valor != null){
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t8,
			SUM(sd.cantidad) AS total 
		  FROM
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s
			  ON s.codigo = sd.codigo
			LEFT JOIN sectorjf se
			  ON  s.taller=se.cod_sector
		  WHERE sd.codigo = :valor
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color");
	
			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
	
			$stmt->execute();
	
			return $stmt->fetchAll();
		}else{
			$stmt = Conexion::conectar()->prepare("SELECT 
			sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color,
			se.cod_sector,
			se.nom_sector,
			SUM(
			  CASE
				WHEN a.cod_talla = '1' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t1,
			SUM(
			  CASE
				WHEN a.cod_talla = '2' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t2,
			SUM(
			  CASE
				WHEN a.cod_talla = '3' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t3,
			SUM(
			  CASE
				WHEN a.cod_talla = '4' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t4,
			SUM(
			  CASE
				WHEN a.cod_talla = '5' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t5,
			SUM(
			  CASE
				WHEN a.cod_talla = '6' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t6,
			SUM(
			  CASE
				WHEN a.cod_talla = '7' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t7,
			SUM(
			  CASE
				WHEN a.cod_talla = '8' 
				THEN sd.cantidad 
				ELSE 0 
			  END
			) AS t8,
			SUM(sd.cantidad) AS total 
		  FROM
			servicios_detallejf sd 
			LEFT JOIN articulojf a 
			  ON sd.articulo = a.articulo 
			LEFT JOIN serviciosjf s
			  ON s.codigo = sd.codigo
			LEFT JOIN sectorjf se
			  ON  s.taller=se.cod_sector
		  GROUP BY sd.codigo,
			a.modelo,
			a.nombre,
			a.cod_color,
			a.color
			ORDER BY a.modelo ASC");

		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();
		}
		$stmt=null;

	}
    
}