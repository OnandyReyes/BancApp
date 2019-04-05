<?php
if(strlen(session_id()) < 1)
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PrestaRed</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <!-- <link rel="shortcut icon" href="../public/img/waterapplogo.jpeg"> -->

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css" type="text/css" />
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css" type="text/css" />

    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css" type="text/css" />
    
    <link rel="stylesheet" href="../public/css/style.css" type="text/css" />

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>R</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>PrestaRed</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../public/dist/img/user.svg.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombres']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../public/dist/img/user.svg.png" class="img-circle" alt="User Image">
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <?php
            if($_SESSION['perfil']==1){
              echo '<li>
              <a href="perfil.php">
                <i class="fa fa-user"></i> <span>Perfil</span>
              </a>
            </li> ';
            }
            ?>

            <?php
            if($_SESSION['escritorio']==1){
              echo '<li>
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Escritorio</span>
              </a>
            </li> ';
            }
            ?>

            <?php
            if($_SESSION['cobrar']==1){
              echo '<li>
              <a href="cobrar.php">
                <i class="fa fa-shopping-cart"></i> <span>Cobrar</span>
              </a>
            </li> ';
            }
            ?>


            <?php
            if($_SESSION['prestamo']==1){
              echo '<li>
              <a href="prestamo.php">
                <i class="fa fa-tasks"></i> <span>Prestamos</span>
              </a>
            </li> ';
            }
            ?>

            <li>
              <a href="grupo.php">
              <i class="fa fa-tasks"></i> <span>Grupo</span>
              </a>
            </li>

            <?php
            if($_SESSION['acceso']==1){
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">';

              if($_SESSION['usuario']==1){
                echo '<li><a href="usuario.php"><i class="fa fa-circle-o"></i> Empleados</a></li>';
              }

              if($_SESSION['cliente']==1){
                echo '<li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>';
              }

              echo '</ul>
            </li>';
            }
            ?>   

            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="estadoCuenta.php"><i class="fa fa-circle-o"></i> Estado de Cuenta</a></li>
              </ul>
              <ul class="treeview-menu">
                <li><a href="pagos.php"><i class="fa fa-circle-o"></i> Pagos</a></li>
              </ul>
            </li>

            <li><a href="../ajax/usuario.php?op=salir"><i class="fa fa-circle-o text-red"></i> <span>Cerrar Sesion</span></a></li>
            <!-- <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li> -->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
