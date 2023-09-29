<div class="modal fade" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Candidato</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id">
                    <input type="hidden" name="id_vacancy_filter" value="<?= $id_vacancy ?>">

                    <div class="form-group">
                        <label class="col-form-label" for="name">Nombre*</label>
                        <input type="text" class="form-control" name="first_name" maxlength="100" value="" required>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label" for="surname">Apellido Paterno*</label>
                                <input type="text" class="form-control" name="surname" maxlength="100" value="" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label" for="last_name">Apellido materno</label>
                                <input type="text" class="form-control" name="last_name" maxlength="100" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="telephone">Telefono*</label>
                        <input type="text" name="telephone" maxlength="13" class="form-control" value="" placeholder="Ingresa tu número telefónico" data-inputmask='"mask": "999 999 9999"' data-mask required>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="experience">Exprencia</label>
                        <input type="text" class="form-control" name="experience" maxlength="100" value="">
                    </div>

                    <div class="form-group" <?= !Utils::isCustomer() ? '' : 'hidden' ?>>
                        <label class="col-form-label" for="id_vacancy">Vacante*</label>
                        <?php $vacantes = Utils::getVacantesEnProceso(); ?>
                        <select name="id_vacancy" id="id_vacancy" class="form-control select2">
                            <option value="" disabled selected>Selecciona vacante</option>
                            <?php foreach ($vacantes as $vacant) : ?>
                                <option value="<?= $vacant['id'] ?>"><?= $vacant['customer'] . " / " . $vacant['vacancy'] . " / " . $vacant['city'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label" for="id_state">Estado*</label>
                                <?php $states = Utils::showStates(); ?>
                                <select name="id_state" id="id_state" class="form-control select2" required>
                                    <option disabled selected="selected"></option>
                                    <?php foreach ($states as $state) : ?>
                                        <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_city" class="col-form-label">Ciudad</label>
                                <select name="id_city" id="id_city" class="form-control select2">
                                    <option disabled selected="selected"></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <label class="col-form-label" for="email">Correo</label>
                        <input type="email" class="form-control" name="email" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="url">Link de contacto(pdf, Facebook, etc))</label>
                        <input type="text" class="form-control" name="url" maxlength="100">
                    </div>


                    <div class="form-group" <?= !Utils::isCustomer() ? '' : 'hidden' ?>>
                        <label class="col-form-label" for="status">Resultado</label>
                        <select name="status" class="form-control">
                            <option value="" disabled selected>Selecciona resultado</option>
                            <option value="1"  selected>Nuevo</option>
                            <option value="2">Por contactar</option>
                            <option value="3">Contactado</option>
                            <option value="4">Pendiente</option>
                            <option value="5">No recomendado</option>
                            <option value="6" hidden>Candidato postulado</option>
                        </select>
                    </div>

                    <div class="form-group" <?= !Utils::isCustomer() ? '' : 'hidden' ?>>
                        <label class="col-form-label" for="comment">Comentarios</label>
                        <textarea class="form-control" name="comment" rows="5"></textarea>
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


<script type="text/javascript">
    window.onload = function() {
        document.querySelector('#id_state').onchange = function() {
            let cities = new City();
            cities.id_state = document.querySelector('#id_state').value;
            cities.selector = document.querySelector('#id_city');
            cities.getCitiesByState();
        }

        document.querySelector('#modal_create form').onsubmit = function(e) {
            e.preventDefault();
            let candidatedirectory = new Candidatedirectory();
            candidatedirectory.save();
        }

        $("#id_vacancy").on("select2:select", function(e) {
            var data = e.params.data;

            let vacancy = new Vacancy();
            vacancy.getVacancySateCity(data.id);
        });
    }
</script>