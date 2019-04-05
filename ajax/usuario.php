<?php  
if(strlen(session_id())< 1)
	session_start();

require_once "../modelos/Usuario.php";

$usuario= new Usuario();


$nombres=isset($_POST['nombres'])? limpiarCadena($_POST['nombres']):"";
$apellidos=isset($_POST['apellidos'])? limpiarCadena($_POST['apellidos']):"";
$cedularnc=isset($_POST['cedularnc'])? limpiarCadena($_POST['cedularnc']):"";
$direccion=isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$telefono=isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";
$celular=isset($_POST['celular'])? limpiarCadena($_POST['celular']):"";
$correo=isset($_POST['correo'])? limpiarCadena($_POST['correo']):"";
$clave=isset($_POST['clave'])? limpiarCadena($_POST['clave']):"";
$claveactual=isset($_POST['claveactual'])? limpiarCadena($_POST['claveactual']):"";
$id_sector=isset($_POST['id_sector'])? limpiarCadena($_POST['id_sector']):"";
$id_usuario_tipo=isset($_POST['id_usuario_tipo'])? limpiarCadena($_POST['id_usuario_tipo']):""; 
$id_provincia=isset($_POST['id_provincia'])? limpiarCadena($_POST['id_provincia']):"";
$id_municipio=isset($_POST['id_municipio'])? limpiarCadena($_POST['id_municipio']):"";
$id_distrito_municipal=isset($_POST['id_distrito_municipal'])? limpiarCadena($_POST['id_distrito_municipal']):"";
$id_usuario=isset($_POST['id_usuario'])? limpiarCadena($_POST['id_usuario']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		$guardar = true;
		$msj = "";

		if($guardar){
			
			
			if(empty($id_usuario)){

				$clavehash=hash("SHA256",$clave);

				if($usuario->validarcedularnc($cedularnc) == 1){
					$guardar = false;
					$msj = "Esta Cédula / RNC no esta disponible!";
					$cedularnc = "";
				}

				if($usuario->validarcorreo($correo) == 1){
					$guardar = false;
					$msj = "Este correo no esta disponible!";
					$correo = "";
				}
				$respuesta =$usuario->insertar($nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$correo,$clavehash,$id_municipio,$id_usuario_tipo);
				//echo $respuesta ? "Usuario registrado" : "Usuario no se pudo registrar";
				if($respuesta){
					$msj = "Usuario registrado";

				}else{
					 $msj = "Usuario no se pudo registrar";
					 $guardar = false;
				}
			}else{
				if(strlen($clave) == 0){
					$clavehash=$claveactual;
				}else{
					//Hash SHA256 en la contraseña
					$clavehash=hash("SHA256",$clave);	
				}
				
				$respuesta =$usuario->editar($id_usuario,$nombres,$apellidos,$cedularnc,$direccion,$telefono,$celular,$correo,$clavehash,$id_municipio,$id_usuario_tipo);
				//echo $respuesta ? "Usuario actualizado" : "Usuario no se pudo actualizar";
				if($respuesta){
					$msj = "Usuario actualizado";

				}else{
					 $msj = "Usuario no se pudo actualizar";
					 $guardar = false;
				}
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
	
	case 'desactivar':
			$respuesta =$usuario->desactivar($id_usuario);
			echo $respuesta ? "Usuario desactivado" : "Usuario no se puede desactivar";
		break;
	
	case 'activar':
		$respuesta =$usuario->activar($id_usuario);
		echo $respuesta ? "Usuario activado" : "Usuario no se puede activar";
		
		break;
	
	case 'mostrar':
		$respuesta=$usuario->mostrar($id_usuario);
		echo json_encode($respuesta);
		break;

	case 'verificaractivo':
		$respuesta=$usuario->verificaractivo($_SESSION["id_usuario"]);
		echo json_encode($respuesta);
		break;
	
	case 'listar':
		$respuesta=$usuario->listar();
		$data = Array();
		
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>($objeto->estado)?'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-warning" onclick="desactivar('.$objeto->id_usuario.')"><i class="fa fa-close"></i> Desactivar</button>':
					'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_usuario.')"><i class="fa fa-pencil"></i></button>'.
					' <button class="btn btn-primary" onclick="activar('.$objeto->id_usuario.')"><i class="fa fa-check"></i> Activar</button>',
				"1"=>$objeto->id_usuario,
				"2"=>$objeto->nombres,
				"3"=>$objeto->apellidos,
				"4"=>$objeto->cedularnc,
				"5"=>($objeto->estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>');
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
	case "selectDistribuidor":

			$respuesta = $usuario->selectDistribuidor();

			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_usuario . '>' . $objeto->nombres.' '. $objeto->apellidos . '</option>';
			}
	break;
	case "selectDistribuidorReporte":

			$respuesta = $usuario->selectDistribuidor();
			echo '<option value="0" >Todos los Empleados</option> ';
			while ($objeto = $respuesta->fetch_object()) {
				echo '<option value=' . $objeto->id_usuario . '>' . $objeto->nombres.' '. $objeto->apellidos . '</option>';
			}
	break;
	
	case 'verificar':
		$correoa=$_POST['correoa'];
		$clavea=$_POST['clavea'];

		//Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);
		
		$respuesta=$usuario->verificar($correoa,$clavehash);

		$fetch=$respuesta->fetch_object();

		if(isset($fetch)){
			//Declaramos las variables de sesion
			$_SESSION['id_usuario']=$fetch->id_usuario;
			$_SESSION['id_usuario_tipo']=$fetch->id_usuario_tipo;
			$_SESSION['nombres']=$fetch->nombres.' '.$fetch->apellidos;
			$_SESSION['correo']=$fetch->correo;

			//Obtenemos los permisos del usuario
			$permisos=$usuario->listapermisos($fetch->id_usuario_tipo);

			//Declaramos el array para almacenar todos los permisos 
			$valores=array();

			while ($obj = $permisos->fetch_object()) {
				array_push($valores, $obj->id_permiso);
			}

			//Determinamos los accesos del usuario
			in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			in_array(2, $valores)?$_SESSION['perfil']=1:$_SESSION['perfil']=0;
			in_array(3, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			in_array(4, $valores)?$_SESSION['usuario']=1:$_SESSION['usuario']=0;
			in_array(5, $valores)?$_SESSION['cliente']=1:$_SESSION['cliente']=0;
			in_array(6, $valores)?$_SESSION['prestamo']=1:$_SESSION['prestamo']=0;
			in_array(7, $valores)?$_SESSION['cobrar']=1:$_SESSION['cobrar']=0;

		}

		echo json_encode($fetch);

	break;
	case 'salir':
		//Limpiamos las variables de sesion
		session_unset();
		//Destuirmos la sesion
		session_destroy();
		//Redirecionamos al login
		header("Location: ../index.php");

	break;
}

?>