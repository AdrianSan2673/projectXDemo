<style type="text/css">
  .texto-clientes {
    letter-spacing: 0px;
    background-size: 150%;
    background: linear-gradient(135deg, #fcdf8a, #f38381);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    -moz-text-stroke-width: 0;
    -webkit-text-stroke-width: 0;
    -webkit-animation: pulse-delay 8.5s linear 0.5s infinite alternate;
    animation: pulse-delay 8.5s linear 0.5s infinite alternate;
  }


  .dropdown-menu.show {
    overflow-y: scroll;
    max-height: 94vh;
  }

  @keyframes pulse-delay {
    0% {
      background: -webkit-linear-gradient(315deg, #fcdf8a, #f38381);
      background: -o-linear-gradient(315deg, #fcdf8a 0, #f38381 100%);
      background: linear-gradient(135deg, #fcdf8a, #f38381);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    4.16667% {
      background: -webkit-linear-gradient(315deg, #c3ec52, #0ba29d);
      background: -o-linear-gradient(315deg, #c3ec52 0, #0ba29d 100%);
      background: linear-gradient(135deg, #c3ec52, #0ba29d);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    8.33333% {
      background: -webkit-linear-gradient(315deg, #13f1fc, #0470dc);
      background: -o-linear-gradient(315deg, #13f1fc 0, #0470dc 100%);
      background: linear-gradient(135deg, #13f1fc, #0470dc);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    12.5% {

      background: -webkit-linear-gradient(315deg, #ce9ffc, #7367f0);
      background: -o-linear-gradient(315deg, #ce9ffc 0, #7367f0 100%);
      background: linear-gradient(135deg, #ce9ffc, #7367f0);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    16.6667% {
      background: -webkit-linear-gradient(315deg, #f36265, #961276);
      background: -o-linear-gradient(315deg, #f36265 0, #961276 100%);
      background: linear-gradient(135deg, #f36265, #961276);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    20.8333% {
      background: -webkit-linear-gradient(315deg, #184e68, #57ca85);
      background: -o-linear-gradient(315deg, #184e68 0, #57ca85 100%);
      background: linear-gradient(135deg, #184e68, #57ca85);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    25% {
      background: -webkit-linear-gradient(315deg, #fad961, #f76b1c);
      background: -o-linear-gradient(315deg, #fad961 0, #f76b1c 100%);
      background: linear-gradient(135deg, #fad961, #f76b1c);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    29.1667% {
      background: -webkit-linear-gradient(315deg, #f2d50f, #da0641);
      background: -o-linear-gradient(315deg, #f2d50f 0, #da0641 100%);
      background: linear-gradient(135deg, #f2d50f, #da0641);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    33.3333% {
      background: -webkit-linear-gradient(315deg, #f54ea2, #ff7676);
      background: -o-linear-gradient(315deg, #f54ea2 0, #ff7676 100%);
      background: linear-gradient(135deg, #f54ea2, #ff7676);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    37.5% {
      background: -webkit-linear-gradient(315deg, #0ff0b3, #036ed9);
      background: -o-linear-gradient(315deg, #0ff0b3 0, #036ed9 100%);
      background: linear-gradient(135deg, #0ff0b3, #036ed9);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    41.6667% {
      background: -webkit-linear-gradient(315deg, #17ead9, #6078ea);
      background: -o-linear-gradient(315deg, #17ead9 0, #6078ea 100%);
      background: linear-gradient(135deg, #17ead9, #6078ea);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    100% {
      background: -webkit-linear-gradient(315deg, #17ead9, #6078ea);
      background: -o-linear-gradient(315deg, #17ead9 0, #6078ea 100%);
      background: linear-gradient(135deg, #17ead9, #6078ea);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse layout-navbar-fixed <?= Utils::isDarkMode() ? 'dark-mode' : '' ?>">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand <?= Utils::isDarkMode() ? 'navbar-dark' : 'navbar-white navbar-light' ?>">
      <!-- Left navbar links -->
      <div class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </div>

      <ul class="navbar-nav mx-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="http://rrhh-ingenia.com#.mxservicios" class="nav-link">Servicios</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>/#contacto" class="nav-link">Contacto</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>bolsa/vacantes" class="nav-link">Bolsa de trabajo</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>/recursos" class="nav-link">Blog</a>
        </li>



      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <div class="theme-switch-wrapper nav-link">
            <label class="theme-switch" for="dark-mode">
              <input type="checkbox" name="dark-mode" <?= Utils::isDarkMode() ? 'checked' : '' ?> id="dark-mode">
              <span class="slider round"></span>
            </label>
          </div>
        </li>
        <li class="nav-item dropdown" id="notifications-content">
          <a class="nav-link" data-toggle="dropdown" href="../notifications/checked" onclick="checkedNotifications(event)" aria-expanded="true">
            <i class="far fa-bell" style="font-size: 25px;"></i>
            <span class="badge badge-danger navbar-badge"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px; font-size: 0.8rem;">
            <span class="dropdown-item dropdown-header"></span>
            <div class="dropdown-divider"></div>
            <div class="notifications-list"></div>
          </div>
        </li>
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?= $_SESSION['avatar_route'] ?>" class="user-image img-circle" alt="User Image">
            <span class="d-none d-md-inline"><?= $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name ?>
              <i class="right fas fa-angle-down"></i></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header <?= $_SESSION['identity']->username == 'salmaperez1' ? 'bg-maroon' : 'bg-success' ?>">
              <img src="<?= $_SESSION['avatar_route'] ?>" class="img-circle" alt="User Image">

              <p style="font-size: 14px;">
                <?= $_SESSION['identity']->first_name . ' ' . $_SESSION['identity']->last_name ?><br>
                <?= $_SESSION['identity']->user_type ?>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <p></p>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="<?= base_url ?>usuario/editar_perfil" class="btn btn-info btn-flat">Editar</a>
              <a href="<?= base_url ?>usuario/logout" class="btn btn-maroon btn-flat float-right">Cerrar
                sesión</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar  <?= $_SESSION['identity']->username == 'salmaperez1' ? 'sidebar-dark-maroon' : 'sidebar-dark-orange' ?> elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url ?>" class="brand-link" style="padding-bottom: 8px">
        <img src="<?= base_url ?>dist/img/isotipo-colores.png" alt="RRHH Ingenia Logo" class="brand-image img-circle" style="width:28px;">
        <span class="brand-text">
          <img src="<?= base_url ?>dist/img/RRHHIngenia_White1.PNG" alt="RRHH Ingenia" style="max-width: 146px; height:auto" />
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url ?>usuario/index" class="nav-link<?= $_GET['controller'] == 'usuario' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <?php if ((Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCustomer() || Utils::isRecruitmentManager() || Utils::isManager()) && (!Utils::isCustomerSA() || Utils::isManager())) : ?>
              <li class="nav-header">RECLUTAMIENTO</li>
              <li class="nav-item has-treeview <?= $_GET['controller'] == 'vacante' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'vacante' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Vacantes
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>vacante/en_proceso" class="nav-link<?= $_GET['controller'] == 'vacante' && $_GET['action'] == 'en_proceso' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>En Proceso</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>vacante/index" class="nav-link<?= $_GET['controller'] == 'vacante' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Por Fecha</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= base_url ?>psicometria/index" class="nav-link<?= $_GET['controller'] == 'psicometria' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-brain"></i>
                  <p>
                    Psicometrías
                  </p>
                </a>
              </li>

              <?php if ((Utils::isAdmin() || Utils::isRecruitmentManager() || Utils::isJunior() || Utils::isSenior()) && $_SESSION['identity']->id == 5754) : ?>
                <li class="nav-item">
                  <a href="<?= base_url ?>CandidatoDirectorio/index" class="nav-link<?= $_GET['controller'] == 'CandidatoDirectorio' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Directorio de candidatos
                    </p>
                  </a>
                </li>
              <?php endif ?>


              <?php if (!Utils::isCustomer()) : ?>
                <li class="nav-item" hidden>
                  <a href="<?= base_url ?>atracciontalento/index" class="nav-link<?= $_GET['controller'] == 'atracciontalento' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-magnet"></i>
                    <p>
                      Atracción de talento
                    </p>
                  </a>
                </li>
              <?php endif ?>
            <?php endif ?>
            <?php if (Utils::isCustomerSA() && Utils::isCustomer()) : ?>
              <li class="nav-header">RECLUTAMIENTO</li>
              <li class="nav-item has-treeview <?= $_GET['controller'] == 'vacante' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'vacante' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Vacantes
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>vacante/en_proceso" class="nav-link<?= $_GET['controller'] == 'vacante' && $_GET['action'] == 'en_proceso' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>En Proceso</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>vacante/index" class="nav-link<?= $_GET['controller'] == 'vacante' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Por Fecha</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="<?= base_url ?>psicometria/index" class="nav-link<?= $_GET['controller'] == 'psicometria' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-brain"></i>
                  <p>
                    Psicometrías
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if (Utils::isCandidate()) : ?>
              <li class="nav-item">
                <a href="<?= base_url ?>candidato/ver" class="nav-link<?= $_GET['controller'] == 'candidato' ? ' active' : '' ?>">
                  <i class="nav-icon far fa-file-alt"></i>
                  <p>
                    Currículum
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url ?>bolsa/vacantes" class="nav-link<?= $_GET['controller'] == 'bolsa' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-briefcase"></i>
                  <p>
                    Vacantes
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url ?>postulaciones/listar" class="nav-link<?= $_GET['controller'] == 'postulaciones' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>Mis postulaciones</p>
                </a>
              </li>
            <?php endif ?>

            <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isJunior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isCandidate() || Utils::isRecruitmentManager()) : ?>
              <?php if ($_SESSION['identity']->id == 1) : ?>
                <li class="nav-item">
                  <a href="<?= base_url ?>postulaciones/index" class="nav-link<?= $_GET['controller'] == 'postulaciones' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-user-check"></i>
                    <p>
                      Postulaciones
                    </p>
                  </a>
                </li>
              <?php endif ?>

              <?php if (Utils::isAdmin() || Utils::isRecruitmentManager() || Utils::isJunior() || Utils::isSenior() || Utils::isManager()) : ?>
                <li class="nav-item">
                  <a href="<?= base_url ?>candidato/index" class="nav-link<?= $_GET['controller'] == 'candidato' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-address-card"></i>
                    <p>
                      Candidatos
                    </p>
                  </a>
                </li>
              <?php endif ?>


            <?php endif ?>

            <?php if (Utils::isAdmin()) : ?>
              <li class="nav-item has-treeview<?= $_GET['controller'] == 'ejecutivos' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'ejecutivos' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-user-tie"></i>
                  <p>
                    Ejecutivos
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>ejecutivos/de_reclutamiento" class="nav-link<?= $_GET['controller'] == 'ejecutivos' && $_GET['action'] == 'de_reclutamiento' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De reclutamiento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>ejecutivos/de_busqueda" class="nav-link<?= $_GET['controller'] == 'ejecutivos' && $_GET['action'] == 'de_busqueda' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De búsqueda</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif ?>

            <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount() || Utils::isLogistics() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSenior()) : ?>
              <li class="nav-header">SA</li>
              <li class="nav-item has-treeview <?= $_GET['controller'] == 'ServicioApoyo' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-house-user"></i>
                  <p>
                    Estudios socioeconómicos
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>ServicioApoyo/en_proceso" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' && $_GET['action'] == 'en_proceso' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>En Proceso</p>
                    </a>
                  </li>
                  <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isLogisticsSupervisor() || Utils::isLogistics() || Utils::isManager()) : ?>
                    <li class="nav-item">
                      <a href="<?= base_url ?>ServicioApoyo/agendados" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' && $_GET['action'] == 'agendados' ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Con Agenda</p>
                      </a>
                    </li>
                  <?php endif ?>
                  <?php if (Utils::isAccount() || Utils::isLogistics() || Utils::isSenior()) : ?>
                    <li class="nav-item">
                      <a href="<?= base_url ?>ServicioApoyo/index" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Historial</p>
                      </a>
                    </li>
                  <?php endif ?>
                  <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isLogisticsSupervisor() || Utils::isOperationsSupervisor() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager()) : ?>
                    <li class="nav-item">
                      <a href="<?= base_url ?>ServicioApoyo/index" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Por Fecha</p>
                      </a>
                    </li>
                  <?php endif ?>
                </ul>
              </li>
            <?php endif ?>
            <?php if (Utils::isCustomerSA()) : ?>
              <li class="nav-item">
                <a href="<?= base_url ?>ServicioApoyo/index" class="nav-link<?= $_GET['controller'] == 'ServicioApoyo' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-house-user"></i>
                  <p>
                    Estudios socioeconómicos
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if (Utils::isAdmin() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
              <li class="nav-item has-treeview <?= $_GET['controller'] == 'ejecutivos_SA' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'ejecutivos_SA' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-user-astronaut"></i>
                  <p>
                    Ejecutivos SA
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>ejecutivos_SA/de_cuenta" class="nav-link<?= $_GET['controller'] == 'ejecutivos_SA' && ($_GET['action'] == 'de_cuenta' || $_GET['action'] == 'asignar_clientes') ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De Cuenta</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>ejecutivos_SA/de_logistica" class="nav-link<?= $_GET['controller'] == 'ejecutivos_SA' && $_GET['action'] == 'de_logistica' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De Logística</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif ?>
            <?php if (Utils::isAdmin() || Utils::isSenior() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isJunior() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor() || Utils::isAccount()) : ?>
              <li class="nav-header texto-clientes">
                <?= Utils::isAccount() ? '<b>CONSULTA DE CONTACTOS RH</b>' : 'VENTAS' ?></li>
              <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
                <li class="nav-item">
                  <a href="<?= base_url ?>empresa_SA/index" class="nav-link<?= $_GET['controller'] == 'empresa_SA' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-city"></i>
                    <p>
                      Empresas
                    </p>
                  </a>
                </li>
              <?php endif ?>


              <?php if (Utils::isAdmin()) : //if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager()) : 
              ?>
                <li class="nav-item <?= $_GET['controller'] == 'recursoshumanos'  ? ' menu-open' : '' ?>">
                  <a href="<?= base_url ?>recursoshumanos/index" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                      Clientes Recursos humanos
                    </p>
                  </a>
                </li>

              <?php endif ?>

              <li class="nav-item has-treeview <?= $_GET['controller'] == 'cliente' || $_GET['controller'] == 'cliente_SA' && $_GET['action'] != 'base_contactos' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'cliente' || $_GET['controller'] == 'cliente_SA' && $_GET['action'] != 'base_contactos' ? ' active' : '' ?>">
                  <i class="nav-icon far fa-handshake"></i>
                  <p>
                    <?= Utils::isAccount() ? '<b>DE NUESTROS CLIENTES</b>' : 'Clientes' ?>
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>cliente/index" class="nav-link<?= $_GET['controller'] == 'cliente' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De Reclutamiento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>cliente_SA/index" class="nav-link<?= $_GET['controller'] == 'cliente_SA' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De SA</p>
                    </a>
                  </li>
                </ul>
              </li>
              <?php if (Utils::isAdmin() || Utils::isSalesManager()  || Utils::isSales()) : ?>
                <li class="nav-item">
                  <a href="<?= base_url ?>prospecto/index" class="nav-link<?= $_GET['controller'] == 'prospecto' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-hand-holding-heart"></i>
                    <p>
                      Prospección
                    </p>
                  </a>
                </li>

                <li class="nav-item" <?= Utils::isAdmin() ? '' : 'hidden' ?>>
                  <a href="<?= base_url ?>EncuestaCliente/index" class="nav-link<?= $_GET['controller'] == 'EncuestaCliente' ? ' active' : '' ?>">
                    <i class="nav-icon fas fa-poll"></i>
                    <p>
                      Encuesta de Satisfacción
                    </p>
                  </a>
                </li>
              <?php endif ?>
            <?php endif ?>

            <?php if (!Utils::isCandidate() && !Utils::isCustomer() && !Utils::isCustomerSA() && $_SESSION['identity']->id != 9396) : ?>
              <li class="nav-item">
                <a href="<?= base_url ?>cliente_SA/base_contactos" class="nav-link<?= $_GET['controller'] == 'cliente_SA' && $_GET['action'] == 'base_contactos' ? ' active' : '' ?>">
                  <i class="nav-icon far fa-building"></i>
                  <p>
                    <?= Utils::isAccount() ? '<b>De Referencias laborales</b>' : 'Base de contactos' ?>
                  </p>
                </a>
              </li>
            <?php endif ?>

            <?php //$acceder = Utils::getEmpresaByContacto()[0]['Empresa']; 
            ?>
            <?php //$acceder = Utils::isManager() ? '82' : $acceder  
            ?>

            <?php if ((Utils::isCustomerSA() || Utils::isAdmin()) && isset($_SESSION['id_cliente']) && $_SESSION['id_cliente'] != 0) : ?>
              <li class="nav-header">RECURSOS HUMANOS</li>
              <li class="nav-item">
                <a href="<?= base_url ?>departamento/index" class="nav-link<?= $_GET['controller'] == 'departamento' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>
                    Departamentos
                  </p>
                </a>
              </li>


              <li class="nav-item has-treeview <?= $_GET['controller'] == 'Empleado' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'Empleado' ? ' active' : '' ?>">
                  <i class="nav-icon  fas fa-people-carry"></i>
                  <p>
                    Empleados
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>Empleado/index&flag=<?= Encryption::encode(1)  ?>" class="nav-link <?= $_GET['controller'] == 'Empleado' && ($_GET['action'] == 'index' && Encryption::decode($_GET['flag']) == 1) ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Colaboradores</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url ?>Empleado/index&flag=<?= Encryption::encode('0')  ?>" class="nav-link<?= $_GET['controller'] == 'Empleado' && $_GET['flag'] == Encryption::encode(0) ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Excolaboradores</p>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="<?= base_url ?>Incidencias/index" class="nav-link<?= $_GET['controller'] == 'Incidencias'  ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Incidencias</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>vacaciones/index" class="nav-link<?= $_GET['controller'] == 'vacaciones'  ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Control de vacaciones</p>
                    </a>
                  </li>
                </ul>
              </li>


              <li class="nav-item">
                <a href="<?= base_url ?>puesto/index" class="nav-link<?= $_GET['controller'] == 'puesto' ? ' active' : '' ?>">
                  <i class="nav-icon far fa-clipboard"></i>
                  <p>
                    Descripcion de puesto
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url ?>capacitaciones/index" class="nav-link<?= $_GET['controller'] == 'capacitaciones' ? ' active' : '' ?>">
                  <i class="fas fa-users nav-icon"></i>
                  <p>
                    Capacitaciones
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview <?= $_GET['controller'] == 'evaluaciones' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'evaluaciones' ? ' active' : '' ?>">
                  <i class="nav-icon  fas fa-paste"></i>
                  <p>
                    Evaluaciones
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>

                <ul class="nav nav-treeview">
                  <li class="nav-item" hidden>
                    <a href="<?= base_url ?>evaluaciones/enviar" class="nav-link<?= $_GET['controller'] == 'evaluaciones'  && $_GET['action'] == 'enviar' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Enviar evaluacion</p>
                    </a>
                  </li>
                  <!-- ===[gabo 16 de mayo evaluaciones]=== -->
                  <li class="nav-item">
                    <a href="<?= base_url ?>evaluaciones/enviar_grupo" class="nav-link<?= $_GET['controller'] == 'evaluaciones'  && $_GET['action'] == 'enviar_grupo' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Enviar evaluacion</p>
                    </a>
                  </li>
                  <!-- ===[gabo 16 de mayo evaluaciones]=== -->


                  <li class="nav-item">
                    <a href="<?= base_url ?>evaluaciones/index" class="nav-link<?= $_GET['controller'] == 'evaluaciones' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Creacion de evaluaciones</p>
                    </a>
                  </li>

                </ul>
              </li>


              <li class="nav-item">
                <a href="<?= base_url ?>configuracionesRH/index" class="nav-link<?= $_GET['controller'] == 'configuracionesRH' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-users-cog"></i>
                  <p>
                    Configuraciones
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if (Utils::isManager() || Utils::isAdmin()) : ?>
              <li class="nav-header">ADMINISTRACIÓN</li>

              <li class="nav-item has-treeview <?= ($_GET['controller'] == 'administracion' && ($_GET['action'] == 'facturacion' || $_GET['action'] == 'facturacion_psicometrias')) || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'facturacion')  ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= ($_GET['controller'] == 'administracion' && ($_GET['action'] == 'facturacion' || $_GET['action'] == 'facturacion_psicometrias')) || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'facturacion') ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-file-invoice-dollar"></i>
                  <p>
                    Facturación
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion/facturacion" class="nav-link<?= $_GET['controller'] == 'administracion' && $_GET['action'] == 'facturacion' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De vacantes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion/facturacion_psicometrias" class="nav-link<?= $_GET['controller'] == 'administracion' && $_GET['action'] == 'facturacion_psicometrias' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Psicometrías</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion/facturacion_AT" class="nav-link<?= $_GET['controller'] == 'administracion' && $_GET['action'] == 'facturacion_at' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De AT</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion_SA/facturacion" class="nav-link<?= $_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'facturacion' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De SA</p>
                    </a>
                  </li>

                  <!-- ===[gabo 23 junio facturacion rh]=== -->
                  <li class="nav-item" <?= Utils::isAdmin() ? '' : 'hidden' ?>>
                    <a href="<?= base_url ?>administracion_RH/facturacion" class="nav-link<?= $_GET['controller'] == 'administracion_RH' && $_GET['action'] == 'facturacion' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De RH </p>
                    </a>
                  </li>
                  <!-- ===[gabo 23 junio facturacion rh fin]=== -->

                </ul>
              </li>
              <li class="nav-item has-treeview <?= ($_GET['controller'] == 'administracion' && $_GET['action'] == 'cobranza') || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'cobranza') ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= ($_GET['controller'] == 'administracion' && $_GET['action'] == 'cobranza') || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'cobranza') ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-hand-holding-usd"></i>
                  <p>
                    Cobranza
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion/cobranza" class="nav-link<?= $_GET['controller'] == 'administracion' && $_GET['action'] == 'cobranza' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De reclutamiento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion_SA/cobranza" class="nav-link<?= $_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'cobranza' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De SA</p>
                    </a>
                  </li>

                  <!-- ===[gabo 23 junio facturacion rh]=== -->
                  <li class="nav-item" <?= Utils::isAdmin() ? '' : 'hidden' ?>>
                    <a href="<?= base_url ?>administracion_RH/cobranza" class="nav-link<?= $_GET['controller'] == 'administracion_RH' && $_GET['action'] == 'cobranza' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De RH</p>
                    </a>
                  </li>
                  <!-- ===[gabo 23 junio facturacion rh fin]=== -->


                </ul>
              </li>
              <li class="nav-item has-treeview <?= ($_GET['controller'] == 'administracion' && $_GET['action'] == 'ordenes_de_compra') || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'ordenes_de_compra') ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= ($_GET['controller'] == 'administracion' && $_GET['action'] == 'ordenes_de_compra') || ($_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'ordenes_de_compra') ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Órdenes de compra
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion/ordenes_de_compra" class="nav-link<?= $_GET['controller'] == 'administracion' && $_GET['action'] == 'ordenes_de_compra' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De reclutamiento</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url ?>administracion_SA/ordenes_de_compra" class="nav-link<?= $_GET['controller'] == 'administracion_SA' && $_GET['action'] == 'ordenes_de_compra' ? ' active' : '' ?>">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>De SA</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php endif ?>
            <?php if (Utils::isAdmin()) : ?>
              <li class="nav-header"></li>
              <li class="nav-item">
                <a href="<?= base_url ?>usuario/all" class="nav-link<?= $_GET['controller'] == 'usuario' && $_GET['action'] != 'index' && $_GET['action'] != 'editar_perfil' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Usuarios
                  </p>
                </a>
              </li>

              <li class="nav-header"></li>
              <li class="nav-item">
                <a href="<?= base_url ?>Configuraciones/index" class="nav-link<?= $_GET['controller'] == 'configuraciones' && $_GET['action'] != 'index'  ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Configuraciones
                  </p>
                </a>
              </li>

            <?php endif ?>
            <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?>
              <li class="nav-item has-treeview <?= $_GET['controller'] == 'reporte' ? ' menu-open' : '' ?>">
                <a href="#" class="nav-link<?= $_GET['controller'] == 'reporte' ? ' active' : '' ?>">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Reportes
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <!-- <?php if (Utils::isAdmin() || Utils::isManager() || Utils::isSales() || Utils::isSalesManager() || Utils::isSAManager() || Utils::isOperationsSupervisor() || Utils::isLogisticsSupervisor()) : ?> -->
                  <li class="nav-item">
                    <a href="<?= base_url ?>reporte/operaciones_SA" class="nav-link<?= $_GET['controller'] == 'reporte' && $_GET['action'] == 'operaciones_SA' ? ' active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>De operaciones</p>
                    </a>
                  </li>
                <?php endif ?>
                </ul>
              </li>
            <?php endif ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>