<div class="modal fade" id="modal_perfil">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="vacante-perfil-form">

                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="card-title">Datos del Puesto</h4>
                    </div>      
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="vacancy" class="col-form-label">Nombre del puesto</label>
                                    <input type="text" name="vacancy" id="vacancy" maxlength="255" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->vacancy : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="department" class="col-form-label">Departamento</label>
                                    <input type="text" name="department" id="department" maxlength="255" class="form-control" required value="<?= isset($vacante) && is_object($vacante) ? $vacante->department : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6"  style="<?= Utils::isSalesManager() || Utils::isSales() ? 'display:none'  : '' ?>"> <!-- gabo 17 abril quitar a ventas -->
                                <div class="form-group">
                                    <label for="type" class="col-form-label">Tipo de vacante</label>
                                    <select name="type" id="type" class="form-control" <?= Utils::isSalesManager()|| Utils::isSales()  ? ''  : 'required' ?>>
                                        <option disabled selected>Selecciona el tipo  <?= $vacante->type; ?> </option>
                                     <!-- 25 abril 2023 -->
                                        <option value="1" <?= isset($vacante) && is_object($vacante) && $vacante->type == '1' ? 'selected' : ''; ?>>Operativa</option>
                                        <option value="2" <?= isset($vacante) && is_object($vacante) && $vacante->type == '2' ? 'selected' : ''; ?>>Orden Común</option>
                                        <option value="3" <?= isset($vacante) && is_object($vacante) && $vacante->type == '3' ? 'selected' : '' ?>>Head Hunting</option>
										                                        <option value="4" <?= isset($vacante) && is_object($vacante) && $vacante->type == 4 ? 'selected' : '' ?>>Iguala</option>

                                        <!-- fin -->


                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4" style="display: none;">
                                <div class="form-group">
                                    <label for="report_to" class="col-form-label">Puesto al que le reportaría:</label>
                                    <input type="text" name="report_to" id="report_to" class="form-control" maxlength="255" value="<?= isset($vacante) && is_object($vacante) ? $vacante->report_to : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-4" style="display: none;">
                                <div class="form-group">
                                    <label for="personal_in_charge" class="col-form-label">¿Tendrá personal a cargo?</label>
                                    <select name="personal_in_charge" id="personal_in_charge" class="form-control">
                                        <option disabled selected></option>
                                        <option value="1" <?= isset($vacante) && is_object($vacante) && $vacante->personal_in_charge == 1 ? 'selected' : ''; ?>>Sí</option>
                                        <option value="0" <?= isset($vacante) && is_object($vacante) && $vacante->personal_in_charge == 0 ? 'selected' : ''; ?>>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area" class="col-form-label">Area</label>
                                    <?php $areas = Utils::showAreas(); ?>
                                    <select name="area" id="area_select" class="form-control select2" required>
                                        <option disabled selected="selected">Selecciona departamento</option>
                                        <?php foreach ($areas as $area) : ?>
                                            <option value="<?= $area['id'] ?>" <?= isset($vacante) && is_object($vacante) && $area['id'] == $vacante->id_area ? 'selected' : ''; ?>><?= $area['area'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subarea" class="col-form-label">Subarea</label>
                                    <select name="subarea" id="subarea_select" class="form-control select2" required>
                                        <?php if (isset($vacante) && is_object($vacante) && !empty($vacante->id_area)) : ?>
                                            <?php $subareas = Utils::showSubareasByArea($vacante->id_area); ?>
                                            <?php foreach ($subareas as $subarea) : ?>
                                                <option value="<?= $subarea['id'] ?>" <?= isset($vacante) && is_object($vacante) && $subarea['id'] == $vacante->id_subarea ? 'selected' : ''; ?>><?= $subarea['subarea'] ?></option>
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
                                <div class="col-md-6" style="<?= Utils::isSalesManager()|| Utils::isSales()  ? 'display:none'  : '' ?>" > <!-- gabo 17 abril quitar a ventas -->
                                    <div class="form-group" >
                                        <label class="col-form-label" for="warranty_time">Tiempo de Garantía</label>
                                        <select class="form-control" name="warranty_time">
                                            <option value="0" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 0 ? 'selected' : ''; ?>>0 días</option>
                                            <option value="15" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 15 ? 'selected' : ''; ?>>15 días</option>
                                            <option value="30" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 30 ? 'selected' : ''; ?>>30 días</option>
                                            <option value="45" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 45 ? 'selected' : ''; ?>>45 días</option>
                                            <option value="60" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 60 ? 'selected' : ''; ?>>60 días</option>
                                            <option value="90" <?= isset($vacante) && is_object($vacante) && $vacante->warranty_time == 90 ? 'selected' : ''; ?>>90 días</option>
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
                            <div class="form-row"  style="<?= Utils::isSalesManager() || Utils::isSales()? 'display:none'  : '' ?>" > <!-- gabo 17 abril quitar a ventas -->
                                <div class="form-group col">
                                    <label class="col-form-label" for="authorization_date">Fecha de autorización</label>
                                    <input type="datetime-local" name="authorization_date" class="form-control" value="<?= isset($vacante) && is_object($vacante) ? (isset($vacante->authorization_date) && !empty($vacante->authorization_date) ? date_format(date_create($vacante->authorization_date), 'Y-m-d\TH:i') : '')  : ''; ?>">
                                </div>
                                <div class="form-group col">
                                    <label class="col-form-label" for="commitment_date">Fecha de compromiso de envío</label>
                                    <input type="date" name="commitment_date"  class="form-control" value="<?= isset($vacante) && is_object($vacante) ? $vacante->commitment_date : ''; ?>">
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
                                            <option value="<?= $state['id'] ?>" <?= isset($vacante) && is_object($vacante) && $state['id'] == $vacante->id_state ? 'selected' : ''; ?>><?= $state['state'] ?></option>
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
                                                <option value="<?= $city['id'] ?>" <?= isset($vacante) && is_object($vacante) && $city['id'] == $vacante->id_city ? 'selected' : ''; ?>><?= $city['city'] ?></option>
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
                                        <option value="-48" <?= isset($vacante) && is_object($vacante) && '-48' == $vacante->working_day ? 'selected' : ''; ?>>-48</option>
                                        <option value="48" <?= isset($vacante) && is_object($vacante) && '48' == $vacante->working_day ? 'selected' : ''; ?>> 48</option>
                                        <option value="+48" <?= isset($vacante) && is_object($vacante) && '+48' == $vacante->working_day ? 'selected' : ''; ?>>+48</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="salary" class="col-form-label">Sueldo base mensual:</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="number" name="salary_min" id="salary_min" class="form-control" placeholder="Mínimo" min="0" value="<?= isset($vacante) && is_object($vacante) ? round($vacante->salary_min) : ''; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="salary_max" id="salary_max" class="form-control" placeholder="Máximo" min="0" value="<?= isset($vacante) && is_object($vacante) ? round($vacante->salary_max) : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="benefits" class="col-form-label">Prestaciones o beneficios</label>
                                    <textarea name="benefits" id="benefits" rows="8" class="form-control"> <?= isset($vacante) && is_object($vacante) ? $vacante->benefits : ''; ?></textarea>
                                </div>
                            </div>
                        </div> -->
                    </div>
                        <input type="hidden" id="id" name="id" value="<?= isset($vacante) && is_object($vacante) ? Encryption::encode(round($vacante->id_vacancy)) : ''; ?>" >
                 <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="edit-perfil" class="btn btn-orange" value="Guardar">
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 document.querySelector('#state').onchange = function() {
    let cities = new City();
    cities.id_state = document.querySelector('#state').value;
    cities.selector = document.querySelector('#city');
    let ciudades = cities.getCitiesByState();
  };
  document.querySelector('#area_select').onchange = function() {
    let subarea = new Subarea();
    subarea.id_area = document.querySelector("#area_select").value;
    subarea.selector = document.querySelector("#subarea_select");
    subarea.getSubareasByArea();
  };
  document.querySelector('#edit-perfil').addEventListener('click', e => {
      e.preventDefault();
      let vacancy = new Vacancy();
      vacancy.update_perfil();
    });
  </script>