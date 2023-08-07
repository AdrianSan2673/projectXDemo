<div class="modal fade" id="modal_descripcion">
  <div class="modal-dialog modal-lg" ">
        <div class=" modal-content">
    <form method="post" id="vacante-descripcion-form">


      <div class="card card-info">
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
                    <option value="<?= $level['id'] ?>" <?= isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_education_level ? 'selected' : ''; ?>><?= $level['level'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="position_number" class="col-form-label">Número de posiciones:</label>
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
                    <label for="experience_years" class="col-form-label">Años o mesess</label>
                    <select name="experience_type" id="experience_type" class="form-control">
                      <option value="Años" <?= isset($vacante) && is_object($vacante) && $vacante->experience_type  == 'Años' ? 'selected' : ''; ?>>Años</option>
                      <option value="Meses" <?= isset($vacante) && is_object($vacante) && $vacante->experience_type  == 'Meses' ? 'selected' : ''; ?>>Meses</option>

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
                    <option value="<?= $gender['id'] ?>" <?= isset($vacante) && is_object($vacante) && $gender['id'] == $vacante->id_gender ? 'selected' : ''; ?>><?= $gender['gender'] ?></option>
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
                    <option value="<?= $status['id'] ?>" <?= isset($vacante) && is_object($vacante) && $status['id'] == $vacante->id_civil_status ? 'selected' : ''; ?>><?= $status['status'] ?></option>
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
                      <option value="" selected disabled>Selecciona un idioma</option>
                      <option value="0" <?= isset($vacante) && is_object($vacante) &&  $vacante->id_language == 0 ? 'selected' : ''; ?>>No aplica</option>
                      <?php foreach ($languages as $language) : ?>
                        <option value="<?= $language['id'] ?>" <?= isset($vacante) && is_object($vacante) && $language['id'] == $vacante->id_language ? 'selected' : ''; ?>><?= $language['language'] ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <?php $language_levels = Utils::showLanguageLevels(); ?>
                    <select name="language_level" id="language_level" class="form-control">
                      <option value="0" selected>Selecciona el nivel</option>
                      <?php foreach ($language_levels as $level) : ?>
                        <option value="<?= $level['id'] ?>" <?= isset($vacante) && is_object($vacante) && $level['id'] == $vacante->id_language_level ? 'selected' : ''; ?>><?= $level['language_level'] ?></option>
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


          <div class="row" style="<?= Utils::isSalesManager() || Utils::isSales() ? 'display:none'  : '' ?>"> <!-- gabo 17 abril  quitar a ventas -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="requirements" class="col-form-label">Que experiencia debe haber desarrollado:</label>
                <textarea name="requirements" id="requirements" rows="5" class="form-control" <?= Utils::isSalesManager()|| Utils::isSales()  ? ''  : 'required' ?>><?= isset($vacante) && is_object($vacante) ? $vacante->requirements : ''; ?></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="functions" class="col-form-label">Puestos que pudo haber ocupado:</label>
                <textarea name="functions" id="functions" rows="5" class="form-control" <?= Utils::isSalesManager()|| Utils::isSales()  ? ''  : 'required' ?>><?= isset($vacante) && is_object($vacante) ? $vacante->functions : ''; ?></textarea>
              </div>
            </div>
          </div>

          <div class="row" style="<?= Utils::isSalesManager() || Utils::isSales() ? 'display:none'  : '' ?>"> <!-- gabo 17 abril  quitar a ventas -->
            <div class="col-md-12">
              <div class="form-group">
                <label for="comments" class="col-form-label">Beneficios:</label>
                <textarea name="benefits" id="benefits" rows="8" class="form-control"><?= isset($vacante) && is_object($vacante)  ? $vacante->benefits : ''; ?></textarea>
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

      <input type="hidden" id="id" name="id" value="<?= isset($vacante) && is_object($vacante) ? Encryption::encode(round($vacante->id_vacancy)) : ''; ?>">
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <input type=submit" name="submit" id="edit-descripciones" class="btn btn-orange" value="Guardar">
      </div>

    </form>


  </div>
</div>
</div>

<script>
  document.querySelector('#edit-descripciones').addEventListener('click', e => {
    e.preventDefault();
    let vacancy = new Vacancy();
    vacancy.update_descripcion();
  });
</script>