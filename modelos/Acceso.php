<?php
require "../config/conexion.php";

Class Acceso{
    //constructor
	public function _construct(){

    }

	//metodo para insertar
	public function verificar(){

		$sql="SELECT * FROM acceso ORDER BY id_acceso desc";
		
        return ejecutarConsultaSimpleFila($sql);
        //return $sql;
	}

}
?>