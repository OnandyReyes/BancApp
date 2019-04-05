<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Provincia{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($nombre){
		$sql="INSERT INTO provincia (nombre) VALUES ('$nombre')";

		return ejecutarConsulta($sql);
	}

	//metodo para editar
	public function editar($id_provincia,$nombre){
		$sql="UPDATE provincia SET nombre='$nombre' WHERE id_provincia='$id_provincia'";

		return ejecutarConsulta($sql);
	}

	//metodo para Borrar
	public function delete($id_provincia){
		$sql="DELETE provincia WHERE id_provincia='$id_provincia'";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_provincia){
		$sql="SELECT * FROM provincia WHERE id_provincia='$id_provincia'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT * FROM provincia ";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function select(){
		$sql="SELECT * FROM provincia ";

		return ejecutarConsulta($sql);
	}

}

?>