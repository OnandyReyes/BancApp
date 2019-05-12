<?php
if(strlen(session_id())< 1)
session_start();

require_once "../modelos/Funciones.php";
$funciones= new Funciones();

require_once "../modelos/Ticket.php";
$ticket= new Ticket();

require_once "../modelos/Numeros_ganadores.php";
$numeros_ganadores= new Numeros_ganadores();

require_once "../modelos/Cuentas.php";
$cuentas= new Cuentas();

// if(!is_null($_POST['id_ticket'])){
//     $id_ticket = $funciones->descodificarJsonLimpiar($_POST['id_ticket']);
// }

switch ($_GET["op"]) {
    case 'ticketDetalle':
        $id_ticket = $funciones->descodificarJsonLimpiar($_GET['id_ticket']);

        $respuesta=$ticket->DetalleTicketId($id_ticket);
        $data = Array();

        while ($objeto = $respuesta->fetch_object()) {
                $numeros = "";
                $tipoJugada = "";

                if($objeto->numero >= 0){
                    $numeros .= $objeto->numero;
                    $tipoJugada = "Quiniela";
                }

                if($objeto->numero2 >= 0){
                    $numeros .= "-".$objeto->numero2;
                    $tipoJugada = "Pale";
                }

                if($objeto->numero3 >= 0){
                    $numeros .= "-".$objeto->numero3;
                    $tipoJugada = "Tripleta";
                }

                $data[]=array(
                    "0"=>$objeto->nombre,
                    "1"=>$numeros,
                    "2"=>$tipoJugada,
                    "3"=>$objeto->nombre
                );
        }

        $resultados = array(
                "sEcho" => 1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
        echo json_encode($resultados);

    break;
    case 'ticketDetalleTable':
    //Recibimos el id_producto
    $id=$_GET['id'];

    $respuesta=$ticket->DetalleTicketId($id);
    
    echo '<thead>
                           <th>Loteria</th>
                            <th>Numeros</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Premio</th>
                          </thead>';


    while ($objeto = $respuesta->fetch_object()) {
                $numeros = "";
                $tipoJugada = "";

                if($objeto->numero >= 0){
                    $numeros .= $objeto->numero;
                    $tipoJugada = "Quiniela";
                }

                if($objeto->numero2 >= 0){
                    $numeros .= "-".$objeto->numero2;
                    $tipoJugada = "Pale";
                }

                if($objeto->numero3 >= 0){
                    $numeros .= "-".$objeto->numero3;
                    $tipoJugada = "Tripleta";
                }

                $premio = 0;
            
                $variable_tickets_detalle = $ticket->DetalleTicketIdTicket($objeto->id_ticket_detalle);
                
                date_default_timezone_set ('America/Santo_Domingo');
    
                $fecha = new DateTime();
                $fecha = $fecha->format('Y-m-d H:i:m');
    
                $variable_numeros_ganadores = $numeros_ganadores->ganadoresLoteriaId($objeto->id_loteria_sub, $fecha);
                
                $variable_ticket = $ticket->ticketsId($objeto->id_ticket);
                
                $variable_usuario = $cuentas->seleccionar($variable_ticket["id_usuario"]);
                
                $premio = $numeros_ganadores->verificarGanador($variable_tickets_detalle, $variable_numeros_ganadores, $variable_usuario,$tipoJugada );
    

                
                // $data[]=array(
                //     "0"=>$objeto->nombre,
                //     "1"=>$numeros,
                //     "2"=>$tipoJugada,
                //     "3"=>$objeto->nombre
                // );

        echo '<tr>
        <td>'.$objeto->nombre.'</td>
        <td>'.$numeros.'</td>
        <td>'.$tipoJugada.'</td>
        <td>'.$objeto->monto.'</td>
        <td>'.$premio.'</td>
        </tr>';
    }

    echo '<tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tfoot>';

break;
case 'ticketDetallePrueba':
//Recibimos el id_producto
$id=$_GET['id'];

$respuesta=$ticket->DetalleTicketId($id);

echo '<table><thead>
                       <th>Loteria</th>
                        <th>Numeros</th>
                        <th>Tipo</th>
                        <th>Monto</th>
                        <th>Premio</th>
                      </thead>';


while ($objeto = $respuesta->fetch_object()) {
            $numeros = "";
            $tipoJugada = "";

            if($objeto->numero >= 0){
                $numeros .= $objeto->numero;
                $tipoJugada = "Quiniela";
            }

            if($objeto->numero2 >= 0){
                $numeros .= "-".$objeto->numero2;
                $tipoJugada = "Pale";
            }

            if($objeto->numero3 >= 0){
                $numeros .= "-".$objeto->numero3;
                $tipoJugada = "Tripleta";
            }

            $premio = 0;
            
            $variable_tickets_detalle = $ticket->DetalleTicketIdTicket($objeto->id_ticket_detalle);
            
            date_default_timezone_set ('America/Santo_Domingo');

		    $fecha = new DateTime();
		    $fecha = $fecha->format('Y-m-d H:i:m');

            $variable_numeros_ganadores = $numeros_ganadores->ganadoresLoteriaId($objeto->id_loteria_sub, $fecha);
            
            $variable_ticket = $ticket->ticketsId($objeto->id_ticket);
            
            $variable_usuario = $cuentas->seleccionar($variable_ticket["id_usuario"]);
            
            $premio = $numeros_ganadores->verificarGanador($variable_tickets_detalle, $variable_numeros_ganadores, $variable_usuario,$tipoJugada );

    echo '<tr>
    <td>'.$objeto->nombre.'</td>
    <td>'.$numeros.'</td>
    <td>'.$tipoJugada.'</td>
    <td>'.$objeto->monto.'</td>
    <td>'.$premio.'</td>
    </tr>';
}

echo '<tfoot>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tfoot></table>';

break;
    
}
?>