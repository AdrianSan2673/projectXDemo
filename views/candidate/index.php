<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php if (isset($_GET['id'])) : ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . "vacante/ver&id=" . $_GET['id'] ?>"><?= $vacante->vacancy ?></a></li>
              <?php if ($_GET['action'] == 'buscar') : ?>
                <?php if (isset($_GET['area'])) : ?>
                  <li class="breadcrumb-item active">Candidatos del área de <?= $vacante->area ?></li>
                <?php else : ?>
                  <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/buscar&id=" . $_GET['id'] . "&area=" . Utils::encrypt($vacante->id_area) ?>">Candidatos del área de <b><?= $vacante->area ?></b></a></li>
                  <li class="breadcrumb-item active">Todos los candidatos</li>
                <?php endif ?>
              <?php endif ?>
              <?php if ($_GET['action'] == 'ver') : ?>
                <li class="breadcrumb-item active">Postulaciones</li>
              <?php endif ?>
              <?php if ($_GET['action'] == 'enviados_a_reclutador') : ?>
                <li class="breadcrumb-item"><a href="<?= base_url . "postulaciones/ver&id=" . $_GET['id'] ?>">Postulaciones</a></li>
                <li class="breadcrumb-item active">Candidatos enviados por ejecutivo de búsqueda</li>
              <?php endif ?>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h1><?= $lbl_candidates ?> para el puesto de <b><?= $vacante->vacancy ?></b></h1>
            </div>
          </div>
        </div>
        <input type="hidden" id="id" value="<?= $vacante->id_vacancy ?>">
        <div class="row text-center">
          <div class="col-md-2">
            <b><?= '$' . number_format($vacante->salary_min) . ' - $' . number_format($vacante->salary_max) . ' (mensual)' ?></b>
          </div>
          <div class="col-md-2">
            <p><?= $vacante->city . ', ' . $vacante->state ?></p>
          </div>
          <div class="col-md-2">
            <p class="text-muted"><?= Utils::getFullDate($vacante->request_date) ?></p>
          </div>
          <div class="col-md-2">
            <p><?= $vacante->customer ?></p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <?php else : ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h1>Candidatos</h1>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <?php endif ?>

  <section class="content-header">
    <div class="row">
      <div class="col-md-5">
        <div class="info-box mb-3 bg-navy">
          <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total de candidatos en Bolsa de Trabajo</span>
            <span class="info-box-number"><?= $total ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
      <?php if (isset($_GET['id'])) : ?>
        <div class="col-md-5">
          <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-address-card"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><?= $lbl_n_candidates ?></span>
              <span class="info-box-number"><?= count($candidates) ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      <?php endif ?>
    </div>
    <div class="row">
      <div class="col-sm-4 ml-auto">
        <?php if ($_GET['controller'] == 'postulaciones') : ?>
          <a class="btn btn-orange float-right btn-lg" href="<?= base_url ?>candidato/crear&vacante=<?= $_GET['id'] ?>">Crear candidato</a>
        <?php else : ?>
          <a class="btn btn-orange float-right btn-lg" href="<?= base_url ?>candidato/crear">Crear candidato</a>
        <?php endif ?>

      </div>
    </div>

    <?php if (($_GET['action']) == 'buscar') : ?>

      <div class="row">
        <?php if (isset($_GET['area'])) : ?>
          <a href="<?= base_url ?>postulaciones/buscar&id=<?= $_GET['id'] ?>" class="btn btn-success btn-lg mx-auto">Mostrar todos</a>
        <?php else : ?>
          <a href="<?= base_url ?>postulaciones/buscar&id=<?= $_GET['id'] ?>&area=<?= Encryption::encode($vacante->id_area) ?>" class="btn btn-info btn-lg mx-auto">Buscar por área</a>
        <?php endif ?>
      </div>
      <div class="row mt-3">
        <button class="btn btn-info btn-lg mx-auto" id="postulate" onclick="postulate(this)">Seleccionar candidatos para la vacante</button>
      </div>
    <?php endif ?>
  </section>
  <br>
  <!-- Main content -->
  <section class="content">
    <?php if ($_SESSION['identity']->id == 1 && $_GET['action'] == 'buscar') : ?>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Filtros</h3>
        </div>
        <div class="card-body">
          <div id="accordion" class="row">
            <div class="col-md-4">
              <div class="card card-info">
                <div class="card-header">
                  <div class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseArea">
                      Áreas
                    </a>
                  </div>
                </div>
                <div id="collapseArea" class="panel-collapse collapse in">
                  <div class="card-body">
                    <?php $areas = Utils::showAreas(); ?>
                    <?php foreach ($areas as $area) : ?>
                      <div class="form-check">
                        <input type="checkbox" name="area[]" id="area<?= $area['id'] ?>" class="form-check-input" value="<?= $area['id'] ?>">
                        <label for="area<?= $area['id'] ?>" class="form-check-label"><?= $area['area'] ?></label>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-maroon">
                <div class="card-header">
                  <div class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseState">
                      Estados
                    </a>
                  </div>
                </div>
                <div id="collapseState" class="panel-collapse collapse in">
                  <div class="card-body">
                    <?php $states = Utils::showStates(); ?>
                    <?php foreach ($states as $state) : ?>
                      <div class="form-check">
                        <input type="checkbox" name="state" id="state<?= $state['id'] ?>" class="form-check-input" value="<?= $state['id'] ?>">
                        <label for="state<?= $state['id'] ?>" class="form-check-label"><?= $state['state'] ?></label>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-orange">
                <div class="card-header">
                  <div class="card-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseGender">
                      Sexo
                    </a>
                  </div>
                </div>
                <div id="collapseGender" class="panel-collapse collapse in">
                  <div class="card-body">
                    <?php $genders = Utils::showGenders(); ?>
                    <?php foreach ($genders as $gender) : ?>
                      <div class="form-check">
                        <input type="checkbox" name="gender" id="gender<?= $gender['id'] ?>" class="form-check-input" value="<?= $gender['id'] ?>">
                        <label for="gender<?= $gender['id'] ?>" class="form-check-label"><?= $gender['gender'] ?></label>
                      </div>
                    <?php endforeach ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Listado de candidatos</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
          </button>
        </div>
      </div>
      <!-- GABOOOOOOO 10/03/2023 -->
      <section class="content-header">
        <div class="container-fluid">
          <!-- gabo mod filtro -->
          <?php if (!isset($_GET['id'])) : ?>
            <form method="POST" action="<?= base_url . "candidato/index" ?>" class="row" id="filtros">
            <?php else : ?>
              <form method="POST" action="<?= base_url . "postulaciones/buscar&id="?><?=  isset($_GET['id']) ? $_GET['id'] : '' ?><?=  isset($_GET['area']) ? '&area='.$_GET['area'] : '' ?>" class="row" id="filtros">
              <?php endif; ?>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="clave" class="col-form-label">Palabra Clave:</label>
                  <input type="" name="clave" id="clave" value="<?= isset($_POST['clave']) ? $_POST['clave'] : '' ?>" class="form-control" data-toggle="tooltip" data-placement="top" title="Este campo tiene prioridad de búsqueda, si desea buscar por filtros  deje este campo en blanco">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id_level" class="col-form-label">Grado de estudios</label>
                  <?php $education_levels = Utils::showEducationLevels(); ?>
                  <select name="id_level" id="id_level" class="form-control">
                    <option value="" selected>Sin filtro</option>
                    <?php foreach ($education_levels as $level) : ?>
                      <option value="<?= $level['id'] ?>" <?= isset($_POST['id_level']) && $level['id'] == $_POST['id_level']    && isset($_POST['clave']) && $_POST['clave'] == ""  ? 'selected' : ''; ?>><?= $level['level'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label for="id_area" class="col-form-label">Área de interés</label>
                  <?php $areas = Utils::showAreas(); ?>
                  <select name="id_area" id="id_area" class="form-control">
                    <option value="" selected>Sin filtro</option>
                    <?php foreach ($areas as $area) : ?>
                      <option value="<?= $area['id'] ?>" <?= isset($_POST['id_area']) && $area['id'] == $_POST['id_area']  && isset($_POST['clave']) && $_POST['clave'] == ""   ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id_subarea" class="col-form-label">Subarea</label>
                  <select name="id_subarea" id="id_subarea" class="form-control">

                    <?php if (isset($_POST['id_area'])  && !empty($_POST['id_area'])  && isset($_POST['clave']) && $_POST['clave'] == "") : ?>
                      <?= $subareas = Utils::showSubareasByArea($_POST['id_area']); ?>
                      <?php foreach ($subareas as $subarea) : ?>
                        <option value="<?= $subarea['id'] ?>" <?= isset($_POST['id_subarea']) && $subarea['id'] == $_POST['id_subarea']   && isset($_POST['clave']) && $_POST['clave'] == ""  ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                      <?php endforeach ?>
                    <?php else : ?>
                      <option disabled selected="selected"></option>
                    <?php endif ?>
                  </select>
                </div>
              </div>


              <div class="col-md-2">
                <div class="form-group">
                  <label for="id_state" class="col-form-label">Estado</label>
                  <?php $states = Utils::showStates(); ?>
                  <select name="id_state" id="id_state" class="form-control" style="width: 100%;">
                    <option value="" selected>Sin filtro</option>
                    <?php foreach ($states as $state) : ?>
                      <option value="<?= $state['id'] ?>" <?= isset($_POST['id_state']) && $state['id'] == $_POST['id_state']  && isset($_POST['clave']) && $_POST['clave'] == ""   ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="id_city" class="col-form-label">Ciudad</label>
                  <select name="id_city" id="id_city" class="form-control select2bs4" style="width: 100%;">
                    <?php if (isset($_POST['id_city'])  && !empty($_POST['id_city'])) : ?>
                      <?= $cities = Utils::showCitiesByState($_POST['id_state']); ?>
                      <?php foreach ($cities as $city) : ?>
                        <option value="<?= $city['id'] ?>" <?= isset($_POST['id_city'])  && $city['id'] == $_POST['id_city']  && isset($_POST['clave']) && $_POST['clave'] == ""   ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                      <?php endforeach ?>
                    <?php else : ?>
                      <option disabled selected="selected"></option>
                    <?php endif ?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <label for="id_state" class="col-form-label">Idioma</label>
                <?php $languages = Utils::showLanguages(); ?>
                <select name="language" id="language" class="form-control">
                  <option value="" hidden selected>Sin filtro</option>
                  <?php foreach ($languages as $language) : ?>
                    <option value="<?= $language['id'] ?>" <?= isset($_POST['language']) && $language['id'] == $_POST['language']  && isset($_POST['clave']) && $_POST['clave'] == "" ? 'selected' : ''; ?>><?= $language['language'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="col-md-1">
                <div class="form-group">
                  <label for="edad1" class="col-form-label">Rango de edad:</label>
                  <input type="number" name="edad1" id="edad1" value="<?= isset($_POST['edad1']) ? $_POST['edad1'] : '' ?>" class="form-control">
                </div>
              </div>
              <div class="col-md-1" style="margin-top:9px;">
                <div class="form-group">
                  <label for="edad2" class="col-form-label"></label>
                  <input type="number" name="edad2" id="edad2" value="<?= isset($_POST['edad2']) ? $_POST['edad2'] : '' ?>" class="form-control">
                </div>
              </div>
              <!-- gabo mod filtro -->
              <div class="col-md-2">
                <label for="gender" class="col-form-label">Sexo</label>
                <select name="id_gender" id="id_gender" class="form-control">
                  <option value="" hidden selected>Sin filtro</option>
                  <option value="1"> Masculino </option>
                  <option value="2"> Femenino </option>
                </select>
              </div>

              <!-- FIN GABO -->

              <div class="col-md-2" style="margin-top:7px">
                <button type="submit" name="search" id="search" class="btn btn-app btn-block btn-info form-control" style="background-color: #17a2b8; color: #fff;"><i class="fas fa-search"></i>Buscar</button>
              </div>
              <!-- gabo mod filtro -->
              <div class="col-md-2" style="margin-top:7px">
                <button type="button" name="clean" id="clean" class="btn btn-app btn-block btn-warning form-control" onclick="limpiarForm()">Limpiar filtros</button>
              </div>
              </form>



        </div>
      </section>
      <!-- /.card-header -->
      <div class="card-body">
        <p class="h4">Candidatos encontrados: <?= count($candidates) ?></p>

        <table id="tb_candidates" class="table table-responsive table-striped table-sm" style="display: none;">
          <thead>
            <tr>
              <th></th>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar') : ?>
                <th></th>
              <?php endif ?>
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <th class="filterhead"></th>
              <!-- GABO -->
              <th></th>
              <th></th>
              <th class="filterhead"></th>
              <!--FIN GABO -->
              <th class="filterhead"></th>
              <th></th>
              <th></th>
              <th></th>
              <?php if (isset($_GET['id']) && $_GET['action'] != 'buscar') : ?>
                <th class="filterhead"></th>
                <th></th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && ($_GET['action'] == "ver" || $_GET['action'] == "enviados_a_reclutador") && isset($_GET['id']) && (Utils::isAdmin() || Utils::isJunior())) : ?>
                <th></th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == "enviados_a_reclutador" && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                <th></th>
              <?php endif ?>
              <th></th>
              <th class="filterhead"></th>
              <th></th>
            </tr>
            <tr>
              <th class="text-center">Foto</th>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar') : ?>
                <th>Seleccionar</th>
              <?php endif ?>
              <th>Nombre del candidato</th>
              <th>Edad</th>
              <th>Ciudad</th>
              <th>Estado</th>
              <th>Escolaridad</th>
              <th>Título</th>
              <!-- GABO -->
              <th>Idioma</th>
              <th>Área de interés</th>
              <th>Subarea</th>
              <!-- FIN GABO -->
              <th>Reseña de su experiencia</th>
              <th>Experiencias</th>
              <th>Fortalezas</th>
              <?php if (isset($_GET['id']) && $_GET['action'] != 'buscar') : ?>
                <th>Estatus</th>
                <th>Postular</th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && ($_GET['action'] == "ver" || $_GET['action'] == "enviados_a_reclutador") && isset($_GET['id']) && (Utils::isAdmin() || Utils::isJunior())) : ?>
                <th>Enviar a ej. recl</th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == "enviados_a_reclutador" && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                <th>Enviar a cliente</th>
              <?php endif ?>
              <th>Fecha de creación</th>
              <th>Creado por</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($candidates as $candidate) : ?>
              <tr>
                <?php
                if (isset($_GET['id'])) {
                  if ($candidate['id_status'] == 1) {
                    $bg_status = 'bg-info';
                  } elseif ($candidate['id_status'] == 2) {
                    $bg_status = 'bg-orange';
                  } elseif ($candidate['id_status'] == 3) {
                    $bg_status = 'bg-success';
                  } else {
                    $bg_status = '';
                  }
                }
                /*if ($candidate['created_by'] == 'Janet Monserrat Gómez López') {
                        $recruiter_color = 'bg-success';
                      }elseif($candidate['created_by'] == 'Ernesto Iván Sánchez Vizcaya'){
                        $recruiter_color = 'bg-orange';
                      }elseif ($candidate['created_by'] == 'María Graciela López Rodríguez') {
                        $recruiter_color = 'bg-warning';
                      }elseif($candidate['created_by'] = 'Verónica Lizeth Hernández Zuviri'){
                        $recruiter_color = 'bg-danger';
                      }elseif ($candidate['created_by'] == 'Lorena Patricia De La Rosa González') {
                        $recruiter_color = 'bg-navy';
                      }else{
                        $recruiter_color = '';
                      }*/

                ?>
                <td class="image"><img class="img-circle img-fluid img-responsive elevation-2" src="<?= $candidate['avatar'] ?>" style="width:60px; height:auto;"></td>
                <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar') : ?>
                  <td>
                    <?php if (($candidate['id_status'] == 1 || $candidate['status'] == '')) : ?>
                      <input type="checkbox" name="postulate[]" value="<?= $candidate['id'] ?>" class="form-control" <?= ($candidate['id_status'] == 1) ? 'checked' : ''; ?>>
                    <?php endif ?>
                  </td>
                <?php endif ?>
                <td><?= $candidate['first_name'] . ' ' . $candidate['surname'] . ' ' . $candidate['last_name'] ?></td>
                <td><?= $candidate['age'] ?></td>
                <td><?= $candidate['city'] ?></td>
                <td><?= $candidate['state'] ?></td>
                <td><?= $candidate['level'] ?></td>
                <td><?= $candidate['job_title'] ?></td>
                <!-- GABO -->
                <td><?= $candidate['language'] ?></td>
                <td><?= $candidate['area'] ?></td>
                <td><?= $candidate['subarea'] ?></td>
                <!-- FIN GABO -->
                <td><?= Utils::lineBreak($candidate['description']) ?></td>
                <td><?= Utils::lineBreak($candidate['experiences']) ?></td>
                <td><?= $candidate['aptitudes'] ?></td>
                <?php if (isset($_GET['id']) && $_GET['action'] != 'buscar') : ?>
                  <td class="<?= $bg_status ?>"><?= $candidate['status'] ?></td>
                  <td class="align-middle text-center">
                    <?php if ($candidate['status'] == '') : ?>
                      <a href="<?= base_url ?>postulaciones/postulate&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?><?= isset($_GET['area']) ? '&id_area=' . $_GET['area'] : '' ?>" class="btn btn-success"><i class="fas fa-check-circle"></i> Postular</a>
                    <?php else : ?>
                      <?php if ($candidate['id_status'] == 1) : ?>
                        <a href="<?= base_url ?>postulaciones/postulate&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?><?= isset($_GET['area']) ? '&id_area=' . $_GET['area'] : '' ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Quitar</a>
                      <?php endif ?>
                    <?php endif ?>
                  </td>
                <?php endif ?>
                <?php if ($_GET['controller'] == 'postulaciones' && ($_GET['action'] == "ver" || $_GET['action'] == "enviados_a_reclutador") && isset($_GET['id']) && (Utils::isAdmin() || Utils::isJunior())) : ?>
                  <td class="align-middle text-center">
                    <?php if ($candidate['id_status'] == 1) : ?>
                      <a href="<?= base_url ?>postulaciones/send_to_sr&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn btn-success"><i class="fas fa-share"></i> Enviar</a>
                    <?php else : ?>
                      <?php if ($candidate['id_status'] == 2) : ?>
                        <a href="<?= base_url ?>postulaciones/send_to_sr&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Quitar</a>
                      <?php endif ?>
                    <?php endif ?>
                  </td>
                <?php endif ?>
                <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == "enviados_a_reclutador" && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                  <td class="align-middle text-center">
                    <?php if ($candidate['id_status'] == 2) : ?>
                      <a href="<?= base_url ?>postulaciones/descripcion_candidato&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>" class="btn btn-success"><i class="fas fa-share"> Compartir</i></a>
                    <?php else : ?>
                      <?php if ($candidate['id_status'] == 3) : ?>
                        <a href="<?= base_url ?>postulaciones/send_to_customer&id_candidate=<?= Encryption::encode($candidate['id']) ?>&id_vacancy=<?= $_GET['id'] ?>&id_status=<?= $candidate['id_status'] ?>" class="btn btn-danger"><i class="fas fa-times-circle"></i> Quitar</a>
                      <?php endif ?>
                    <?php endif ?>
                  </td>
                <?php endif ?>
                <td><?= Utils::getShortDate($candidate['created_at']) ?></td>
                <td class="<?= $recruiter_color ?>"><?= $candidate['created_by'] ?></td>
                <td class="text-right py-0 align-middle">
                  <div class="btn-group btn-group-sm">
                    <a href="<?= base_url ?>candidato/ver&id=<?= Encryption::encode($candidate['id']) ?>" class="btn btn-success">
                      <i class="fas fa-eye"></i> Ver
                    </a>
                    <a href="<?= base_url ?>candidato/editar&id=<?= Encryption::encode($candidate['id']) ?>" class="btn btn-info">
                      <i class="fas fa-pencil-alt"></i> Editar
                    </a>
                    <a href="<?= base_url ?>resume/generate&id=<?= Encryption::encode($candidate['id']) ?>" target="_blank" class="btn btn-danger">
                      <i class="fas fa-download"></i> Plantilla
                    </a>
                    <?php if (isset($candidate['resume'])) : ?>
                      <a href="<?= $candidate['resume'] ?>" target="_blank" class="btn btn-orange">
                        <i class="fas fa-file-download"></i> CV
                      </a>
                    <?php endif ?>
                    <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'enviados_a_reclutador' && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                      <button type="button" id="<?= $candidate['id_applicant'] ?>" class="btn btn-secondary btn-comments">
                        <i class="far fa-comment"></i> Comentarios
                      </button>
                    <?php endif ?>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
          <tfoot>
            <tr>
              <th class="text-center">Foto</th>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar') : ?>
                <th>Seleccionar</th>
              <?php endif ?>
              <th>Nombre del candidato</th>
              <th>Edad</th>
              <th>Ciudad</th>
              <th>Estado</th>
              <th>Escolaridad</th>
              <th>Título</th>
              <!-- GABO -->
              <th>Idioma</th>
              <th>Área de interés</th>
              <th>Subarea</th>
              <!-- FIN GABO -->
              <th>Reseña de su experiencia</th>
              <th>Experiencias</th>
              <th>Fortalezas</th>
              <?php if (isset($_GET['id']) && $_GET['action'] != 'buscar') : ?>
                <th>Estatus</th>
                <th>Postular</th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && ($_GET['action'] == "ver" || $_GET['action'] == "enviados_a_reclutador") && isset($_GET['id']) && (Utils::isAdmin() || Utils::isJunior())) : ?>
                <th>Enviar a ej. recl</th>
              <?php endif ?>
              <?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == "enviados_a_reclutador" && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
                <th>Enviar a cliente</th>
              <?php endif ?>
              <th>Fecha de creación</th>
              <th>Creado por</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </section>
</div>
<script>
  $(document).ready(function() {
    let table = document.querySelector('#tb_candidates');
    table.style.display = "block";
    utils.dtTable(table, true);
  });
</script>
<?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'enviados_a_reclutador' && isset($_GET['id']) && (Utils::isAdmin() || Utils::isSenior())) : ?>
  <div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" id="update-form">
          <div class="modal-header">
            <h4 class="modal-title">Entrevista</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_applicant" id="id_applicant">
            <div class="form-group mb-3">
              <label class="col-form-label" for="candidate">Candidato</label>
              <input type="text" class="form-control" name="candidate" id="candidate" readonly>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_comments">Comentarios de la entrevista</label>
              <textarea class="form-control" name="interview_comments" rows="10" id="interview_comments"></textarea>
            </div>
            <div class="form-group mb-3">
              <label class="col-form-label" for="interview_date">Fecha de entrevista</label>
              <input type="date" class="form-control" id="interview_date" name="interview_date" value="<?= date("Y-m-d") ?>">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="<?= base_url ?>app/applicant.js?v=<?= rand() ?>"></script>
  <script>
    $(document).ready(function() {


      $("#tb_candidates ").on('click', '.btn-comments', function() {
        let applicant = new Applicant();
        applicant.getApplicantInterview($(this).attr('id'));
      });

      document.querySelector("#update-form").onsubmit = function(e) {
        e.preventDefault();
        let applicant = new Applicant();
        applicant.update_interview();
      };
    });
  </script>

<?php endif ?>
<?php if ($_GET['controller'] == 'postulaciones' && $_GET['action'] == 'buscar') : ?>
  <script src="<?= base_url ?>app/applicant.js?v=<?= rand() ?>"></script>
  <script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>
  <script src="<?= base_url ?>app/subarea.js?v=<?= rand() ?>"></script>
  <script src="<?= base_url ?>app/city.js?v=<?= rand() ?>"></script>

  <script>
    function postulate(e) {
      e.disabled = true;
      let applicant = new Applicant();
      applicant.postulate();
    }
  </script>
<?php endif ?>

<!-- gabo mod filtro -->
<?php if (isset($_POST['clave']) && $_POST['clave'] != "") {  ?>
  <script>
    $('#clave').tooltip('show')
  </script>
<?php   }   ?>


<script>
  document.querySelector('#id_area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#id_area").value;
    subarea.selector = document.querySelector("#id_subarea");
    subarea.getSubareasByArea();
  };
  document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  }
  window.onload = function() {
    if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
      let cities = new City();
      cities.id_state = document.querySelector('#id_state').value;
      cities.selector = document.querySelector('#id_city');
      cities.getCitiesByState();
    }
  }
  // gabo mod filtro
  $(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });

  function limpiarForm() {

    document.getElementById('id_state').selectedIndex = 0;
    $('#id_city').val('1');
    $('#id_city').trigger('change');
    document.getElementById('id_level').selectedIndex = 0;
    document.getElementById('id_area').selectedIndex = 0;
    document.getElementById('id_subarea').selectedIndex = 0;
    document.getElementById('id_gender').selectedIndex = 0;
    document.getElementById('language').selectedIndex = 0;
    document.getElementById('clave').value = "";
    document.getElementById('edad1').value = "";
    document.getElementById('edad2').value = "";



  }
</script>