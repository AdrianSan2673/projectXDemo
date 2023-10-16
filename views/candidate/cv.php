<style>
  h6 {
    line-height: 1.5;
  }

  .navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: transparent;
    transition: background-color 0.3s ease;
  }

  .photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;

    left: 50%;
    position: absolute;
    margin-left: -50px;
  }

  .photo img {
    width: 100%;
    height: auto;
  }

  .step-trigger {
    font-size: 0.8rem !important;
  }  
</style>
<div class="content-wrapper">
  <div class="container">
    <section class="content pt-4">
      <div class="container-fluid"> 
        <form id="cv-maker" method="post">
          <div class="card card-transparent">
            <div class="card-body p-0">
              <div class="bs-stepper p-3">
                <div class="bs-stepper-header" role="tablist">
                  <!-- your steps here -->
                  <div class="step" data-target="#header-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="header-part">
                      <span class="bs-stepper-circle">1</span>
                      <span class="bs-stepper-label">Encabezado</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#experience-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="experience-part">
                      <span class="bs-stepper-circle">2</span>
                      <span class="bs-stepper-label">Experiencia</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#education-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="education-part">
                      <span class="bs-stepper-circle">3</span>
                      <span class="bs-stepper-label">Educación</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#additional-preparation-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="additional-preparation-part">
                      <span class="bs-stepper-circle">4</span>
                      <span class="bs-stepper-label">Formación Adicional</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#languages-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="languages-part">
                      <span class="bs-stepper-circle">5</span>
                      <span class="bs-stepper-label">Idiomas</span>
                    </button>
                  </div>
                  <div class="line"></div>
                  <div class="step" data-target="#aptitudes-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="aptitudes-part">
                      <span class="bs-stepper-circle">6</span>
                      <span class="bs-stepper-label">Aptitudes</span>
                    </button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-7">
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="header-part" class="content">
                        <div class="form-row">
                          <div class="form-group col-md-8">
                            <h6 class="pb-2">Ingresa tu nombre completo en los campos y proporciona medios de contacto que puedan utilizar los reclutadores.</h6>
                            <label for="first_name" class="col-form-label">Nombre(s)</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) ? $_SESSION['data']->first_name : ''; ?>">
                          </div>
                          <div class="col-md-4 text-center">
                            <div class="photo">
                              <img src="<?= isset($_SESSION['route']) && !empty($_SESSION['route']) ? $_SESSION['route'] : base_url.'dist/img/user-icon.png' ?>" alt="User Avatar">
                            </div>
                            <div class="btn-group btn-group-xs" style="margin-top: 110px !important;">
                            <?php if(isset($_SESSION['route']) && !empty($_SESSION['route'])): ?>
                              <button class="btn btn-xs btn-info btn-edit-photo" style="font-size: 0.55rem;"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>
                              <button class="btn btn-xs btn-danger btn-delete-photo" style="font-size: 0.55rem;"><i class="fas fa-times mr-1"></i>Borrar</button>
                            <?php endif; ?>
                              <label class="btn btn-xs btn-orange ml-2" style="font-size: 0.55rem;">
                                <input type="file" class="d-none btn-upload-photo" accept="image/x-png,image/gif,image/jpeg"><i class="fas fa-upload"></i> Subir 
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col">
                            <label for="surname" class="col-form-label">Apellido Paterno</label>
                            <input type="text" name="surname" id="surname" class="form-control" value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->surname) ? $_SESSION['data']->surname : ''; ?>">
                          </div>
                          <div class="form-group col">
                            <label for="last_name" class="col-form-label">Apellido Materno</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->last_name) ? $_SESSION['data']->last_name : ''; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="job_title" class="col-form-label">Puesto de trabajo deseado</label>
                          <input type="text" name="job_title" id="job_title" class="form-control" value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->job_title) ? $_SESSION['data']->job_title : ''; ?>">
                        </div>
                        <div class="form-row">
                          <div class="form-group col">
                            <label for="id_state" class="col-form-label">Estado</label>
                            <?php $states = Utils::showStates(); ?>
                            <select name="id_state" id="id_state" class="form-control id_state" style="width: 100%;">
                              <option disabled selected="selected"></option>
                              <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>" <?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->id_state) && $state['id'] == $_SESSION['data']->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col">
                            <label for="id_city" class="col-form-label">Ciudad</label>
                            <select name="id_city" id="id_city" class="form-control select2bs4 id_city" style="width: 100%;">
                              <?php if (isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->id_state)) : ?>
                                <?= $cities = Utils::showCitiesByState($_SESSION['data']->id_state); ?>
                                <?php foreach ($cities as $city) : ?>
                                  <option value="<?= $city['id'] ?>" <?= isset($_SESSION['data']) && is_object($_SESSION['data']) && $city['id'] == $_SESSION['data']->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
                                <?php endforeach ?>
                              <?php else : ?>
                                <option disabled selected="selected"></option>
                              <?php endif ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="description" class="col-form-label">Resumen profesional</label>
                          <textarea name="description" id="description" rows="10" class="form-control"><?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->description) ? $_SESSION['data']->description : ''; ?></textarea>
                        </div>
                        <div class="form-row">
                          <div class="form-group col">
                            <label for="id_area" class="col-form-label">Área de interés</label>
                            <?php $areas = Utils::showAreas();?>
                            <select name="id_area" id="id_area" class="form-control id_area">
                                <option value="" hidden selected>Selecciona un área</option>
                                <?php foreach ($areas as $area) : ?>
                                    <option value="<?= $area['id'] ?>" <?=$area['id'] == $_SESSION['data']->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                                <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="form-group col">
                            <label for="id_subarea" class="col-form-label">Subarea</label>
                            <select name="id_subarea" id="id_subarea" class="form-control id_subarea">
                            <?php if (!empty($_SESSION['data']->id_area)): ?>
                              <?= $subareas = Utils::showSubareasByArea($_SESSION['data']->id_area);?>
                              <?php foreach ($subareas as $subarea): ?>
                                <option value="<?= $subarea['id'] ?>" <?= $subarea['id'] == $_SESSION['data']->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                              <?php endforeach ?>
                            <?php else: ?>
                              <option disabled selected="selected"></option>
                            <?php endif ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col">
                            <label for="telephone" class="col-form-label">Teléfono</label>
                            <input type="text" name="telephone" id="telephone" maxlength="13" class="form-control" required value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->telephone) ? $_SESSION['data']->telephone : ''; ?>" data-inputmask='"mask": "999 999 9999"' data-mask>
                          </div>
                          <div class="form-group col">
                            <label for="cellphone" class="col-form-label">Celular:</label>
                            <input type="text" name="cellphone" id="cellphone" maxlength="13" class="form-control" required value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->cellphone) ? $_SESSION['data']->cellphone : ''; ?>" data-inputmask='"mask": "999 999  9999"' data-mask>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="email" class="col-form-label">Correo electrónico</label>
                          <input type="email" name="email" id="email" readonly class="form-control" value="<?= isset($_SESSION['data']) && is_object($_SESSION['data']) && isset($_SESSION['data']->email) ? $_SESSION['data']->email : ''; ?>" required>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="experience-part" class="content">
                        <h6 class="pb-2">Describe tu experiencia laboral en el campo de texto proporcionado. Incluye detalles como los nombres de las empresas, los cargos que ocupaste y las responsabilidades que tenías. También puedes mencionar los períodos de empleo.</h6>
                        <div id="content-experiences">
                          <?php foreach($experiences as $key => $experience): ?>
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <button class="btn btn-link" data-toggle="collapse" data-target="#experience<?=$experience['id_experience']?>" aria-expanded="false" aria-controls="experience<?=$experience['id_experience']?>"><?=$experience['position']?></button>
                                </h4>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                              <div id="experience<?=$experience['id_experience']?>" class="collapse">
                                <div class="card-body">
                                  <input type="hidden" name="experience_id[]" value="<?=$key + 1?>">
                                  <input type="hidden" name="id_experience[]" value="<?=$experience['id_experience']?>">
                                  <div class="form-row">
                                    <div class="form-group col">
                                      <label for="position_experience" class="col-form-label">Puesto</label>
                                      <input type="text" name="position_experience[]" class="form-control position" value="<?=$experience['position']?>">
                                    </div>
                                    <div class="form-group col">
                                      <label for="enterprise_experience" class="col-form-label">Empresa</label>
                                      <input type="text" name="enterprise_experience[]" class="form-control" value="<?=$experience['enterprise']?>">
                                    </div>
                                  </div>
                                  <div class=" form-row">
                                    <div class="form-group col">
                                      <label for="id_area_experience" class="col-form-label">Área del puesto</label>
                                      <?php $areas = Utils::showAreas();?>
                                      <select name="id_area_experience[]" class="form-control select2 id_area">
                                        <option disabled selected="selected"></option>
                                        <?php foreach ($areas as $area) : ?>
                                            <option value="<?= $area['id'] ?>" <?= isset($experience['id_area']) & $area['id'] == $experience['id_area'] ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group col">
                                      <label for="id_subarea_experience" class="col-form-label">Subarea</label>
                                      <select name="id_subarea_experience[]" class="form-control select2 id_subarea">
                                        <?php if (!empty($experience['id_area'])) : ?>
                                          <?php $subareas = Utils::showSubareasByArea($experience['id_area']) ?>
                                          <?php foreach ($subareas as $subarea): ?>
                                            <option value="<?= $subarea['id'] ?>" <?= $subarea['id'] == $experience['id_subarea'] ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                                          <?php endforeach ?>
                                        <?php else: ?>
                                          <option disabled selected="selected"></option>
                                        <?php endif ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col">
                                      <label for="id_state_experience" class="col-form-label">Estado</label>
                                      <select name="id_state_experience[]" class="form-control select2 id_state">
                                        <option disabled selected="selected"></option>
                                        <?php $states = Utils::showStates(); ?>
                                        <?php foreach ($states as $state) : ?>
                                          <option value="<?= $state['id'] ?>" <?= isset($experience['id_state']) && $state['id'] == $experience['id_state'] ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                                        <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group col">
                                      <label for="id_city_experience" class="col-form-label">Ciudad</label>
                                      <select name="id_city_experience[]" class="form-control select2 id_city">
                                          <?= $cities = Utils::showCitiesByState($experience['id_state']); ?>
                                          <?php foreach ($cities as $city) : ?>
                                            <option value="<?= $city['id'] ?>" <?= $city['id'] == $experience['id_state']? 'selected' : ''; ?>><?= $city['city'] ?></option>
                                          <?php endforeach ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col">
                                      <label for="start_date_experience" class="col-form-label">Periodo</label>
                                      <div class="col form-row">
                                        <div class="form-group col">
                                          <input type="date" name="start_date_experience[]" class="form-control" value="<?=$experience['start_date']?>">
                                        </div>
                                        <div class="form-group col">
                                          <input type="date" name="end_date_experience[]" class="form-control" value="<?=$experience['end_date']?>" style="display:  <?=$experience['still_works'] == 1 ? 'none': ''?>;">
                                        </div>
                                        <div class="form-group col text-center">
                                          <input type="checkbox" name="still_works_experience[]" class="form-check-input" <?=$experience['still_works'] == 1 ? 'checked': ''?>>
                                          <label for="still_works_experience" class="form-check-label">¿Aún trabaja?</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col">
                                      <label for="review" class="col-form-label">Breve reseña del puesto</label>
                                      <textarea name="review_experience[]" class="form-control" rows="5"><?=$experience['review']?></textarea>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                                        <input type="text" name="activity1[]" class="form-control" value="<?=$experience['activity1']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                                        <input type="text" name="activity2[]" class="form-control" value="<?=$experience['activity2']?>">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                                        <input type="text" name="activity3[]" class="form-control" value="<?=$experience['activity3']?>">
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                                        <input type="text" name="activity4[]" class="form-control" value="<?=$experience['activity4']?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <button type="button" id="btn-add-experience" class="btn btn-block btn-outline-primary btn-flat">Añadir trabajo</button>
                        <br><br>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="education-part" class="content">
                        <h6 class="pb-2">Indica tu historial educativo en el campo de texto. Incluye información sobre los títulos académicos que has obtenido, las instituciones educativas en las que estudiaste y los años en los que asististe a cada una.</h6>
                        <div class="form-group">
                          <label for="education_level">Último grado de estudios</label>
                          <?php $education_levels = Utils::showEducationLevels(); ?>
                          <select name="education_level" id="education_level" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($education_levels as $level) : ?>
                              <option value="<?= $level['id'] ?>" <?= isset($education) && is_object($education) && $level['id'] == $education->id_level ? 'selected' : ''; ?>><?= $level['level'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="education_institution">Institución</label>
                          <input type="text" name="education_institution" id="education_institution" class="form-control" value="<?= isset($education) && is_object($education) ? $education->institution : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="education_title" class="col-form-label">Área de estudio</label>
                          <input type="text" name="education_title" id="education_title" class="form-control" value="<?= isset($education) && is_object($education) ? $education->title : ''; ?>">
                        </div>
                        <div class="form-group">
                          <label for="age" class="col-form-label">Periodo</label>
                          <div class="row">
                            <div class="col-md-4">
                              <input type="date" name="education_start_date" id="education_start_date" class="form-control" value="<?= isset($education) && is_object($education) ? $education->start_date : ''; ?>">
                            </div>
                            <div class="col-md-4">
                              <input type="date" name="education_end_date" id="education_end_date" class="form-control" value="<?= isset($education) && is_object($education) ? $education->end_date : ''; ?>">
                            </div>
                            <div class="col-md-4 text-center">
                              <input type="checkbox" name="education_still_studies" id="education_still_studies" class="form-check-input">
                              <label for="education_still_studies" class="form-check-label" <?= isset($education) && is_object($education) && $education->still_studies == 1 ? 'checked' : ''; ?>>¿Aún estudia?</label>
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="additional-preparation-part" class="content">
                        <h6 class="pb-2"></h6>
                        <div id="content-additional-preparation">
                          <?php foreach ($preparations as $key => $preparation) : ?>
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <button class="btn btn-link" data-toggle="collapse" data-target="#preparation<?=$preparation['id']?>" aria-expanded="false" aria-controls="preparation<?=$preparation['id']?>"><?=$preparation['course']?></button>
                                </h4>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                              <div id="preparation<?=$preparation['id']?>" class="collapse">
                                <div class="card-body">
                                  <input type="hidden" name="id_preparation[]" value="<?=$preparation['id']?>">
                                  <div class="form-group">
                                    <label for="type" class="col-form-label">Tipo de formación</label>
                                    <?php $education_levels = Utils::showEducationLevels(true); ?>
                                    <select name="preparation_level[]" class="form-control">
                                      <option hidden selected value=""></option>
                                      <?php foreach ($education_levels as $level) : ?>
                                        <option value="<?= $level['id'] ?>" <?= isset($preparation['id_level']) && $level['id'] == $preparation['id_level'] ? 'selected' : ''; ?>><?= $level['level'] ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="course" class="col-form-label">Nombre de la formación</label>
                                    <input type="text" name="preparation_course[]" class="form-control" value="<?=$preparation['course']?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="institution" class="col-form-label">Institución</label>
                                    <input type="text" name="preparation_institution[]" class="form-control" value="<?=$preparation['institution']?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="start_date" class="col-form-label">Periodo</label>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <input type="date" name="preparation_start_date[]" class="form-control" value="<?=$preparation['start_date']?>">
                                      </div>
                                      <div class="col-md-6">
                                        <input type="date" name="preparation_end_date[]" class="form-control" value="<?=$preparation['end_date']?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                          <?php $education_levels = Utils::showEducationLevels(true); ?>
                          <select id="preparation_level" class="form-control" hidden>
                            <?php foreach ($education_levels as $level) : ?>
                              <option value="<?= $level['id'] ?>"><?= $level['level'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                        <button type="button" id="btn-add-additional-preparation" class="btn btn-block btn-outline-primary btn-flat">Añadir formación</button>
                        <br><br>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="languages-part" class="content">
                        <h6 class="pb-2"></h6>
                        <div id="content-languages">
                          <?php foreach($languages as $key => $idioma) :?>
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <button class="btn btn-link" data-toggle="collapse" data-target="#language<?=$idioma['id']?>" aria-expanded="false" aria-controls="language<?=$idioma['id']?>"><?=$idioma['language']?></button>
                                </h4>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                              <div id="language<?=$idioma['id']?>" class="collapse">
                                <div class="card-body">
                                  <input type="hidden" name="id_language[]" value="<?=$idioma['id']?>">
                                  <div class="form-group">
                                    <label for="language" class="col-form-label">Idioma:</label>
                                    <?php $languagesList = Utils::showLanguages(); ?>
                                    <select name="language[]" class="form-control">
                                      <option disabled selected>Selecciona un idioma</option>
                                      <?php foreach ($languagesList as $language) : ?>
                                        <option value="<?= $language['id'] ?>" <?= $language['id'] == $idioma['id_language'] ? 'selected' : ''; ?>><?= $language['language'] ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="language_level" class="col-form-label">Nivel:</label>
                                    <?php $language_levels = Utils::showLanguageLevels(); ?>
                                    <select name="language_level[]" class="form-control">
                                      <option disabled selected="">Selecciona el nivel</option>
                                      <?php foreach ($language_levels as $level) : ?>
                                        <option value="<?= $level['id'] ?>" <?= $level['id'] == $idioma['level'] ? 'selected' : ''; ?>><?= $level['language_level'] ?></option>
                                      <?php endforeach ?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="language_institution" class="col-form-label">Institución</label>
                                    <input type="text" name="language_institution[]" class="form-control" value="<?= $idioma['institution']?>">
                                  </div>
                                  <div class="form-group">
                                    <label for="language_start_date" class="col-form-label">Periodo</label>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <input type="date" name="language_start_date[]" class="form-control" value="<?= $idioma['start_date'] ?>">
                                      </div>
                                      <div class="col-md-6">
                                        <input type="date" name="language_end_date[]" class="form-control" value="<?= $idioma['end_date'] ?>">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <?php $languagesList = Utils::showLanguages(); ?>
                          <select id="language" class="form-control" hidden>
                            <?php foreach ($languagesList as $language) : ?>
                              <option value="<?= $language['id'] ?>"><?= $language['language'] ?></option>
                            <?php endforeach ?>
                          </select>
                        <?php $language_levels = Utils::showLanguageLevels(); ?>
                        <select id="language_level" class="form-control" hidden>
                          <?php foreach ($language_levels as $level) : ?>
                            <option value="<?= $level['id'] ?>"><?= $level['language_level'] ?></option>
                          <?php endforeach ?>
                        </select>
                        <button type="button" id="btn-add-language" class="btn btn-block btn-outline-primary btn-flat">Añadir idioma</button>
                        <br><br>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                      <div id="aptitudes-part" class="content">
                        <h6 class="pb-2">Enumera tus aptitudes y habilidades relevantes para el puesto o la industria en la que te estás postulando. Puedes incluir habilidades técnicas, habilidades interpersonales, conocimientos, etc. </h6>
                        <div id="content-aptitudes">
                          <?php foreach ($aptitudes as $key => $aptitude) : ?>
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title w-100">
                                  <button class="btn btn-link" data-toggle="collapse" data-target="#aptitude<?=$aptitude['id']?>" aria-expanded="false" aria-controls="aptitude<?=$aptitude['id']?>"><?=$aptitude['aptitude']?></button>
                                </h4>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                  </button>
                                </div>
                              </div>
                              <div id="aptitude<?=$aptitude['id']?>" class="collapse">
                                <div class="card-body">
                                  <input type="hidden" name="id_aptitude[]" value="<?=$aptitude['id']?>">
                                  <div class="form-group">
                                    <label for="aptitude" class="col-form-label">Aptitud:</label>
                                    <input type="text" name="aptitude[]" value="<?= $aptitude['aptitude'] ?>" class="form-control">
                                  </div>
                                  <div class="form-group">
                                    <label for="aptitude_level" class="col-form-label">Nivel</label>
                                    <input type="range" name="aptitude_level[]" min="0" max="10" value="<?=$aptitude['level']?>" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                        <button type="button" id="btn-add-aptitude" class="btn btn-block btn-outline-primary btn-flat">Añadir aptitud</button>
                        <br><br>
                        <button class="btn btn-primary" onclick="stepper.previous()">Atrás</button>
                        <button class="btn btn-primary" onclick="stepper.next()">Siguiente</button>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-5 text-center bg-lightblue">
                    <div id="pdf-container"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </form>
      </div><!-- /.container-fluid -->
    </section>
  </div>
</div>
<div class="modal fade" id="modal_imagen">
  <div class="modal-dialog modal-lg" style="max-width: 1000px;">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="img-container" style="max-height: 500px;">
                <img src="" class="img-fluid" />
              </div>
            </div>
          </div>
          <div class="text-center docs-buttons mt-3">
            <div class="btn-group">
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="move" title="Move">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
                  <span class="fa fa-arrows-alt"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="setDragMode" data-option="crop" title="Crop">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
                  <span class="fa fa-crop-alt"></span>
                </span>
              </button>
            </div>

            <div class="btn-group">
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="0.1" title="Zoom In">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
                  <span class="fa fa-search-plus"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="zoom" data-option="-0.1" title="Zoom Out">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
                  <span class="fa fa-search-minus"></span>
                </span>
              </button>
            </div>

            <div class="btn-group">
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
                  <span class="fa fa-arrow-left"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="10" data-second-option="0" title="Move Right">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
                  <span class="fa fa-arrow-right"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
                  <span class="fa fa-arrow-up"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="move" data-option="0" data-second-option="10" title="Move Down">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
                  <span class="fa fa-arrow-down"></span>
                </span>
              </button>
            </div>

            <div class="btn-group">
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="-45" title="Rotate Left">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
                  <span class="fa fa-undo-alt"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="rotate" data-option="45" title="Rotate Right">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
                  <span class="fa fa-redo-alt"></span>
                </span>
              </button>
            </div>

            <div class="btn-group">
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
                  <span class="fa fa-arrows-alt-h"></span>
                </span>
              </button>
              <button type="button" class="btn bg-gradient-primary btn-lg" data-method="scaleY" data-option="-1" title="Flip Vertical">
                <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
                  <span class="fa fa-arrows-alt-v"></span>
                </span>
              </button>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.js"></script>
<script>
  /*   document.querySelector('#id_area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#id_area").value;
    subarea.selector = document.querySelector("#id_subarea");
    subarea.getSubareasByArea();
  }; */
  /* document.querySelector('#id_state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#id_state').value;
    cities.selector = document.querySelector('#id_city');
    cities.getCitiesByState();
  } */

  window.onload = function() {
    if (document.querySelector("#id_state").value != '' && document.querySelector("#id_city").value == '') {
      let cities = new City();
      cities.id_state = document.querySelector('#id_state').value;
      cities.selector = document.querySelector('#id_city');
      cities.getCitiesByState();
    }
    if (document.querySelector('#id_area').value != '' && document.querySelector('#id_subarea'.value == '')) {
      let subarea = new Subarea();
      subarea.id_area = document.querySelector("#id_area").value;
      subarea.selector = document.querySelector("#id_subarea");
    }
  }
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'), {
    linear: false,
    animation: true
  })
    var form = document.querySelector('#cv-maker');

    var inputs = form.getElementsByTagName('input');

      
    function generarCV () {
      var form = document.querySelector('#cv-maker');
      var formData = new FormData(form);
      let xhr = new XMLHttpRequest();
      xhr.open('POST', '../Resume/creator');
      xhr.send(formData);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          let r = this.responseText;
          console.log(r);
          try {
            document.getElementById("pdf-container").innerHTML = '';
            var row = document.createElement('div');
            row.classList.add('row');

            pdfjsLib.getDocument({
                data: atob(r)
              })
              .promise.then(function(pdf) {
                var numPages = pdf.numPages;
                for (var pageNumber = 1; pageNumber <= numPages; pageNumber++) {
                  pdf.getPage(pageNumber).then(function(page) {
                    var col = document.createElement('div');
                    col.classList.add('col-sm-8');
                    col.classList.add('mt-3');

                    var scale = 0.7;
                    var viewport = page.getViewport({
                      scale: scale
                    });

                    var canvas = document.createElement("canvas");
                    var context = canvas.getContext("2d");
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    canvas.addEventListener('contextmenu', function(event) {
                      event.preventDefault();
                    });

                    var renderContext = {
                      canvasContext: context,
                      viewport: viewport
                    };

                    page.render(renderContext).promise.then(function() {
                      col.appendChild(canvas);
                      row.appendChild(col);
                    });
                  });
                }
                document.querySelector('#pdf-container').appendChild(row);
              });

          } catch (error) {}

        }
      }
    }
    generarCV();
    setInterval(generarCV, 10000);

    /* for (var i = 0; i < inputs.length; i++) {
      var input = inputs[i];

      if (input.tagName.toLowerCase() === 'input' && input.type !== 'hidden') {
        input.addEventListener('blur', function() {
          generarCV();
        });
      }
    } */
    var new_image = document.querySelector('#modal_imagen img');
    var cropper;
    var optionsImgs = {
      movable: true,
      zoomable: true,
      scalable: true,
      viewMode: 0,
      rotatable: true,
      autoCropArea: 1,
      aspectRatio: 1/1
      //preview:'.preview'
    }

    $('#modal_imagen').on('shown.bs.modal', function() {
      cropper = new Cropper(new_image, optionsImgs);
    }).on('hidden.bs.modal', function() {
      cropper.destroy();
      cropper = null;
    });
    document.querySelector('#cv-maker').addEventListener('change', e => {
      if (e.target.classList.contains('btn-upload-photo') || e.target.parentElement.classList.contains('btn-upload-photo')) {
        var new_image = document.querySelector('#modal_imagen img');
        console.log(e.target.files);
        var files = e.target.files;
        var done = function(url) {
          new_image.src = url;
          $('#modal_imagen').modal({
            backdrop: 'static',
            keyboard: false
          });
        };

        if (files && files.length > 0) {
          reader = new FileReader();
          reader.onload = function(e) {
            done(reader.result);
          };
          reader.readAsDataURL(files[0]);
        }
      }
      if (e.target.classList.contains('id_state')) {
        console.log(e.target)
        console.log(e.target.parentElement.parentElement.children[1]);
        let cities = new City();
        cities.id_state = e.target.value;
        cities.selector = e.target.parentElement.parentElement.children[1].children[1];
        cities.getCitiesByState();
      }
      if (e.target.classList.contains('id_area')) {
        let subarea = new Subarea();
        subarea.id_area = e.target.value;
        subarea.selector = e.target.parentElement.parentElement.children[1].children[1];
        subarea.getSubareasByArea();
      }
      e.stopPropagation();
    })
    document.querySelector('#cv-maker').addEventListener('click', e => {
      e.preventDefault();
      console.log(e)
    });
    document.querySelector('#header-part').addEventListener('click', e => {
      if (e.target.classList.contains('btn-edit-photo') || e.target.parentElement.classList.contains('btn-edit-photo')) {
        let image = document.querySelector('#modal_imagen img');
        image.src = '';
        image.style.display = 'none';
        let foto = document.querySelector('#cv-maker img');
        image.src = foto.src;
        image.style.display = 'block';
        $('#modal_imagen').modal('show');
        let cropper;
        $('#modal_imagen').on('shown.bs.modal', function(){
            cropper = null;
            cropper = new Cropper(image, {
                movable: true,
                zoomable: true,
                scalable: true,
                viewMode: 0,
                rotatable: true,
                preview:'.preview',
                ready: function(e){
                    document.querySelectorAll('#modal_imagen .btn-primary')[0].addEventListener('click', e => {
                        cropper.rotate(-45);
                    })
                
                    document.querySelectorAll('#modal_imagen .btn-primary')[1].addEventListener('click', e => {
                        cropper.rotate(45);
                    })
                }
            });
            
        }).on('hidden.bs.modal', function(){
            cropper.destroy();
            cropper = null;
        });
      }

      if (e.target.classList.contains('btn-delete-photo') || e.target.parentElement.classList.contains('btn-delete-photo')) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', '../Candidato/delete_image');
        let data = `Objeto=1`;
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send(data);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            let r = this.responseText;
            console.log(r);
            try {
              let json_app = JSON.parse(r);
              if (json_app.status == 1) {
                document.querySelector('#cv-maker img').src = json_app.imagen;
                document.querySelector('#cv-maker  div.btn-group.btn-group-xs button.btn.btn-xs.btn-info.btn-edit-photo').remove();
                document.querySelector('#cv-maker  div.btn-group.btn-group-xs button.btn.btn-xs.btn-danger.btn-delete-photo').remove();
              }
            } catch (error) {
              console.log(error);
            }
          }
        }
      }
      e.stopPropagation();
    })
    document.querySelector('#modal_imagen').onsubmit = function(e) {
      e.preventDefault();


      canvas = cropper.getCroppedCanvas({
        maxWidth: 500,
        maxHeight: 500,
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high'
      });

      canvas.toBlob(function(blob) {
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function() {
          var base64data = reader.result;

          let xhr = new XMLHttpRequest();
          xhr.open('POST', '../Candidato/image');
          let data = `Objeto=${base64data}`;
          xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
          xhr.send(data);
          xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
              let r = this.responseText;
              console.log(r);
              try {
                let json_app = JSON.parse(r);
                if (json_app.status == 1) {
                  document.querySelector('#cv-maker img').src = json_app.imagen;
                  if (!!document.querySelector('#cv-maker  div.btn-group.btn-group-xs button.btn.btn-xs.btn-info.btn-edit-photo') === false) {
                    let btn_info = document.createElement('button');
                    btn_info.classList.add('btn');
                    btn_info.classList.add('btn-xs');
                    btn_info.classList.add('btn-info');
                    btn_info.classList.add('btn-edit-photo');
                  }
                  if (!!document.querySelector('#cv-maker  div.btn-group.btn-group-xs button.btn.btn-xs.btn-danger.btn-delete-photo') === false) {
                    
                  }
                  generarCV(form);
                  $('#modal_imagen').modal('hide');
                }
              } catch (error) {
                console.log(error);
              }
            }
          }
        };
      });
    }
    document.querySelector('#content-experiences').addEventListener('input', e => {
      if (e.target.name == 'position_experience[]') {
        if (e.target.value != '')
          e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = e.target.value;
        else
        e.target.parentElement.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = 'No especificado'
      }
    });
    document.querySelector('#content-experiences').addEventListener('click', e => {
      if (e.target.name == 'still_works_experience[]') {
        if (e.target.checked) {
          e.target.parentElement.parentElement.children[1].children[0].style.display = 'none';
          e.target.parentElement.parentElement.children[1].children[0].value = null;
        } else {
          e.target.parentElement.parentElement.children[1].children[0].style.display = '';
        }
      }
    })
    let experienceCounter = document.querySelectorAll('#content-experiences .card').length + 1;
    document.querySelector('#btn-add-experience').addEventListener('click', e => {
      let states = document.querySelectorAll('#id_state option');

      let statesText = '';
      states.forEach((i) => {
        if (i.value > 0)
          statesText += `<option value="${i.value}">${i.textContent}</option>`;
      })

      let areas = document.querySelectorAll('#id_area option');

      let areasText = '';
      areas.forEach((i) => {
        if (i.value > 0)
          areasText += `<option value="${i.value}">${i.textContent}</option>`;
      })

      let experience = `
        <div class="card-header">
          <h4 class="card-title w-100">
            <button class="btn btn-link" data-toggle="collapse" data-target="#experience${experienceCounter}" aria-expanded="false" aria-controls="experience${experienceCounter}">No especificada</button>
          </h4>
        </div>
        <div id="experience${experienceCounter}" class="collapse show">
          <div class="card-body">
            <input type="hidden" name="experience_id[]" value="${experienceCounter}">
            <div class="form-row">
              <div class="form-group col">
                <label for="position_experience" class="col-form-label">Puesto</label>
                <input type="text" name="position_experience[]" class="form-control">
              </div>
              <div class="form-group col">
                <label for="enterprise_experience" class="col-form-label">Empresa</label>
                <input type="text" name="enterprise_experience[]" class="form-control">
              </div>
            </div>
            <div class=" form-row">
              <div class="form-group col">
                <label for="id_area_experience" class="col-form-label">Área del puesto</label>
                <select name="id_area_experience[]" class="form-control select2 id_area">
                  <option disabled selected="selected"></option>
                  ${areasText}
                </select>
              </div>
              <div class="form-group col">
                <label for="id_subarea_experience" class="col-form-label">Subarea</label>
                <select name="id_subarea_experience[]" class="form-control select2 id_subarea">
                    <option disabled selected="selected"></option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="id_state_experience" class="col-form-label">Estado</label>
                <select name="id_state_experience[]" class="form-control select2 id_state">
                  <option disabled selected="selected"></option>
                  ${statesText}
                </select>
              </div>
              <div class="form-group col">
                <label for="id_city_experience" class="col-form-label">Ciudad</label>
                <select name="id_city_experience[]" class="form-control select2 id_city">
                    <option disabled selected="selected"></option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="start_date_experience" class="col-form-label">Periodo</label>
                <div class="col form-row">
                  <div class="form-group col">
                    <input type="date" name="start_date_experience[]" class="form-control">
                  </div>
                  <div class="form-group col">
                    <input type="date" name="end_date_experience[]" class="form-control">
                  </div>
                  <div class="form-group col text-center">
                    <input type="checkbox" name="still_works_experience[]" class="form-check-input">
                    <label for="still_works_experience" class="form-check-label">¿Aún trabaja?</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="review" class="col-form-label">Breve reseña del puesto</label>
                <textarea name="review_experience[]" class="form-control" rows="5"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="activity1" class="col-form-label">Logro o actividad 1</label>
                  <input type="text" name="activity1[]" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="activity2" class="col-form-label">Logro o actividad 2</label>
                  <input type="text" name="activity2[]" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="activity3" class="col-form-label">Logro o actividad 3</label>
                  <input type="text" name="activity3[]" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="activity4" class="col-form-label">Logro o actividad 4</label>
                  <input type="text" name="activity4[]" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      let div = document.createElement('div');
      div.classList.add('card');
      div.innerHTML = experience;
      document.querySelector('#content-experiences').appendChild(div);
      experienceCounter++;
    })
    document.querySelector('#content-additional-preparation').addEventListener('input', e => {
      if (e.target.name == 'preparation_course[]') {
        if (e.target.value != '')
          e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = e.target.value;
        else
        e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = 'No especificado'
      }
    });
    let preparationCounter = document.querySelectorAll('#content-additional-preparation .card').length + 1;
    document.querySelector('#btn-add-additional-preparation').addEventListener('click', e => {
      let preparations = document.querySelectorAll('#preparation_level option');

      let preparationsText = '';
      preparations.forEach((i) => {
        if (i.value > 0)
          preparationsText += `<option value="${i.value}">${i.textContent}</option>`;
      })

      let preparation = `
        <div class="card-header"> 
          <h4 class="card-title w-100">
            <button class="btn btn-link" data-toggle="collapse" data-target="#preparation${preparationCounter}" aria-expanded="false" aria-controls="preparation${preparationCounter}">No especificado</button>
          </h4>
        </div>
        <div id="preparation${preparationCounter}" class="collapse show">
          <div class="card-body">
            <input type="hidden" name="preparation_id[]" value="${preparationCounter}"> 
            <div class="form-group">
              <label for="type" class="col-form-label">Tipo de formación</label>
              <select name="preparation_level[]" class="form-control">
                <option hidden selected value=""></option>
                ${preparationsText}
              </select>
            </div>
            <div class="form-group">
              <label for="course" class="col-form-label">Nombre de la formación</label>
              <input type="text" name="preparation_course[]" class="form-control">
            </div>
            <div class="form-group">
              <label for="institution" class="col-form-label">Institución</label>
              <input type="text" name="preparation_institution[]" class="form-control">
            </div>
            <div class="form-group">
              <label for="start_date" class="col-form-label">Periodo</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="date" name="preparation_start_date[]" class="form-control">
                </div>
                <div class="col-md-6">
                  <input type="date" name="preparation_end_date[]" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      let div = document.createElement('div');
      div.classList.add('card');
      div.innerHTML = preparation;
      document.querySelector('#content-additional-preparation').appendChild(div);
      preparationCounter++;
    })
    document.querySelector('#content-languages').addEventListener('change', e => {
      if (e.target.name == 'language[]') {
        if (e.target.value != '')
          e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = e.target[e.target.selectedIndex].text;
        else
          e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = 'No seleccionado';
      }
      
    });
    let languageCounter = document.querySelectorAll('#content-languages .card').length + 1;
    document.querySelector('#btn-add-language').addEventListener('click', e => {
      let languages = document.querySelectorAll('#language option');

      let languagesText = '';
      languages.forEach((i) => {
        if (i.value > 0)
          languagesText += `<option value="${i.value}">${i.textContent}</option>`;
      })
      let languageLevel = document.querySelectorAll('#language_level option');

      let languageLevelText = '';
      languageLevel.forEach((i) => {
        if (i.value > 0)
          languageLevelText += `<option value="${i.value}">${i.textContent}</option>`;
      })
      let language = `
        <div class="card-header">
          <h4 class="card-title w-100">
            <button class="btn btn-link" data-toggle="collapse" data-target="#language${languageCounter}" aria-expanded="false" aria-controls="language${languageCounter}">No especificado</button>
          </h4>
        </div>
        <div id="language${languageCounter}" class="collapse show">
          <div class="card-body">
            <input type="hidden" name="language_id[]" value="${languageCounter}">
            <div class="form-group">
              <label for="language" class="col-form-label">Idioma:</label>
              <select name="language[]" class="form-control">
                <option disabled selected>Selecciona un idioma</option>
                ${languagesText}
              </select>
            </div>
            <div class="form-group">
              <label for="language_level" class="col-form-label">Nivel:</label>
              <select name="language_level[]" class="form-control select2">
                <option disabled selected="">Selecciona el nivel</option>
                ${languageLevelText}
              </select>
            </div>
            <div class="form-group">
              <label for="language_institution" class="col-form-label">Institución</label>
              <input type="text" name="language_institution[]" class="form-control">
            </div>
            <div class="form-group">
              <label for="language_start_date" class="col-form-label">Periodo</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="date" name="language_start_date[]" class="form-control">
                </div>
                <div class="col-md-6">
                  <input type="date" name="language_end_date[]" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      let div = document.createElement('div');
      div.classList.add('card');
      div.innerHTML = language;
      document.querySelector('#content-languages').appendChild(div);
      languageCounter++;
    })
    
    document.querySelector('#content-aptitudes').addEventListener('input', e => {
      if (e.target.name == 'aptitude[]') {
        if (e.target.value != '')
          e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = e.target.value;
        else
        e.target.parentElement.parentElement.parentElement.parentElement.children[0].children[0].children[0].textContent = 'No especificado'
      }
    });
    let aptitudeCounter = document.querySelectorAll('#content-aptitudes .card').length + 1;
    document.querySelector('#btn-add-aptitude').addEventListener('click', e => {
      let aptitude = `
        <div class="card-header">
          <h4 class="card-title w-100">
            <button class="btn btn-link" data-toggle="collapse" data-target="#aptitude${aptitudeCounter}" aria-expanded="false" aria-controls="aptitude${aptitudeCounter}">No especificado</button>
          </h4>
        </div>
        <div id="aptitude${aptitudeCounter}" class="collapse show">
          <div class="card-body">
            <input type="hidden" name="aptitude_id[]" value="${aptitudeCounter}">
            <div class="form-group">
              <label for="aptitude" class="col-form-label">Aptitud:</label>
              <input type="text" name="aptitude[]" class="form-control">
            </div>
            <div class="form-group">
              <label for="aptitude_level" class="col-form-label">Nivel</label>
              <input type="range" name="aptitude_level[]" min="0" max="10" class="form-control">
            </div>
          </div>
        </div>
      `;
      let div = document.createElement('div');
      div.classList.add('card');
      div.innerHTML = aptitude;
      document.querySelector('#content-aptitudes').appendChild(div);
      aptitudeCounter++;
    })
  });
</script>