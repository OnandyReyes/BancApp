<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Municipio{

	//constructor
	public function _construct(){

	}

	//metodo para listar los datos para select
	public function select($id_provincia){
		$sql="SELECT * FROM municipio where id_provincia='$id_provincia' ";

		return ejecutarConsulta($sql);
	}

}

?>