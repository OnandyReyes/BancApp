<?php
require "../config/conexion.php";

Class Ticket{
    //constructor
	public function _construct(){

    }
    
    //metodo para insertar
	public function insertar($serial,$id_usuario,$jugadas){
		
		//Aqui hay que hacer pila de codigo antes de guardar la venta
		
		$sw = true;
		
		date_default_timezone_set ('America/Santo_Domingo');

		$fecha_creacion = new DateTime();
		$fecha_creacion = $fecha_creacion->format('Y-m-d H:i:m');
		$sql="INSERT INTO tickets (serial, fecha_creacion, id_usuario, anular) VALUES ('$serial','$fecha_creacion','$id_usuario','0')";
		
		$id_ticket = ejecutarConsulta_retornarID($sql);
		
		$num_elementos=0;
		$sw=true;

		foreach($jugadas as $row){
			$numeros = $row["numeros"];
			$numeros2 = $row["numeros2"];
			$numeros3 = $row["numeros3"];
			$monto = $row["monto"];
			$loteria = $row["loteria"];
		 	$sql_detalle = "INSERT INTO tickets_detalles (id_ticket,numero,numero2,numero3,monto,id_loteria_sub,sorteo) VALUES ('$id_ticket','$numeros','$numeros2','$numeros3','$monto','$loteria','0')";
			 
			 //echo $value->sm_id; 
			 ejecutarConsulta($sql_detalle) or $sw = false;
		}
		
		//$numero,$numero2,$numero3,$monto,$id_loteria_sub,$sorteo
		// foreach($jugadas as $row)
        // {
		// 	$sql_detalle = "INSERT INTO tickets_detalles (id_ticket,numero,numero2,numero3,monto,id_loteria_sub,sorteo) VALUES ('$id_ticket','$row["Numero1"]','$row["Numero2"]','$row["Numero3"]','$row["Monto"]','$row["LoteriaId"]','0')";
		// 	ejecutarConsulta($sql_detalle) or $sw = false;
		// }

		return $sw;
	}

	//metodo para insertar
	public function ultimoIdTicket(){

		$sql="SELECT * FROM tickets ORDER BY id_ticket desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}
}
?>