<?php
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{

if($_SESSION['prestamo']){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reporte</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- <link rel="shortcut icon" href="../public/img/waterapplogo.jpeg"> -->
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../public/css/blue.css">
	 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="window.print();">
   <!--Contenido-->
<table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          
                          <tbody>
                              <?php
                                require_once "../modelos/Cliente.php";
                                require_once "../modelos/Pago.php";
                                require_once "../modelos/Prestamo.php";
        
                                $clientes = new Cliente();
                                $prestamos = new Prestamo();
                                $pagos = new Pago();
                               
                                $rptCliente=$clientes->listar();

                                while ($cliente = $rptCliente->fetch_object()) {
                                    $rptPrestamo=$prestamos->listarClientePendiente($cliente->id_usuario);
                                    $count = $rptPrestamo->num_rows;
                                if($count > 0){
                                    echo  '<tr>
                                            <td>'.$cliente->nombres.' '.$cliente->apellidos.'</td>
                                         </tr>' ;
                                    
                                    echo  '<tr>
                                            <td>
                                            <table class="table table-striped table-bordered table-condensed table-hover">
                                                <thead>
                                                    <th>NO. PRESTAMO</th>
                                                    <th>CAPITAL</th>
                                                    <th>INTERES</th>
                                                    <th>CUOTAS</th> 
                                                    <th>BALANCE</th>
                                                    <th>BALANCE CAPITAL</th>
                                                    <th>BALANCE INTERES</th>
                                                    <th>CUOTAS</th>
                                                </thead>
                                                <tbody>';

                                                while($prestamo = $rptPrestamo->fetch_object()){
                                                    
                                                    $rptPago=$pagos->cuotas($prestamo->id_prestamo);
                                                    
                                                    echo '<tr>
                                                        <td>'.$prestamo->id_prestamo.'</td>
                                                        <td>'.$prestamo->monto.'</td>
                                                        <td>'.$prestamo->interes.'</td>
                                                        <td>'.$prestamo->cuotas.'</td>';
                                                        $interes = $prestamo->interes / 100;
                                                        $Balance = 0;
                                                        $balanceCapital = 0;
                                                        $balanceInteres = 0;
                                                        $cuotas = $rptPago->num_rows;
                                                        while($pago = $rptPago->fetch_object()){
                                                            $Balance+= $pago->monto;
                                                            $balanceCapital += $pago->monto - ($prestamo->monto * $interes);
                                                            $balanceInteres += $prestamo->monto * $interes;
                                                        }
                                                        echo '<td>'.$Balance.'</td>
                                                            <td>'.$balanceCapital.'</td>
                                                            <td>'.$balanceInteres.'</td>
                                                            <td>'.$cuotas.'</td>';
                                                    echo '</tr>';
                                                }
                                                    
                                                
                                        echo '</tbody>
                                            </table>
                                            </td>
                                            
                                        </tr>' ;
                                    }
                                
                                }
                              ?>
                            
                          </tbody>
                        </table>
  <!--Fin-Contenido-->
  </body>
</html>





<?php
}else{
  require 'noacceso.php';
}

?>

<script type="text/javascript">
    

</script>

<?php  
}
ob_end_flush();
?>