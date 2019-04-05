<?php  
if(strlen(session_id())< 1)
	session_start();

require_once "../modelos/Cliente.php";

$usuario= new Cliente();


$nombres=isset($_POST['nombres'])? limpiarCadena($_POST['nombres']):"";
$apellidos=isset($_POST['apellidos'])? limpiarCadena($_POST['apellidos']):"";
$apodo=isset($_POST['apodo'])? limpiarCadena($_POST['apodo']):"";
$cedularnc=isset($_POST['cedularnc'])? limpiarCadena($_POST['cedularnc']):"";
$direccion=isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$telefono=isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";
$celular=isset($_POST['celular'])? limpiarCadena($_POST['celular']):"";
$id_sector=isset($_POST['id_sector'])? limpiarCadena($_POST['id_sector']):"";
$id_cliente_tipo=isset($_POST['id_cliente_tipo'])? limpiarCadena($_POST['id_cliente_tipo']):""; 
$id_usuario_tipo=isset($_POST['id_usuario_tipo'])? limpiarCadena($_POST['id_usuario_tipo']):""; 
$id_provincia=isset($_POST['id_provincia'])? limpiarCadena($_POST['id_provincia']):"";
$id_municipio=isset($_POST['id_municipio'])? limpiarCadena($_POST['id_municipio']):"";
$id_grupo=isset($_POST['id_grupo'])? limpiarCadena($_POST['id_grupo']):"";
$id_distrito_municipal=isset($_POST['id_distrito_municipal'])? limpiarCadena($_POST['id_distrito_municipal']):"";
$id_usuario=isset($_POST['id_usuario'])? limpiarCadena($_POST['id_usuario']):"";
$id_cliente_categoria=isset($_POST['id_cliente_categoria'])? limpiarCadena($_POST['id_cliente_categoria']):"";
$ocupacion=isset($_POST['ocupacion'])? limpiarCadena($_POST['ocupacion']):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
		$guardar = true;
		$msj = "";

		if($guardar){
			//Hash SHA256 en la contraseña
			
			if(empty($id_usuario)){

				if($guardar){
					$respuesta = $usuario->insertar($nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$id_cliente_tipo,$id_municipio, 2, $id_cliente_categoria, $ocupacion, $apodo );
					
					//$msj = $respuesta;
					
					if($respuesta){
						$msj = "Cliente registrado";
						require_once "../modelos/Cliente_grupo.php";
						$cliente_grupo = new Cliente_grupo();
						$ultimoid=$usuario->UltimoID();
						$result = $cliente_grupo->insertar($id_grupo,$ultimoid["ultimo_id"]);
						//mail($correo,"Validacion WaterApp","Su cuenta ha sido creada con exito! Bienvenido a WaterApp!","From: WaterApp");
					}else{
						 $msj = "Cliente no se pudo registrar";
						 $guardar = false;
					}
				}
			}else{

					$respuesta =$usuario->editar($id_usuario,$nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$id_cliente_tipo,$id_municipio,2, $id_cliente_categoria, $ocupacion, $apodo);
					//echo $respuesta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
					if($respuesta){
						$msj = "Cliente actualizado";
						require_once "../modelos/Cliente_grupo.php";
						$cliente_grupo = new Cliente_grupo();
						$ultimoid=$usuario->UltimoID();
						$result = $cliente_grupo->editar($id_grupo,$ultimoid["ultimo_id"]);
						
					}else{
						 $msj = "Cliente no se pudo actualizar";
						 $guardar = false;
					}

				
			}
		}

		$array = [
		    "estado" => $guardar,
		    "mensaje" => $msj,
		    "cedularnc" => $cedularnc
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
	case 'clase':

		$clase=$usuario->clase($id_usuario);

		echo $clase["clase"];
	
		break;
	case 'cuentaxpagar':

		//$respuesta = $usuario->cuentaxpagar($_SESSION["id_usuario"]);
		$montoPendiente=$usuario->cuentaxpagar($id_usuario);

		// $deuda = 0;
		// while ($objeto = $respuesta->fetch_object()) {
		// 	$deuda = $objeto->deuda;
		// 	break;
		// }

		echo $montoPendiente["total_deuda"];
	
		break;
	case 'cuentaxcobrar':

		$montoPendiente=$usuario->cuentaxpagar($id_usuario);

		//echo $montoPendiente["total_deuda"];
		echo json_encode($montoPendiente["total_deuda"]);
		break;
	case 'mostrar':
		$respuesta=$usuario->mostrar($id_usuario);
		echo json_encode($respuesta);
		break;
	case 'listar':
		$respuesta=$usuario->listar();
		$data = Array();
		$id_usuario_tipo = $_SESSION["id_usuario_tipo"];

		while ($objeto = $respuesta->fetch_object()) {
			if($id_usuario_tipo == 1){
				$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-danger" onclick="eliminar('.$objeto->id_usuario.')"><i class="fa fa-close"></i></button>',
				"1"=>$objeto->id_usuario,
				"2"=>$objeto->nombres." ".$objeto->apellidos,
				"3"=>$objeto->tipo,
				"4"=>$objeto->cedularnc,
				"5"=>($objeto->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>');
			}else{
				$data[]=array(
				"0"=>'',
				"1"=>$objeto->id_usuario,
				"2"=>$objeto->nombres." ".$objeto->apellidos,
				"3"=>$objeto->tipo,
				"4"=>$objeto->cedularnc,
				"5"=>($objeto->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>');
			}
			
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
		break;
	case "selectUsuario_tipo":
			require_once "../modelos/Usuario_tipo.php";
			$usuario_tipo = new Usuario_tipo();

			$respuesta = $usuario_tipo->select();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_usuario_tipo . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectProvincia":
			require_once "../modelos/Provincia.php";
			$provincia = new Provincia();

			$respuesta = $provincia->select();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_provincia . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectSector":
			require_once "../modelos/Sector.php";
			$sector = new Sector();
			
			$respuesta = $sector->select($id_provincia);

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_sector . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectMunicipio":
			require_once "../modelos/Municipio.php";
			$municipio = new Municipio();
			
			$respuesta = $municipio->select($id_provincia);

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_municipio . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectDistrito_municipal":
			require_once "../modelos/Distrito_municipal.php";
			$distrito_municipal = new Distrito_municipal();
			
			$respuesta = $distrito_municipal->select($id_municipio);

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_distrito_municipal . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectCliente_tipo":
			require_once "../modelos/Cliente_tipo.php";
			$cliente_tipo = new Cliente_tipo();
			
			$respuesta = $cliente_tipo->select();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_cliente_tipo . '>' . $objeto->nombre . '</option>';
			}
	break;
	case "selectCliente":
			
			$respuesta = $usuario->select();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_usuario. '>' . $objeto->nombres.' '.$objeto->apellidos. '</option>';
			}
	break;
	case "selectClienteCategoria":
			$respuesta = $usuario->selectClienteCategoria();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_cliente_categoria. '>' . $objeto->nombre. '</option>';
			}
	break;
	case "selectClienteReporte":
			$respuesta = $usuario->select();
			echo '<option value="0" >Todos los clientes</option> ';
			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_usuario. '>' . $objeto->nombres.' '.$objeto->apellidos. '</option>';
			}
	break;
}

?>