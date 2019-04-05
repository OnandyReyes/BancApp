<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{

require 'header.php';

if($_SESSION['cobrar']){
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
                        <form name="formulario" id="formulario" method="POST">
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h4><b>COBRAR</b></h4>
                          </div>

                          <div id="grupo_cliente" class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-4">
                            <label>Cliente *</label>
                            <select id="id_cliente" name="id_cliente" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>

                          <div id="grupo_vendedor" class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <label>Prestamos *</label>
                            <select id="id_prestamo" name="id_prestamo" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <label>Tipo Factura</label>
                            <select id="tipo_factura" name="tipo_factura"  class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3 selectpicker" data-live-search="true" required>
                              <option value="1">Punto De Venta</option>
                              <option value="2">Factura</option>
                            </select>
                          </div>
                          <div id="linea1" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                          </div>

                          <div id="linea2" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                          </div>

                          <div id="linea3" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                          </div>
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button id="btnGuardar" class="btn btn-primary" type="submit" ><i class="fa fa-save"></i>Guardar</button>

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

  <!-- Modal -->

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
          <h4 class="modal-title">Seleccione un Producto</h4>
        </div>
        <div class="modal-body">
          <table id="tblproductos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Tipo</th>
              <th>Precio</th>
              <th>Existencia</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Marca</th>
              <th>Tipo</th>
              <th>Precio</th>
              <th>Existencia</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
 <div class="modal fade" id="myModalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >&times;</button>
          <h4 class="modal-title">Registrar Cliente</h4>
        </div>
        <div class="modal-body">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres *</label>
                            <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" maxlength="150" placeholder="Nombres" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="apellidosdiv">
                            <label>Apellidos </label>
                            <input type="text" class="form-control" name="apellidoCliente" id="apellidoCliente" maxlength="150" placeholder="Apellidos" >
                          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" onclick="crearCliente()" type="button"><i class="fa fa-save"></i>Guardar</button>

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Fin-Modal-->

<?php
}else{
  require 'noacceso.php';
}
require 'footer.php';
?>

<script type="text/javascript" src="scripts/cobrar.js"></script>

<?php  
}
ob_end_flush();
?>