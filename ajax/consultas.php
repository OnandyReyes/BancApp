<?php  
if(strlen(session_id())< 1)
	session_start();
require_once "../modelos/Consultas.php";

$consulta = new Consultas();

switch ($_GET["op"]) {
	case 'entradaProductosFecha':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];

		$respuesta=$consulta->entradaProductosFecha($fecha_inicio,$fecha_fin);
		$data = Array();
		
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_producto_existencia.')"><i class="fa fa-eye"></i></button>',
				"1"=>$objeto->fecha,
				"2"=>$objeto->nombres,
				"3"=>$objeto->apellidos);
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
	break;
	case 'cuadreDia':
		
		$respuesta = $consulta->cuadreDia();
		$totalprecio = 0;
		$totalcosto = 0;

		echo '<thead style="background-color: #A9D0F5">
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Beneficio</th>
                              </thead>';

		while ($objeto = $respuesta->fetch_object()) {
			$costo = 0;
			$respuesta2 = $consulta->ventasClienteHoy($objeto->id_usuario);
			while ($objeto2 = $respuesta2->fetch_object()) {
				$ventaDetalle=$consulta->ventasDetalle($objeto2->id_venta);
				$costo += $ventaDetalle["costo"];
			}

			echo '<tr class="filas"><td>'.$objeto->nombres.' '.$objeto->apellidos.'</td><td>'.number_format($objeto->total,2).'</td><td>'.number_format(($objeto->total - $costo),2).'</td></tr>';

			$totalcosto=$totalcosto+($objeto->total - $costo);
			$totalprecio=$totalprecio+$objeto->total;
		}

		// $respuesta = $consulta->reciboClienteDia();

		// while ($objeto = $respuesta->fetch_object()) {

		// 	$total = $objeto->total;
		// 	echo '<tr class="filas"><td>'.$objeto->nombres.'</td><td>'.$objeto->apellidos.'</td><td>'.$objeto->cedularnc.'</td><td>'.$total.'</td></tr>';

		// 	$totalprecio=$totalprecio+$total;
		// }

		echo '<tfoot>
                                <th>TOTAL</th>
                                <th><h4 id="totalprecio">$ '.number_format($totalprecio,2).'</h4></th>
                                <th><h4 id="totalcosto">$ '.number_format($totalcosto,2).'</h4></th>
                              </tfoot>';
		
	break;
	case 'ventasFechaCliente':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_cliente =$_REQUEST["id_cliente"];
		if($id_cliente == 0){
			$respuesta=$consulta->ventasFecha($fecha_inicio,$fecha_fin);
		}else{
			$respuesta=$consulta->ventasFechaCliente($fecha_inicio,$fecha_fin,$id_cliente);
		}
		
		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			if($objeto->id_venta != null){
				$ventaDetalle=$consulta->ventasDetalle($objeto->id_venta);

				$data[]=array(
				"0"=>'<a target="_blank" class="btn btn-info" href="../reportes/exTicket.php?id='.$objeto->id_venta.'">Factura</a>',
				"1"=>$objeto->fecha,
				"2"=>$objeto->clientes_nombres.' '.$objeto->clientes_apellidos,
				"3"=>$objeto->venta_tipo,
				"4"=>$objeto->total,
				"5"=>($objeto->total - $ventaDetalle["costo"]));
			}
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
	break;
	case 'ventasFechaEmpleados':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_empleado =$_REQUEST["id_empleado"];
		$id_ruta =$_REQUEST["id_ruta"];

		if($id_empleado == 0){
			if($id_ruta == 0){
				$respuesta=$consulta->ventasFechasEmpleados($fecha_inicio,$fecha_fin);	
			}else{
				$respuesta=$consulta->ventasFechasRuta($fecha_inicio,$fecha_fin,$id_ruta);	
			}
		}else{
			if($id_ruta == 0){
				$respuesta=$consulta->ventasFechasEmpleado($fecha_inicio,$fecha_fin,$id_empleado);
			}else{
				$respuesta=$consulta->ventasFechasEmpleadoRuta($fecha_inicio,$fecha_fin,$id_empleado,$id_ruta);
			}
		}
		
		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			if($objeto->id_venta != null){
				$ventaDetalle=$consulta->ventasDetalle($objeto->id_venta);
				$data[]=array(
				"0"=>'<a target="_blank" class="btn btn-info" href="../reportes/exTicket.php?id='.$objeto->id_venta.'">Factura</a>',
				"1"=>$objeto->fecha,
				"2"=>$objeto->clientes_nombres.' '.$objeto->clientes_apellidos,
				"3"=>$objeto->venta_tipo,
				"4"=>$objeto->total,
				"5"=>($objeto->total - $ventaDetalle["costo"]));
			}
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
	break;
	
	case 'ventasFechaEmpleadosTotal':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_empleado =$_REQUEST["id_empleado"];
		$id_ruta =$_REQUEST["id_ruta"];
		$Total = 0;
		$TotalCobrado = 0;
		
		if($id_empleado == 0){
			if($id_ruta == 0){
				$respuesta=$consulta->ventasFechasEmpleados($fecha_inicio,$fecha_fin);	
			}else{
				$respuesta=$consulta->ventasFechasRuta($fecha_inicio,$fecha_fin,$id_ruta);	
			}
		}else{
			if($id_ruta == 0){
				$respuesta=$consulta->ventasFechasEmpleado($fecha_inicio,$fecha_fin,$id_empleado);
			}else{
				$respuesta=$consulta->ventasFechasEmpleadoRuta($fecha_inicio,$fecha_fin,$id_empleado,$id_ruta);
			}
		}

		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			$Total += $objeto->total;
			
		}

		$array = [
		    "Total" => $Total
		];

		echo json_encode($array);
		
	break;
	case 'ventasFechaClienteTotal':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_cliente =$_REQUEST["id_cliente"];
		$Total = 0;
		$TotalCobrado = 0;
		if($id_cliente == 0){
			$respuesta=$consulta->ventasFecha($fecha_inicio,$fecha_fin);
		}else{
			$respuesta=$consulta->ventasFechaCliente($fecha_inicio,$fecha_fin,$id_cliente);
		}

		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			$Total += $objeto->total;
			
		}

		$array = [
		    "Total" => $Total
		];

		echo json_encode($array);
		
	break;

	case 'ventasFechaClienteID':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_cliente = $_SESSION["id_usuario"];

		$respuesta=$consulta->ventasFechaCliente($fecha_inicio,$fecha_fin,$id_cliente);
		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>'<a target="_blank" class="btn btn-info" href="../reportes/exFactura.php?id='.$objeto->id_venta.'">Factura</a>',
				"1"=>$objeto->fecha,
				"2"=>$objeto->total,
				"3"=>$objeto->venta_tipo,
				"4"=>$objeto->usuarios_nombres.' '.$objeto->usuarios_apellidos);
		}

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
	break;
	case 'ventasCreditoFechaClienteID':
		$fecha_inicio=$_REQUEST["fecha_inicio"];
		$fecha_fin=$_REQUEST["fecha_fin"];
		$id_cliente = $_SESSION["id_usuario"];

		$respuesta=$consulta->ventasCreditoFechaCliente($fecha_inicio,$fecha_fin,$id_cliente);
		$data = Array();
		// "0"=>'<button class="btn btn-warning" onclick="mostrar('.$objeto->id_venta.')"><i class="fa fa-eye"></i></button>',
		while ($objeto = $respuesta->fetch_object()) {
			$data[]=array(
				"0"=>($objeto->id_venta_documento == 1)?'<a target="_blank" class="btn btn-info" href="../reportes/exFactura.php?id='.$objeto->id_venta.'">Factura</a>':'<a target="_blank" class="btn btn-info" href="../reportes/exTicket.php?id='.$objeto->id_venta.'">Ticket</a>',
				"1"=>$objeto->fecha,
				"2"=>$objeto->total,
				"3"=>$objeto->venta_tipo,
				"4"=>$objeto->usuarios_nombres.' '.$objeto->usuarios_apellidos);
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