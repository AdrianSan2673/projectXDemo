<style>
  h6 {
    line-height: 1.5;
  }
</style>
<div class="content-wrapper">
    <section class="content pt-4">
      <div class="container-fluid">
      <div class="row">
          <div class="col-md-8">
            <form id="cv-maker" method="post">
              <div class="card card-transparent">
                <div class="card-body p-0">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#header-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="header-part" id="header-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Encabezado</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#experience-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="experience-part" id="experience-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Experiencia</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#education-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="education-part" id="education-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Educación</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#additional-preparation-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="additional-preparation-part" id="additional-preparation-part-trigger">
                          <span class="bs-stepper-circle">4</span>
                          <span class="bs-stepper-label">Formación</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#languages-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="languages-part" id="languages-part-trigger">
                          <span class="bs-stepper-circle">5</span>
                          <span class="bs-stepper-label">Idiomas</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#aptitudes-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="aptitudes-part" id="aptitudes-part-trigger">
                          <span class="bs-stepper-circle">6</span>
                          <span class="bs-stepper-label">Aptitudes</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="header-part" class="content" role="tabpanel" aria-labelledby="header-part-trigger">
                        <h6 class="pb-2">Ingresa tu nombre completo en los campos y proporciona medios de contacto que puedan utilizar los reclutadores.</h6>
                        <div class="form-group">
                          <label for="first_name" class="col-form-label">Nombre(s)</label>
                          <input type="text" name="first_name" id="first_name" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->first_name : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="surname" class="col-form-label">Apellido Paterno</label>
                            <input type="text" name="surname" id="surname" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->surname : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="last_name" class="col-form-label">Apellido Materno</label>
                          <input type="text" name="last_name" id="last_name" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->last_name : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="job_title" class="col-form-label">Experiencia en</label>
                          <input type="text" name="job_title" id="job_title" class="form-control" value="<?=isset($candidato) && is_object($candidato) ? $candidato->job_title : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="description" class="col-form-label">Reseña breve</label>
                          <textarea name="description" id="description" rows="10" class="form-control"><?=isset($candidato) && is_object($candidato) ? $candidato->description : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                          <label for="id_state" class="col-form-label">Estado</label>
                          <?php $states = Utils::showStates();?>
                          <select name="id_state" id="id_state" class="form-control"  style="width: 100%;">
                              <option disabled selected="selected"></option>
                              <?php foreach ($states as $state) : ?>
                                  <option value="<?= $state['id'] ?>" <?=isset($candidato) && is_object($candidato) && $state['id'] == $candidato->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                              <?php endforeach; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="id_city" class="col-form-label">Ciudad</label>
                          <select name="id_city" id="id_city" class="form-control select2bs4" style="width: 100%;">
                            <?php if (isset($candidato) && is_object($candidato) && !empty($candidato->id_state)): ?>
                              <?= $cities = Utils::showCitiesByState($candidato->id_state);?>
                              <?php foreach ($cities as $city): ?>
                                <option value="<?= $city['id'] ?>" <?=isset($candidato) && is_object($candidato) && $city['id'] == $candidato->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                              <?php endforeach ?>
                            <?php else: ?>
                              <option disabled selected="selected"></option>
                            <?php endif ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="telephone" class="col-form-label">Teléfono</label>
                          <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->telephone : ''; ?>" data-inputmask='"mask": "999 999 9999"' data-mask>
                        </div>
                        <div class="form-group">
                          <label for="cellphone" class="col-form-label">Celular:</label>
                          <input type="text" name="cellphone" id="cellphone" maxlength="13" class="form-control" required value="<?=isset($candidato) && is_object($candidato) ? $candidato->cellphone : ''; ?>" data-inputmask='"mask": "999 999  9999"' data-mask>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" readonly value="<?=$_SESSION['identity']->email?>" class="form-control" required>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mx-auto">                          
                            <div class="form-group">
                              <label for="avatar" class="col-form-label">Elija una foto del candidato</label>
                              <input type="file" name="avatar" id="avatar" class="form-control" accept="image/png,image/gif,image/jpeg">
                            </div>
                            <div id="editor"><img src="<?=isset($route) ? $route : ''?>"></div>
                          </div>
                          <div class="col-md-6 text-center">
                            <canvas id="preview"></canvas>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="experience-part" class="content" role="tabpanel" aria-labelledby="experience-part-trigger">
                        <h6 class="pb-2">Describe tu experiencia laboral en el campo de texto proporcionado. Incluye detalles como los nombres de las empresas, los cargos que ocupaste y las responsabilidades que tenías. También puedes mencionar los períodos de empleo.</h6>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="position" class="col-form-label">Puesto</label>
                              <input type="text" name="position" id="position" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->position : ''?>" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="enterprise" class="col-form-label">Empresa</label>
                              <input type="text" name="enterprise" id="enterprise" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->enterprise : ''?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="id_area" class="col-form-label">Área del puesto</label>
                              <?php $areas = Utils::showAreas();?>
                              <select name="id_area" id="id_area" class="form-control select2" required>
                                  <option disabled selected="selected"></option>
                                  <?php foreach ($areas as $area) : ?>
                                      <option value="<?= $area['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $area['id'] == $experiencia->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="id_subarea" class="col-form-label">Subarea</label>
                              <select name="id_subarea" id="id_subarea" class="form-control select2" required>
                              <?php if (isset($experiencia) && is_object($experiencia) && !empty($experiencia->id_area)): ?>
                                <?= $subareas = Utils::showSubareasByArea($experiencia->id_area);?>
                                <?php foreach ($subareas as $subarea): ?>
                                  <option value="<?= $subarea['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $subarea['id'] == $experiencia->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
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
                              <label for="id_state" class="col-form-label">Estado</label>
                              <?php $states = Utils::showStates();?>
                              <select name="id_state" id="id_state" class="form-control select2" required>
                                  <option disabled selected="selected"></option>
                                  <?php foreach ($states as $state) : ?>
                                      <option value="<?= $state['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $state['id'] == $experiencia->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="id_city" class="col-form-label">Ciudad</label>
                              <select name="id_city" id="id_city" class="form-control select2" required>
                              <?php if (isset($experiencia) && is_object($experiencia) && !empty($experiencia->id_state)): ?>
                                <?= $cities = Utils::showCitiesByState($experiencia->id_state);?>
                                <?php foreach ($cities as $city): ?>
                                  <option value="<?= $city['id'] ?>" <?=isset($experiencia) && is_object($experiencia) && $city['id'] == $experiencia->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
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
                              <label for="start_date" class="col-form-label">Periodo</label>
                              <div class="row">
                                <div class="col-md-4">
                                  <input type="date" name="start_date" id="start_date" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->start_date : ''?>" required>
                                </div>
                                <div class="col-md-4">
                                  <input type="date" name="end_date" id="end_date" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->end_date : ''?>">
                                </div>
                                <div class="col-md-4 text-center">
                                  <input type="checkbox" name="still_works" id="still_works" <?=isset($experiencia) && is_object($experiencia) && $experiencia->still_works == 1 ? 'checked' : ''; ?> class="form-check-input">
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
                              <input type="text" name="review" id="review" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->review : ''?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                              <input type="text" name="activity1" id="activity1" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity1 : ''?>" required>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                              <input type="text" name="activity2" id="activity2" class="form-control" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity2 : ''?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                              <input type="text" name="activity3" id="activity3" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity3 : ''?>" class="form-control">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                              <input type="text" name="activity4" id="activity4" value="<?=isset($experiencia) && is_object($experiencia) ? $experiencia->activity4 : ''?>" class="form-control">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="education-part" class="content" role="tabpanel" aria-labelledby="education-part-trigger">
                        <h6 class="pb-2">Indica tu historial educativo en el campo de texto. Incluye información sobre los títulos académicos que has obtenido, las instituciones educativas en las que estudiaste y los años en los que asististe a cada una.</h6>
                        <div class="form-group">
                          <label for="education_level">Último grado de estudios</label>
                          <?php $education_levels = Utils::showEducationLevels(); ?>
                          <select name="education_level" id="education_level" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($education_levels as $level): ?>
                              <option value="<?=$level['id']?>" <?=isset($educacion) && is_object($educacion) && $level['id'] == $educacion->id_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="institution">Institución</label>
                          <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->institution : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="title" class="col-form-label">Área de estudio</label>
                          <input type="text" name="title" id="title" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->title : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="age" class="col-form-label">Periodo</label>
                          <div class="row">
                            <div class="col-md-4">
                              <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->start_date : ''; ?>">
                            </div>
                            <div class="col-md-4">
                              <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($educacion) && is_object($educacion) ? $educacion->end_date : ''; ?>">
                            </div>
                            <div class="col-md-4 text-center">
                              <input type="checkbox" name="still_studies" id="still_studies" class="form-check-input">
                              <label for="still_studies" class="form-check-label" <?=isset($educacion) && is_object($educacion) && $educacion->still_studies == 1 ? 'checked' : ''; ?>>¿Aún estudia?</label>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="additional-preparation-part" class="content" role="tabpanel" aria-labelledby="additional-preparation-part-trigger">
                        <h6 class="pb-2"></h6>
                        <div class="form-group">
                          <label for="type" class="col-form-label">Tipo de formación</label>
                          <?php $education_levels = Utils::showEducationLevels(); ?>
                          <select name="level" id="level" class="form-control" required>
                            <option hidden selected value="" required></option>
                            <?php foreach ($education_levels as $level): ?>
                              <option value="<?=$level['id']?>" <?=isset($formacion) && is_object($formacion) && $level['id'] == $formacion->id_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="course" class="col-form-label">Nombre de la formación</label>
                          <input type="text" name="course" id="course" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->course : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="institution" class="col-form-label">Institución</label>
                          <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->institution : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="age" class="col-form-label">Periodo</label>
                          <div class="row">
                            <div class="col-md-6">
                              <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->start_date : ''; ?>">
                            </div>
                            <div class="col-md-6">
                              <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($formacion) && is_object($formacion) ? $formacion->end_date : ''; ?>">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="languages-part" class="content" role="tabpanel" aria-labelledby="languages-part-trigger">
                        <h6 class="pb-2"></h6>
                        <div class="form-group">
                          <label for="language" class="col-form-label">Idioma:</label>
                          <?php $languages = Utils::showLanguages(); ?>
                          <select name="language" id="language" class="form-control select2" required>
                            <option disabled selected>Selecciona un idioma</option>
                            <?php foreach ($languages as $language): ?>
                              <option value="<?=$language['id']?>" <?=isset($idioma) && is_object($idioma) && $language['id'] == $idioma->id_language ? 'selected' : ''; ?>><?=$language['language']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="level" class="col-form-label">Nivel:</label>
                          <?php $language_levels = Utils::showLanguageLevels(); ?>
                          <select name="level" id="level" class="form-control select2" required>
                            <option disabled selected="">Selecciona el nivel</option>
                            <?php foreach ($language_levels as $level): ?>
                              <option value="<?=$level['id']?>" <?=isset($idioma) && is_object($idioma) && $level['id'] == $idioma->level ? 'selected' : ''; ?>><?=$level['language_level']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="institution" class="col-form-label">Institución</label>
                          <input type="text" name="institution" id="institution" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->institution : ''; ?>" required>
                        </div>
                        <div class="form-group">
                          <label for="start_date" class="col-form-label">Periodo</label>
                          <div class="row">
                            <div class="col-md-6">
                              <input type="date" name="start_date" id="start_date" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->start_date : ''; ?>">
                            </div>
                            <div class="col-md-6">
                              <input type="date" name="end_date" id="end_date" class="form-control" required value="<?=isset($idioma) && is_object($idioma) ? $idioma->end_date : ''; ?>">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="aptitudes-part" class="content" role="tabpanel" aria-labelledby="aptitudes-part-trigger">
                        <h6 class="pb-2">Enumera tus aptitudes y habilidades relevantes para el puesto o la industria en la que te estás postulando. Puedes incluir habilidades técnicas, habilidades interpersonales, conocimientos, etc. </h6>
                        <div class="form-group">
                          <label for="aptitude" class="col-form-label">Aptitud:</label>
                          <input type="text" name="aptitude" id="aptitude" value="<?=isset($aptitud) && is_object($aptitud) ? $aptitud->aptitude : ''?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label for="level" class="col-form-label">Nivel</label>
                          <select name="level" id="level" class="form-control" required>
                            <option disabled selected=""></option>
                            <?php foreach (range(1, 10) as $i): ?>
                              <option value="<?=$i?>" <?=isset($aptitud) && is_object($aptitud) && $aptitud->level == $i ? 'selected' : ''; ?>><?=$i?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </form>   
          </div>
          <div class="col-md-4 text-center">
            <div id="pdf-container"></div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.js"></script>
<script type="text/javascript" src="<?=base_url?>app/cutimage.js?v=<?=rand()?>"></script>
<script>
/*   document.querySelector('#id_area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#id_area").value;
    subarea.selector = document.querySelector("#id_subarea");
    subarea.getSubareasByArea();
  }; */
  document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  }

  window.onload = function(){
    if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
      let cities = new City();
      cities.id_state = document.querySelector('#id_state').value;
      cities.selector = document.querySelector('#id_city');
      cities.getCitiesByState();
    }
  }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      var form = document.querySelector('#cv-maker');

      var inputs = form.getElementsByTagName('input');

      for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        
        if (input.tagName.toLowerCase() === 'input' && input.type !== 'hidden') {
          input.addEventListener('blur', function() {
            var formData = new FormData(form);
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../Resume/generate');
            xhr.send(formData);
            xhr.onreadystatechange = function(){
              if (xhr.readyState == 4 && xhr.status == 200) {
                  let r = this.responseText;
                  try {
                    document.getElementById("pdf-container").innerHTML = '';
                    var row = document.createElement('div');
                    row.classList.add('row');

                    // Cargar el PDF base64
                    pdfjsLib.getDocument({ data: atob(r) })
                      .promise.then(function (pdf) {
                        // Obtener el número total de páginas del PDF
                        var numPages = pdf.numPages;
                        // Renderizar todas las páginas del PDF en el visor
                        for (var pageNumber = 1; pageNumber <= numPages; pageNumber++) {
                          pdf.getPage(pageNumber).then(function (page) {
                            var col = document.createElement('div');
                            col.classList.add('col-sm-6');

                            var scale = 0.5;
                            var viewport = page.getViewport({ scale: scale });

                            var canvas = document.createElement("canvas");
                            var context = canvas.getContext("2d");
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            var renderContext = {
                              canvasContext: context,
                              viewport: viewport
                            };

                            page.render(renderContext).promise.then(function () {
                              col.appendChild(canvas);
                              row.appendChild(col);
                            });
                          });
                        }
                        document.querySelector('#pdf-container').appendChild(row);
                      });
                      
                    } catch (error) {
                  }
                        
              }
            }
          });
        }
      }
    });
</script>