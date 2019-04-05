<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Distrito_municipal{

	//constructor
	public function _construct(){

	}

	//metodo para listar los datos para select
	public function select($id_municipio){
		$sql="SELECT * FROM distrito_municipal where id_municipio='$id_municipio' ";

		return ejecutarConsulta($sql);
	}

}

?>