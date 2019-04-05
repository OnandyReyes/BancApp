<?php
if(strlen(session_id())< 1)
session_start();

require_once "../modelos/Pago.php";

$pago = new Pago();

$id_pago=isset($_POST['id_pago'])? limpiarCadena($_POST['id_pago']):"";
$monto=isset($_POST['monto'])? limpiarCadena($_POST['monto']):"";
$id_prestamo=isset($_POST['id_prestamo'])? limpiarCadena($_POST['id_prestamo']):"";
$id_usuario=$_SESSION["id_usuario"];
$tipo_pago=isset($_POST['tipo_pago'])? limpiarCadena($_POST['tipo_pago']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		$guardar = true;
		$msj = "";

		if($guardar){
			if(empty($id_pago)){
				require_once "../modelos/Prestamo.php";
				$prestamos = new Prestamo();

				$prestamo = $prestamos->mostrar($id_prestamo);
				$interes = $prestamo["interes"] / 100;
				$interes = $interes * $prestamo["monto"];
				if($tipo_pago == 0){
					$monto_abonado = $prestamo["monto"] / $prestamo["cuotas"];
					$monto_abonado += $interes;
					$capitalAbonado = $monto_abonado - $interes;

				}else{
					$monto_abonado = $interes;
					$capitalAbonado = 0;
					
				}
				
				$capitalNuevo = $prestamo["capital"] - $capitalAbonado;

				if($guardar){
					$respuesta = $pago->insertar($monto_abonado, $capitalNuevo, $id_prestamo, $id_usuario );
					
					//$msj = $respuesta;
					
					if($respuesta){
						$msj = "Pago realizado correctamente!!";
						$rpt2 = $pago->ultimoId();
						$id_pago = $rpt2["id_pago"];
						
							if($prestamos->actualizarCapital($id_prestamo, $capitalNuevo)){
								$msj = "Pago realizado correctamente!!";
								$capital =$capitalNuevo;
							}else{
								$guardar = false;
								$id_pago =0;
								$msj = "Pago realizado pero hubo un problema con el capital!!";
							}
						
					}else{
						 $msj = "Prestamo no se pudo completar";
						 $guardar = false;
						 $id_pago =0;
					}
				}
			}else{

				
			}
		}

		$array = [
		    "estado" => $guardar,
			"mensaje" => $msj,
			"id" => $id_pago,
			"capital" => $capital
		];

		echo json_encode($array);


		break;
		case 'ultimoPago':
			require_once "../modelos/Prestamo.php";
			require_once "../modelos/Cliente.php";
			require_once "../modelos/Usuario.php";

			$prestamos = new Prestamo();
			$clientes = new Cliente();
			$usuarios = new Usuario();
			
			try {
				$p=$pago->ultimoPago();
				$prestamo = $prestamos->mostrar($p['id_prestamo']);
			  	$cliente = $clientes->mostrar($prestamo['id_cliente']);
				$usuario = $usuarios->mostrar($prestamo['id_usuario']);

				$cuotas = $pago->cuotas($p['id_prestamo']);
				$cuotaCant = 0;
				while ($objd = $cuotas->fetch_object()) {
					$cuotaCant++;
					if($objd->id_pago == $p['id_pago']){
					  break;
					}
				}

				$estado = true;
				$msj = "Correcto";
			} catch (\Throwable $th) {
				$estado = false;
				$msj = $th;
			}
			$array = [
				"estado" => $estado,
				"mensaje" => $msj,
				"pago" => $p,
				"prestamo" => $prestamo,
				"cliente" => $cliente,
				"usuario" => $usuario,
				"cuota" => $cuotaCant
			];

			echo json_encode($array);
		break;
		case 'FacturaNumero':
			require_once "../modelos/Prestamo.php";
			require_once "../modelos/Cliente.php";
			require_once "../modelos/Usuario.php";
			$numeroFactura=isset($_GET['numeroFactura'])? limpiarCadena($_GET['numeroFactura']):"";
			$prestamos = new Prestamo();
			$clientes = new Cliente();
			$usuarios = new Usuario();
			
			try {
				$p=$pago->ultimoPagoFactura($numeroFactura);
				$prestamo = $prestamos->mostrar($p['id_prestamo']);
			  $cliente = $clientes->mostrar($prestamo['id_cliente']);
				$usuario = $usuarios->mostrar($prestamo['id_usuario']);

				$cuotas = $pago->cuotas($p['id_prestamo']);
				$cuotaCant = 0;
				while ($objd = $cuotas->fetch_object()) {
					$cuotaCant++;
					if($objd->id_pago == $p['id_pago']){
					  break;
					}
				}

				$estado = true;
				$msj = "Correcto";
			} catch (\Throwable $th) {
				$estado = false;
				$msj = $th;
			}
			$array = [
				"estado" => $estado,
				"mensaje" => $msj,
				"pago" => $p,
				"prestamo" => $prestamo,
				"cliente" => $cliente,
				"usuario" => $usuario,
				"cuota" => $cuotaCant
			];

			echo json_encode($array);
		break;
}

?>