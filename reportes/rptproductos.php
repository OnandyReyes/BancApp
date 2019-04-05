<?php
ob_start();
if(strlen(session_id()) < 1)
  session_start();

if(!isset($_SESSION["nombres"])){
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';

}else{

if($_SESSION['producto']){

//Incluimos la clase PDF
require('PDF_MC_Table.php');

//Instanciamos la clase para generar el documento
$pdf = new PDF_MC_Table();

//Agregamos la primera pagina del documento
$pdf->AddPage();

//el inicio del margen superior en 25 pixeles
$y_axis_initial = 25;

//Tipo de letra y creamos el titulo de la pagina. No es un encabezado no se repetira
$pdf->SetFont('Arial','B',12);

$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,6,'LISTA DE PRODUCTOS',1,0,'C');
$pdf->Ln(10);

//Creamos las celdas para los titulos de cada columna y le asignamos un fondo y el tipo de letra
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(58,6,'Nombre',1,0,'C',1);
$pdf->Cell(20,6,'Cantidad',1,0,'C',1);
$pdf->Cell(20,6,'Costo',1,0,'C',1);
$pdf->Cell(20,6,'Precio',1,0,'C',1);
$pdf->Cell(20,6,'T. Costo',1,0,'C',1);
$pdf->Cell(20,6,'T. Precio',1,0,'C',1);
$pdf->Cell(20,6,'Beneficio',1,0,'C',1);
$pdf->Ln(10);

//Comenzamos a crear las filas segun la consulta mysql
require_once "../modelos/Producto.php";
$producto = new Producto();

$respuesa = $producto->listar();

//Implementamos las celdas de la tabla con los registros a mostrar
$pdf->SetWidths(array(58,20,20,20,20,20,20));

$TTcosto = 0;
$TTprecio = 0;
$TTbeneficio = 0;

while ($objeto = $respuesa->fetch_object()) {
  $nombre = $objeto->nombre;
  $existencia = $objeto->existencia;
  $costo = number_format($objeto->costo, 2, '.', '');
  $precio = number_format((($objeto->precio / 100 ) * $objeto->costo) + $objeto->costo, 2, '.', '');
  $Tcosto = number_format($costo * $existencia, 2, '.', '');
  $Tprecio = number_format($precio * $existencia, 2, '.', '');
  $beneficio = number_format($Tprecio - $Tcosto, 2, '.', '');


  $pdf->SetFont('Arial','',10);
  $pdf->Row(array(utf8_decode($nombre),$existencia,$costo,$precio,$Tcosto,$Tprecio,$beneficio));

  $TTcosto +=  $Tcosto;
  $TTprecio +=  $Tprecio;
  $TTbeneficio += $beneficio;

}

$pdf->Row(array('','','','','','',''));

$pdf->SetFont('Arial','B',10);
$pdf->Row(array('TOTALES','','','',number_format($TTcosto, 2, '.', ''),number_format($TTprecio, 2, '.', ''),number_format($TTbeneficio, 2, '.', '')));

//Mostramos el documento pdf
$pdf->Output();

}else{
  echo 'No tiene permiso para visualizar el reporte';
}
}
ob_end_flush();
?>