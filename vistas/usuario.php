<?php
ob_start();
session_start();

if(!isset($_SESSION["nombres"])){
  header("location: login.html");

}else{
require 'header.php';

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
                          <h1 class="box-title">Usuarios <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombres</th> 
                            <th>Estado</th> 
                          </thead>
                          <tbody>
                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Nombres</th> 
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombres *</label>
                            <input type="hidden" name="id_usuario" id="id_usuario" >
                            <input type="hidden" name="id_sector" id="id_sector" value="42" >
                            <input type="text" class="form-control" name="nombres" id="nombres" maxlength="250" placeholder="Nombres" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos </label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="250" placeholder="Apellidos" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Usuario *</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" maxlength="250" placeholder="Usuario" required >
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Cédula *</label>
                            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cédula" data-mask="999-9999999-9" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Celular *</label>
                            <input type="text" class="form-control" maxlength="13" name="celular" id="celular" data-mask="999-999-9999" placeholder="Celular" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion *</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Calle" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Provincias *</label>
                            <input type="text" class="form-control" name="usuario2" id="usuario2" maxlength="250" placeholder="Usuario" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Municipio *</label>
                            <input type="text" class="form-control" name="usuario3" id="usuario3" maxlength="250" placeholder="Usuario" required >
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono *</label>
                            <input type="text" class="form-control" maxlength="13" name="telefono" id="telefono" data-mask="999-999-9999" placeholder="Telefono" required >
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo de Usuario *</label>
                            <select id="id_usuario_tipo" name="id_usuario_tipo" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Correo *</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Clave *</label>
                             <input type="password" class="form-control" minlength="4" name="clave" id="clave" placeholder="Clave">
                             <input type="hidden" name="claveactual" id="claveactual" >
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
require 'footer.php';
?>

<script type="text/javascript" src="scripts/usuario.js"></script>

<?php  
}
ob_end_flush();
?>