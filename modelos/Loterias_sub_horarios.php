<?php
require "../config/conexion.php";

Class Loterias_sub_horarios{
    //constructor
	public function _construct(){

    }

	//metodo para insertar
	public function traerHorarioPorDia($dia, $loteria){

		$sql="SELECT * FROM loterias_sub_horarios lsh INNER JOIN loterias_sub ls on ls.id_loteria_sub = lsh.id_loteria_sub WHERE ls.id_loteria_sub = '$loteria' AND lsh.id_dia = '$dia' ORDER BY lsh.id_loteria_sub_horario desc";
		
        return ejecutarConsultaSimpleFila($sql);
        //return $sql;
	}

	//metodo para insertar
	public function traerHorarioPorDiaString($dia, $loteria){

		$sql="SELECT * FROM loterias_sub_horarios lsh INNER JOIN loterias_sub ls on ls.id_loteria_sub = lsh.id_loteria_sub WHERE ls.id_loteria_sub = '$loteria' AND lsh.id_dia = '$dia' ORDER BY lsh.id_loteria_sub_horario desc";
		
        //return ejecutarConsultaSimpleFila($sql);
        return $sql;
	}
}
?>