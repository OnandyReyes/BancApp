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

		if (is_array($jugadas) || is_object($jugadas))
            {
                foreach ($jugadas as $row)
                {
                    $numeros = $row["numeros"];
					$numeros2 = $row["numeros2"];
					$numeros3 = $row["numeros3"];
					$monto = $row["monto"];
					$loteria = $row["loteria"];
					$sql_detalle = "INSERT INTO tickets_detalles (id_ticket,numero,numero2,numero3,monto,id_loteria_sub,sorteo) VALUES ('$id_ticket','$numeros','$numeros2','$numeros3','$monto','$loteria','0')";
					
					//return $sql_detalle;
					ejecutarConsulta($sql_detalle) or $sw = false;
                }
			}
			

		return $sw;
	}

	//metodo para insertar
	public function listaHoy(){

		date_default_timezone_set ('America/Santo_Domingo');

		$fecha_creacion = new DateTime();
		$fecha_creacion = $fecha_creacion->format('Y-m-d H:i:m');

		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario  WHERE DATE(fecha_creacion)=DATE('$fecha_creacion')";
		
		return ejecutarConsulta($sql);
	}

	public function ticketsIdUsuario($id_usuario){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario WHERE cu.id_usuario = '$id_usuario' ";

		return ejecutarConsulta($sql);
	}

	public function ticketsId($id_ticket){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario WHERE id_ticket = '$id_ticket' ";

		return ejecutarConsultaSimpleFila($sql);
	}


	public function ticketsIdUsuarioHoy($id_usuario, $hoy ){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario	WHERE cu.id_usuario = '$id_usuario' AND DATE(fecha_creacion) >= DATE('$hoy') AND DATE(fecha_creacion) <= DATE('$hoy') ";

		return ejecutarConsulta($sql);
		//return $sql;
	}

	public function ticketsIdUsuarioRango($id_usuario, $fecha_inicio, $fecha_fin ){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario	WHERE cu.id_usuario = '$id_usuario' AND DATE(fecha_creacion) >= DATE('$fecha_inicio') AND DATE(fecha_creacion) <= DATE('$fecha_fin') ";

		return ejecutarConsulta($sql);
		//return $sql;
	}

	public function ticketsRango( $fecha_inicio, $fecha_fin ){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario WHERE DATE(fecha_creacion) >= DATE('$fecha_inicio') AND DATE(fecha_creacion) <= DATE('$fecha_fin') ";

		return ejecutarConsulta($sql);
		//return $sql;
	}

	public function ticketsIdUsuarioRangoFecha($id_usuario, $desde, $hasta ){
		$sql="SELECT * FROM tickets t INNER JOIN cuentas cu on cu.id_usuario = t.id_usuario
		INNER JOIN usuarios us on us.id_usuario = cu.id_usuario	WHERE cu.id_usuario = '$id_usuario' AND DATE(fecha_creacion) >= '$desde' AND DATE(fecha_creacion) <= '$hasta' ";

		return ejecutarConsulta($sql);
		//return $sql;
	}

	public function DetalleTicketId($id_ticket){
		$sql="SELECT * FROM tickets_detalles td INNER JOIN loterias_sub ls on ls.id_loteria_sub = td.id_loteria_sub WHERE td.id_ticket = '$id_ticket' ";

		return ejecutarConsulta($sql);
	}

	public function DetalleTicketIdTicket($id_ticket_detalle){
		$sql="SELECT * FROM tickets_detalles td INNER JOIN loterias_sub ls on ls.id_loteria_sub = td.id_loteria_sub WHERE td.id_ticket_detalle = '$id_ticket_detalle' ";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function DetalleTicketLoteriaHoy($id_loteria_sub, $hoy){
		$sql="SELECT * FROM tickets_detalles td INNER JOIN tickets t on t.id_ticket = td.id_ticket 
		INNER JOIN loterias_sub ls on ls.id_loteria_sub = td.id_loteria_sub 
		WHERE td.id_loteria_sub = '$id_loteria_sub' AND DATE(t.fecha_creacion) = DATE('$hoy')  ";

		return ejecutarConsulta($sql);
	}

	//metodo para insertar
	public function ultimoIdTicket(){

		$sql="SELECT * FROM tickets ORDER BY id_ticket desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}

	//metodo para insertar
	public function ultimoIdTicketCreador($id_usuario){

		$sql="SELECT * FROM tickets WHERE id_usuario = '$id_usuario' ORDER BY id_ticket desc LIMIT 1";
		
		return ejecutarConsultaSimpleFila($sql);
	}

	public function verificarTicketCuenta($id_usuario, $id_ticket){

		$sql="SELECT * FROM tickets WHERE id_usuario = '$id_usuario' AND id_ticket = '$id_ticket' ORDER BY id_ticket desc LIMIT 1";
		
        return ejecutarConsultaSimpleFila($sql);
        //return $sql;
	}



	//metodo para eliminar
	public function eliminar($id_ticket){
		$sw=true;

		$sql= "DELETE FROM tickets_detalles WHERE id_ticket = '$id_ticket' ";

		ejecutarConsulta($sql) or $sw = false;

		$sql= "DELETE FROM tickets WHERE id_ticket = '$id_ticket' ";

		ejecutarConsulta($sql) or $sw = false;

		return $sw;
	}
}
?>