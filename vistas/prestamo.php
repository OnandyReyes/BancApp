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
                          <h1 class="box-title">Prestamos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Tipo</th>
                            <th>Cliente</th>
                            <th>Apodo</th> 
                            <th>Monto</th>
                            <th>Interes</th>
                            <th>Fecha</th> 
                            <th>Estado</th> 
                          </thead>
                          <tbody>
                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Tipo</th>
                            <th>Cliente</th> 
                            <th>Apodo</th> 
                            <th>Monto</th>
                            <th>Interes</th>
                            <th>Fecha</th>
                            <th>Estado</th> 
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <input type="hidden" name="id_prestamo" id="id_prestamo" >

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cliente *</label>
                            <select id="id_cliente" name="id_cliente" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Prestamo *</label>
                            <select id="id_prestamo_tipo" name="id_prestamo_tipo" class="form-control selectpicker" data-live-search="true" required>
                              <option value="1">Diario</option>
                              <option value="2">Quincenal</option>
                              <option value="2">Semanal</option>
                              <option value="3" selected>Mensual</option>
                            </select>
                          </div>
                          <div class="row">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label >Monto *</label>
                                <input type="number" class="form-control " name="monto" id="monto"  placeholder="Monto" step=".01" required >
                                <button type="button" class="btn btn-info" onclick="calcular()"><i class="fa fa-refresh"></i></button>
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label >Interes *</label>
                                <input type="number" class="form-control " name="interes" id="interes"  placeholder="Interes" step=".01" required >
                                <button type="button" class="btn btn-info" onclick="calcular()"><i class="fa fa-refresh"></i></button>
                              </div>
                              <div id="mesesGroup" class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <label >Cuotas *</label>
                                <input type="number" class="form-control " name="meses" id="meses"  placeholder="Cuotas" step=".01" required >
                                <button type="button" class="btn btn-info" onclick="calcular()"><i class="fa fa-refresh"></i></button>
                              </div>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label >Monto Total </label>
                                <h4 id="total">0.00</h4>
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label >Pagos </label>
                                <h4 id="pago">0.00</h4>
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <!-- <label>Fecha Inicio</label> -->
                                  <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>" >
                              </div>
                              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <!-- <label>Fecha Fin</label> -->
                                  <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>" >
                              </div>
                            </div>
                          </div>
                          
                          
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>Cancelar</button>
                          </div>
                        </form>
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

<script type="text/javascript" src="scripts/prestamo.js"></script>

<?php  
}
ob_end_flush();
?>