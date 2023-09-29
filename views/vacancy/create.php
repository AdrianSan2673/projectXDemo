<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-5">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left mb-2">
              <li class="breadcrumb-item"><a href="<?= base_url ?>">Inicio</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url . "vacante/index" ?>">Vacantes</a></li>
              <li class="breadcrumb-item active">
                <?= isset($_GET['id']) && !empty($vacante) ? $vacante->vacancy : 'Nueva vacante' ?></li>
            </ol>
          </div>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <h1><?= isset($_GET['id']) && !empty($vacante) ? $vacante->vacancy : 'Nueva vacante' ?></h1>
            </div>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- form start -->
            <form id="vacancy-form" method="POST">
              <?php if (isset($_GET['id']) && isset($vacante) && is_object($vacante)) : ?>
                <input type="hidden" name="id" id="id" value="<?= $_GET['id'] ?>">
              <?php endif ?>
              <!-- general form elements -->

              <?php if (Utils::isCustomer()) : ?>
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
                          <select name="customer" id="customer" class="form-control" required readonly>
                            <option readonly selected="selected" value="<?= $cliente->id ?>">
                              <?= $cliente->customer ?></option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer_contact" class="col-form-label">Contacto</label>
                          <select name="customer_contact" id="customer_contact" class="form-control" readonly>
                            <option readonly selected="selected" value="<?= $contacto->id ?>">
                              <?= $contacto->first_name . ' ' . $contacto->last_name ?>
                            </option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="business_name" class="col-form-label">Razón social</label>
                          <select name="business_name" id="business_name" class="form-control">
                            <?= $BNs = Utils::showBNByCustomer($id_customer); ?>
                            <?php foreach ($BNs as $bn) : ?>
                              <option value="<?= $bn['id'] ?>" <?= isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>>
                                <?= $bn['business_name'] ?></option>
                            <?php endforeach ?>
                            <option value>Pendiente</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              <?php else : ?>
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
                            <?php foreach ($customers as $customer) : ?>
                              <option value="<?= $customer['id'] ?>" <?= isset($vacante) && is_object($vacante) && $customer['id'] == $vacante->id_customer ? 'selected' : ''; ?>>
                                <?= $customer['customer'] ?></option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="customer_contact" class="col-form-label">Contacto</label>
                          <select name="customer_contact" id="customer_contact" class="form-control">
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)) : ?>
                              <?php $contacts = Utils::showContactsByCustomer($vacante->id_customer); ?>
                              <?php foreach ($contacts as $contact) : ?>
                                <option value="<?= $contact['id'] ?>" <?= isset($vacante) && is_object($vacante) && $contact['id'] == $vacante->id_customer_contact ? 'selected' : ''; ?>>
                                  <?= $contact['first_name'] . ' ' . $contact['last_name'] ?>
                                </option>
                              <?php endforeach ?>
                            <?php else : ?>
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
                            <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_customer)) : ?>
                              <?php $BNs = Utils::showBNByCustomer($vacante->id_customer); ?>
                              <?php foreach ($BNs as $bn) : ?>
                                <option value="<?= $bn['id'] ?>" <?= isset($vacante) && is_object($vacante) && $bn['id'] == $vacante->id_business_name ? 'selected' : ''; ?>>
                                  <?= $bn['business_name'] ?></option>
                              <?php endforeach ?>
                            <?php else : ?>
                              <option disabled selected="selected"></option>
                            <?php endif ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="recruiter" class="col-form-label">Reclutador</label>
                          <?php $recruiters = Utils::showRecruiters(); ?>
                          <select name="recruiter" id="recruiter" class="form-control">
                            <option disabled selected="selected"></option>
                            <?php foreach ($recruiters as $recruiter) : ?>
                              <option value="<?= $recruiter['id'] ?>" <?= isset($vacante) && is_object($vacante) && $recruiter['id'] == $vacante->id_recruiter ? 'selected' : ''; ?>>
                                <?= $recruiter['first_name'] . ' ' . $recruiter['last_name'] ?>
                              </option>
                            <?php endforeach ?>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
              <?php endif ?>

              <div class="card card-info">
                <div class="card-header">
                  <h4 class="card-title">Datos del Puesto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="<?= Utils::isSalesManager() || Utils::isSales() ? 'col-md-6'  : 'col-md-4' ?>">
                      <!-- gabo 17 abril quitar a ventas -->
                      <div class="form-group">
                        <label for="vacancy" class="col-form-label">Nombre del puesto</label>
                        <input type="text" name="vacancy" id="vacancy" maxlength="255" class="form-control" style="<?= Utils::isAdmin() || Utils::isAdmin()  ? ''  : 'required' ?>" value="<?= isset($vacante) && is_object($vacante) ? $vacante->vacancy : ''; ?>">
                        <!-- gabo 17 abril quitar a ventas -->
                      </div>
                    </div>
                    <div class=" <?= Utils::isSalesManager() || Utils::isSales() ? 'col-md-6'  : 'col-md-4' ?>">
                      <!-- gabo 17 abril quitar a ventas -->
                      <div class="form-group row">
                        <label for="department" class="col-form-label">Departamento</label>
                        <input type="text" name="department" id="department" maxlength="255" class="form-control" style="<?= Utils::isAdmin() ? ''  : 'required' ?>" value="<?= isset($vacante) && is_object($vacante) ? $vacante->department : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4" style="<?= Utils::isSalesManager() || Utils::isSales() ? 'display:none'  : '' ?>">
                      <!-- gabo 17 abril quitar a ventas -->
                      <div class="form-group">
                        <label for="type" class="col-form-label">Tipo de vacante</label>
                        <select name="type" id="type" class="form-control" style="<?= Utils::isSalesManager() || Utils::isSales()  ? ''  : 'required' ?>">
                          <option disabled selected>Selecciona el tipo</option>
                          <option value="1" <?= isset($vacante) && is_object($vacante) && $vacante->type == 1 ? 'selected' : ''; ?>>
                            Operativa</option>
                          <option value="2" <?= isset($vacante) && is_object($vacante) && $vacante->type == 2 ? 'selected' : ''; ?>>
                            Orden Común</option>
                          <option value="3" <?= isset($vacante) && is_object($vacante) && $vacante->type == 3 ? 'selected' : '' ?>>
                            Head Hunting</option>
                          <option value="4" <?= isset($vacante) && is_object($vacante) && $vacante->type == 4 ? 'selected' : '' ?>>
                            Iguala</option>

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4" style="display: none;">
                      <div class="form-group">
                        <label for="report_to" class="col-form-label">Puesto al que le
                          reportaría:</label>
                        <input type="text" name="report_to" id="report_to" class="form-control" maxlength="255" value="<?= isset($vacante) && is_object($vacante) ? $vacante->report_to : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4" style="display: none;">
                      <div class="form-group">
                        <label for="personal_in_charge" class="col-form-label">¿Tendrá personal
                          a cargo?</label>
                        <select name="personal_in_charge" id="personal_in_charge" class="form-control">
                          <option disabled selected></option>
                          <option value="1" <?= isset($vacante) && is_object($vacante) && $vacante->personal_in_charge == 1 ? 'selected' : ''; ?>>
                            Sí</option>
                          <option value="0" <?= isset($vacante) && is_object($vacante) && $vacante->personal_in_charge == 0 ? 'selected' : ''; ?>>
                            No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="area" class="col-form-label">Area</label>
                        <?php $areas = Utils::showAreas(); ?>
                        <select name="area" id="area" class="form-control select2" required>
                          <option disabled selected="selected">Selecciona departamento
                          </option>
                          <?php foreach ($areas as $area) : ?>
                            <option value="<?= $area['id'] ?>" <?= isset($vacante) && is_object($vacante) && $area['id'] == $vacante->id_area ? 'selected' : ''; ?>>
                              <?= $area['area'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="subarea" class="col-form-label">Subarea</label>
                        <select name="subarea" id="subarea" class="form-control select2" required>
                          <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_area)) : ?>
                            <?php $subareas = Utils::showSubareasByArea($vacante->id_area); ?>
                            <?php foreach ($subareas as $subarea) : ?>
                              <option value="<?= $subarea['id'] ?>" <?= isset($vacante) && is_object($vacante) && $subarea['id'] == $vacante->id_subarea ? 'selected' : ''; ?>>
                                <?= $subarea['subarea'] ?></option>
                            <?php endforeach ?>
                          <?php else : ?>
                            <option disabled selected="selected">Selecciona Subarea</option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>

                  </div>
                  <?php if (!Utils::isCustomer()) : ?>
                    <div class="row">
                      <div class="col-md-6" style="<?= Utils::isSalesManager() || Utils::isSales()  ? 'display:none'  : '' ?>">
                        <!-- gabo 17 abril quitar a ventas -->
                        <div class="form-group">
                          <label class="col-form-label" for="warranty_time">Tiempo de
                            Garantía</label>
                          <select class="form-control" name="warranty_time">
                            <option value="0" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 0 ? 'selected' : ''; ?>>
                              0 días</option>
                            <option value="15" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 15 ? 'selected' : ''; ?>>
                              15 días</option>
                            <option value="30" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 30 ? 'selected' : ''; ?>>
                              30 días</option>
                            <option value="45" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 45 ? 'selected' : ''; ?>>
                              45 días</option>
                            <option value="60" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 60 ? 'selected' : ''; ?>>
                              60 días</option>
                            <option value="90" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 90 ? 'selected' : ''; ?>>
                              90 días</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-form-label">Monto a facturar</label>
                          <input type="number" class="form-control" name="amount_to_invoice" value="<?= isset($vacante) && is_object($vacante) ? round($vacante->amount_to_invoice, 2) : 0 ?>" min="0" step="0.01">
                        </div>
                      </div>
                    </div>
                    <div class="form-row" style="<?= Utils::isSalesManager() || Utils::isSales()  ? 'display:none'  : '' ?>">
                      <!-- gabo 17 abril quitar a ventas -->
                      <div class="form-group col">
                        <label class="col-form-label" for="authorization_date">Fecha de
                          autorización</label>
                        <input type="datetime-local" name="authorization_date" class="form-control" value="<?= isset($vacante) && is_object($vacante) ? (isset($vacante->authorization_date) && !empty($vacante->authorization_date) ? date_format(date_create($vacante->authorization_date), 'Y-m-d\TH:i') : '')  : ''; ?>">
                      </div>
                      <div class="form-group col">
                        <label class="col-form-label" for="commitment_date">Fecha de compromiso de
                          envío</label>
                        <input type="date" name="commitment_date" class="form-control" value="<?= isset($vacante) && is_object($vacante) ? $vacante->commitment_date : ''; ?>">
                      </div>
                    </div>
                  <?php endif ?>

                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="state" class="col-form-label">Estado</label>
                        <?php $states = Utils::showStates(); ?>
                        <select name="state" id="state" class="form-control select2" required>
                          <option disabled selected="selected"></option>
                          <?php foreach ($states as $state) : ?>
                            <option value="<?= $state['id'] ?>" <?= isset($vacante) && is_object($vacante) && $state['id'] == $vacante->id_state ? 'selected' : ''; ?>>
                              <?= $state['state'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="city" class="col-form-label">Ciudad</label>
                        <select name="city" id="city" class="form-control select2" required>
                          <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_state)) : ?>
                            <?php $cities = Utils::showCitiesByState($vacante->id_state); ?>
                            <?php foreach ($cities as $city) : ?>
                              <option value="<?= $city['id'] ?>" <?= isset($vacante) && is_object($vacante) && $city['id'] == $vacante->id_city ? 'selected' : ''; ?>>
                                <?= $city['city'] ?></option>
                            <?php endforeach ?>
                          <?php else : ?>
                            <option disabled selected="selected"></option>
                          <?php endif ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 ">
                      <div class="form-group">
                        <label for="working_day" class="col-form-label">Jornada Semanal</label>
                        <select name="working_day" id="working_day" class="form-control" required>
                          <option disabled selected>Selecciona Jornada</option>
                          <option value="-48" <?= isset($vacante) && is_object($vacante) && '-48' == $vacante->working_day ? 'selected' : ''; ?>>
                            -48</option>
                          <option value="48" <?= isset($vacante) && is_object($vacante) && '48' == $vacante->working_day ? 'selected' : ''; ?>>
                            48</option>
                          <option value="+48" <?= isset($vacante) && is_object($vacante) && '+48' == $vacante->working_day ? 'selected' : ''; ?>>
                            +48</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="salary" class="col-form-label">Sueldo base mensual:</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="number" name="salary_min" id="salary_min" class="form-control" placeholder="Mínimo" min="0" value="<?= isset($vacante) && is_object($vacante) ? round($vacante->salary_min) : ''; ?>">
                          </div>
                          <div class="col-md-4">
                            <input type="number" name="salary_max" id="salary_max" class="form-control" placeholder="Máximo" min="0" value="<?= isset($vacante) && is_object($vacante) ? round($vacante->salary_max) : ''; ?>">
                          </div>

                          <div class="col-md-4">
                            <div class="row" style=" margin:0 auto;width:50%">
                              <input type="checkbox" name="telephone" style="width:35%" id="telephone" class="form-control " <?= isset($vacante) && is_object($vacante) && $vacante->telephoneCheck == 1 ? '' : 'checked'; ?>>
                              <label for="working_day" style="left:-2rem" class="col-form-label">Sin
                                teléfono</label>

                            </div>
                          </div>



                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row" style="<?= Utils::isSalesManager() || Utils::isSales()   ? 'display:none'  : '' ?>">
                    <!-- gabo 17 abril quitar a ventas -->
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="benefits" class="col-form-label">Prestaciones o
                          beneficios</label>
                        <textarea name="benefits" id="benefits" rows="8" class="form-control"> <?= isset($vacante) && is_object($vacante) ? $vacante->benefits : ''; ?></textarea>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="card card-orange">
                <div class="card-header">
                  <h4 class="card-title">Perfil del Puesto</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="education_level" class="col-form-label">Escolaridad*:</label>
                        <?php $education_levels = Utils::showEducationLevels(); ?>
                        <select name="education_level" id="education_level" class="form-control" required>
                          <option disabled selected="selected"></option>
                          <?php foreach ($education_levels as $level) : ?>
                            <option value="<?= $level['id'] ?>" <?= isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_education_level ? 'selected' : ''; ?>>
                              <?= $level['level'] ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="position_number" class="col-form-label">Número de
                          posiciones:</label>
                        <input type="number" name="position_number" id="position_number" min="0" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->position_number : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="experience_years" class="col-form-label">Experiencia</label>
                            <input type="number" name="experience_years" id="experience_years" min="0" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->experience_years : ''; ?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="experience_years" class="col-form-label">Años o
                              mesess</label>
                            <select name="experience_type" id="experience_type" class="form-control">
                              <option value="Años" <?= isset($vacante) && is_object($vacante) && $vacante->experience_type  == 'Años' ? 'selected' : ''; ?>>
                                Años</option>
                              <option value="Meses" <?= isset($vacante) && is_object($vacante) && $vacante->experience_type  == 'Meses' ? 'selected' : ''; ?>>
                                Meses</option>
                            </select>

                          </div>
                        </div>

                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="age" class="col-form-label">Rango de edad:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="number" name="age_min" id="age_min" class="form-control" placeholder="Mínimo" required min="18" max="80" value="<?= isset($vacante) && is_object($vacante) ? $vacante->age_min : ''; ?>">
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="age_max" id="age_max" class="form-control" placeholder="Máximo" required min="18" max="80" value="<?= isset($vacante) && is_object($vacante) ? $vacante->age_max : ''; ?>">
                          </div>
                        </div>

                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Sexo:</label>
                        <?php $genders = Utils::showGenders(); ?>
                        <select name="gender" id="gender" class="form-control" required>
                          <option hidden value="" selected></option>
                          <?php foreach ($genders as $gender) : ?>
                            <option value="<?= $gender['id'] ?>" <?= isset($vacante) && is_object($vacante) && $gender['id'] == $vacante->id_gender ? 'selected' : ''; ?>>
                              <?= $gender['gender'] ?></option>
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
                          <option hidden value="" selected></option>
                          <?php foreach ($civil_status as $status) : ?>
                            <option value="<?= $status['id'] ?>" <?= isset($vacante) && is_object($vacante) && $status['id'] == $vacante->id_civil_status ? 'selected' : ''; ?>>
                              <?= $status['status'] ?></option>
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
                              <option value="" selected disabled>Selecciona un idioma
                              </option>
                              <option value="0" <?= isset($vacante) && is_object($vacante) &&  $vacante->id_language == 0 ? 'selected' : ''; ?>>
                                No aplica</option>
                              <?php foreach ($languages as $language) : ?>
                                <option value="<?= $language['id'] ?>" <?= isset($vacante) && is_object($vacante) && $language['id'] == $vacante->id_language ? 'selected' : ''; ?>>
                                  <?= $language['language'] ?></option>
                              <?php endforeach ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <?php $language_levels = Utils::showLanguageLevels(); ?>
                            <select name="language_level" id="language_level" class="form-control">
                              <option value="0" selected>Selecciona el nivel</option>
                              <?php foreach ($language_levels as $level) : ?>
                                <option value="<?= $level['id'] ?>" <?= isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_language_level ? 'selected' : ''; ?>>
                                  <?= $level['language_level'] ?></option>
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
                        <label for="workdays" class="col-form-label">Días de trabajo:</label>
                        <input type="text" name="workdays" id="workdays" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->workdays : ''; ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="schedule" class="col-form-label">Horario:</label>
                        <input type="text" name="schedule" id="schedule" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->schedule : ''; ?>">
                      </div>
                    </div>
                  </div>


                  <div class="row" style="<?= Utils::isSalesManager() || Utils::isSales()  ? 'display:none'  : '' ?>">
                    <!--  gabo 17 abril quitar a ventas -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="requirements" class="col-form-label">Que experiencia debe
                          haber desarrollado:</label>
                        <textarea name="requirements" id="requirements" rows="5" class="form-control" style="<?= Utils::isSalesManager() || Utils::isSales()  ? ''  : 'required' ?>"><?= isset($vacante) && is_object($vacante) ? $vacante->requirements : ''; ?></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="functions" class="col-form-label">Puestos que pudo haber
                          ocupado:</label>
                        <textarea name="functions" id="functions" rows="5" class="form-control" style="<?= Utils::isSalesManager() || Utils::isSales()  ? ''  : 'required' ?>"><?= isset($vacante) && is_object($vacante) ? $vacante->functions : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6" style="display: none;">
                      <div class="form-group">
                        <label for="technical_knowledge" class="col-form-label">Conocimientos
                          técnicos:</label>
                        <textarea name="technical_knowledge" id="technical_knowledge" rows="5" class="form-control"><?= isset($vacante) && is_object($vacante) ? $vacante->technical_knowledge : ''; ?></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="comments" class="col-form-label">Comentarios:</label>
                        <textarea name="comments" id="comments" rows="8" class="form-control"><?= isset($vacante) && is_object($vacante) ? $vacante->comments : ''; ?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card card-maroon" hidden>
                <div class="card-header">
                  <h4 class="card-title">
                    Proceso del cliente
                  </h4>
                </div>
                <div class="card-body">
                  <div class="row" style="display: none;">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="how_many_interviews" class="col-form-label">¿Cuántas
                          entrevistas prevee se realicen?</label>
                        <input type="number" name="how_many_interviews" id="how_many_interviews" class="form-control" min="0" value="<?= isset($vacante) && is_object($vacante) ? $vacante->how_many_interviews : ''; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="time_without_filling" class="col-form-label">¿Cuánto tiempo
                        tiene sin cubrir esta vacante?</label>
                      <input type="text" name="time_without_filling" class="form-control">
                    </div>
                    <div class="form-group col">
                      <label for="another_agency" class="col-form-label">¿Están trabajando con
                        alguna otra agencia de reclutamiento?</label>
                      <select name="another_agency" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                      </select>

                    </div>
                  </div>
                </div>
              </div>

              <?php if (Utils::isAdmin() || Utils::isSalesManager() || Utils::isSales()) :  ?>
                <div class="card card-purple">
                  <div class="card-header">
                    <h4 class="card-title">
                      Condiciones Comerciales
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="send_date_candidate" class="col-form-label">Fecha de envio
                            de candidatos:</label>
                          <input type="date" name="send_date_candidate" id="send_date_candidate" class="form-control" value="<?= $vacante->send_date_candidate != null || $vacante->send_date_candidate != ''  ?  date_format(date_create($vacante->send_date_candidate), 'Y-m-d')  : date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Cantidad anticipo:</label>
                          <input type="number" name="advance_payment" id="advance_payment" class="form-control" value="<?= $vacante->advance_payment != null || $vacante->advance_payment != '' ? str_replace(',', '', number_format($vacante->advance_payment, 2)) : '0'; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Gastos administrativos:</label>
                          <input type="number" name="payment_amount" id="payment_amount" class="form-control" value="<?= $vacante->payment_amount != null || $vacante->payment_amount != '' ? str_replace(',', '', number_format($vacante->payment_amount, 2)) : '0'; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Porcentaje a facturar:</label>
                          <input type="number" name="recruitment_service_cost" class="form-control" value="<?= $vacante->recruitment_service_cost != null || $vacante->recruitment_service_cost != '' ? $vacante->recruitment_service_cost : '0'; ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif;  ?>
              <!-- gabo 29 sept -->
              <?php if (Utils::isAdmin() || Utils::isSalesManager() || Utils::isSales()) :  ?>
                <div class="card card-red">
                  <div class="card-header">
                    <h4 class="card-title">
                      Notas
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="send_date_candidate" class="col-form-label">Fecha de envio
                            de candidatos:</label>
                          <input type="date" name="send_date_candidate" id="send_date_candidate" class="form-control" value="<?= $vacante->send_date_candidate != null || $vacante->send_date_candidate != ''  ?  date_format(date_create($vacante->send_date_candidate), 'Y-m-d')  : date('Y-m-d'); ?>" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Cantidad anticipo:</label>
                          <input type="number" name="advance_payment" id="advance_payment" class="form-control" value="<?= $vacante->advance_payment != null || $vacante->advance_payment != '' ? str_replace(',', '', number_format($vacante->advance_payment, 2)) : '0'; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Gastos administrativos:</label>
                          <input type="number" name="payment_amount" id="payment_amount" class="form-control" value="<?= $vacante->payment_amount != null || $vacante->payment_amount != '' ? str_replace(',', '', number_format($vacante->payment_amount, 2)) : '0'; ?>" required>
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="col-form-label">Porcentaje a facturar:</label>
                          <input type="number" name="recruitment_service_cost" class="form-control" value="<?= $vacante->recruitment_service_cost != null || $vacante->recruitment_service_cost != '' ? $vacante->recruitment_service_cost : '0'; ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endif;  ?>


              <div class="card-footer">
                <div class="row">
                  <div class="col-2">
                    <a class="btn btn-secondary float-left" href="<?= base_url ?>vacante/index">Regresar</a>
                  </div>
                  <div class="col-4 text-center">
                    <?php if ((!Utils::isCustomer() || !Utils::isCustomerSA()) && isset($_GET['id'])) : ?>
                      <a href="<?= base_url ?>vacante/vacantePDF&id=<?= $_GET['id'] ?>" target="_blank" class="btn btn-orange text-bold">Descargar propuesta</a>
                    <?php endif; ?>
                  </div>

                  <div class="col-4 text-center">
                    <?php if ((!Utils::isCustomer() || !Utils::isCustomerSA()) && isset($_GET['id'])) : ?>
                      <a href="<?= base_url ?>vacante/entregableVacante&id=<?= $_GET['id'] ?>" target="_blank" class="btn btn-success text-bold">Descargar Entregable</a>
                    <?php endif; ?>
                  </div>

                  <div class="col-2">
                    <?php if (isset($_GET['id']) && isset($vacante) && is_object($vacante)) : ?>
                      <button type="submit" class="btn btn-info float-right" id="editSubmit">Editar
                        vacante</button>
                    <?php else : ?>
                      <button type="submit" class="btn btn-success float-right" id="registerSubmit">Crear vacante</button>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>

</div>
<script src="<?= base_url ?>app/customercontact.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/businessname.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/vacancy.js?v=<?= rand() ?>"></script>
<script src="<?= base_url ?>app/recruitercustomers.js?v=<?= rand() ?>"></script>
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
<?php if (isset($_GET['id'])) : ?>
  <script type="text/javascript">
    document.querySelector('#vacancy-form #editSubmit').addEventListener('click', e => {
      e.preventDefault();
      let vacancy = new Vacancy();
      vacancy.update();
    });
  </script>
<?php else : ?>
  <script type="text/javascript">
    document.querySelector('#vacancy-form').addEventListener('submit', e => {
      e.preventDefault();
      document.querySelector("#registerSubmit").disabled = true;
      let vacancy = new Vacancy();
      vacancy.create();
    });
  </script>
<?php endif ?>