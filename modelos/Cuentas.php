<?php
require "../config/conexion.php";

Class Cuentas{
    //constructor
	public function _construct(){

    }

	//metodo para insertar
	public function verificarCuentaPorImei($imei){

		$sql="SELECT * FROM cuentas ORDER BY imei = '$imei' desc";
		
        return ejecutarConsultaSimpleFila($sql);
        //return $sql;
	}
}
?>