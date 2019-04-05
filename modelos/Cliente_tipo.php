<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Cliente_tipo{

	//constructor
	public function _construct(){

	}

	//metodo para listar los datos para select
	public function select(){
		$sql="SELECT * FROM cliente_tipo ";

		return ejecutarConsulta($sql);
	}

}

?>