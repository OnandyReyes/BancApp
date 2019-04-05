<?php  
if(strlen(session_id())< 1)
	session_start();

require_once "../modelos/Grupo.php";

$grupo= new Grupo();


$nombres=isset($_POST['nombres'])? limpiarCadena($_POST['nombres']):"";
$id_grupo=isset($_POST['id_grupo'])? limpiarCadena($_POST['id_grupo']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		$guardar = true;
		$msj = "";

		if($guardar){
			//Hash SHA256 en la contraseña
			
			if(empty($id_grupo)){

				if($guardar){
					$respuesta = $grupo->insertar($nombres,1 );
					
					//$msj = $respuesta;
					
					if($respuesta){
						$msj = "Grupo creado";
						//mail($correo,"Validacion WaterApp","Su cuenta ha sido creada con exito! Bienvenido a WaterApp!","From: WaterApp");
					}else{
						 $msj = "Grupo no se pudo crear";
						 $guardar = false;
					}
				}
			}else{

					$respuesta =$grupo->editar($id_grupo,$nombres);
					//echo $respuesta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
					if($respuesta){
						$msj = "Grupo actualizado";

					}else{
						 $msj = "Grupo no se pudo actualizar";
						 $guardar = false;
					}

				
			}
		}

		$array = [
		    "estado" => $guardar,
		    "mensaje" => $msj
		];

		echo json_encode($array);


		break;
		
		case 'guardaryeditarregistro':


		$guardar = true;
		$msj = "";

		if($usuario->validarcedularnc($cedularnc) == 1){
			$guardar = false;
			$msj = "Esta Cédula / RNC no esta disponible!";
			$cedularnc = "";
		}

		if($guardar){
			//Hash SHA256 en la contraseña
			$clavehash=hash("SHA256",$clave);
			
			$respuesta =$usuario->insertar($nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$id_cliente_tipo,$id_municipio, 2, $id_cliente_categoria );
				if($respuesta){
					$msj = "Cliente registrado";
					//mail($correo,"Validacion WaterApp","Su cuenta ha sido creada con exito! Bienvenido a WaterApp!","From: WaterApp");
				}else{
					 $msj = "Cliente no se pudo registrar";
					 $guardar = false;
				}

		}

		$array = [
		    "estado" => $guardar,
		    "mensaje" => $msj,
		    "cedularnc" => $cedularnc,
		    "correo" => $correo,
		    "clave" => $clave
		];

		echo json_encode($array);
		
		break;
	case 'UltimoID':
		$respuesta=$usuario->UltimoID();
		echo json_encode($respuesta);
		break;
	case 'desactivar':
			$respuesta =$usuario->desactivar($id_usuario);
			echo $respuesta ? "Cliente desactivado" : "Cliente no se puede desactivar";
		break;
	case 'eliminar':
			$respuesta =$usuario->eliminar($id_usuario);
			echo $respuesta ? "Cliente eliminado" : "Cliente no se puede eliminar porque se ha utilizado";
		break;
	case 'activar':
		$respuesta =$usuario->activar($id_usuario);
		echo $respuesta ? "Cliente activado" : "Cliente no se puede activar";
		
		break;
		case "select":

				$respuesta=$grupo->listar();

				while ($objeto = $respuesta->fetch_object()) {
					echo '<option value=' . $objeto->id_grupo . '>' . $objeto->nombre . '</option>';
				}
		break;

	case 'mostrar':
		$respuesta=$grupo->mostrar($id_grupo);
		echo json_encode($respuesta);
        break;
    case 'desactivar':
			$respuesta =$grupo->desactivar($id_grupo);
			echo $respuesta ? "Grupo desactivado" : "Grupo no se puede desactivar";
		break;
	
	case 'activar':
		$respuesta =$grupo->activar($id_grupo);
		echo $respuesta ? "Grupo activado" : "Grupo no se puede activar";
		
		break;
	case 'listar':
		$respuesta=$grupo->listar();
		$data = Array();

		while ($objeto = $respuesta->fetch_object()) {
				$data[]=array(
                    "0"=>($objeto->estado)?'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_grupo.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-warning" onclick="desactivar('.$objeto->id_grupo.')"><i class="fa fa-close"></i> Desactivar</button>':
					'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_grupo.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$objeto->id_grupo.')"><i class="fa fa-check"></i> Activar</button>',
				"1"=>$objeto->id_grupo,
				"2"=>$objeto->nombre,
				"3"=>($objeto->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>');
			
			
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