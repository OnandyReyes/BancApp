<?php
require_once "../modelos/Cuentas.php";
$cuentas= new Cuentas();

require_once "../modelos/Ticket.php";
$tickets= new Ticket();

require_once "../modelos/Numeros_ganadores.php";
$numeros_ganadores= new Numeros_ganadores();

date_default_timezone_set ('America/Santo_Domingo');

$fecha = new DateTime();
$fecha = $fecha->format('Y-m-d H:i:m');


switch ($_GET["op"]) {
case 'cuadreFiltro':
    $fecha_inicio=$_GET["fecha_inicio"];
    $fecha_fin=$_GET["fecha_fin"];
    $id_vendedor =$_GET["id_vendedor"];
    
    if($id_vendedor == 0){
        $respuesta=$cuentas->listaVendedores();
    }else{
        $respuesta=$cuentas->listaVendedoresFiltro($id_vendedor);
    }
    
    $data = Array();
                                    
    $total_venta = 0;
    $total_premios = 0;
    $total_comision = 0;
    $total_ganancia = 0;

    echo '<thead>
        <th>Vendedor</th>
        <th>Venta</th>
        <th>Premios</th>
        <th>Comision</th>
        <th>Ganancia</th>
      </thead><tbody>';

    while ($objeto = $respuesta->fetch_object()) {
        
        $ticketVendedores = $tickets->ticketsIdUsuarioRango($objeto->id_usuario, $fecha_inicio, $fecha_fin );
        //$ticketVendedores = $tickets->ticketsIdUsuarioHoy($objeto->id_usuario, $fecha );
        $venta = 0;
        $premio = 0;

        $usuario = $cuentas->seleccionar($objeto->id_usuario);

        while($objeto2 = $ticketVendedores->fetch_object()){
            $tickets_detalles = $tickets->DetalleTicketId($objeto2->id_ticket);
            
            while($objeto3 = $tickets_detalles->fetch_object()){
            
              $tipoJugada = "";

              if($objeto3->numero >= 0){
                  $tipoJugada = "Quiniela";
              }

              if($objeto3->numero2 >= 0){
                  $tipoJugada = "Pale";
              }

              if($objeto3->numero3 >= 0){
                  $tipoJugada = "Tripleta";
              }

                $variable_tickets_detalle = $tickets->DetalleTicketIdTicket($objeto3->id_ticket_detalle);
                $variable_numeros_ganadores = $numeros_ganadores->ganadoresLoteriaId($objeto3->id_loteria_sub, $objeto2->fecha_creacion);
                
                $premio += $numeros_ganadores->verificarGanador($variable_tickets_detalle, $variable_numeros_ganadores, $usuario, $tipoJugada );

                $venta += $objeto3->monto;

            }
        }   

        $comision = 0;
        
        $comision = $usuario["comision"] / 100;

        $comision = $venta * $comision;
        
        $ganancia = $venta - ($premio + $comision);

        $total_comision += $comision;
        $total_ganancia += $ganancia;
        $total_venta += $venta ;
        $total_premios += $premio;

        echo '<tr>';
        echo '<td>'.$objeto->usuario.'</td>'; 
        echo '<td>'.$venta.'</td>'; 
        echo '<td>'.$premio.'</td>';
        echo '<td>'.$comision.'</td>'; 
        echo '<td>'.$ganancia.'</td>';
        echo '</tr>';

    }
    
    echo '</tbody><tfoot>
        <th>Total : </th>
        <th>'.$total_venta.'</th>
        <th>'.$total_premios.'</th>
        <th>'.$total_comision.'</th>
        <th>'.$total_ganancia.'</th>
      </tfoot>';
break;
case 'jugadasFiltro':
    $fecha_inicio=$_GET["fecha_inicio"];
    $fecha_fin=$_GET["fecha_fin"];
    $id_vendedor =$_GET["id_vendedor"];
    
    if($id_vendedor == 0){
        $respuesta=$tickets->ticketsRango( $fecha_inicio, $fecha_fin );
    }else{
        $respuesta=$tickets->ticketsIdUsuarioRango($id_vendedor, $fecha_inicio, $fecha_fin );
    }

    echo '<table id="jugadasHoy" class="table table-striped table-bordered table-condensed table-hover"><thead>
        <th>#</th>
        <th>Usuario</th>
        <th>Fecha</th>
        <th>Accion</th>
        <th>Estado</th>
      </thead><tbody>';

    while ($objeto = $respuesta->fetch_object()) {

        $estilo = "";
        $premio = "";
        $resultado2 = $numeros_ganadores->ticketGanador($objeto->id_ticket);
        if($resultado2 > 0){
            $estilo = 'style="background-color:#C7EAB7;"';
            $premio = "Premiado";
        }

        echo '<tr '.$estilo.' >';
        echo '<td>'.$objeto->id_ticket.'</td>'; 
        echo '<td>'.$objeto->nombres." ".$objeto->apellidos.'</td>'; 
        echo '<td>'.date_format(date_create($objeto->fecha_creacion), 'd/m/Y H:i:s').'</td>';
        echo '<td><button id="'.$objeto->id_ticket.'" type="button" class="btn btn-primary abrirModal">Ver</button></td>'; 
        echo '<td>'.$premio.'</td>';
        echo '</tr>';
    }
    
    echo '</tbody><tfoot>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tfoot></table>';
break;
}
?>
