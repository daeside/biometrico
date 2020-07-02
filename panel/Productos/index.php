<?php

session_start();
require_once ('Controller.php');

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Clientes - Panel de Control</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <!-- datatables -->
  <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css"/>
</head>

<body>
  <!-- Sidenav -->
  <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="./index.html">
        <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
      </a>
      <!-- User -->
      <ul class="nav align-items-center d-md-none">
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="ni ni-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="../assets/img/theme/team-1-800x800.jpg">
              </span>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
            <div class=" dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bienvenido!</h6>
            </div>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Mi Perfil</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-settings-gear-65"></i>
              <span>Configuraciones</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-calendar-grid-58"></i>
              <span>Actividades</span>
            </a>
            <a href="./examples/profile.html" class="dropdown-item">
              <i class="ni ni-support-16"></i>
              <span>Soporte</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#!" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Cerrar Sesion</span>
            </a>
          </div>
        </li>
      </ul>
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="./index.html">
                <img src="../assets/img/brand/blue.png">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="./index.html">
              <i class="ni ni-tv-2 text-primary"></i> Escritorio
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../Productos">
              <i class="ni ni-box-2 text-info"></i> Productos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../Cotizaciones">
              <i class="ni ni-credit-card text-info"></i> Cotizaciones
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Clientes">
              <i class="ni ni-shop text-info"></i> Clientes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../Usuarios">
              <i class="ni ni-single-02 text-info"></i> Usuarios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/icons.html">
              <i class="ni ni-delivery-fast text-orange"></i> Servicios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/icons.html">
              <i class="ni ni-archive-2 text-yellow"></i> Facturación
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/icons.html">
              <i class="ni ni-building text-red"></i> Bancos
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./examples/maps.html">
              <i class="ni ni-pin-3 text-orange"></i> Maps
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/profile.html">
              <i class="ni ni-single-02 text-yellow"></i> User profile
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/tables.html">
              <i class="ni ni-bullet-list-67 text-red"></i> Tables
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/login.html">
              <i class="ni ni-key-25 text-info"></i> Login
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./examples/register.html">
              <i class="ni ni-circle-08 text-pink"></i> Register
            </a>
          </li> -->
        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        <h6 class="navbar-heading text-muted">Documentation</h6>
        <!-- Navigation -->
        <ul class="navbar-nav mb-md-3">
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
              <i class="ni ni-spaceship"></i> Getting started
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
              <i class="ni ni-palette"></i> Foundation
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
              <i class="ni ni-ui-04"></i> Components
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Productos</a>
        <!-- Form -->
        <!-- <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
        </form> -->
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="../assets/img/theme/team-4-800x800.jpg">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold">Jesus Yepez</span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0">Bienvenido!</h6>
              </div>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>Mi Perfil</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Configuración</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-calendar-grid-58"></i>
                <span>Actividades</span>
              </a>
              <a href="./examples/profile.html" class="dropdown-item">
                <i class="ni ni-support-16"></i>
                <span>Soporte</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Cerrar Sesion</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Table stats -->



             <!-- Table Finish -->
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Alta de Productos
                </div>







                <form id="products-form">
          <div class="row">

          <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control form-product" value="1" style="visibility:hidden;">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control form-product" id="code" name="code" placeholder="Codigo">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control form-product" id="description" name="description" placeholder="Descripcion">
              </div>
            </div>

            <br><br><br>
            <div class="col-md-12" style="text-align:center;">
            <button class="btn btn-icon btn-sm btn-primary" type="button" id="save-product">
                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                    <span class="btn-inner--text">Guardar producto</span>
            </button>
            </div>
        </form>



              </div>
            </div>
            <div class="table-responsive" style="display: none;">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col"><center>Editar</center></th>
                    <th scope="col"><center># Cliente</center></th>
                    <th scope="col"><center>Alias</center></th>
                    <th scope="col"><center>Razón Social</center></th>
                    <th scope="col"><center>RFC</center></th>
                    <th scope="col"><center>Dirección</center></th>
                    <th scope="col"><center>Contacto</center></th>
                    <th scope="col"><center>Telefono</center></th>
                    <th scope="col"><center>Correo</center></th>
                    <th scope="col"><center>Usuario</center></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <center><a href="Detalle/"><i class="fas fa-edit"></i></a></center> <!-- boton edicion -->
                    </th>
                    <td>
                      <center>4124</center> <!-- Numero de Cliente -->
                    </td>
                    <td>
                      <center>Tecnotronik</center><!-- Alias --> 
                    </td>
                    <td>
                      <center>JESUS GEOVANY YEPEZ ZAMUDIO</center> <!-- Razon Social -->
                    </td>
                    <td>
                      <center>ZATB710304787</center> <!-- RFC -->
                    </td>
                    <td>
                      <left>Av. Xel-Ha Edificio Siglo XXI Smz.24 #105</left> <!-- Dirección  -->
                    </td>
                    <td>
                      <center>Ing. Jesus Yepez</center> <!-- Contacto -->
                    </td>
                    <td>
                      <center>9984103996</center> <!-- Telefono -->
                    </td>
                    <td>
                      <center>yepez@tecnotronik.com</center> <!-- Correo -->
                    </td>
                    <td>
                      <center>jyepz</center> <!-- Usuario -->
                    </td>

                    <!-- <td>
                      <center><span class="badge badge-info">Capturada</span></center> 
                    </td>
                    <td>
                      <center><button type="button" class="btn btn-secondary btn-sm">Facturar</button></center> 
                    </td>
                    <td>
                      <center>17000</center>
                    </td>
                    <td>
                      <center><button type="button" class="btn btn-secondary btn-sm">Crear</button></center> 
                    </td>
                    <td>
                      <center><button type="button" class="btn btn-secondary btn-sm">Crear</button></center> 
                    </td>
                    <td>
                      <center>jyepz</center>
                    </td> -->
                  </tr>
                  </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--  -->
      </div>

      <div class="modal fade" id="nuevo-cliente" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
<div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          
            <div class="modal-body p-0">
              
                  
<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-left text-muted mb-4">
            <strong>Agregar nuevo cliente</strong>
        </div>

        <form id="client-form">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control form-client" id="client-name" name="client-name" placeholder="Alias del cliente">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control form-client" id="client-razon-social" name="client-razon-social" placeholder="Razon social">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" class="form-control form-client" id="client-rfc" name="client-rfc" placeholder="RFC del cliente">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <input type="text" class="form-control form-client" id="client-sucursal" name="client-sucursal" placeholder="Sucursal">
              </div>
            </div>

            <!--div class="col-md-12" style="text-align:center;">
              <button class="btn btn-icon btn-sm btn-success" type="button" id="add-sucursal-btn">
                  <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                  <span class="btn-inner--text">Agregar sucursal</span>
              </button>
              <button class="btn btn-icon btn-sm btn-warning" type="button" id="remove-sucursal-btn">
                  <span class="btn-inner--icon"><i class="ni ni-fat-minus"></i>-</span>
                  <span class="btn-inner--text">Remover sucursal</span>
              </button>
            </div-->

            <br><br>
            
              <div class="col-md-12" id="detalle-container-1-1">
                <div class="form-group">
                  <input type="text" class="form-control form-client" id="client-detalle-name-1" name="client-detalle-name-1" placeholder="Contacto nombre 1">
                </div>
              </div>
              <div class="col-md-6" id="detalle-container-2-1">
                <div class="form-group">
                  <input type="text" class="form-control form-client" id="client-detalle-email-1" name="client-detalle-email-1" placeholder="Contacto correo 1">
                </div>
              </div>
              <div class="col-md-6" id="detalle-container-3-1">
                <div class="form-group">
                  <input type="text" class="form-control form-client" id="client-detalle-tel-1" name="client-detalle-tel-1" placeholder="Contacto telefono 1">
                </div>
              </div>
            

            <div class="col-md-12" style="text-align:center;">
              <button class="btn btn-icon btn-sm btn-success" type="button" id="add-contacto-btn">
                  <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                  <span class="btn-inner--text">Agregar contacto</span>
              </button>
              <button class="btn btn-icon btn-sm btn-warning" type="button" id="remove-contacto-btn">
                  <span class="btn-inner--icon"><i class="ni ni-fat-minus"></i>-</span>
                  <span class="btn-inner--text">Remover contacto</span>
              </button>
            </div>

            <br><br><br><br>
            <div class="col-md-12" style="text-align:center;">
            <button class="btn btn-icon btn-sm btn-primary" type="button" id="save-client">
                    <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>
                    <span class="btn-inner--text">Guardar cliente</span>
            </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->

<div class="col-md-10">
      <!-- <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-form">Form</button> -->
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          
            <div class="modal-body p-0">
              
                  
<div class="card bg-secondary shadow border-0">
    <div class="card-body px-lg-5 py-lg-5">
        <div class="text-left text-muted mb-4">
            <strong>Nueva Solictud de Cotización</strong>
        </div>

        <form>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <select class="form-control">
                  <option selected="">-Selecciona Cliente-</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                </select>
              </div>
            </div>   
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" placeholder="Nombre" class="form-control" value="DIANA LUCIA TORRES MORENO" disabled />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" placeholder="Dirección" class="form-control" value="RETORNO DEL SOL # 26 MZ. 11LOTE 18 " disabled />
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="CP" class="form-control" value="77500" disabled />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <input type="text" placeholder="Ciudad" class="form-control" value="Cancún" disabled />
              </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" placeholder="Estado" class="form-control" value="Quintana Roo" disabled/>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <input type="text" placeholder="País" class="form-control" value="México" disabled />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="email" placeholder="Email" class="form-control" value="asistente@conceptovisual.mx" disabled />
                </div>
              </div>
            </div>

          </div>  
        </form>

        <form role="form">
          <div class="form-group mb-3">
            <div class="input-group input-group-alternative">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="ni ni-email-83"></i>
                </span>
              </div>
                <select class="form-control">
                  <option selected="">-Selecciona Cliente-</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                </select>
            </div>
          </div>

                      <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Nombre" type="text" value="DIANA LUCIA TORRES MORENO" disabled="">
                </div>
            </div>


                  </form>




        <form role="form">

            <div class="form-group mb-3">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Email" type="email">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="Password" type="password">
                </div>
            </div>
            <div class="custom-control custom-control-alternative custom-checkbox">
                <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Remember me</span>
                </label>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-primary my-4">Sign in</button>
            </div>
        </form>
    </div>
</div>


      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2019 <a href="https://tecnotronik.com" class="font-weight-bold ml-1" target="_blank">TecnoTronik</a>
            </div>
          </div>
          <!-- <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div> -->
        </div>
      </footer>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
  <!--datatables-->
  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script>

//$(document).ready(function() {
  
  /*
  $.post("Controller.php", {type: "read", form: ''}, function(result){
    $('#clients-table').dataTable().fnClearTable();
    $('#clients-table').dataTable().fnDraw();
    $('#clients-table').dataTable().fnDestroy();

    JSON.parse(result).forEach(item => 
      $("#clients-table").DataTable().row.add([
        item.id, item.name, item.razon_social, item.rfc, "<a href='AddSucursal.php?id="+item.id+"&name="+item.name+"' target='_blank'>Agregar</a>", "<a href='AddContacts.php?id="+item.id+"&name="+item.name+"' target='_blank'>Agregar</a>"
      ]).draw()
    );
  });
});
  */

  $("#save-product").click(function()
  {
    let products = true;
    let selectProducts = $(".form-product");

    for(let i = 0; i < selectProducts.length; i++)
    {
      if(selectProducts.eq(i).val() === "")
      {
        products = false;
        break;
      }
    }

    if(products)
    {
        let data = $("#products-form").serializeArray();
        $.post("Controller.php", {form: data, type: "save"}, function(result){
          
            if(result)
            {
                alert('Se guardo el producto correctamente');
                location.reload();
            }
            else
            {
                alert('Error al guardar el producto');
            }
        });
    }
    else
    {
        alert("Verifique que no haya campos vacios");
    }
  });
  </script>
</body>

</html>