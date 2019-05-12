<?php
require "../config/conexion.php";

Class Numeros_ganadores{
    //constructor
	public function _construct(){

	}

	public function insertar($id_loteria_sub, $fecha_creacion, $fecha_sorteo, $primera, $segunda, $tercera, $id_usuario ){

		$sw = true;

		$sql = "DELETE FROM numeros_ganadores WHERE id_loteria_sub = '$id_loteria_sub' AND DATE(fecha_sorteo) = DATE('$fecha_sorteo') ";

		ejecutarConsulta($sql) or $sw = false;

		if($sw == true){
			$sql = "INSERT INTO numeros_ganadores (id_loteria_sub,fecha_creacion,fecha_sorteo,primera,segunda,tercera,id_usuario) VALUES 
			('$id_loteria_sub','$fecha_creacion','$fecha_sorteo','$primera','$segunda','$tercera','$id_usuario')";
			
			ejecutarConsulta($sql) or $sw = false;
		}

		return $sw;
	}

	public function listaHoy(){

		date_default_timezone_set ('America/Santo_Domingo');

		$fecha_creacion = new DateTime();
		$fecha_creacion = $fecha_creacion->format('Y-m-d H:i:m');

		$sql="SELECT * FROM numeros_ganadores ng INNER JOIN loterias_sub ls on ng.id_loteria_sub = ls.id_loteria_sub WHERE DATE(ng.fecha_creacion)=DATE('$fecha_creacion')";
		//return $sql;
		return ejecutarConsulta($sql);
	}
	
	//metodo para insertar
	public function ganadoresLoteriaId($id_loteria_sub, $fecha){

		$sql="SELECT * FROM numeros_ganadores WHERE id_loteria_sub = '$id_loteria_sub' AND DATE(fecha_sorteo) =  DATE('$fecha') ORDER BY id_numero_ganador desc";
		
        return ejecutarConsultaSimpleFila($sql);
        //return $sql;
	}

	public function tipoJugada($numero, $numero2, $numero3){
		$tipo = 0;

		if($numero >= 0 && $numero2 >= 0 && $numero3 >= 0){
			$tipo = 3;
		}

		if($numero >= 0 && $numero2 >= 0){
			$tipo = 2;
		}

		if($numero >= 0 && $numero3 >= 0){
			$tipo = 2;
		}

		if($numero >= 0){
			$tipo = 1;
		}

		return $tipo;
	}

	public function verificarGanador($tickets_detalles, $numeros_ganadores, $usuario, $tipo){
		
		//$tipo = $this->tipoJugada($tickets_detalles["numero"], $tickets_detalles["numero2"], $tickets_detalles["numero3"]);

		switch ($tipo) {
			case "Quiniela":
				return $this->premioQuiniela($tickets_detalles, $numeros_ganadores, $usuario);
				break;
			case "Pale":
				return $this->premioPale($tickets_detalles, $numeros_ganadores, $usuario);
				break;
			case "Tripleta":
				return $this->premioTripleta($tickets_detalles, $numeros_ganadores, $usuario);
				break;
			default:
				# code...
				break;
		}
	}

	public function premioQuiniela($tickets_detalles, $numeros_ganadores, $usuario){
		$premio = 0;

		if($tickets_detalles["numero"] == $numeros_ganadores["primera"]){
			$premio += $tickets_detalles["monto"] * $usuario["primera"];
		}

		if($tickets_detalles["numero"] == $numeros_ganadores["segunda"]){
			$premio += $tickets_detalles["monto"] * $usuario["segunda"];
		}

		if($tickets_detalles["numero"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tercera"];
		}

		return $premio;

	}

	public function premioPale($tickets_detalles, $numeros_ganadores, $usuario){
		$premio = 0;

		//Primera y Segunda
		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["segunda"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["segunda"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale"];
		}

		//Primera y Tercera
		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale"];
		}

		if($tickets_detalles["numer2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale"];
		}

		//Segunda y Tercera
		if($tickets_detalles["numero"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale2"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["pale2"];
		}

		return $premio;
	}

	public function premioTripleta($tickets_detalles, $numeros_ganadores, $usuario){
		$premio = 0;

		//Primera, Segunda y Tercera
		//numero de primero
		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		//numero2 de primero
		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		//numero3 de primero
		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["segunda"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"]){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta"];
		}

		//Tripleta 2
		//numero y numero2
		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		//numero y numero3
		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		//numero2 y numero3
		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero2"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero3"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["segunda"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		if($tickets_detalles["numero3"] == $numeros_ganadores["primera"] &&
			$tickets_detalles["numero2"] == $numeros_ganadores["tercera"] ){
			$premio += $tickets_detalles["monto"] * $usuario["tripleta2"];
		}

		return $premio;
	}
}
?>