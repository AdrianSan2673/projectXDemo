<div class="modal fade" id="modal_postulate">
    <div class="modal-dialog modal-lg" style="width:40%!important;">
        <div class="modal-content">
            <form method="post" id="candidate-postulate-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo-postular"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_solicitud" id="id_solicitud">
                    <input type="hidden" id="accion" name="accion">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label" for="comments">Elige las vacantes a la que deseas postular
                                    a este candidato</label>
                                <?php $vacantes = Utils::getVacanciesInProcessByIdRecruiter($_SESSION['identity']->id); ?>
                                <?php $vacantes = Utils::getVacanciesInProcessByIdRecruiter(24); ?>
                                <select multiple name="id_vacancies[]" id="id_vacancy_v" class="form-control select2" required>

                                    <?php foreach ($vacantes as $vacante) : ?>
                                        <option value="<?= $vacante['id'] ?>">
                                            <?= $vacante['customer'] . " - " . $vacante['vacancy'] ?></option>
                                    <?php endforeach ?>


                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Aceptar">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('#candidate-postulate-form').addEventListener('submit', e => {
        e.preventDefault();
        let vacancy = new Vacancy();
        vacancy. | ();
    });
</script>