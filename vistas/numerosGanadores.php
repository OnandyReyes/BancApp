<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombres"]) && $_SESSION['id_cuenta_tipo'] != 1){
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
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="formularioregistros">
                        
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarNumeroGanadores" type="button" class="btn btn-primary"><span class="fa fa-plus"></span>Agregar Numeros Ganadores</button>
                            </a>
                          </div>

                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color: #A9D0F5">
                                <th>Loteria</th>
                                <th>Numeros</th>
                                <th>Fecha</th>
                              </thead>
                              <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tfoot>
                              <tbody>
                                
                              </tbody>
                            </table>
                          </div>
                          
                        
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form name="formulario" id="formulario" method="POST">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
            <h4 class="modal-title">Insertar los numeros</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <label>Loteria</label>
                        <select id="id_loteria_sub" name="id_loteria_sub" class="form-control selectpicker" data-live-search="true" required>
                        <?php
                            require_once "../modelos/Loterias.php";

                            $loterias= new Loterias();

                            $respuesta = $loterias->select();

                            while($objeto = $respuesta->fetch_object()){
                
                            echo '<option value="'.$objeto->id_loteria_sub.'" >'.$objeto->nombre.'</option>';   
        
                            }

                        ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Primera *</label>
                        <input type="number" min="00" max="99" class="form-control " name="primera" id="primera"  placeholder="Primera" required >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Segunda *</label>
                        <input type="number" min="00" max="99" class="form-control " name="segunda" id="segunda"  placeholder="Segunda" required >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <label >Tercera *</label>
                        <input type="number" min="00" max="99" class="form-control " name="tercera" id="tercera"  placeholder="Tercera" required >
                    </div>
                </div>
                
                
                
            </div>
            <div class="modal-footer">
            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Guardar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        </div>
    </form>      
    
  </div>
 
  <!--Fin-Modal-->



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
var tabla;
function init(){
    listar();
    
	$("#formulario").on("submit",function(e){
		guardaryeditar(e);
    });
    
}

//Funcion limpiar
function limpiar(){

    $("#primera").val("");
    $("#segunda").val("");
    $("#tercera").val("");

}

function guardaryeditar(e){
	e.preventDefault(); //No se activara la accion predeterminada del evento

		$("#btnGuardar").prop("disabled",true);
		var formData = new FormData($("#formulario")[0]);

		$.ajax({
			url: "../ajax/numeros_ganadores.php?op=insertar",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function(datos){

				data = JSON.parse(datos);
				
				if(data.estado){
					tabla.ajax.reload();
					limpiar();
                    bootbox.alert(data.mensaje);
                    $("#btnGuardar").prop("disabled",false);
				}else{

					$("#btnGuardar").prop("disabled",false);
					bootbox.alert(data.mensaje);
				}
			}
		});
	
	
}

function listar(){
	tabla =$('#tbllistado').dataTable({
		"aProcessing":true,
		"aServerSide":true,
		dom:'Bfrtip',
		buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdf'
				],
		"ajax":
				{
					url: '../ajax/numeros_ganadores.php?op=listar',
					type : "get",
					dataType : "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
		"bDestroy":true,
		"iDisplayLength":10,//Paginacion
		"order":[[ 0, "desc"]]// Ordenar (columna,orden)
				
	}).DataTable();
}



init();
</script>
<!-- <script type="text/javascript" src="scripts/escritorio.js"></script> -->

<?php  
}
ob_end_flush();
?>