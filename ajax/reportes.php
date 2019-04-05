<?php  
$nuevo = $_GET["op"];

switch ($_GET["op"]) {
    case 'estadoCuenta':
        require_once "../modelos/Cliente.php";
        require_once "../modelos/Prestamo.php";
        require_once "../modelos/Pago.php";
        
        $cliente = new Cliente();
        $prestamo = new Prestamo();
        $pago = new Pago();

        $respuesta=$prestamo->listar();
		$data = Array();
        
        while ($obj = $respuesta->fetch_object()) {
            $montoCuota = 0;
            $cuotas = $pago->cuotas($obj->id_prestamo);
			while ($objd = $cuotas->fetch_object()) {
				$montoCuota+= $objd->monto;
            }
            $interes = (100 - $obj->interes) / 100;
            $data[]=array(
				"0"=>$obj->id_prestamo,
				"1"=>$obj->monto,
				"2"=>$obj->capital - ($montoCuota * $interes),
				"3"=>$montoCuota,
				"4"=>$obj->fecha);
        }

		// while ($objeto = $respuesta->fetch_object()) {
        //     $PrestamosActivos = 0;
        //     $MontoPrestado = 0;
        //     $MontoDeuda = 0;
        //     $MontoPagado = 0;

        //     $prestamoCliente = $prestamo->listarCliente($objeto->id_usuario);
            
        //     while ($obj = $prestamoCliente->fetch_object()) {
        //         if($obj->pago == "0"){
        //             $PrestamosActivos++;
        //         }
                
        //         $MontoPrestado+= $obj->monto;
        //         $MontoDeuda+= $obj->capital;
                
        //     }

        //     $MontoPagado = $MontoPrestado - $MontoDeuda;

        //     $data[]=array(
		// 		"0"=>$objeto->id_usuario,
		// 		"1"=>$objeto->nombres.' '.$objeto->apellidos,
		// 		"2"=>$PrestamosActivos,
		// 		"3"=>$MontoPrestado,
		// 		"4"=>$MontoDeuda,
		// 		"5"=>$MontoPagado);
		// }

		$resultados = array(
				"sEcho" => 1,
				"iTotalRecords"=>count($data),
				"iTotalDisplayRecords"=>count($data),
				"aaData"=>$data);
		echo json_encode($resultados);
		
        break;
        case 'pagos':
            require_once "../modelos/Pago.php";
            require_once "../modelos/Prestamo.php";
            require_once "../modelos/Cliente.php";

            $pagos = new Pago();
            $prestamos = new Prestamo();
            $clientes = new Cliente();

            $respuesta=$pagos->listar();

            while ($obj = $respuesta->fetch_object()) {
                $prestamo = $prestamos->mostrar($obj->id_prestamo);
                $cliente = $clientes->mostrar($prestamo['id_cliente']);
                
                $nombre_completo = $cliente['nombres'].' '.$cliente['apellidos'];

                $data[]=array(
                    "0"=>$obj->id_pago,
                    "1"=>$nombre_completo,
                    "2"=>$obj->monto,
                    "3"=>$obj->fecha_creacion,
                    "4"=>'<a target="_blank" class="btn btn-info" href="../reportes/exTicket.php?id='.$obj->id_pago.'">Ticket</a> <a target="_blank" class="btn btn-info" href="../reportes/exFactura.php?id='.$obj->id_pago.'">Factura</a>');
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