<?php  
if(strlen(session_id())< 1)
	session_start();
require_once "../modelos/Prestamo.php";

$prestamo = new Prestamo();

$id_prestamo=isset($_POST['id_prestamo'])? limpiarCadena($_POST['id_prestamo']):"";
$id_prestamo_tipo=isset($_POST['id_prestamo_tipo'])? limpiarCadena($_POST['id_prestamo_tipo']):"";
$monto=isset($_POST['monto'])? limpiarCadena($_POST['monto']):"";
$interes=isset($_POST['interes'])? limpiarCadena($_POST['interes']):"";
$cuotas=isset($_POST['meses'])? limpiarCadena($_POST['meses']):"";
$fecha_inicio=isset($_POST['fecha_inicio'])? limpiarCadena($_POST['fecha_inicio']):"";
$fecha_fin=isset($_POST['fecha_fin'])? limpiarCadena($_POST['fecha_fin']):"";
$id_usuario=$_SESSION["id_usuario"];
$id_cliente=isset($_POST['id_cliente'])? limpiarCadena($_POST['id_cliente']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		$guardar = true;
		$msj = "";

		if($guardar){
			if(empty($id_prestamo)){

				if($guardar){
					$respuesta = $prestamo->insertar($id_prestamo_tipo, $monto, $monto, $interes,$cuotas, $fecha_inicio, $fecha_fin, $id_usuario, $id_cliente, 0 );
					
					//$msj = $respuesta;
					
					if($respuesta){
						$msj = "Prestamo creado";
						//mail($correo,"Validacion WaterApp","Su cuenta ha sido creada con exito! Bienvenido a WaterApp!","From: WaterApp");
					}else{
						 $msj = "Prestamo no se pudo crear";
						 $guardar = false;
					}
				}
			}else{

				
			}
		}

		$array = [
		    "estado" => $guardar,
		    "mensaje" => $msj
		];

		echo json_encode($array);


		break;
	case 'listar':
		$respuesta=$prestamo->listar();
		$data = Array();
		
		// while ($objeto = $respuesta->fetch_object()) {
		// 	$data[]=array(
		// 		"0"=>($objeto->pago)?'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_prestamo.')"><i class="fa fa-eye"></i></button>':
		// 			'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_prestamo.')"><i class="fa fa-eye"></i></button>'.
		// 			' <button class="btn btn-danger" onclick="eliminar('.$objeto->id_prestamo.')"><i class="fa fa-thrash"></i> Eliminar</button>',
		// 		"1"=>$objeto->id_prestamo,
		// 		"2"=>$objeto->prestamo_tipo,
		// 		"3"=>$objeto->cliente_nombres.' '.$objeto->cliente_apellidos,
		// 		"4"=>$objeto->monto,
		// 		"5"=>$objeto->interes,
		// 		"6"=>$objeto->fecha,
		// 		"7"=>($objeto->pago)?'<span class="label bg-green">Pago</span>':'<span class="label bg-red">Pendiente</span>');
		// }

		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>($objeto->pago)?'':' <button class="btn btn-danger" onclick="eliminar('.$objeto->id_prestamo.')"><i class="fa fa-thrash"></i> Eliminar</button>',
				"1"=>$objeto->id_prestamo,
				"2"=>$objeto->prestamo_tipo,
				"3"=>$objeto->cliente_nombres.' '.$objeto->cliente_apellidos,
				"4"=>$objeto->apodo.' '.$objeto->ocupacion,
				"5"=>$objeto->monto,
				"6"=>$objeto->interes,
				"7"=>$objeto->fecha,
				"8"=>($objeto->pago)?'<span class="label bg-green">Pago</span>':'<span class="label bg-red">Pendiente</span>');
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
		break;
		case 'quincenalEscritorio':
		$respuesta=$prestamo->quincenalEscritorio();
		$data = Array();

		while ($objeto = $respuesta->fetch_object()) {
			if($objeto->id_pago != null){

				$total = 0;
				$monto = $objeto->monto;
				$interes = $objeto->interes / 100;
				$interes = $monto * $interes;
				$total = $monto + $interes;

				$data[]=array(
				"4"=>$objeto->id_prestamo,
				"0"=>$objeto->cliente_nombres.' '.$objeto->cliente_apellidos,
				"1"=>$total,
				"0"=>($objeto->pago)?'':' <button class="btn btn-danger" onclick="eliminar('.$objeto->id_prestamo.')"><i class="fa fa-thrash"></i> Eliminar</button>',
				
				"2"=>$objeto->prestamo_tipo,
				
				"4"=>$objeto->monto,
				"5"=>$objeto->interes,
				"6"=>$objeto->fecha,
				"7"=>($objeto->pago)?'<span class="label bg-green">Pago</span>':'<span class="label bg-red">Pendiente</span>');
			}
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
		break;
		case 'mostrar':
		$respuesta=$prestamo->mostrar($id_prestamo);
		echo json_encode($respuesta);
		break;
		case 'eliminar':
			$respuesta =$prestamo->eliminar($id_prestamo);
			echo $respuesta ? "Prestamo eliminado" : "Prestamo no se puede eliminar";
		break;
		case "selectClientePendiente":

			$respuesta = $prestamo->selectClientePendiente($id_cliente);

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_prestamo . '>' . $objeto->id_prestamo . '</option>';
			}
		break;
}

?>