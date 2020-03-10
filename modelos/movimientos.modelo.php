<?php

require_once "conexion.php";

class ModeloMovimientos{

   /* 
   * total unidades vendidas del mes actual y mes pasado
   */
   static public function mdlTotUndVen($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1003_venta_mes_und()");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1004_venta_mes_und_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

   }

   /* 
   * total unidades producidas del mes actual y pasado
   */
   static public function mdlTotUndProd($valor){

      if($valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1005_produccion_mes_und");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1006_produccion_mes_und_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }

   }
   
   /* 
   * query para sacar los meses codigo y nombre
   */
   static public function mldMesesMov(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1011_nombre_meses()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de ventas por mes
   */
   static public function mdlTotalMesVent(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1001_venta_anoxmes_und()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los totales de produccion por mes
   */
   static public function mdlTotalMesProd(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1002_produccion_anoxmes_und()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }
   
   /* 
   * sacamos los totales por mes de la  nueva tabla TOTALES
   */
   static public function mldMostrarTotales(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1007_resumen_mov_mes()");

      $stmt -> execute();

      return $stmt -> fetchAll();

      $stmt -> close();

      $stmt = null;

   }

   /* 
	* Método para actualizar los totales por dia
	*/
	static public function mdlActualizarMovimientos($valor1,$valor2){
	
		$sql="CALL sp_1008_actualizar_totales_p($valor1, $valor2)";

		$stmt=Conexion::conectar()->prepare($sql);

		if($stmt->execute()){

			return "ok";
		
		}else{
		
			return "error";
		
		}
		
		$stmt=null;

	}

   /* 
   * sacamos las ventas de los ultimos 3 años, por mes y año
   */
   static public function mdlTotalesSolesVenta(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1009_ventas_ult_3annos()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * sacamos los pagos por mes y año
   */
   static public function mdlTotalesSolesPagos(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1010_pagos_ult_3annos()");

      $stmt -> execute();

      return $stmt -> fetchall();

   }

   /* 
   * total de dias con produccion del mes pasado
   */
   static public function mdlTotDiasProd($valor){

      $stmt = Conexion::conectar()->prepare("CALL sp_1012_contar_dias_prod_p('$valor')");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 
   
   /* 
   * top 10 de ventas modelos
   */
   static public function mdlMovMes($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1013_top10_mod()");

         $stmt -> execute();

         return $stmt -> fetchALL();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1014_top10_mod_p($valor)");

         $stmt -> execute();

         return $stmt -> fetchAll();

         $stmt -> close();

         $stmt = null;

      }


   }    

   /* 
   * Cantidad total de unidades vendidas el mes actual
   */
   static public function mdlSumaUnd($valor){

      if( $valor == null){

         $stmt = Conexion::conectar()->prepare("CALL sp_1015_vent_und_total_mes()");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }else{

         $stmt = Conexion::conectar()->prepare("CALL sp_1016_vent_und_total_mes_p($valor)");

         $stmt -> execute();

         return $stmt -> fetch();

         $stmt -> close();

         $stmt = null;

      }


   }    

   /* 
   * MOSTRAR ULTIMO NUMERO DE TALONARIO
   */
   static public function mdlMostrarTalonario(){

      $stmt = Conexion::conectar()->prepare("CALL sp_1017_consulta_talonarios()");

      $stmt -> execute();

      return $stmt -> fetch();

      $stmt -> close();

      $stmt = null;
   } 


}