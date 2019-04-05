<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Sector{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($nombre){
		$sql="INSERT INTO sector (nombre) VALUES ('$nombre')";

		return ejecutarConsulta($sql);
	}

	//metodo para editar
	public function editar($id_sector,$nombre){
		$sql="UPDATE sector SET nombre='$nombre' WHERE id_sector='$id_sector'";

		return ejecutarConsulta($sql);
	}

	//metodo para Borrar
	public function delete($id_sector){
		$sql="DELETE sector WHERE id_sector='$id_sector'";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_sector){
		$sql="SELECT * FROM sector WHERE id_sector='$id_sector'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT * FROM sector ";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function select($id_provincia){
		$sql="SELECT * FROM sector where id_provincia='$id_provincia' ";

		return ejecutarConsulta($sql);
	}

}

?>