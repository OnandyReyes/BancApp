<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Permiso{

	//constructor
	public function _construct(){

	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT * FROM permiso ";

		return ejecutarConsulta($sql);
	}

}

?>