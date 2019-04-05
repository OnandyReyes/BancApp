<?php  

require_once "../modelos/Permiso.php";

$permiso= new Permiso();

switch ($_GET["op"]) {
	case 'listar':
		$respuesta=$permiso->listar();
		$data = Array();
		
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>$objeto->nombre
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