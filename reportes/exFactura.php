<?php
ob_start();
if(strlen(session_id()) < 1)
  session_start();

if(!isset($_SESSION["nombres"])){
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';

}else{

		require ('Factura.php');

		$logo = "logo2.jpg";
		$ext_logo = "jpg";
		$empresa = "A8R,bussines group";
		$rnc = "";
		$direccion = "San Pedro de Macoris, Calle la piedra numero no.37 barrio lindo";
		$telefono = "829-372-4763";
		$email = "amaurys1230.@gmail.com";

		require_once "../modelos/Pago.php";
		require_once "../modelos/Prestamo.php";
		require_once "../modelos/Cliente.php";

		$pagos = new Pago();
		$prestamos = new Prestamo();
		$clientes = new Cliente();

		$obj = $pagos->mostrar($_GET["id"]);
		
		if($obj != null){
			$pdf = new PDF_Invoice('P', 'mm', 'A4');
			$pdf->AddPage();

			$pdf->addSociete(utf8_decode($empresa), $rnc."\n".utf8_decode("Dirección: ").utf8_decode($direccion)."\n".utf8_decode("Teléfono: ").$telefono."\n"."Email: ".utf8_decode($email), $logo, $ext_logo);
			$probando = $obj['id_pago'];
			$pdf->fact_dev("RECIBO #","$probando");
			$pdf->temporaire("");
			$pdf->addDate($obj['fecha_creacion']);

			$prestamo = $prestamos->mostrar($obj['id_prestamo']);
			$cliente = $clientes->mostrar($prestamo['id_cliente']);
			
			$pdf->addClientAdresse(utf8_decode($cliente['nombres'].' '.$cliente['apellidos']),"Domicilio: ".utf8_decode($cliente['provincia'].', '.$cliente['municipio'].', '.$cliente['direccion']),utf8_decode("Rnc/Cédula: ").$cliente['cedularnc'],"Correo: ".utf8_decode($cliente['correo']),"Celular: ".$cliente['celular'],"Teléfono: ".$cliente['telefono']);
			
			$cols = array("CUOTA"=>30,
							"PAGO"=>30,
							"BALANCE"=>30);

			$pdf->addCols($cols);
			$cols=array("CUOTA"=>"C",
							"PAGO"=>"C",
							"BALANCE"=>"C");
			$pdf->addLineFormat($cols);
			$pdf->addLineFormat($cols);

			$y = 89;

			$cuotas = $pagos->cuotas($obj['id_prestamo']);
			$cuotaCant = 0;
			$capital = $prestamo["capital"];
			$total = 0;
			$comentario = "";
			while ($objd = $cuotas->fetch_object()) {
				$cuotaCant++;
				
				if($objd->id_pago == $obj['id_pago']){
					$total = $objd->monto;
					$line = array("CUOTA"=>"$cuotaCant",
									"PAGO"=>"$objd->monto",
									"BALANCE"=>"$objd->capital");
					$size = $pdf->addLine($y,$line);
					$y += $size + 2;
					break;
				}
			}

			require_once "Letras.php";
			$V=new EnLetras();
			$con_letra=strtoupper($V->ValorEnLetras($total,"PESOS DOMINICANOS"));
			$pdf->addCadreTVas("---".$con_letra);

			$pdf->addTVAs(0,$total,"RD ");
			$pdf->addCadreEurosFrancs("Impuesto"." 0 %");
			$pdf->Output('Reporte de Venta','I');

		}else{
			echo 'No se encontro la Factura';
		}
		
}
ob_end_flush();
?>