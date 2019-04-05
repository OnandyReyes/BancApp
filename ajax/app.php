<?php
require_once "../modelos/Ticket.php";

$ticket= new Ticket();

switch ($_GET["op"]) {
    case 'crearFactura':
        
        $recibir_jugadas=$_POST['jugadas'];
        $jugadas_nuevas=json_decode($recibir_jugadas,true);
        $usuario=$_POST['usuario'];

        $estado = true;
        $msj = "Esto es un mensaje";

        //$respuesta =$ticket->insertar("01010101","1",$jugadas_nuevas);

        $array = [
		    "estado" => $estado,
		    "mensaje" => $msj,
		    "jugadas" => $recibir_jugadas,
		    "usuario" => $usuario
		];

		echo json_encode($array);
    break;
    case 'probando':
        
        $array = [
            "estado" => "Nuevo Estado",
            "mensaje" => "Mensaje Nuevo"
        ];
        echo json_encode($array);
    break;
}
?>