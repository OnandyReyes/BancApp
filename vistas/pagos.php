<?php
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{
require 'header.php';
if($_SESSION['prestamo']){
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
                          <h1 class="box-title">Pagos </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" >
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Codigo</th>
                            <th>Cliente</th>
                            <th>Monto Pagado</th> 
                            <th>Fecha</th> 
                            <th></th> 
                          </thead>
                          <tbody>
                            
                          </tbody>
                          <tfoot>
                            <th>Codigo</th>
                            <th>Cliente</th>
                            <th>Monto Pagado</th> 
                            <th>Fecha</th> 
                            <th></th>  
                          </tfoot>
                        </table>
                    </div>
                    
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->



<?php
}else{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript">
    var tabla;

    $(document).ready(function() {
        listar();
    });

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
                        url: '../ajax/reportes.php?op=pagos',
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

</script>

<?php  
}
ob_end_flush();
?>