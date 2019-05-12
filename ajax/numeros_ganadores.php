<?php
require_once "../modelos/Numeros_ganadores.php";

$numeros_ganadores= new Numeros_ganadores();

$id_loteria_sub=isset($_POST['id_loteria_sub'])? limpiarCadena($_POST['id_loteria_sub']):"";
$primera=isset($_POST['primera'])? limpiarCadena($_POST['primera']):"";
$segunda=isset($_POST['segunda'])? limpiarCadena($_POST['segunda']):"";
$tercera=isset($_POST['tercera'])? limpiarCadena($_POST['tercera']):"";

$id_usuario =  $_SESSION['id_usuario'];

date_default_timezone_set ('America/Santo_Domingo');
    
$fecha = new DateTime();
$fecha = $fecha->format('Y-m-d H:i:m');

switch ($_GET["op"]) {
    case 'insertar':
        $guardar = true;
        $msj = "";

        if($guardar){
            $respuesta = $numeros_ganadores->insertar($id_loteria_sub, $fecha, $fecha, $primera, $segunda, $tercera, $id_usuario );
        
            if($respuesta){
                $msj = "Numeros Ganadores registrados correctamente!";

            }else{
                 $msj = "Numeros ganadores no se pudo agregar!";
                 $guardar = false;
            }
        }

        $array = [
		    "estado" => $guardar,
		    "mensaje" => $msj
		];

		echo json_encode($array);
    break;
    case 'listar':
        
        $respuesta=$numeros_ganadores->listaHoy();
        $data = Array();

        while ($objeto = $respuesta->fetch_object()) {

                $data[]=array(
                "0"=>$objeto->nombre,
                "1"=>$objeto->primera.' - '.$objeto->segunda.' - '.$objeto->tercera,
                "2"=>date_format(date_create($objeto->fecha_sorteo), 'd/m/Y H:i:s')
            );
        }

        $resultados = array(
                "sEcho" => 1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
        echo json_encode($resultados);

    break;
    case 'ganadoresXLoteria':
        

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