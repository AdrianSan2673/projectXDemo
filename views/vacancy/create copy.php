<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4>
                  <?php if (isset($_GET['id']) && !empty($vacante)): ?>
                    <?php echo $vacante->vacancy ?>
                  <?php else: ?>
                    Nueva vacante
                  <?php endif ?>
                </h4>
            </div>         
          </div>
        </div>
        <div class="row">
          <div class="col-sm-2 mr-auto">
            <a class="btn btn-secondary btn-block float-left" href="<?=base_url?>vacante/index">Regresar</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- form start -->
            <form id="vacancy-form" method="POST">
            <?php if (isset($_GET['id']) && isset($vacante) && is_object($vacante)): ?>
              <input type="hidden" name="id" id="id" value="<?=$_GET['id']?>">
            <?php endif ?>
              <!-- general form elements -->

              <?php if (Utils::isCustomer()): ?>
                <div class="card card-success">
                  <div class="card-header">
                    <h4 class="card-title">Contacto</h4>
                  </div>
                  <!-- /.card-header -->
                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer" class="col-form-label">Empresa</label>
                          <select name="customer" id="customer" class="form-control" required disabled>
                            <option disabled selected="selected" value="<?=$cliente->id?>"><?=$cliente->customer?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer_contact" class="col-form-label">Contacto:</label>
                          <select name="customer_contact" id="customer_contact" class="form-control" disabled>
                              <option disabled selected="selected" value="<?=$contacto->id?>"><?=$contacto->first_name.' '.$contacto->last_name?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="business_name" class="col-form-label">Razón social</label>
                          <select name="business_name" id="business_name" class="form-control">
                            <?= $BNs = Utils::showBNByCustomer($id_customer);?>
                            <?php foreach ($BNs as $bn): ?>
                              <option value="<?= $bn['id'] ?>" <?=isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name']?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="recruiter" class="col-form-label">Reclutador</label>
                          <?php $recruiters = Utils::showRecruiters(); ?>
                          <select name="recruiter" id="recruiter" class="form-control select2">
                            <option disabled selected="selected"></option>
                            <?php foreach ($recruiters as $recruiter): ?>
                              <option value="<?=$recruiter['id']?>" <?=isset($vacante) && is_object($vacante) && $recruiter['id'] == $vacante->id_recruiter ? 'selected' : ''; ?>><?=$recruiter['first_name'].' '.$recruiter['last_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    
                  </div>
                  <!-- /.card-body -->
                </div>
              <?php else: ?>
                <div class="card card-success">
                  <div class="card-header">
                    <h4 class="card-title">Contacto</h4>
                  </div>
                  <!-- /.card-header -->
                  
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer" class="col-form-label">Empresa</label>
                          <?php $customers = Utils::showCustomers(); ?>
                          <select name="customer" id="customer" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($customers as $customer): ?>
                              <option value="<?=$customer['id']?>" <?=isset($vacante) && is_object($vacante) && $customer['id'] == $vacante->id_customer ? 'selected' : ''; ?>><?=$customer['customer'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer_contact" class="col-form-label">Contacto:</label>
                          <select name="customer_contact" id="customer_contact" class="form-control select2">
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)): ?>
                              <?= $contacts = Utils::showContactsByCustomer($vacante->id_customer);?>
                              <?php foreach ($contacts as $contact): ?>
                                <option value="<?= $contact['id'] ?>" <?=isset($vacante) && is_object($vacante) && $contact['id'] == $vacante->id_customer_contact ? 'selected' : ''; ?>><?= $contact['first_name'].' '.$contact['last_name'] ?></option>
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
                          <label for="business_name" class="col-form-label">Razón social</label>
                          <select name="business_name" id="business_name" class="form-control">
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)): ?>
                            <?= $BNs = Utils::showBNByCustomer($vacante->id_customer);?>
                            <?php foreach ($BNs as $bn): ?>
                              <option value="<?= $bn['id'] ?>" <?=isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>><?= $bn['business_name']?></option>
                            <?php endforeach ?>
                          <?php else: ?>
                            <option disabled selected="selected"></option>
                          <?php endif ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="recruiter" class="col-form-label">Reclutador</label>
                          <?php $recruiters = Utils::showRecruiters(); ?>
                          <select name="recruiter" id="recruiter" class="form-control select2">
                            <option disabled selected="selected"></option>
                            <?php foreach ($recruiters as $recruiter): ?>
                              <option value="<?=$recruiter['id']?>" <?=isset($vacante) && is_object($vacante) && $recruiter['id'] == $vacante->id_recruiter ? 'selected' : ''; ?>><?=$recruiter['first_name'].' '.$recruiter['last_name'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    
                    
                  </div>
                  <!-- /.card-body -->
                </div>
              <?php endif ?>
                
              <div class="card card-success">
                <div class="card-header">
                  <h4 class="card-title">Perfil del Puesto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="vacancy" class="col-form-label">Nombre del puesto:</label>
                        <input type="text" name="vacancy" id="vacancy" maxlength="255" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->vacancy : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group row">
                        <label for="department" class="col-form-label">Departamento:</label>
                        <input type="text" name="department" id="department" maxlength="255" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->department : ''; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="report_to" class="col-form-label">Puesto al que le reportaría:</label>
                        <input type="text" name="report_to" id="report_to" class="form-control" maxlength="255" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->report_to : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="personal_in_charge" class="col-form-label">¿Tendrá personal a cargo?</label>
                        <select name="personal_in_charge" id="personal_in_charge" class="form-control" required>
                          <option disabled selected></option>
                          <option value="1" <?=isset($vacante) && is_object($vacante) && $vacante->personal_in_charge==1 ? 'selected' : ''; ?>>Sí</option>
                          <option value="0" <?=isset($vacante) && is_object($vacante) && $vacante->personal_in_charge==0 ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="area" class="col-form-label">Area</label>
                        <?php $areas = Utils::showAreas();?>
                        <select name="area" id="area" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($areas as $area) : ?>
                                <option value="<?= $area['id'] ?>" <?=isset($vacante) && is_object($vacante) && $area['id'] == $vacante->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="subarea" class="col-form-label">Subarea</label>
                        <select name="subarea" id="subarea" class="form-control select2" required>
                        <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_area)): ?>
                          <?= $subareas = Utils::showSubareasByArea($vacante->id_area);?>
                          <?php foreach ($subareas as $subarea): ?>
                            <option value="<?= $subarea['id'] ?>" <?=isset($vacante) && is_object($vacante) && $subarea['id'] == $vacante->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
                          <?php endforeach ?>
                        <?php else: ?>
                          <option disabled selected="selected"></option>
                        <?php endif ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-success">
                <div class="card-header">
                  <h4 class="card-title">Descripción del Puesto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="education_level" class="col-form-label">Escolaridad requerida:</label>
                        <?php $education_levels = Utils::showEducationLevels(); ?>
                        <select name="education_level" id="education_level" class="form-control" required>
                          <option disabled selected="selected"></option>
                          <?php foreach ($education_levels as $level): ?>
                            <option value="<?=$level['id']?>" <?=isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_education_level ? 'selected' : ''; ?>><?=$level['level']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position_number" class="col-form-label">Número de posiciones</label>
                        <input type="number" name="position_number" id="position_number" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->position_number : ''; ?>">
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="experience_years" class="col-form-label">Años de experiencia necesarios</label>
                        <input type="number" name="experience_years" id="experience_years" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->experience_years : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="experience" class="col-form-label">¿Necesita experiencia en algún giro? Especificar</label>
                        <textarea name="experience" id="experience" rows="5" class="form-control"><?=isset($vacante) && is_object($vacante) ? $vacante->experience : ''; ?></textarea>
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Rango de edad:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="number" name="age_min" id="age_min" class="form-control" placeholder="Mínimo" required min="18" max="80" value="<?=isset($vacante) && is_object($vacante) ? $vacante->age_min : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="age_max" id="age_max" class="form-control" placeholder="Máximo" required min="18" max="80" value="<?=isset($vacante) && is_object($vacante) ? $vacante->age_max : ''; ?>">
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Sexo:</label>
                        <?php $genders = Utils::showGenders(); ?>
                        <select name="gender" id="gender" class="form-control" required>
                          <option disabled selected></option>
                          <?php foreach ($genders as $gender): ?>
                            <option value="<?=$gender['id']?>" <?=isset($vacante) && is_object($vacante) && $gender['id'] == $vacante->id_gender ? 'selected' : ''; ?>><?=$gender['gender']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="civil_status" class="col-form-label">Estado civil:</label>
                        <?php $civil_status = Utils::showCivilStatus(); ?>
                        <select name="civil_status" id="civil_status" class="form-control select2" required>
                          <option disabled selected="selected"></option>
                          <?php foreach ($civil_status as $status): ?>
                            <option value="<?=$status['id']?>" <?=isset($vacante) && is_object($vacante) && $status['id'] == $vacante->id_status ? 'selected' : ''; ?>><?=$status['status']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="salary" class="col-form-label">Idiomas:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <?php $languages = Utils::showLanguages(); ?>
                            <select name="language" id="language" class="form-control">
                              <option value="0" selected>Selecciona un idioma</option>
                              <?php foreach ($languages as $language): ?>
                                <option value="<?=$language['id']?>" <?=isset($vacante) && is_object($vacante) && $language['id'] == $vacante->id_language ? 'selected' : ''; ?>><?=$language['language']?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <?php $language_levels = Utils::showLanguageLevels(); ?>
                            <select name="language_level" id="language_level" class="form-control">
                              <option value="0" selected>Selecciona el nivel</option>
                              <?php foreach ($language_levels as $level): ?>
                                <option value="<?=$level['id']?>" <?=isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_language_level ? 'selected' : ''; ?>><?=$level['language_level']?></option>
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
                        <label for="salary" class="col-form-label">Sueldo base mensual:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="number" name="salary_min" id="salary_min" class="form-control" placeholder="Mínimo" min="0" value="<?=isset($vacante) && is_object($vacante) ? round($vacante->salary_min) : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="salary_max" id="salary_max" class="form-control" placeholder="Máximo" min="0" value="<?=isset($vacante) && is_object($vacante) ? round($vacante->salary_max) : ''; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="benefits" class="col-form-label">Prestaciones</label>
                        <textarea name="benefits" id="benefits" rows="5" class="form-control" required><?=isset($vacante) && is_object($vacante) ? $vacante->benefits : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="workdays" class="col-form-label">Días de trabajo:</label>
                        <input type="text" name="workdays" id="workdays" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->workdays : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="schedule" class="col-form-label">Horario</label>
                        <input type="text" name="schedule" id="schedule" class="form-control" required value="<?=isset($vacante) && is_object($vacante) ? $vacante->schedule : ''; ?>">
                      </div>
                    </div>
                  </div>    
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="state" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates();?>
                        <select name="state" id="state" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            <?php foreach ($states as $state) : ?>
                                <option value="<?= $state['id'] ?>" <?=isset($vacante) && is_object($vacante) && $state['id'] == $vacante->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="city" class="col-form-label">Ciudad</label>
                        <select name="city" id="city" class="form-control select2" required>
                        <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_state)): ?>
                          <?= $cities = Utils::showCitiesByState($vacante->id_state);?>
                          <?php foreach ($cities as $city): ?>
                            <option value="<?= $city['id'] ?>" <?=isset($vacante) && is_object($vacante) && $city['id'] == $vacante->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
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
                        <label for="requirements" class="col-form-label">Requisitos:</label>
                        <textarea name="requirements" id="requirements" rows="5" class="form-control" required><?=isset($vacante) && is_object($vacante) ? $vacante->requirements : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="functions" class="col-form-label">Funciones:</label>
                        <textarea name="functions" id="functions" rows="5" class="form-control" required><?=isset($vacante) && is_object($vacante) ? $vacante->functions : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="skills" class="col-form-label">Habilidades:</label>
                        <textarea name="skills" id="skills" class="form-control" rows="5" required><?=isset($vacante) && is_object($vacante) ? $vacante->skills : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="technical_knowledge" class="col-form-label">Conocimientos técnicos:</label>
                        <textarea name="technical_knowledge" id="technical_knowledge" rows="5" class="form-control" required><?=isset($vacante) && is_object($vacante) ? $vacante->technical_knowledge : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card card-success">
                <div class="card-header">
                  <h4 class="card-title">
                    Proceso del cliente
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="how_many_interviews" class="col-form-label">¿Cuántas entrevistas prevee se realicen?</label>
                        <input type="number" name="how_many_interviews" id="how_many_interviews" class="form-control" required min="0" value="<?=isset($vacante) && is_object($vacante) ? $vacante->how_many_interviews : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="accept_reentry" class="col-form-label">¿Se aceptan reingresos?</label>
                        <select name="accept_reentry" id="accept_reentry" class="form-control" required>
                          <option disabled selected></option>
                          <option value="1" <?=isset($vacante) && is_object($vacante) && $vacante->accept_reentry == 1 ? 'selected' : ''; ?>>Sí</option>
                          <option value="0" <?=isset($vacante) && is_object($vacante) && $vacante->accept_reentry == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="col-form-label">
                        <label for="offer_transportation" class="col-form-label">¿Ofrecen transporte?</label>
                        <select name="offer_transportation" id="offer_transportation" class="form-control" required>
                          <option disabled selected></option>
                          <option value="1" <?=isset($vacante) && is_object($vacante) && $vacante->offer_transportation == 1 ? 'selected' : ''; ?>>Sí</option>
                          <option value="0" <?=isset($vacante) && is_object($vacante) && $vacante->offer_transportation == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-form-label">
                        <label for="do_medical_exam" class="col-form-label">¿Realizan exámen médico?</label>
                        <select name="do_medical_exam" id="do_medical_exam" class="form-control" required>
                          <option disabled selected></option>
                          <option value="1" <?=isset($vacante) && is_object($vacante) && $vacante->do_medical_exam == 1 ? 'selected' : ''; ?>>Sí</option>
                          <option value="0" <?=isset($vacante) && is_object($vacante) && $vacante->do_medical_exam == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <a class="btn btn-secondary float-left" href="<?=base_url?>vacante/index">Regresar</a>
                <?php if (isset($_GET['id']) && isset($vacante) && is_object($vacante)): ?>
                  <button type="submit" class="btn btn-info float-right" id="editSubmit">Editar vacante</button>
                <?php else: ?>
                  <button type="submit" class="btn btn-success float-right" id="registerSubmit">Crear vacante</button>
                <?php endif ?>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script src="<?=base_url?>app/customercontact.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/businessname.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/vacancy.js?v=<?=rand()?>"></script>
<script src="<?=base_url?>app/recruitercustomers.js?v=<?=rand()?>"></script>
<script>
  document.querySelector('#customer').onchange = function() {
    let contact = new CustomerContact();
    contact.getContacts();

    let business_name = new BusinessName();
    business_name.getBusinessName();

    //let recruiter_customer = new RecruiterCustomer();
    //recruiter_customer.getRecruiterByCustomer();
  };

  document.querySelector('#state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#state').value;
    cities.selector = document.querySelector('#city');
    let ciudades = cities.getCitiesByState();
  };
  document.querySelector('#area').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#area").value;
    subarea.selector = document.querySelector("#subarea");
    subarea.getSubareasByArea();
  };
</script>
<?php if (isset($_GET['id'])): ?>
<script type="text/javascript">
  document.querySelector('#vacancy-form #editSubmit').addEventListener('submit', e =>{
    e.preventDefault();
    let vacancy = new Vacancy();
    vacancy.update();
  });
</script>
<?php else: ?>
<script type="text/javascript">
  document.querySelector('#vacancy-form').addEventListener('submit', e =>{
    e.preventDefault();
    document.querySelector("#registerSubmit").disabled = true;
    let vacancy = new Vacancy();
    vacancy.save();
  });
</script>
<?php endif ?>
