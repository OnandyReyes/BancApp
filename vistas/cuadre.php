<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{

require 'header.php';

//if($_SESSION['escritorio']){
  // if($_SESSION['id_usuario_tipo'] == 1){
    date_default_timezone_set ('America/Santo_Domingo');

    $fecha = new DateTime();
    $fecha02 = $fecha->format('Y-m-d');
    $fecha = $fecha->format('Y-m-d H:i:m');
    
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                        <!-- centro -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h2>Cuadre Hoy</h2>
                          </div>
                          <div class="box-body">
                            <div class="panel-body table-responsive" id="cuadrehoyriosegistros">
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha Inicio</label>
                                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo $fecha02; ?>" >
                              </div>
                              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <label>Fecha Fin</label>
                                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo $fecha02; ?>" >
                              </div>
                              <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Vendedores</label>
                                <select name="id_vendedor" id="id_vendedor" class="form-control selectpicker" data-live-search="true" required>
                                </select>
                                <button class="btn btn-success" onclick="listar()">Mostrar</button>
                              </div>
                                <table id="cuadreHoy" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>Vendedor</th>
                                    <th>Venta</th>
                                    <th>Premios</th>
                                    <th>Comision</th>
                                    <th>Ganancia</th>
                                  </thead>
                                  <tbody>
                                  <?php
                                    require_once "../modelos/Cuentas.php";

                                    $cuentas= new Cuentas();
                            
                                    $respuesta=$cuentas->listaVendedores();
                                    $data = Array();
                                    
                                    $total_venta = 0;
                                    $total_premios = 0;
                                    $total_comision = 0;
                                    $total_ganancia = 0;

                                    while ($objeto = $respuesta->fetch_object()) {
                                        require_once "../modelos/Ticket.php";

                                        $tickets= new Ticket();

                                        require_once "../modelos/Numeros_ganadores.php";
                                        $numeros_ganadores= new Numeros_ganadores();

                                      
                                        $ticketVendedores = $tickets->ticketsIdUsuarioHoy($objeto->id_usuario, $fecha );
                                        $venta = 0;
                                        $premio = 0;

                                        $usuario = $cuentas->seleccionar($objeto->id_usuario);

                                        while($objeto2 = $ticketVendedores->fetch_object()){
                                            $tickets_detalles = $tickets->DetalleTicketId($objeto2->id_ticket);
                                            
                                            while($objeto3 = $tickets_detalles->fetch_object()){
                                            
                                              $tipoJugada = "";

                                              if($objeto3->numero >= 0){
                                                  $tipoJugada = "Quiniela";
                                              }

                                              if($objeto3->numero2 >= 0){
                                                  $tipoJugada = "Pale";
                                              }

                                              if($objeto3->numero3 >= 0){
                                                  $tipoJugada = "Tripleta";
                                              }

                                                $variable_tickets_detalle = $tickets->DetalleTicketIdTicket($objeto3->id_ticket_detalle);
                                                $variable_numeros_ganadores = $numeros_ganadores->ganadoresLoteriaId($objeto3->id_loteria_sub, $fecha);
                                                
                                                $premio += $numeros_ganadores->verificarGanador($variable_tickets_detalle, $variable_numeros_ganadores, $usuario, $tipoJugada );

                                                $venta += $objeto3->monto;

                                                
                                                
                                            }
                                        }   

                                        

                                        $comision = 0;

                                        
                                        
                                        $comision = $usuario["comision"] / 100;

                                        $comision = $venta * $comision;
                                        
                                        $ganancia = $venta - ($premio + $comision);

                                        $total_comision += $comision;
                                        $total_ganancia += $ganancia;
                                        $total_venta += $venta ;
                                        $total_premios += $premio;
                                      ?>
                                      <tr>
                                        <td><?php echo $objeto->usuario; ?></td>
                                        <td><?php echo $venta; ?></td>
                                        <td><?php echo $premio;?></td>
                                        <td><?php echo $comision; ?></td>
                                        <td><?php echo $ganancia; ?></td>
                                      </tr>
                                  
                                  <?php          
                                    }
                                  ?>
                                  </tbody>
                                  <tfoot>
                                    <th>Total : </th>
                                    <th><?php echo $total_venta; ?></th>
                                    <th><?php echo $total_premios; ?></th>
                                    <th><?php echo $total_comision; ?></th>
                                    <th><?php echo $total_ganancia; ?></th>
                                  </tfoot>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- centro -->
                    <!-- centro -->
                     
                    <!-- /.box-header -->
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
  
<?php
  // }else{
  //   if($_SESSION['id_usuario_tipo'] == 2)
  //     header("location: mispedidos.php");

  //   if($_SESSION['id_usuario_tipo'] == 3)
  //     header("location: mispedidos.php");
    
  // }
// }else{
//   require 'noacceso.php';
// }
require 'footer.php';
?>
<script>
function init(){
	
	jugadasHoyEscritorio();
	
	//listar();

	//Cargamos los items al select cliente
	$.post("../ajax/cuentas.php?op=selectVendedores",function(r){
		$("#id_vendedor").html(r);
		$("#id_vendedor").selectpicker('refresh');
	});
	
}

function listar(){
	var fecha_inicio = $("#fecha_inicio").val();
	var fecha_fin = $("#fecha_fin").val();
	var id_vendedor = $("#id_vendedor").val();

  $.get("../ajax/reportes.php?op=cuadreFiltro",
  {fecha_inicio: fecha_inicio,fecha_fin: fecha_fin,id_vendedor: id_vendedor},function(r){
    $("#cuadreHoy").html(r);
    
  });
  
	var table = $('#cuadreHoy').DataTable();

}

function jugadasHoyEscritorio(){

	var table = $('#cuadreHoy').DataTable();
}


init();
</script>
<!-- <script type="text/javascript" src="scripts/escritorio.js"></script> -->

<?php  
}
ob_end_flush();
?>