<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombres"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

require_once "../modelos/Pago.php";
require_once "../modelos/Prestamo.php";
require_once "../modelos/Cliente.php";
require_once "../modelos/Usuario.php";

$pagos = new Pago();
$prestamos = new Prestamo();
$clientes = new Cliente();
$usuarios = new Usuario();
//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo

$obj = $pagos->mostrar($_GET["id"]);


if($obj != null){

  $prestamo = $prestamos->mostrar($obj['id_prestamo']);
  $cliente = $clientes->mostrar($prestamo['id_cliente']);
  $usuario = $usuarios->mostrar($prestamo['id_usuario']);
      
//Establecemos los datos de la empresa
$empresa = "A8R,bussines group";
$rnc = "";
$direccion = "San Pedro de Macoris, Calle la piedra numero no.37 barrio lindo";
$telefono = "829-372-4763";
$celular = "";
$email = "amaurys1230.@gmail.com";

?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
            <!-- Mostramos los datos de la empresa en el documento HTML -->
            <h2><strong>.::. <?php echo $empresa; ?> .::.</strong></h2><br>
            <?php echo 'Tels.:'.$telefono.' / '.$celular; ?><br> 
            <?php echo $direccion .''; ?>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo 'Fecha: '.$obj['fecha_creacion']; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <td>RECIBO #: <?php echo " ".$_GET["id"]; ?></td>
    </tr> 
    <tr>
        <td>Usuario : <?php echo utf8_decode($usuario['nombres'].' '.$usuario['apellidos']); ?></td>
    </tr> 
    <tr>
        <td></td>
    </tr> 
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>Cliente: <?php echo utf8_decode($cliente['nombres'].' '.$cliente['apellidos']); ?></td>
    </tr>
    <tr>
        <td><?php echo utf8_decode("Rnc/Cedula: ".$cliente['cedularnc']); ?></td>
    </tr>
    <tr>
        <td>PRESTAMO No. <?php echo "".$obj['id_prestamo']; ?></td>
    </tr>
    <tr>
        <td>FECHA CONTRATO : <?php echo "".$prestamo["fecha_creacion"]; ?></td>
    </tr>
    <tr>
      <table>
        <tr>
          <td colspan="3">========================================</td>
        </tr>
        <tr>
          <td>CUOTA</td>
          <td>PAGO</td>
          <td>BALANCE</td>
        </tr>
        <tr>
          <td colspan="3">========================================</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr> 
        <?php
          $cuotas = $pagos->cuotas($obj['id_prestamo']);
          $cuotaCant = 0;
          $capital = $prestamo["capital"];
          $total = 0;
          $comentario = "";
          $monedaSub = "RD$";
          while ($objd = $cuotas->fetch_object()) {
            $cuotaCant++;
            
            if($objd->id_pago == $obj['id_pago']){
              $total = $objd->monto;
              echo "<tr>";
              echo "<td >".$cuotaCant."</td>";
              echo "<td >".$monedaSub.$total."</td>";
              echo "<td >".$monedaSub.$objd->capital."</td>";
              echo "</tr>";
              break;
            }
          }
          
          ?>
      </table>
        
    </tr>
     
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">========================================</td>
    </tr> 
    <tr>
        <td align="right"></td>
        <!-- <td align="right"><b></b></td> -->
    </tr>
</table>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3" align="center">Firma :_____________________________</td>
    </tr>
    <tr>
      <td colspan="3" align="center"></td>
    </tr>     
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center">¡Gracias por su pago!</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
</table>
<br>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php 
}else{
            echo 'No se encontro el Recibo';
        }


}
ob_end_flush();
?>