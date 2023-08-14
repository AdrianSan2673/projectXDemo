<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <div class="alert alert-success">
            <h4>
              <?php if ((isset($_GET['id']) || Utils::isCandidate()) && !empty($candidato)) : ?>
                <?= $candidato->first_name . ' ' . $candidato->surname . ' ' . $candidato->last_name ?>
              <?php else : ?>
                Nuevo candidato
              <?php endif ?>
            </h4>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- form start -->
          <form id="candidate-form" name="candidate-form" method="POST">
            <input type="hidden" id="id" value="<?= isset($candidato) && is_object($candidato) ? Encryption::encode($candidato->id) : '' ?>">
            <?php if (isset($_GET['vacante'])) : ?>
              <input type="hidden" name="id_vacancy" id="id_vacancy" value="<?= isset($_GET['vacante']) && !empty($_GET['vacante']) ? $_GET['vacante'] : '' ?>">
            <?php endif ?>
            <!-- general form elements -->
            <div class="card card-orange">
              <div class="card-header">
                <h4 class="card-title">Datos personales</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="first_name" class="col-form-label">Nombre(s)</label>
                          <input type="text" name="first_name" id="first_name" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->first_name : ''; ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="surname" class="col-form-label">Apellido Paterno</label>
                          <input type="text" name="surname" id="surname" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->surname : ''; ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="last_name" class="col-form-label">Apellido
                            Materno</label>
                          <input type="text" name="last_name" id="last_name" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->last_name : ''; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <!-- gabo 18 abril vacante -->
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="date_birth" class="col-form-label">Fecha de
                            nacimiento</label>
                          <input type="date" name="date_birth" id="date_birth" class="form-control" value="<?= isset($candidato) && is_object($candidato) ? $candidato->date_birth : ''; ?>">
                        </div>
                      </div>
                      <!-- gabo 18 abril vacante -->
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="age" class="col-form-label">Edad</label>
                          <input type="number" name="age" id="age" class="form-control" value="<?= isset($candidato) && is_object($candidato) ? $candidato->age : ''; ?>" min="16" max="99">
                        </div>
                      </div>
                      <!-- gabo 18 abril vacante -->
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="gender" class="col-form-label">Sexo</label>
                          <?php $genders = Utils::showGenders(); ?>
                          <select name="id_gender" id="id_gender" class="form-control">
                            <option disabled selected></option>
                            <?php foreach ($genders as $gender) : ?>
                              <option value="<?= $gender['id'] ?>" <?= isset($candidato) && is_object($candidato) && $gender['id'] == $candidato->id_gender ? 'selected' : ''; ?>>
                                <?= $gender['gender'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="id_civil_status" class="col-form-label">Estado
                            civil</label>
                          <?php $civil_status = Utils::showCivilStatus(); ?>
                          <select name="id_civil_status" id="id_civil_status" class="form-control">
                            <option value>Selecciona el estado civil</option>
                            <?php foreach ($civil_status as $status) : ?>
                              <option value="<?= $status['id'] ?>" <?= isset($candidato) && is_object($candidato) && $status['id'] == $candidato->id_civil_status ? 'selected' : ''; ?>>
                                <?= $status['status'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 mx-auto">
                        <div class="form-group">
                          <label for="avatar" class="col-form-label">Elija una foto del
                            candidato</label>
                          <input type="file" name="avatar" id="avatar" class="form-control" accept="image/png,image/gif,image/jpeg">
                        </div>
                        <div id="editor"><img src="<?= isset($route) ? $route : '' ?>"></div>
                      </div>
                      <div class="col-md-6 text-center">
                        <canvas id="preview"></canvas>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h4 class="card-title">Perfil Profesional</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="id_level" class="col-form-label">Grado de estudios</label>
                      <?php $education_levels = Utils::showEducationLevels(); ?>
                      <select name="id_level" id="id_level" class="form-control" required>
                        <option value="" hidden selected>Selecciona el Último grado de estudios
                        </option>
                        <?php foreach ($education_levels as $level) : ?>
                          <option value="<?= $level['id'] ?>" <?= isset($candidato) && is_object($candidato) && $level['id'] == $candidato->id_education_level ? 'selected' : ''; ?>>
                            <?= $level['level'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="job_title" class="col-form-label">Experiencia en</label>
                      <input type="text" name="job_title" id="job_title" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->job_title : ''; ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description" class="col-form-label">Reseña breve</label>
                      <textarea name="description" id="description" rows="10" class="form-control"><?= isset($candidato) && is_object($candidato) ? $candidato->description : ''; ?></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_area" class="col-form-label">Área de interés</label>
                      <?php $areas = Utils::showAreas(); ?>
                      <select name="id_area" id="id_area" class="form-control" required>
                        <option value="" hidden selected>Selecciona un Área</option>
                        <?php foreach ($areas as $area) : ?>
                          <option value="<?= $area['id'] ?>" <?= isset($candidato) && is_object($candidato) && $area['id'] == $candidato->id_area ? 'selected' : ''; ?>>
                            <?= $area['area'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_subarea" class="col-form-label">Subarea</label>
                      <select name="id_subarea" id="id_subarea" class="form-control" required>
                        <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_area)) : ?>
                          <?= $subareas = Utils::showSubareasByArea($candidato->id_area); ?>
                          <?php foreach ($subareas as $subarea) : ?>
                            <option value="<?= $subarea['id'] ?>" <?= isset($candidato) && is_object($candidato) && $subarea['id'] == $candidato->id_subarea ? 'selected' : ''; ?>>
                              <?= $subarea['subarea'] ?></option>
                          <?php endforeach ?>
                        <?php else : ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="resume" class="col-form-label">Â¿Adjuntar curriculum
                        personal?</label>
                      <input type="file" id="resume" name="resume" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/pdf">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-maroon">
              <div class="card-header">
                <h4 class="card-title">Datos de Contacto</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="telephone" class="col-form-label">Teléfono</label>
                      <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->telephone : ''; ?>" data-inputmask='"mask": "999 999 9999"' data-mask>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="cellphone" class="col-form-label">Celular:</label>
                      <input type="text" name="cellphone" id="cellphone" maxlength="13" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->cellphone : ''; ?>" data-inputmask='"mask": "999 999  9999"' data-mask>
                    </div>
                  </div>
                  <?php if (Utils::isCandidate()) : ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email" class="col-form-label">Correo electrinico</label>
                        <input type="email" name="email" id="email" readonly value="<?= $_SESSION['identity']->email ?>" class="form-control" required>
                      </div>
                    </div>
                  <?php else : ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="email" class="col-form-label">Correo electrinico</label>
                        <input type="email" name="email" id="email" class="form-control" required value="<?= isset($candidato) && is_object($candidato) ? $candidato->email : ''; ?>">
                      </div>
                    </div>
                  <?php endif ?>

                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_state" class="col-form-label">Estado</label>
                      <?php $states = Utils::showStates(); ?>
                      <select name="id_state" id="id_state" class="form-control" style="width: 100%;" required>
                        <option disabled selected="selected"></option>
                        <?php foreach ($states as $state) : ?>
                          <option value="<?= $state['id'] ?>" <?= isset($candidato) && is_object($candidato) && $state['id'] == $candidato->id_state ? 'selected' : ''; ?>>
                            <?= $state['state'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="id_city" class="col-form-label">Ciudad</label>
                      <select name="id_city" id="id_city" class="form-control select2bs4" style="width: 100%;" required>
                        <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_state)) : ?>
                          <?= $cities = Utils::showCitiesByState($candidato->id_state); ?>
                          <?php foreach ($cities as $city) : ?>
                            <option value="<?= $city['id'] ?>" <?= isset($candidato) && is_object($candidato) && $city['id'] == $candidato->id_city ? 'selected' : ''; ?>>
                              <?= $city['city'] ?></option>
                          <?php endforeach ?>
                        <?php else : ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row" style="display: <?= !Utils::isCandidate() ? 'none' : 'flex' ?>;">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="linkedinn">LinkedIn</label>
                      <input type="text" name="linkedinn" id="linkedinn" class="form-control" value="<?= isset($candidato) && is_object($candidato) ? $candidato->linkedinn : ''; ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="facebook">Facebook</label>
                      <input type="text" name="facebook" id="facebook" class="form-control" value="<?= isset($candidato) && is_object($candidato) ? $candidato->facebook : ''; ?>">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="instagram">Instagram</label>
                      <input type="text" name="instagram" id="instagram" class="form-control" value="<?= isset($candidato) && is_object($candidato) ? $candidato->instagram : ''; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- gabo 15 junio experiencia candidato -->
            <?php if (!Utils::isCandidate()  && isset($_GET['vacante']) && $_GET['vacante'] != '' && $vacante->type == 1) :  ?>
              <div class="card card-success">
                <div class="card-header" style="text-align: center;">
                  <h4 class="card-title">
                    Experiencia
                  </h4>
                  <btn class="btn btn-orange" style=" float:right" onclick="agregarFila()">
                    <i class="fas fa-plus"></i>
                  </btn>
                </div>
                <div class="card-body">
                  <div class="card-body" id="div_experience">
                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group" style="text-align: center">
                          <label for="" class="col-form-label" style="margin-top:30px">Información:</label>

                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group" style="text-align: center">
                          <label class="col-form-label">Empresa/puesto</label>
                          <input onblur="verificar()" type="text" name="enterprise_experience[]" id="enterprise_experience" style="text-align:center" class=" form-control" value="">
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group" style="text-align: center">
                          <label class="col-form-label">Descripción</label>
                          <textarea onblur="verificar()" name="review_experience[]" id="review_experience" class=" form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                        </div>
                      </div>
                      <div class="col-md-1">
                        <div class="form-group" style="text-align: center">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>


            <!-- gabo 15 junio experiencia candidato fin -->

            <!--  gabo nuevo  -->
            <?php if (!Utils::isCandidate()  && isset($_GET['vacante']) && $_GET['vacante'] != '') :  ?>


              <div class="card card-red">
                <div class="card-header" style="text-align: center;">
                  <h4 class="card-title">
                    Perfil
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:34px">Sexo:</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Requerido</label>
                        <input type="" name="" id="" style="text-align:center" class=" form-control" value="<?= isset($vacante) && $vacante->gender != '' ? $vacante->gender : ''; ?>" maxlength="20" readonly>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Candidato</label>
                        <input type="" name="gender_c" id="gender_c" style="text-align:center" class=" form-control" value=" ">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Estado</label>
                        <select name="status_gender" id="status_gender" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>

                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:5px">Edad:</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <input type="" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->age_min != '' && $vacante->age_max != '' ? $vacante->age_min . "-" . $vacante->age_max : ''; ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <input type="number" name="age_c" id="age_c" style="text-align:center" class=" form-control" value="" min="18" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <select name="status_age" id="status_age" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>
                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:5px">Estado
                          Civil:</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <input type="" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->status != '' ? $vacante->status : ''; ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <input type="" name="civil_status_c" id="civil_status_c" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="20">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <select name="status_civil_status" id="status_civil_status" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>
                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              <div class="card card-purple">
                <div class="card-header" style="text-align: center;">
                  <h4 class="card-title">
                    Escolaridad
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:30px">Estudios:</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Requerido</label>
                        <input type="" name="" id="" class="form-control" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->level != '' ? $vacante->level : ''; ?>">
                      </div>
                    </div>

                    <div class=" col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Candidato</label>
                        <input type="" name="level_c" id="level_c" class="form-control" style="text-align:center" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                      </div>
                    </div>
                    <div class=" col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Estado</label>
                        <select name="status_level" id="status_level" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>
                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <?php if (isset($vacante->language) && $vacante->language != '') :  ?>


                <div class="card card-info div_language">
                  <div class="card-header" style="ext-align: center;">
                    <h4 class="card-title">
                      Idiomas
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group" style="text-align: center">
                          <label for="" class="col-form-label" style="margin-top:30px">Idioma:</label>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" style="text-align: center">
                          <label class="col-form-label">Requerido</label>
                          <input type="" name="" id="" class="form-control" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->language != '' ? $vacante->language : ''; ?>">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group" style="text-align: center">
                          <label class="col-form-label">Candidato</label>
                          <input type="" name="language_c" id="language_c" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" style="text-align: center">
                          <label class="col-form-label">Estado</label>
                          <select name="status_language" id="status_language" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                            <option value="" selected disabled>Seleciona Estado</option>
                            <option value="si"> Cumple</option>
                            <option value="no">No cumple</option>
                            <option value="no aplica">No aplica</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <?php if (isset($vacante->language_level) && $vacante->language_level != '') :   ?>

                      <div class="row">
                        <div class="col-md-3">
                          <div class="form-group" style="text-align: center">
                            <label for="" class="col-form-label" style="margin-top:10px">Dominio:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" style="text-align: center">
                            <input type="" name="" id="" class="form-control" value="" style="text-align:center" readonly value="<?= isset($vacante) && $vacante->language_level != '' ? $vacante->language_level : ''; ?>">
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group" style="text-align: center">
                            <input type="" name="language_level_c" id="language_level_c" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?> maxlength="50">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" style="text-align: center">
                            <select name="status_language_level" id="status_language_level" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                              <option value="" selected disabled>Seleciona Estado</option>
                              <option value="si"> Cumple</option>
                              <option value="no">No cumple</option>
                              <option value="no aplica">No aplica</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    <?php endif  ?>

                  </div>
                </div>

              <?php endif ?>


              <div class="card card-orange">
                <div class="card-header" style="text-align: center;">
                  <h4 class="card-title">
                    Experiencia
                  </h4>
                </div>
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:30px">Años o meses de
                          Experiencia:</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Requerido</label>
                        <input type="number" name="" id="" style="text-align:center" class=" form-control" readonly value="<?= isset($vacante) && $vacante->experience_years != '' ? $vacante->experience_years : ''; ?>">
                      </div>
                    </div>

                    <!-- ===[gabo 27 junio perfil]=== -->
                    <div class="col-md-2">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Candidato</label>
                        <input type="number" name="experience_years_c" id="experience_years_c" style="text-align:center" class=" form-control" value="" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Tiempo</label>
                        <select name="tiempo" id="tiempo" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona</option>
                          <option value="meses">Meses</option>
                          <option value="años">Años</option>
                        </select>
                      </div>
                    </div>



                    <div class="col-md-2">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Estado</label>
                        <select name="status_experience_years" id="status_experience_years" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>
                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- ===[gabo 27 junio perfil]=== -->

                  <!-- Act gabo  -->
                  <div class="row">
                    <div class="col-md-3" style="text-align: center;margin:auto  ">
                      <div class="form-group " style="text-align: center; ">
                        <label class="col-form-label" style="text-align: center;margin:auto">Comentarios sobre la
                          experiencia:</label>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group" style="text-align: center">
                        <textarea class="form-control" name="experiencia_comments" id="experiencia_comments" cols="25" rows="3" <?= Utils::isCustomer() ? 'disabled' : '' ?>> </textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label for="" class="col-form-label" style="margin-top:30px">Puestos que
                          pudo haber ocupado:</label>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Requerido</label>
                        <textarea class="form-control" name="" id="" rows="4" readonly> <?= isset($vacante) && $vacante->functions != '' ? $vacante->functions : ''; ?>  </textarea>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Candidato</label>
                        <textarea class="form-control" name="functions_c" id="functions_c" rows="4" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="text-align: center">
                        <label class="col-form-label">Estado</label>
                        <select name="status_functions" id="status_functions" class="form-control" <?= Utils::isCustomer() ? 'disabled' : '' ?>>
                          <option value="" selected disabled>Seleciona Estado</option>
                          <option value="si"> Cumple</option>
                          <option value="no">No cumple</option>
                          <option value="no aplica">No aplica</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3" style="text-align: center;margin:auto  ">
                      <div class="form-group " style="text-align: center; ">
                        <label class="col-form-label" style="text-align: center;margin:auto">Comentarios sobre los
                          puestos:</label>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group" style="text-align: center">
                        <textarea class="form-control" name="functions_comments" id="functions_comments" cols="25" rows="3" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-3" style="text-align: center;margin:auto  ">
                      <div class="form-group " style="text-align: center; ">
                        <label class="col-form-label" style="text-align: center;margin:auto">Comentarios generales:</label>
                      </div>
                    </div>
                    <div class="col-md-9">
                      <div class="form-group" style="text-align: center">
                        <textarea class="form-control" name="general_comments" id="general_comments" cols="25" rows="5" <?= Utils::isCustomer() ? 'disabled' : '' ?>></textarea>
                      </div>
                    </div>
                  </div>
                  <!-- fin gabo mod -->
                </div>
              </div>
            <?php endif ?>


            <!-- gabo fin nuevo -->


            <div class="card-footer">
              <?php if (Utils::isCandidate()) : ?>
                <a href="<?= base_url ?>candidato/ver" class="btn btn-secondary btn-lg float-left">Regresar</a>
              <?php else : ?>
                <a href="javascript: history.back()" class="btn btn-lg btn-secondary float-left">Regresar</a>
              <?php endif ?>
              <button class="btn btn-lg btn-orange float-right" id="candidate_submit"><?= ($_GET['action'] == 'crear' ? 'Crear' : 'Guardar') ?></button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
<script src="<?= base_url ?>app/candidate.js?v=<?= rand() ?>"></script>
<script type="text/javascript" src="<?= base_url ?>app/cutimage.js?v=<?= rand() ?>"></script>
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


  $(function() {
    $.validator.setDefaults({
      submitHandler: function() {
        document.querySelector("#candidate-form #candidate_submit").disabled = true;
        let candidate = new Candidate();


        var vacios = 0;
        if (document.getElementById("div_experience") !== null) {
          var inputs = document.getElementsByClassName("multiple");
          var bandera = false;

          Array.from(inputs).forEach((input) => {
            if (input.value.trim() == "") {
              vacios++;
            }
            bandera = true;
          })

          if (bandera == true) {

            $('#enterprise_experience').prop("required", true);
            $('#review_experience').prop("required", true);

            var empresa = document.getElementById("enterprise_experience").value.trim();
            var descripcion = document.getElementById("review_experience").value.trim();

            if (empresa == "" || descripcion == "") {
              vacios++;
            }

          }
        }



        if (document.querySelector("#id").value != '') {
          candidate.update();
        } else {
          if (vacios == 0) {
            candidate.create();
          } else {
            utils.showToast('Llena los datos de experiencia correctamente', 'error');
            document.querySelector("#candidate-form #candidate_submit").disabled = false;
          }
        }


      }
    });
    //===[gabo 15 junio experiencia candidato fin ]===

    $('#candidate-form').validate({
      rules: {
        first_name: {
          required: true,
          minlength: 3,
        },
        surname: {
          required: true,
          minlength: 3
        },
        last_name: {
          required: true,
          minlength: 1
        },
        id_level: {
          required: true
        },
        job_title: {
          required: true,
          minlength: 5
        },
        id_area: {
          required: true
        },
        id_subarea: {
          required: true
        }
      },
      messages: {
        first_name: {
          required: "Ingrese su nombre, por favor",
          minlength: "Tu nombre debe tener al menos 3 caracteres"
        },
        surname: {
          required: "Ingrese su apellido paterno, por favor",
          minlength: "Tu apellido paterno debe tener al menos 3 caracteres"
        },
        last_name: {
          required: "Ingrese su apellido materno, por favor",
          minlength: "Tu apellido materno debe tener al menos 1 caracter"
        },
        id_gender: {
          required: "Seleccione su sexo"
        },
        id_level: {
          required: "Seleccione su Último grado de estudios"
        },
        job_title: {
          required: "Ingrese el puesto en el que tiene experiencia, por favor",
          minlength: "El nombre del puesto debe tener al menos 5 caracteres"
        },
        id_area: {
          required: "Seleccione su Área de interés"
        },
        id_subarea: {
          required: "Seleccione su subárea de interés"
        },
        telephone: {
          required: "Su número de teléfono es requerido"
        },
        cellphone: {
          required: "Su número de celular es requerido"
        },
        email: {
          required: "Su dirección de correo electrónico es requerida",
          email: "Formato incorrecto de correo invalido. Verifíquelo por favor."
        },
        id_state: {
          required: "Es necesario que indique su estado de residencia"
        },
        id_city: {
          required: "Es necesario que indique el municipio, localidad o ciudad de residencia"
        }



      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });


    
  });


  window.onload = function() {
    if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
      let cities = new City();
      cities.id_state = document.querySelector('#id_state').value;
      cities.selector = document.querySelector('#id_city');
      cities.getCitiesByState();
    }
  }


  function delete_row(objeto) {
    objeto.parentElement.parentElement.parentElement.remove();
  }



  //===[gabo 15 junio experiencia candidato ]===
  function agregarFila() {
    if (document.getElementById('div_experience')) {
      const div = document.querySelector('#div_experience');
      const row = document.createElement('div');
      row.classList.add('row');
      row.classList.add('borrados');
      row.innerHTML = `
                          <div class="col-md-2">
                            <div class="form-group" style="text-align: center">
                              <label for="" class="col-form-label" style="margin-top:30px"></label>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group" style="text-align: center">
                               <label class="col-form-label"></label>
                              <input type="text" name="enterprise_experience[]"  style="text-align:center" class="multiple form-control" required >
                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group" style="text-align: center">
                             <label class="col-form-label"></label>
                             <textarea   name="review_experience[]"  rows="4"  class="multiple form-control"  required ></textarea>
                            </div>
                          </div>
                          <div class="col-md-1">
						           	<div class="form-group" style="text-align: center;padding-top:1.3rem">
						           	<btn class="btn btn-danger" onclick="delete_row(this)">
						            	<i class="fas fa-trash"></i> 
						            </btn>
						          	</div>
                         
          `;
      div.appendChild(row);
    }
  }

  //===[gabo 15 junio experiencia candidato  ]===
  function verificar() {
    var empresa = document.getElementById("enterprise_experience").value.trim();
    var descripcion = document.getElementById("review_experience").value.trim();


    var inputs = document.getElementsByClassName("multiple");
    var bandera = false;
    Array.from(inputs).forEach((input) => {
      bandera = true;
    })


    if (bandera == false) {
      if (empresa != "" || descripcion != "") {
        $('#enterprise_experience').prop("required", true);
        $('#review_experience').prop("required", true);

      } else {
        $('#enterprise_experience').removeAttr("required");
        $('#review_experience').removeAttr("required");


      }

    }
  }

  //===[gabo 15 junio experiencia candidato fin ]===
</script>