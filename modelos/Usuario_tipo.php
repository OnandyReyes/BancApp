<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Usuario_tipo{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($nombre){
		$sql="INSERT INTO usuario_tipo (nombre) VALUES ('$nombre')";

		return ejecutarConsulta($sql);
	}

	//metodo para editar
	public function editar($id_usuario_tipo,$nombre){
		$sql="UPDATE usuario_tipo SET nombre='$nombre' WHERE id_usuario_tipo='$id_usuario_tipo'";

		return ejecutarConsulta($sql);
	}

	//metodo para Borrar
	public function delete($id_usuario_tipo){
		$sql="DELETE usuario_tipo WHERE id_usuario_tipo='$id_usuario_tipo'";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_usuario_tipo){
		$sql="SELECT * FROM usuario_tipo WHERE id_usuario_tipo='$id_usuario_tipo'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para listar los datos
	public function listar(){
		$sql="SELECT * FROM usuario_tipo ";

		return ejecutarConsulta($sql);
	}

	//metodo para listar los datos para select
	public function select(){
		$sql="SELECT * FROM usuario_tipo WHERE id_usuario_tipo = 3";

		return ejecutarConsulta($sql);
	}

}

?>