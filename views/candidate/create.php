<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($candidato)): ?>
                    <?= $candidato->first_name.' '.$candidato->surname.' '.$candidato->last_name ?>
                  <?php else: ?>
                    <?php if (Utils::isCandidate()): ?>
                      Crear currículum
                    <?php else: ?>
                      Nuevo candidato
                    <?php endif ?>
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
            <form id="register-candidate-form" method="POST">
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
                            <input type="text" name="first_name" id="first_name" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->first_name : ''; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="surname" class="col-form-label">Apellido Paterno</label>
                            <input type="text" name="surname" id="surname" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->surname : ''; ?>">
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label for="last_name" class="col-form-label">Apellido Materno</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->last_name : ''; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="date_birth" class="col-form-label">Fecha de nacimiento</label>
                            <input type="date" name="date_birth" id="date_birth" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->date_birth : ''; ?>">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="gender" class="col-form-label">Sexo</label>
                            <?php $genders = Utils::showGenders(); ?>
                            <select name="id_gender" id="id_gender" class="form-control select2" required>
                              <option disabled selected></option>
                              <?php foreach ($genders as $gender): ?>
                                <option value="<?=$gender['id']?>" <?=isset($candidato) && is_object($candidato) && $gender['id'] == $candidato->id_gender ? 'selected' : ''; ?>><?=$gender['gender']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="id_civil_status" class="col-form-label">Estado civil</label>
                            <?php $civil_status = Utils::showCivilStatus(); ?>
                            <select name="id_civil_status" id="id_civil_status" class="form-control select2" required>
                              <option disabled selected="selected"></option>
                              <?php foreach ($civil_status as $status): ?>
                                <option value="<?=$status['id']?>" <?=isset($candidato) && is_object($candidato) && $status['id'] == $candidato->id_civil_status ? 'selected' : ''; ?>><?=$status['status']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mx-auto">
                          <!--  -->
                          <div id="editor"></div>

                          <div class="form-group">
                            <label for="avatar" class="col-form-label">Elija una foto del candidato</label>
                          
                            <input type="file" name="avatar" id="avatar" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                          </div>
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
                        <label for="job_title" class="col-form-label">Cargo o título profesional</label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->job_title : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="description" class="col-form-label">Reseña breve</label>
                        <textarea name="description" id="description" rows="3" class="form-control" required><?=isset($candidato) && is_object($candidato) ? $candidato->description : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <div class="card card-danger">
                <div class="card-header">
                  <h4 class="card-title">Datos de Contacto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="telephone" class="col-form-label">Teléfono</label>
                        <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->telephone : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="cellphone" class="col-form-label">Celular:</label>
                        <input type="text" name="cellphone" id="cellphone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->cellphone : ''; ?>">
                      </div>
                    </div>
                    <?php if (Utils::isCandidate()): ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Correo electrónico</label>
                          <input type="email" name="email" id="email" disabled value="<?=$_SESSION['identity']->email?>" class="form-control" required>
                        </div>
                      </div>
                    <?php else: ?>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="email" class="col-form-label">Correo electrónico</label>
                          <input type="email" name="email" id="email" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->email : ''; ?>">
                        </div>
                      </div>
                    <?php endif ?>
                      
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_state" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="id_state" id="id_state" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>" <?=isset($candidato) && is_object($candidato) && $state['id'] == $candidato->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_city" class="col-form-label">Ciudad</label>
                        <select name="id_city" id="id_city" class="form-control select2" required>
                          <option disabled selected="selected"></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="linkedinn">LinkedIn</label>
                        <input type="text" name="linkedinn" id="linkedinn" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->linkedinn : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="facebook">Facebook</label>
                        <input type="text" name="facebook" id="facebook" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->facebook : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="instagram">Instagram</label>
                        <input type="text" name="instagram" id="instagram" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->instagram : ''; ?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-success div_experiences">
                <div class="card-header">
                  <h4 class="card-title">Experiencia</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position" class="col-form-label">Puesto</label>
                        <input type="text" name="position[]" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="enterprise" class="col-form-label">Empresa</label>
                        <input type="text" name="enterprise[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position_area" class="col-form-label">Área del puesto</label>
                        <?php $areas = Utils::showAreas();?>
                        <select name="position_area[]" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($areas as $area) : ?>
                                <option value="<?= $area['id'] ?>"><?= $area['area'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position_subarea[]" class="col-form-label">Subarea</label>
                        <select name="position_subarea[]" class="form-control select2" required>
                        <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_area)): ?>
                          <?= $subareas = Utils::showSubareasByArea($vacante->id_area);?>
                          <?php foreach ($subareas as $subarea): ?>
                            <option value="<?= $subarea['id'] ?>"><?= $subarea['subarea'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="state_enterprise" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="state_enterprise[]" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="city_enterprise" class="col-form-label">Ciudad</label>
                        <select name="city_enterprise[]" class="form-control select2" required>
                        <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_state)): ?>
                          <?= $cities = Utils::showCitiesByState($candidato->id_state);?>
                          <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>"><?= $city['city'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="start_date_job" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="date" name="start_date_job[]" class="form-control" required>
                          </div>
                          <div class="col-md-4">
                            <input type="date" name="end_date_job[]" class="form-control" required>
                          </div>
                          <div class="col-md-4 text-center">
                            <input type="checkbox" name="still_works[]" class="form-check-input">
                            <label for="still_works" class="form-check-label">¿Aún trabaja?</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="review" class="col-form-label">Breve reseña del puesto</label>
                        <input type="text" name="review[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                        <input type="text" name="activity1[]" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                        <input type="text" name="activity2[]" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                        <input type="text" name="activity3[]" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                        <input type="text" name="activity4[]" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mx-auto">
                  <div class="form-group">
                    <button type="button" id="add_experience" class="btn btn-block btn-outline-success">Agregar otra experiencia</button>
                  </div>
                </div>
              </div>
              <div class="card card-info">
                <div class="card-header">
                  <h4 class="card-title">Educación</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="education_level">Último grado de estudios</label>
                        <?php $education_levels = Utils::showEducationLevels(); ?>
                        <select name="education_level" id="education_level" class="form-control select2" required>
                          <option disabled selected="selected" required></option>
                          <?php foreach ($education_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($candidato) && is_object($candidato) && $level['id'] == $candidato->id_education_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="institution">Institución</label>
                      <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->institution : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title" class="col-form-label">Área de estudio</label>
                        <input type="text" name="title" id="title" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->title : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->start_date : ''; ?>">
                          </div>
                          <div class="col-md-4">
                            <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->end_date : ''; ?>">
                          </div>
                          <div class="col-md-4 text-center">
                            <input type="checkbox" name="still_studies" id="still_studies" class="form-check-input">
                            <label for="still_studies" class="form-check-label" <?=isset($candidato) && is_object($candidato) && $candidato->still_studies == 1 ? 'checked' : ''; ?>>¿Aún estudia?</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-orange">
                <div class="card-header">
                  <h4 class="card-title">Formación adicional</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="course" class="col-form-label">Curso</label>
                        <input type="text" name="course" id="course" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->course : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="institution_additional_education" class="col-form-label">Institución</label>
                      <input type="text" name="institution_additional_education" id="institution_additional_education" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->institution_cap : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start_date_additional" id="start_date_additional" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->start_date_cap : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end_date_additional" id="end_date_additional" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->end_date_cap : ''; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-navy div_languages">
                <div class="card-header">
                  <h4 class="card-title">Idiomas</h4>
                </div>
                <div class="card-body div_language">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="salary" class="col-form-label">Idiomas:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <?php $languages = Utils::showLanguages(); ?>
                            <select name="language[]" id="language" class="form-control select2" required>
                              <option disabled selected>Selecciona un idioma</option>
                              <?php foreach ($languages as $language): ?>
                                <option value="<?=$language['id']?>" <?=isset($candidato) && is_object($candidato) && $language['id'] == $candidato->id_language ? 'selected' : ''; ?>><?=$language['language']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <?php $language_levels = Utils::showLanguageLevels(); ?>
                            <select name="language_level[]" id="language_level" class="form-control select2" required>
                              <option disabled selected="">Selecciona el nivel</option>
                              <?php foreach ($language_levels as $level): ?>
                                <option value="<?=$level['id']?>" <?=isset($candidato) && is_object($candidato) && $level['id'] == $candidato->id_language_level ? 'selected' : ''; ?>><?=$level['language_level']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institution_language">Institución</label>
                        <input type="text" name="institution_language[]" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Periodo</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start_date_language[]" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->start_date_language : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end_date_language[]" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->end_date_language : ''; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mx-auto">
                  <div class="form-group">
                    <button type="button" id="add_language" class="btn btn-block btn-outline-success">Agregar otro idioma</button>
                  </div>
                </div>
              </div>
              <div class="card card-teal div_aptitudes">
                <div class="card-header">
                  <h4 class="card-title">Aptitudes</h4>
                </div>
                <div class="card-body div_aptitude">
                  <div class="row">
                    <div class="col-md-10">
                      <div class="form-group">
                        <label for="aptitude" class="col-form-label">Aptitud:</label>
                        <input type="text" name="aptitude[]" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="aptitude_level" class="col-form-label">Nivel</label>
                        <select name="aptitude_level[]" class="form-control select2" required>
                          <option disabled selected=""></option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mx-auto">
                  <div class="form-group">
                    <button type="button" id="add_aptitude" class="btn btn-block btn-outline-success">Agregar otra aptitud</button>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-orange float-right" id="candidate_submit">Crear</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?=base_url?>app/candidate.js?v=<?=rand()?>"></script>
<script type="text/javascript" src="<?=base_url?>app/cutimage.js?v=<?=rand()?>"></script>
<script>
  document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  }

  document.getElementsByName('position_area[]')[0].onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.getElementsByName("position_area[]")[0].value;
    subarea.selector = document.getElementsByName("position_subarea[]")[0];
    subarea.getSubareasByArea();
  }

  document.getElementsByName("state_enterprise[]")[0].onchange = function() {
    let cities = new City();
    cities.id_state = document.getElementsByName("state_enterprise[]")[0].value;
    cities.selector = document.getElementsByName("city_enterprise[]")[0];
    cities.getCitiesByState();
  }

  document.querySelector("#still_studies").onclick = function(){
    if (this.checked) {
      document.querySelector("#end_date").style.display = 'none';
    }else{
      document.querySelector("#end_date").style.display = 'block';
    }
  }

  document.getElementsByName("still_works[]")[0].onclick = function(){
    if (this.checked) {
      document.getElementsByName("end_date_job[]")[0].style.display = 'none';
    }else{
      document.getElementsByName("end_date_job[]")[0].style.display = 'block';
    }
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    var states = document.querySelector("#id_state").innerHTML;
    var areas = document.getElementsByName("position_area[]")[0].innerHTML;

    document.querySelector("#add_experience").addEventListener("click", e => {
      e.preventDefault();
      var div_experience = 
                  '<div class="card-body div_experience">'+
                    '<hr style="border-top: 2px dashed #8c8b8b;" class="mb-5">'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="position" class="col-form-label">Puesto</label>'+
                          '<input type="text" name="position[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="enterprise" class="col-form-label">Empresa</label>'+
                          '<input type="text" name="enterprise[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="position_area" class="col-form-label">Área del puesto</label>'+
                          '<select name="position_area[]" class="form-control select2" required>'+
                            areas+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="position_subarea[]" class="col-form-label">Subarea</label>'+
                          '<select name="position_subarea[]" class="form-control select2" required>'+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="state_enterprise" class="col-form-label">Estado</label>'+
                          '<select name="state_enterprise[]" class="form-control select2" required>'+
                              states+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="city_enterprise" class="col-form-label">Ciudad</label>'+
                          '<select name="city_enterprise[]" class="form-control select2 city_enterprise" required>'+
                            '<option disabled selected="selected"></option>'+
                          '</select>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-12">'+
                        '<div class="form-group">'+
                          '<label for="start_date_job" class="col-form-label">Periodo</label>'+
                          '<div class="row">'+
                            '<div class="col-md-4">'+
                              '<input type="date" name="start_date_job[]" class="form-control" required">'+
                            '</div>'+
                            '<div class="col-md-4">'+
                              '<input type="date" name="end_date_job[]" class="form-control" required">'+
                            '</div>'+
                            '<div class="col-md-4 text-center">'+
                              '<input type="checkbox" name="still_works[]" class="form-check-input" required>'+
                              '<label for="still_works" class="form-check-label">¿Aún trabaja?</label>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-12">'+
                        '<div class="form-group">'+
                          '<label for="review" class="col-form-label">Breve reseña del puesto</label>'+
                          '<input type="text" name="review[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="activity1" class="col-form-label">Logro o actividad 1</label>'+
                          '<input type="text" name="activity1[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="activity2" class="col-form-label">Logro o actividad 2</label>'+
                          '<input type="text" name="activity2[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="activity3" class="col-form-label">Logro o actividad 3</label>'+
                          '<input type="text" name="activity3[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="activity4" class="col-form-label">Logro o actividad 4</label>'+
                          '<input type="text" name="activity4[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-3 mx-auto">'+
                        '<div class="form-group">'+
                          '<button type="button" name="remove_experience" class="btn btn-block btn-outline-danger remove_experience">Quitar experiencia</button>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>';
      document.querySelector(".div_experiences").insertAdjacentHTML('beforeend', div_experience);
      let nExperience = document.getElementsByClassName("div_experience").length;
      utils.showToast((nExperience + 1) + '° experiencia agregada', 'success');

      var areas_name = document.getElementsByName("position_area[]");

      for (let i = 1; i < areas_name.length; i++) {
        areas_name[i].addEventListener('change', e => {
          let subarea = new Subarea();
          subarea.id_area = document.getElementsByName("position_area[]")[i].value;
          subarea.selector = document.getElementsByName("position_subarea[]")[i];
          subarea.getSubareasByArea();
        });
      }

      var states_name = document.getElementsByName("state_enterprise[]");

      for (let i = 1; i < states_name.length; i++) {
        states_name[i].addEventListener('change', e => {
          let cities = new City();
          cities.id_state = states_name[i].value;
          cities.selector = document.getElementsByName("city_enterprise[]")[i];
          cities.getCitiesByState();
        });
      }

      var still_works_name = document.getElementsByName("still_works[]");

      for (let i = 1; i < still_works_name.length; i++) {
        document.getElementsByName("still_works[]")[i].onclick = function(){
          if (this.checked) {
            document.getElementsByName("end_date_job[]")[i].style.display = 'none';
          }else{
            document.getElementsByName("end_date_job[]")[i].style.display = 'block';
          }
        }
      }

      var remove_experience = document.getElementsByName("remove_experience");
      for (let i = 0; i < remove_experience.length; i++) {
        
        remove_experience[i].addEventListener('click', e => {
          e.preventDefault();
          e.target.closest('div.div_experience').remove();
        });
      }
    });


    var languages = document.querySelector("#language").innerHTML;
    var language_levels = document.querySelector("#language_level").innerHTML;

    document.querySelector("#add_language").addEventListener("click", e => {
      e.preventDefault();
      var div_language = 
                  '<div class="card-body div_language">'+
                    '<hr style="border-top: 2px dashed #8c8b8b;" class="mb-5">'+
                    '<div class="row">'+
                      '<div class="col-md-12">'+
                        '<div class="form-group">'+
                          '<label for="salary" class="col-form-label">Idiomas:</label>'+
                          '<div class="row">'+
                            '<div class="col-md-6">'+
                              '<select name="language[]" class="form-control select2" required>'+
                                '<option disabled selected>Selecciona un idioma</option>'+
                                languages+
                              '</select>'+
                            '</div>'+
                            '<div class="col-md-6">'+
                              '<select name="language_level[]" class="form-control select2" required>'+
                                language_levels+
                              '</select>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="institution">Institución</label>'+
                          '<input type="text" name="institution_language[]" class="form-control" required>'+
                        '</div>'+
                      '</div>'+
                      '<div class="col-md-6">'+
                        '<div class="form-group">'+
                          '<label for="age" class="col-form-label">Periodo</label>'+
                          '<div class="row">'+
                            '<div class="col-md-6">'+
                              '<input type="date" name="start_date_language[]" class="form-control" required">'+
                            '</div>'+
                            '<div class="col-md-6">'+
                              '<input type="date" name="end_date_language[]" class="form-control" required">'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                    '<div class="row">'+
                      '<div class="col-md-3 mx-auto">'+
                        '<div class="form-group">'+
                          '<button type="button" name="remove_language" class="btn btn-block btn-outline-danger">Quitar idioma</button>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>';
      document.querySelector(".div_languages").insertAdjacentHTML('beforeend', div_language);
      let nLanguage = document.getElementsByClassName("div_language").length;
      utils.showToast((nLanguage) + '° idioma agregado', 'success');
      var remove_language = document.getElementsByName("remove_language");
      for (let i = 0; i < remove_language.length; i++) {

        remove_language[i].addEventListener('click', e => {
          e.preventDefault();
          e.target.closest('div.div_language').remove();
        });
      }
    });


    document.querySelector("#add_aptitude").addEventListener('click', e =>{
      e.preventDefault();
      var div_aptitude = 
                '<div class="card-body div_aptitude">'+
                  '<hr style="border-top: 2px dashed #8c8b8b;" class="mb-5">'+
                  '<div class="row">'+
                    '<div class="col-md-10">'+
                      '<div class="form-group">'+
                        '<label for="aptitude" class="col-form-label">Aptitud:</label>'+
                        '<input type="text" name="aptitude[]" class="form-control" required>'+
                      '</div>'+
                    '</div>'+
                    '<div class="col-md-2">'+
                      '<div class="form-group">'+
                        '<label for="aptitude_level" class="col-form-label">Nivel</label>'+
                        '<select name="aptitude_level[]" class="form-control select2" required>'+
                          '<option disabled selected=""></option>'+
                          '<option value="1">1</option>'+
                          '<option value="2">2</option>'+
                          '<option value="3">3</option>'+
                          '<option value="4">4</option>'+
                          '<option value="5">5</option>'+
                          '<option value="6">6</option>'+
                          '<option value="7">7</option>'+
                          '<option value="8">8</option>'+
                          '<option value="9">9</option>'+
                          '<option value="10">10</option>'+
                        '</select>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                  '<div class="row">'+
                      '<div class="col-md-3 mx-auto">'+
                        '<div class="form-group">'+
                          '<button type="button" name="remove_aptitude" class="btn btn-block btn-outline-danger">Quitar aptitud</button>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                '</div>';
      document.querySelector(".div_aptitudes").insertAdjacentHTML('beforeend', div_aptitude);
      let nAptitude = document.getElementsByClassName("div_aptitude").length;
      utils.showToast((nAptitude) + '° aptitud agregada', 'success');
      var remove_aptitude = document.getElementsByName("remove_aptitude");
      for (let i = 0; i < remove_aptitude.length; i++) {
        remove_aptitude[i].addEventListener('click', e => {
          e.preventDefault();
          e.target.closest('div.div_aptitude').remove();
          console.log("Quitar aptitud");
        });
      }
    });

    document.querySelector("#register-candidate-form #candidate_submit").onclick = function(e) {
      e.preventDefault();
      this.disabled = true;
      let candidate = new Candidate();
      candidate.save();
    };

  });
</script>
  

