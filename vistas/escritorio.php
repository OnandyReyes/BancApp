<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{

require 'header.php';

if($_SESSION['escritorio']){
  // if($_SESSION['id_usuario_tipo'] == 1){

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
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h2>Prestamos Diario</h2>
                          </div>
                          <div class="box-body">
                            <div class="panel-body table-responsive" id="prestamosdiariosegistros">
                                <table id="diariosEscritorio" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Cuota</th>
                                    <th>Accion</th>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- centro -->
                    <!-- centro -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h2>Prestamos Semanales</h2>
                          </div>
                          <div class="box-body">
                            <div class="panel-body table-responsive" id="prestamossemanalessegistros">
                                <table id="semanalesEscritorio" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Cuota</th>
                                    <th>Accion</th>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- centro -->
                    <!-- centro -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h2>Prestamos Quincenales</h2>
                          </div>
                          <div class="box-body">
                            <div class="panel-body table-responsive" id="prestamosquincenalesregistros">
                                <table id="quincenalEscritorio" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Cuota</th>
                                    <th>Accion</th>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- centro -->
                    <!-- centro -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-sx-12">
                        <div class="box box-primary">
                          <div class="box-header with-border">
                            <h2>Prestamos Mensuales</h2>
                          </div>
                          <div class="box-body">
                            <div class="panel-body table-responsive" id="prestamosmensualesregistros">
                                <table id="mensualesEscritorio" class="table table-striped table-bordered table-condensed table-hover">
                                  <thead>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Cuota</th>
                                    <th>Accion</th>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- centro -->
                    </div>
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
}else{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/escritorio.js"></script>

<?php  
}
ob_end_flush();
?>