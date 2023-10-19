<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <?php if (isset($_GET['paso']) && $_GET['paso'] == 2) : ?>
          <h6 class="login-box-msg">Agrega tu nombre</h6>
          <form method="post" action="<?= base_url ?>candidato/registrar&paso=3">
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
              <div class="col-6">
                <a href="<?= base_url ?>candidato/registrar&paso=1" class="btn btn-default btn-block">Regresar</a>
              </div>
              <div class="col-6">
                <input type="submit" value="Avanzar" class="btn btn-primary btn-block">
              </div>
            </div>
          </form>
          <p class="mt-3 mb-1"><a href="<?= base_url ?>usuario/index" class="text-center">Ya tengo una cuenta</a></p>
        
          <?php elseif (isset($_GET['paso']) && $_GET['paso'] == 3) : ?>
            <h6 class="login-box-msg">Agrega tus datos personales</h6>
            <form method="post" action="<?= base_url ?>candidato/registrar&paso=4">
              <div class="form-row">
                <div class="input-group mb-3 col-3">
                  <select name="day" class="form-control" required>
                    <option value="" hidden selected>Día</option>
                    <?php foreach (range(1, 31) as $i): ?>
                      <option value="<?=$i?>" <?= isset($_SESSION['data']->date_birth) && !empty($_SESSION['data']->date_birth) && date('d', strtotime($_SESSION['data']->date_birth)) == $i ? 'selected' : '' ?>><?=$i?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-5">
                  <select name="month" class="form-control" required>
                    <option value="" hidden selected>Mes</option>
                    <?php $months = Utils::getMonths(); ?>
                    <?php foreach ($months as $i => $m): ?>
                      <option value="<?=$i+1?>" <?= isset($_SESSION['data']->date_birth) && !empty($_SESSION['data']->date_birth) && date('m', strtotime($_SESSION['data']->date_birth)) == $i+1 ? 'selected' : '' ?>><?=$m?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-4">
                  <select name="year" class="form-control" required>
                    <option value="" hidden selected>Año</option>
                    <?php foreach (range(date('Y') - 14, date('Y') - 100) as $i): ?>
                      <option value="<?=$i?>" <?= isset($_SESSION['data']->date_birth) && !empty($_SESSION['data']->date_birth) && date('Y', strtotime($_SESSION['data']->date_birth)) == $i ? 'selected' : '' ?>><?=$i?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <div class="input-group mb-3">
                <select id="state" name="state" class="form-control" required>
                  <option value="" hidden selected>Selecciona un estado</option>
                  <?php $states = Utils::showStates(); ?>
                  <?php foreach ($states as $i => $s): ?>
                    <option value="<?=$s['id']?>" <?= isset($_SESSION['data']->id_state) && !empty($_SESSION['data']->id_state) && $_SESSION['data']->id_state == $s['id'] ? 'selected' : '' ?>><?=$s['state']?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="input-group mb-3">
                <select name="city" id="city" class="form-control select2bs4" required>
                  <option value="" hidden selected>Ciudad</option>
                  <?php if (isset($_SESSION['data']->id_state) && !empty($_SESSION['data']->id_state)): ?>
                    <?= $cities = Utils::showCitiesByState($_SESSION['data']->id_state);?>
                    <?php foreach ($cities as $city): ?>
                      <option value="<?= $city['id'] ?>" <?= isset($_SESSION['data']->id_city) && !empty($_SESSION['data']->id_city) && $_SESSION['data']->id_city == $city['id'] ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                    <?php endforeach ?>
                  <?php endif ?>
                </select>
              </div>
              <div class="input-group mb-3">
                <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" placeholder="Teléfono" required data-inputmask='"mask": "999 999 9999"' data-mask>
              </div>
              <div class="row">
                <div class="col-6">
                  <a href="<?= base_url ?>candidato/registrar&paso=2" class="btn btn-default btn-block">Regresar</a>
                </div>
                <div class="col-6">
                  <input type="submit" value="Avanzar" class="btn btn-primary btn-block">
                </div>
              </div>
            </form>
            <p class="mt-3 mb-1"><a href="<?= base_url ?>usuario/index" class="text-center">Ya tengo una cuenta</a></p>
            <script type="text/javascript">
                document.querySelector('#state').onchange = function() {
                  let cities = new City();
                  cities.id_state = document.querySelector('#state').value;
                  cities.selector = document.querySelector('#city');
                  cities.getCitiesByState();
                }
            </script>
          <?php else : ?>
          <h6 class="login-box-msg">Información de cuenta</h6>
          <form method="post" action="<?= base_url ?>candidato/registrar&paso=2">
            <div class="input-group mb-3" >
              <input type="email" class="form-control" name="email" placeholder="Dirección de correo electrónico" value="<?=isset($_SESSION['data']->email) && !empty($_SESSION['data']->email) ? $_SESSION['data']->email : ''?>" required>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Elija una contraseña" value="<?=isset($_SESSION['data']->password) && !empty($_SESSION['data']->password) ? $_SESSION['data']->password : ''?>" required>
            </div>
            <div class="row">
              <div class="col-12">
                <input type="submit" value="Avanzar" class="btn btn-primary btn-block">
              </div>
            </div>
            <br>
            <a href="<?=$client->createAuthUrl(); ?>" class="btn btn-block btn-default mt-3">
                <i class="fab fa-google mr-3"></i> Continuar con Google
            </a><br>
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