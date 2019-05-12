<?php
require_once "../modelos/Loterias.php";

$loterias= new Loterias();

$id_usuario =  $_SESSION['id_usuario'];

date_default_timezone_set ('America/Santo_Domingo');
    
$fecha = new DateTime();
$fecha = $fecha->format('Y-m-d H:i:m');

switch ($_GET["op"]) {
    case 'listar':

        $respuesta=$loterias->listar();
        $data = Array();

        while ($objeto = $respuesta->fetch_object()) {

                $data[]=array(
                "0"=>$objeto->id_loteria_sub,
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