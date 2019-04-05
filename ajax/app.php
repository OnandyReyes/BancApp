<?php
require_once "../modelos/Ticket.php";

$ticket= new Ticket();

$recibir_jugadas=isset($_POST['jugadas'])? limpiarCadena($_POST['jugadas']):"";
$jugadas_nuevas=json_decode($recibir_jugadas,true);
$usuario=isset($_POST['user'])? limpiarCadena($_POST['user']):"";

switch ($_GET["op"]) {
    case 'crearFactura':
        $estado = true;
        $msj = "Esto es un mensaje";

        //$respuesta =$ticket->insertar("01010101","1",$jugadas_nuevas);

        $array = [
		    "estado" => $respuesta,
		    "mensaje" => $msj,
		    "jugadas" => $jugadas_nuevas,
		    "usuario" => $usuario
		];

		echo json_encode($array);
    break;
}
?>