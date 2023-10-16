<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <?php if (isset($_GET['paso']) && $_GET['paso'] == 2) : ?>
          <h6 class="login-box-msg">Información de cuenta</h6>
          <form method="post" action="<?= base_url ?>candidato/registrar&paso=3">
            <div class="input-group mb-3" >
              <input type="email" class="form-control" name="email" placeholder="Dirección de correo electrónico" value="<?=isset($_SESSION['data']->email) && !empty($_SESSION['data']->email) ? $_SESSION['data']->email : ''?>" required>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Elija una contraseña" value="<?=isset($_SESSION['data']->password) && !empty($_SESSION['data']->password) ? $_SESSION['data']->password : ''?>" required>
            </div>
            <div class="row">
              <div class="col-6">
              <a href="<?= base_url ?>candidato/registrar&paso=1" class="btn btn-default btn-block">Regresar</a>
              </div>
              <div class="col-6">
                <input type="submit" value="Avanzar" class="btn btn-primary btn-block">
              </div>
            </div>
          </form>
          <p class="mt-3 mb-1"><a href="<?= base_url ?>usuario/index" class="text-center">Ya tengo una cuenta</a></p>
        <?php else : ?>
          <h6 class="login-box-msg">Agrega tu nombre</h6>
          <form method="post" action="<?= base_url ?>candidato/registrar&paso=2">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="first_name" placeholder="Nombre(s)" value="<?=isset($_SESSION['data']->first_name) && !empty($_SESSION['data']->first_name) ? $_SESSION['data']->first_name : ''?>" required>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="surname" placeholder="Apellido Paterno" value="<?=isset($_SESSION['data']->surname) && !empty($_SESSION['data']->surname) ? $_SESSION['data']->surname : ''?>" required>
            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="last_name" placeholder="Apellido Materno" value="<?=isset($_SESSION['data']->last_name) && !empty($_SESSION['data']->last_name) ? $_SESSION['data']->last_name : ''?>">
            </div>
            <div class="row">
              <div class="col-12">
                <input type="submit" value="Avanzar" class="btn btn-primary btn-block">
              </div>
            </div>
          </form>
          <p class="mt-3 mb-1"><a href="<?= base_url ?>usuario/index" class="text-center">Ya tengo una cuenta</a></p>
        <?php endif ?>
        <?php if ($status != 0) :?>
          <div class="alert <?=$color?> alert-dismissible">
            <h5><i class="icon <?=$icon?>"></i> Alerta!</h5>
            <?=$message?>
          </div>
        <?php endif; ?>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>