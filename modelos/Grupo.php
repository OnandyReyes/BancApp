<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Grupo{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar( $nombre , $estado){

		$sql="INSERT INTO grupo ( nombre, estado) 
        VALUES ('$nombre','$estado')";

		return ejecutarConsulta($sql);
		
		//return $sql;
	}

	//metodo para editar
	public function editar($id_grupo,$nombre){
		$sql="UPDATE grupo SET nombre='$nombre' WHERE id_grupo='$id_grupo'";

		return ejecutarConsulta($sql);
	}

	public function listar(){
		$sql="SELECT * FROM grupo ";

		return ejecutarConsulta($sql);
	}

	//metodo para mostrar los datos de uno especifico
	public function mostrar($id_grupo){
		$sql="SELECT * FROM grupo WHERE id_grupo='$id_grupo'";

		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para desactivar
	public function desactivar($id_grupo){
		$sql="UPDATE grupo SET estado='0' WHERE id_grupo='$id_grupo'";

		return ejecutarConsulta($sql);
	}

	//metodo para activar
	public function activar($id_grupo){
		$sql="UPDATE grupo SET estado='1' WHERE id_grupo='$id_grupo'";

		return ejecutarConsulta($sql);
	}

}

?>