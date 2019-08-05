<?php
if(strlen(session_id())< 1)
session_start();

require_once "../modelos/Usuarios.php";
$usuarios= new Usuarios();

switch ($_GET["op"]) {
    case 'listar':
		$respuesta=$usuarios->listar_vendedores();
		$data = Array();
		
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>($objeto->estado)?'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-warning" onclick="desactivar('.$objeto->id_usuario.')"><i class="fa fa-close"></i> Desactivar</button>':
					'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$objeto->id_usuario.')"><i class="fa fa-check"></i> Activar</button>',
				"1"=>$objeto->id_usuario,
				"2"=>$objeto->usuario,
				"3"=>$objeto->nombres.' '.$objeto->apellidos,
				"4"=>($objeto->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>');
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