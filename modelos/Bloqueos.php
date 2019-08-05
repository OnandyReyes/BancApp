<?php
Class Bloqueos{
    //constructor
	public function _construct(){

    }
    
    public function general($ticket_detalle, $id_usuario){
			require_once "../modelos/Cuentas.php";

			$cuentas= new Cuentas();
																			
			$usuario = $cuentas->seleccionar($id_usuario);
			
			$tipo = "";

			if($ticket_detalle["numeros"] >= 0){
					$tipo = "Quiniela";
			}

			if($ticket_detalle["numeros2"] >= 0){
					$tipo = "Pale";
			}

			if($ticket_detalle["numeros3"] >= 0){
					$tipo = "Tripleta";
			}

			switch ($tipo) {
				case "Quiniela":
					return $this->quiniela($ticket_detalle, $usuario);
					break;
				case "Pale":
					return $this->pale($ticket_detalle, $usuario);
					break;
				case "Tripleta":
					return $this->tripleta($ticket_detalle, $usuario);
					break;
				default:
					# code...
					break;
			}
		}
		
		public function quiniela($ticket_detalle, $usuario){
			$monto = 0;

			require_once "../modelos/Ticket.php";

			$tickets= new Ticket();

			$fecha = new DateTime();

			$fecha = $fecha->format('Y-m-d H:i:m');
		
			$rpt = $tickets->DetalleTicketLoteriaHoy($ticket_detalle["id_loteria_sub"], $fecha);

			while($obj = $rpt->fetch_object()){
				if($ticket_detalle["numeros"] == $obj->numero ){
					$monto += $obj->monto;
				}
			}

			$monto += $ticket_detalle["monto"];
			
			$estado = false;

			if($monto > $usuario["bloqueoNumero"]){
				$estado = true;
			}

			return $estado;
		}
    
		public function pale($ticket_detalle, $usuario){
			$monto = 0;

			require_once "../modelos/Ticket.php";

			$tickets= new Ticket();

			$fecha = new DateTime();

			$fecha = $fecha->format('Y-m-d H:i:m');
		
			$rpt = $tickets->DetalleTicketLoteriaHoy($ticket_detalle["id_loteria_sub"], $fecha);

			while($obj = $rpt->fetch_object()){
				if($ticket_detalle["numeros"] == $obj->numero && $ticket_detalle["numeros2"] == $obj->numero2){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros2"] == $obj->numero && $ticket_detalle["numeros"] == $obj->numero2){
					$monto += $obj->monto;
				}
			}

			$monto += $ticket_detalle["monto"];
			
			$estado = false;

			if($monto > $usuario["bloqueoPale"]){
				$estado = true;
			}

			return $estado;
		}

		public function tripleta($ticket_detalle, $usuario){
			$estado = false;

			$monto = 0;

			require_once "../modelos/Ticket.php";

			$tickets= new Ticket();

			$fecha = new DateTime();

			$fecha = $fecha->format('Y-m-d H:i:m');
		
			$rpt = $tickets->DetalleTicketLoteriaHoy($ticket_detalle["id_loteria_sub"], $fecha);

			while($obj = $rpt->fetch_object()){
				if($ticket_detalle["numeros"] == $obj->numero && $ticket_detalle["numeros2"] == $obj->numero2 && 
				$ticket_detalle["numeros3"] == $obj->numero3){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros"] == $obj->numero && $ticket_detalle["numeros2"] == $obj->numero3 && 
				$ticket_detalle["numeros3"] == $obj->numero2){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros"] == $obj->numero2 && $ticket_detalle["numeros2"] == $obj->numero && 
				$ticket_detalle["numeros3"] == $obj->numero2){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros"] == $obj->numero2 && $ticket_detalle["numeros2"] == $obj->numero3 && 
				$ticket_detalle["numeros3"] == $obj->numero){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros"] == $obj->numero3 && $ticket_detalle["numeros2"] == $obj->numero2 && 
				$ticket_detalle["numeros3"] == $obj->numero){
					$monto += $obj->monto;
				}

				if($ticket_detalle["numeros"] == $obj->numero3 && $ticket_detalle["numeros2"] == $obj->numero && 
				$ticket_detalle["numeros3"] == $obj->numero2){
					$monto += $obj->monto;
				}
			}

			$monto += $ticket_detalle["monto"];
			
			$estado = false;

			if($monto > $usuario["bloqueoTripleta"]){
				$estado = true;
			}

			return $estado;
		}
	
}
?>