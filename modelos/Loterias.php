<?php
require "../config/conexion.php";

Class Loterias{
    //constructor
	public function _construct(){

    }

    public function listar(){
		$sql="SELECT * FROM loterias_sub ";

		return ejecutarConsulta($sql);
	}

	//metodo para insertar
	public function select(){

		$sql="SELECT * FROM loterias_sub ";
		
        return ejecutarConsulta($sql);

	}

}
?>