<?php  
if(strlen(session_id())< 1)
    session_start();

require_once "../modelos/Cuentas.php";

$cuentas= new Cuentas();

$correo=isset($_POST['correo'])? limpiarCadena($_POST['correo']):"";
$clave=isset($_POST['clave'])? limpiarCadena($_POST['clave']):"";

switch ($_GET["op"]) {
	case 'selectVendedores':
		
		$respuesta = $cuentas->listaVendedores();
		echo '<option value="0" >Todos los Vendedores</option> ';
		while ($objeto = $respuesta->fetch_object()) {
			echo '<option value=' . $objeto->id_usuario. '>' . $objeto->nombres.' '.$objeto->apellidos. '</option>';
		}

	break;
    case 'verificar':
		$correoa=$_POST['correoa'];
		$clavea=$_POST['clavea'];

		//Hash SHA256 en la contraseña
		//$clavehash=hash("SHA256",$clavea);
		
		$respuesta=$cuentas->verificar($correoa,$clavea);

		$fetch=$respuesta->fetch_object();

		if(isset($fetch)){
			//Declaramos las variables de sesion
			$_SESSION['id_usuario']=$fetch->id_usuario;
			$_SESSION['id_cuenta_tipo']=$fetch->id_cuenta_tipo;
			$_SESSION['nombres']=$fetch->nombres.' '.$fetch->apellidos;

			//Obtenemos los permisos del usuario
			//$permisos=$cuentas->listapermisos($fetch->id_usuario_tipo);

			//Declaramos el array para almacenar todos los permisos 
			// $valores=array();

			// while ($obj = $permisos->fetch_object()) {
			// 	array_push($valores, $obj->id_permiso);
			// }

			//Determinamos los accesos del usuario
			// in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			// in_array(2, $valores)?$_SESSION['perfil']=1:$_SESSION['perfil']=0;
			// in_array(3, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			// in_array(4, $valores)?$_SESSION['usuario']=1:$_SESSION['usuario']=0;
			// in_array(5, $valores)?$_SESSION['cliente']=1:$_SESSION['cliente']=0;
			// in_array(6, $valores)?$_SESSION['prestamo']=1:$_SESSION['prestamo']=0;
			// in_array(7, $valores)?$_SESSION['cobrar']=1:$_SESSION['cobrar']=0;

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