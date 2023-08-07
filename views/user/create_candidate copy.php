  <p class="login-box-msg text-white"><b>Regístrate</b></p>
  <form id="create_candidate_form" action="#" method="post">
    <input type="hidden" name="id_vacancy" id="id_vacancy" value="<?=isset($_GET['vacante']) && !empty($_GET['vacante']) ? $_GET['vacante'] : ''?>">
    <div class="input-group mb-3">
      <input id="first_name" name="first_name" type="text" class="form-control" placeholder="Nombre(s)" required>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="input-group mb-3">
          <input id="surname" name="surname" type="text" class="form-control" placeholder="Apellido paterno" required>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="input-group mb-3">
          <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellido materno" required>
        </div>
      </div>
    </div>
    <label class="col-form-label text-white">Fecha de nacimiento</label>
    <div class="row">
      <div class="col-3">
        <div class="input-group mb-3">
          <select id="day" name="day" class="form-control" required>
            <option value="" hidden selected>Día</option>
            <?php foreach (range(1, 31) as $i): ?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col-5">
        <div class="input-group mb-3">
          <select id="month" name="month" class="form-control" required>
            <option value="" hidden selected>Mes</option>
            <?php $months = Utils::getMonths(); ?>
            <?php foreach ($months as $i => $m): ?>
              <option value="<?=$i+1?>"><?=$m?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col-4">
        <div class="input-group mb-3">
          <select id="year" name="year" class="form-control" required>
            <option value="" hidden selected>Año</option>
            <?php foreach (range(date('Y') - 14, date('Y') - 100) as $i): ?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <?php $genders = Utils::showGenders(); ?>
      <?php foreach ($genders as $g): ?>
        <div class="col-6">
          <div class="icheck-success form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="<?=$g['gender']?>" value="<?=$g['id']?>" required>
            <label class="form-check-label text-white" for="<?=$g['gender']?>"><?=$g['gender']?></label>
          </div>
        </div>
      <?php endforeach ?>
        
    </div>
    <div class="input-group mb-3">
      <select id="state" name="state" class="form-control" required>
        <option value="" hidden selected>Selecciona un estado</option>
        <?php $states = Utils::showStates(); ?>
        <?php foreach ($states as $i => $s): ?>
          <option value="<?=$s['id']?>"><?=$s['state']?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="input-group mb-3">
      <select name="city" id="city" class="form-control select2bs4" required>
        <option value="" hidden selected>Ciudad</option>
      </select>
    </div>
    <div class="input-group mb-3">
      <?php $education_levels = Utils::showEducationLevels(); ?>
      <select name="level" id="level" class="form-control select2bs4" required>
        <option value="" hidden selected>Selecciona tu último grado de estudios</option>
        <?php foreach ($education_levels as $level): ?>
          <option value="<?=$level['id']?>"><?=$level['level']?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="input-group mb-3">
      <input id="job_title" name="job_title" type="text" class="form-control" placeholder="Cargo o título profesional" required>
    </div>
    <div class="input-group mb-3">
      <textarea placeholder="Reseña breve" id="description" name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="input-group mb-3">
     <?php $areas = Utils::showAreas();?>
      <select name="area" id="area" class="form-control select2bs4" required>
          <option value="" hidden selected>Selecciona tu área de interés</option>
          <?php foreach ($areas as $area) : ?>
              <option value="<?= $area['id'] ?>"><?= $area['area'] ?></option>
          <?php endforeach; ?>
      </select>
    </div>
    <div class="input-group mb-3">
      <select name="subarea" id="subarea" class="form-control select2bs4" required>
        <option value="" hidden selected>Subarea</option>
      </select>
    </div>
    <div class="input-group mb-3">
      <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" placeholder="Teléfono" required data-inputmask='"mask": "999 999 9999"' data-mask>
    </div>
    <div class="input-group mb-3">
      <input id="email" name="email" type="email" class="form-control" placeholder="Correo electrónico" required>
    </div>
    <div class="input-group mb-3">
      <input id="password" name="password" type="password" class="form-control" placeholder="Contraseña" required>
    </div>
    <div class="input-group mb-3">
      <input type="file" id="resume" name="resume" placeholder="Adjuntar currículum" class="form-control-file text-white" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/pdf">
    </div>
    <div class="input-group">
      <p class="text-white">Al hacer clic en "Registrar", aceptas nuestro <a href="http://rrhh-ingenia.com/Aviso_de_Privacidad">Aviso de Privacidad</a></p>
    </div>
    <div class="row">
      <div class="col-12">
        <button type="submit" id="submit" class="btn btn-orange btn-block">Registrar</button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <?php if (isset($_GET['vacante'])): ?>
    <p class="text-center mt-3">
      <a href="<?=base_url?>usuario/index&vacante=<?=$_GET['vacante']?>" id="login" class="bg-success btn btn-block">Ya tengo una cuenta</a>
    </p>
  <?php else: ?>
    <p class="text-center mt-3">
      <a href="<?=base_url?>usuario/index" id="login" class="bg-success btn btn-block">Ya tengo una cuenta</a>
    </p>
  <?php endif ?>
  
  <div class="modal fade" id="modal-login">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Error al crear cuenta</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p></p>
              </div>
              <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-orange" data-dismiss="modal">Aceptar</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <script type="text/javascript">
      document.querySelector("#create_candidate_form").addEventListener('submit', e => {
          e.preventDefault();
          document.querySelector("#submit").disabled = true;
          this.value = 'Enviando...';
          let account = new Account();
          account.register();
      });
      document.querySelector('#state').onchange = function() {
        let cities = new City();
        cities.id_state = document.querySelector('#state').value;
        cities.selector = document.querySelector('#city');
        cities.getCitiesByState();
      }
      document.querySelector('#area').onchange = function() {
        let subarea = new Subarea();
        subarea.id_area = document.querySelector("#area").value;
        subarea.selector = document.querySelector("#subarea");
        subarea.getSubareasByArea();
      };
  </script>