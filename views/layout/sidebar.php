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
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MLF9ZBQL"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand <?= Utils::isDarkMode() ? 'navbar-dark' : 'navbar-white navbar-light' ?>">
      <!-- Left navbar links -->
      <div class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </div>

      <ul class="navbar-nav mx-auto">
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>/empresa-agencia-estudios-socioeconomicos-laboral-tampico-monterrey-san-luis-potosi-mexico-cdmx/" class="nav-link">Servicios</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>/#contacto" class="nav-link">Contacto</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>bolsa/vacantes" class="nav-link">Bolsa de trabajo</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url ?>/recursos" class="nav-link">Blog</a>
        </li> -->
        <?php //if (count(Utils::getEmpresaByContactoRH()) >= 2 && Utils::isCustomerSA() && ($_GET['controller'] != 'vacante'  && $_GET['controller'] != 'psicometria' && $_GET['controller'] != 'ServicioApoyo' && $_GET['controller'] != 'usuario')) :  
        ?>

        <?php //endif; 
        ?>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
         
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
            <!--<img src="C:\xampp\htdocs\projectXDemo\icons8-usuario-40.png" class="user-image img-circle" alt="User Image">-->
            <i class="fa fa-user" style="font-size: 25px;"></i>
            <span class="d-none d-md-inline"><?= $_SESSION['identity']->Nombres . ' ' . $_SESSION['identity']->Apellidos ?> <i class="right fas fa-angle-down"></i></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header <?= $_SESSION['identity']->usuario == 'salmaperez1' ? 'bg-maroon' : 'bg-success' ?>">
              <!--<img src="<?= $_SESSION['avatar_route'] ?>" class="img-circle" alt="User Image">-->
              <i class="fa fa-user" style="font-size: 50px;"></i>

              <p style="font-size: 14px;">
                <?= $_SESSION['identity']->Nombres . ' ' . $_SESSION['identity']->Apellidos ?><br>
                <?= $_SESSION['identity']->tipo_usuario ?>
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
              <a href="<?= base_url ?>usuario/logout" class="btn btn-maroon btn-flat float-right">Cerrar sesión</a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar  <?= $_SESSION['identity']->username == 'salmaperez1' ? 'sidebar-dark-maroon' : 'sidebar-dark-orange' ?> elevation-4">
      <!-- Brand Logo -->
      <!-- <a href="<?= base_url ?>" class="brand-link" style="padding-bottom: 8px">
        <img src="<?= base_url ?>dist/img/isotipo-colores.png" alt="RRHH Ingenia Logo" class="brand-image img-circle" style="width:28px;">
        <span class="brand-text">
          <img src="<?= base_url ?>dist/img/RRHHIngenia_White1.PNG" alt="RRHH Ingenia" style="max-width: 146px; height:auto" />
        </span>
      </a> -->

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= base_url ?>usuario/index" class="nav-link<?= $_GET['controller'] == 'usuario' && $_GET['action'] == 'index' ? ' active' : '' ?>">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>

            <?php if ((Utils::isCustomerSA())) ?>
            <li class="nav-header">INICIO</li>
            <li class="nav-item">
              <a href="<?= base_url ?>proyecto/index" class="nav-link<?= $_GET['controller'] == 'proyecto' ? ' active' : '' ?>">
                <i class="nav-icon fa fa-folder"></i>
                <p>
                  Proyectos
                </p>
              </a>
            </li>

            <?php //if (Utils::isAdmin()) : 
            ?>
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="<?= base_url ?>proyecto/index" class="nav-link<?= $_GET['controller'] == 'proyecto' ? ' active' : '' ?>">
                <i class="nav-icon fa fa-folder-open"></i>
                <p>
                  Revisar Proyectos
                </p>
              </a>
            </li>



            <?php //if (Utils::isAdmin()) : 
            ?>
            <li class="nav-header"></li>
            <li class="nav-item">
              <a href="<?= base_url ?>usuario/all" class="nav-link<?= $_GET['controller'] == 'usuario' && $_GET['action'] != 'index' && $_GET['action'] != 'editar_perfil' ? ' active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>

            <?php // endif 
            ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>