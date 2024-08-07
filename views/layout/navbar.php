<body class="hold-transition layout-navbar-fixed layout-top-nav">
<!-- Site wrapper -->
  <div class="wrapper" id="inicio">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-lg navbar-dark navbar-lightblue ml-0">
        <div class="container">
            <a href="<?=base_url?>/" class="navbar-brand col-lg-3 col-md-6 col-sm-6 col-6 col">
              <img src="<?=base_url?>dist/img/RRHHIngenia-Website2020_LogoFooter.svg" alt="RRHH Ingenia" class="img-fluid logo">
            </a>
          
            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a href="<?=base_url?>#servicios" class="nav-link">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?=base_url?>/Contacto" class="nav-link">Contacto</a>
                    </li>
                    <?php if (isset($_SESSION['identity'])): ?>
                        <li class="nav-item">
                            <a href="<?=base_url?>usuario/index" class="nav-link">Plataforma</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?=base_url?>candidato/registrar" class="nav-link">Registrarse</a>
                        </li>
                    <?php endif ?>
                    <?php if (isset($_SESSION['identity'])): ?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown user-menu">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                <span class="d-none d-md-inline"><?=$_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name?> <i class="right fas fa-angle-down"></i></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <!-- User image -->
                                    <li class="user-header bg-success">
                                        <img src="<?=$_SESSION['avatar_route']?>" class="img-circle" alt="User Image">

                                        <p style="font-size: 14px;">
                                        <?=$_SESSION['identity']->first_name.' '.$_SESSION['identity']->last_name?><br>
                                        <?=$_SESSION['identity']->user_type?>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <a href="<?=base_url?>usuario/editar_perfil" class="btn btn-default btn-flat">Editar</a>
                                        <a href="<?=base_url?>usuario/logout" class="btn btn-default btn-flat float-right">Cerrar sesión</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="<?=base_url?>usuario/index" class="nav-link">
                                Iniciar sesión
                            </a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a href="<?=base_url?>bolsa/vacantes" class="nav-link">Bolsa de trabajo</a>
                    </li>
                        
                </ul>
            </div>
        </div>
    </nav>