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
                            <h2>Jugadas</h2>
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
                              <div id="jugadasHoyTable">
                                <table id="jugadasHoy" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                    <th>Estado</th>
                                  </thead>
                                  <tbody id="tblJugadas">
                                    <?php
                                      require_once "../modelos/Ticket.php";

                                      $ticket= new Ticket();

                                      require_once "../modelos/Numeros_ganadores.php";

                                      $numeros_ganadores_hoy = new Numeros_ganadores();
                              
                                      $respuesta=$ticket->listaHoy();
                                      $data = Array();

                                      while ($objeto = $respuesta->fetch_object()) {
                                        $estilo = "";
                                        $premio = "";
                                        $resultado2 = $numeros_ganadores_hoy->ticketGanador($objeto->id_ticket);
                                        if($resultado2 > 0){
                                            $estilo = 'style="background-color:#C7EAB7;"';
                                            $premio = "Premiado";
                                        }

                                        //$estilo = 'style="background-color:#C7EAB7;"';
                                        ?>
                                        <tr <?php echo $estilo; ?> >
                                          <td><?php echo $objeto->id_ticket; ?></td>
                                          <td><?php echo $objeto->nombres." ".$objeto->apellidos; ?></td>
                                          <td><?php echo date_format(date_create($objeto->fecha_creacion), 'd/m/Y H:i:s');?></td>
                                          <td><?php echo '<button id="'.$objeto->id_ticket.'" type="button" class="btn btn-primary abrirModal">Ver</button>'; ?>
                                          <?php 
                                          // if($_SESSION['id_cuenta_tipo'] == 1){
                                          //     echo '<button class="btn btn-danger" onclick="eliminar('.$objeto->id_ticket.')"><i class="fa fa-close"></i></button>'; 
                                          // }
                                            
                                            ?>
                                          </td>
                                          <td>
                                            <?php 
                                              echo $premio;
                                            ?>
                                          </td>
                                        </tr>
                                    
                                    <?php          
                                      }
                                    ?>
                                  </tbody>
                                  <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><?php echo ""; ?></th>
                                    <th></th>
                                  </tfoot>
                                </table>
                              </div>
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
  <div class="modal fade" id="myModalTicketDetalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
          <h4 class="modal-title">Jugadas</h4>
        </div>
        <div class="modal-body">
          <table id="tblticketDetalle" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Loteria</th>
              <th>Numeros</th>
              <th>Tipo</th>
              <th>Monto</th>
            </thead>
            <tbody>

            </tbody>
            <tfoot>
              <th>Loteria</th>
              <th>Numeros</th>
              <th>Tipo</th>
              <th>Monto</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
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
var table2;


function init(){
	
	jugadasHoyEscritorio();
	
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

  $("#jugadasHoyTable").html("");

  $.get("../ajax/reportes.php?op=jugadasFiltro",
  {fecha_inicio: fecha_inicio,fecha_fin: fecha_fin,id_vendedor: id_vendedor},function(r){
    $("#jugadasHoyTable").html(r);
    
    
    $(".abrirModal").click(function(){
		  var id = this.id;
		  $.post("../ajax/ticket.php?op=ticketDetalleTableFechaTicket&id="+id,function(r){
			  $("#tblticketDetalle").html(r);
		  });
			
		  $('#myModalTicketDetalle').modal('show');
      
		});

    $('#jugadasHoy').DataTable();
  });
  

}

function jugadasHoyEscritorio(){

	$(".abrirModal").click(function(){
		var id = this.id;
		  $.post("../ajax/ticket.php?op=ticketDetalleTable&id="+id,function(r){
			$("#tblticketDetalle").html(r);
		  });
			
		  $('#myModalTicketDetalle').modal('show');
		});

    table = $('#jugadasHoy').DataTable();     
}

// function eliminar(id_ticket){
// 	bootbox.confirm("Esta seguro de eliminar la Jugada?",function(result){
// 		if(result){
// 			$.post("../ajax/ticket.php?op=eliminar",{id_ticket : id_ticket},function(e){
// 				bootbox.alert(e);
// 				table.ajax.reload();
// 			});
// 		}
// 	});
// }

init();
</script>
<!-- <script type="text/javascript" src="scripts/escritorio.js"></script> -->

<?php  
}
ob_end_flush();
?>