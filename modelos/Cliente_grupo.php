<?php  
//conexion a la base de datos
require "../config/conexion.php";

Class Cliente_grupo{

	//constructor
	public function _construct(){

	}

	//metodo para insertar
	public function insertar($id_grupo, $id_cliente){

		$sql="INSERT INTO cliente_grupo (id_grupo,id_cliente) VALUES ('$id_grupo','$id_cliente')";

		return ejecutarConsulta($sql);
		
    }
    
    //metodo para editar
	public function editar($id_grupo,$id_cliente){
		$sql="UPDATE cliente_grupo SET id_grupo='$id_grupo' WHERE id_cliente='$id_cliente' ";

		return ejecutarConsulta($sql);
	}

}

?>