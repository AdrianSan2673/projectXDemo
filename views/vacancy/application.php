<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <div class="alert alert-success">
                <h4><?=$vacante->vacancy?> | <?=$vacante->customer?></h4>
            </div>       
          </div>
        </div>
        <div class="row text-center">
            <div class="col-md-3">
                <b><?='$'.$vacante->salary_min.' - $'.$vacante->salary_max.' (mensual)'?></b>
            </div>
            <div class="col-md-3">
                <p><?=$vacante->city.', '.$vacante->state?></p>
            </div>
            <div class="col-md-3">
                <p class="text-muted"><?=Utils::getFullDate($vacante->request_date)?></p>
            </div>
            <div class="col-md-3">
                <p>No. Posiciones: <?=$vacante->position_number?></p>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Postular candidato nuevo</h4>
                </div>
                <!-- /.card-header -->
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="first_name" class="col-form-label">Nombre(s):</label>
                        <input type="text" name="first_name" id="first_name" maxlength="255" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="surname" class="col-form-label">Apellido paterno:</label>
                        <input type="text" name="surname" id="surname" maxlength="255" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="last_name" class="col-form-label">Apellido materno:</label>
                        <input type="text" name="last_name" id="last_name" maxlength="255" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="date_birth" class="col-form-label">Fecha de nacimiento:</label>
                        <input type="date" name="date_birth" id="date_birth" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="gender" class="col-form-label">Sexo:</label>
                        <select name="gender" id="gender" class="form-control" required>
                          <option disabled selected></option>
                          <?php foreach ($genders as $gender): ?>
                            <option value="<?=$gender['id']?>"><?=$gender['gender']?></option>
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
                            <option value="<?=$status['id']?>"><?=$status['status']?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telephone" class="col-form-label">Teléfono o celular:</label>
                        <input type="text" name="telephone" id="telephone" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="additional telephone" class="col-form-label">Teléfono adicional:</label>
                        <input type="text" name="additional telephone" id="additional telephone" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email" class="col-form-label">Correo electrónico:</label>
                        <input type="text" name="email" id="email" class="form-control">
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
                                    <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city" class="col-form-label">Ciudad</label>
                            <select name="city" id="city" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="linkedinn" class="col-form-label">LinkedInn</label>
                            <input type="text" name="linkedinn" id="linkedinn" class="form-control" placeholder="Nombre de usuario LinkedInn">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="facebook" class="col-form-label">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Nombre de usuario Facebook">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="instagram" class="col-form-label">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Nombre de usuario Instagram">
                        </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="job_title" class="col-form-label">Título profesional</label>
                        <input type="text" name="job_title" id="job_title" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="description" class="col-form-label">Reseña</label>
                          <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                        </div>
                      </div>
                  </div>
                  <hr>
                  <h6>Experiencia</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="position" class="col-form-label">Puesto</label>
                        <input type="text" name="position" id="position" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="enterprise" class="col-form-label">Empresa</label>
                      <input type="text" name="enterprise" id="enterprise" class="form-control">
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
                                    <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city" class="col-form-label">Ciudad</label>
                            <select name="city" id="city" class="form-control select2" required>
                            <option disabled selected="selected"></option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="period" class="col-form-label">Período</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start_date" id="start_date" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end_date" id="end_date" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="review" class="col-form-label">Breve reseña del puesto</label>
                        <textarea name="review" id="review" class="form-control" rows="3" maxlength="255"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="activity1" class="col-form-label">Logro o actividad</label>
                      <input type="text" name="activity1" id="activity1" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="activity2" class="col-form-label">Logro o actividad</label>
                      <input type="text" name="activity2" id="activity2" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="activity3" class="col-form-label">Logro o actividad</label>
                      <input type="text" name="activity3" id="activity3" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label for="activity4" class="col-form-label">Logro o actividad</label>
                      <input type="text" name="activity4" id="activity4" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <h6>Educación</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="id_level" class="col-form-label">Último grado de estudios</label>
                        <select name="id_level" id="id_level" class="form-control"></select>
                      </div>
                      
                    </div>
                    <div class="col-md-6">
                      <label for="institution" class="col-form-label">Institución</label>
                      <input type="text" name="institution" id="institution" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="period" class="col-form-label">Período</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" name="start_date_education" id="start_date_education" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="end_date_education" id="end_date_education" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h6>Formación adicional</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="course" class="col-form-label">Nombre del curso o post grado</label>
                      <input type="text" name="course" id="course" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institution" class="col-form-label">Institución</label>
                      <input type="text" name="institution" id="institution" class="form-control">
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h6>Idiomas</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="language" class="col-form-label">Idioma</label>
                        <select name="language" id="language" class="form-control"></select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="level" class="col-form-label">Nivel de dominio</label>
                        <select name="level" id="level" class="form-control"></select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="institution" class="col-form-label">Institución</label>
                        <input type="text" name="institution" id="institution" class="form-control">
                      </div>                    
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="period" class="col-form-label">Período</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="date" name="start" id="start" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <input type="date" name="end" id="end" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h6>Aptitudes</h6>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="aptitude" class="col-form-label">Aptitud</label>
                        <input type="text" name="aptitude" id="aptitude" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label for="level" class="col-form-label">Nivel</label>
                      <input type="text" name="level" id="level" class="form-control">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>
<script>
    document.querySelector('#state').addEventListener('change', e => {
        let cities = new City();
        cities.getCitiesByState();
    });
</script>