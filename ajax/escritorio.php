<?php

switch ($_GET["op"]) {
    case 'jugadasHoy':
        require_once "../modelos/Ticket.php";

        $ticket= new Ticket();

        $respuesta=$ticket->listaHoy();
        $data = Array();

        while ($objeto = $respuesta->fetch_object()) {

                $data[]=array(
                "0"=>$objeto->id_ticket,
                "1"=>$objeto->nombres." ".$objeto->apellidos,
                "2"=>date_format(date_create($objeto->fecha_creacion), 'd/m/Y H:i:s'),
                "3"=>'<button id="'.$objeto->id_ticket.'" type="button" class="btn btn-primary abrirModal">Ver</button>'
            );
        }

        $resultados = array(
                "sEcho" => 1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
        echo json_encode($resultados);

    break;
    case '':
        require_once "../modelos/Numeros_ganadores.php";

        $numeros_ganadores= new Numeros_ganadores();

        $respuesta=$numeros_ganadores->listaHoy();
        $data = Array();

        while ($objeto = $respuesta->fetch_object()) {

                $data[]=array(
                "0"=>$objeto->id_ticket,
                "1"=>$objeto->nombres." ".$objeto->apellidos,
                "2"=>date_format(date_create($objeto->fecha_creacion), 'd/m/Y H:i:s'),
                "3"=>'<button id="'.$objeto->id_ticket.'" type="button" class="btn btn-primary abrirModal">Ver</button>'
            );
        }

        $resultados = array(
                "sEcho" => 1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
        echo json_encode($resultados);
    break;

    
}
?>