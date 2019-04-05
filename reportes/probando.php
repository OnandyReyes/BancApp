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
if ($_SESSION['ventas']==1)
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php

//Incluímos la clase Venta
require_once "../modelos/Venta.php";
//Instanaciamos a la clase con el objeto venta
$venta = new Venta();
//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
if($_SESSION['id_usuario_tipo'] == 2){
    $rspta = $venta->ventacabeceracliente($_GET["id"],$_SESSION['id_usuario']);
}else{
    $rspta = $venta->ventacabecera($_GET["id"]);
}
$row_cnt = $rspta->num_rows;

if($row_cnt > 0){
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();

//Establecemos los datos de la empresa
$empresa = "SURTIDORA MARTINEZ";
$rnc = "0000000000";
$direccion = "Hato Mayor del Rey, C/ Primera las marvinas";
$telefono = "809-553-1555";
$celular = "829-676-2977";
$email = "florentina@gmail.com";
?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
            <!-- Mostramos los datos de la empresa en el documento HTML -->
            <h2><strong> <?php echo $empresa; ?></strong></h2><br>
            <?php echo 'Tels.:'.$telefono.' / '.$celular; ?><br> 
            <?php echo $direccion .''; ?><br>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo 'Fecha: '.$reg->fecha; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
        <td><?php echo utf8_decode("Tipo: ".$reg->venta_tipo); ?></td>
    </tr>
    <tr>
        <!-- Mostramos los datos del cliente en el documento HTML -->
        <td>Cliente: <?php echo utf8_decode($reg->cliente_nombres.' '.$reg->cliente_apellidos); ?></td>
    </tr>
    <tr>
        <td><?php echo utf8_decode("Rnc/Cedula: ".$reg->cedularnc); ?></td>
    </tr>
    <tr>
        <td>#Factura: <?php echo " ".$reg->id_venta; ?></td>
    </tr>    
</table>
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="300px">
    <tr>
        <td>CANT.    NOMBRE                              TOTAL</td>
       <!--  <td>NOMBRE   </td>
        <td align="right">TOTAL</td> -->
    </tr>
    <tr>
      <td colspan="3">========================================</td>
    </tr>
    <?php
    $rsptad = $venta->ventadetalle($_GET["id"]);
    $cantidad=0;
    while ($regd = $rsptad->fetch_object()) {
        echo "<tr>";
        echo "<td>".$regd->cantidad."    ".$regd->producto."                    RD$".$regd->subtotal."   </td>";
        // echo "<td>".$regd->producto."    </td>";
        // echo "<td align='right'>RD$ ".$regd->subtotal."</td>";
        echo "</tr>";
        $cantidad+=$regd->cantidad;
    }
    ?>
    <br>
    <!-- Mostramos los totales de la venta en el documento HTML -->
    <tr>
        <td>&nbsp;</td>
        <td align="right"><b>TOTAL:</b></td>
        <td align="right"><b>RD$  <?php echo $reg->total;  ?></b></td>
    </tr>
    <?php if($reg->id_venta_tipo == 2){
    ?>
    <tr>
        <td>&nbsp;</td>
        <td align="right"><b>ABONO:</b></td>
        <td align="right"><b>RD$  <?php echo $reg->cantidad_pagada;  ?></b></td>
    </tr>
    <?php
        } 
    ?>
    <br>
    <tr>
      <td colspan="3">Cantidad de Productos: <?php echo $cantidad; ?></td>
    </tr>
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr> 
    <tr>
      <td colspan="3" align="center">Recibido:_____________</td>
    </tr>
    <tr>
      <td colspan="3" align="center"></td>
    </tr>     
    <tr>
      <td colspan="3" align="center">¡Gracias por su compra!</td>
    </tr>
    
</table>
<br>
</div>
<p>&nbsp;</p>

</body>
</html>
<?php 
}else{
            echo 'No se encontro el Ticket';
        }

}
else
{
  echo 'No tiene permiso para visualizar el reporte';
}

}
ob_end_flush();
?>