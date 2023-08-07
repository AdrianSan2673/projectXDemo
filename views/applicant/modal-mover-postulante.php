<div class="modal fade" id="modal_mover_postulante">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="mover-postulante-form">
                <div class="modal-header">
                    <h4 class="modal-title">Mover Postulante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_candidato" name="id_candidate">
                    <div class="form-group" id="select_empresa">
                        <label for="customer" class="col-form-label">Mover a:</label>
                        <?php $vacantes = Utils::getVacantesEnProceso(); ?>
                        <select type="reset" name="id_vacancy" id="id_vacancy" class="form-control select2">
                            <option value="" hidden selected></option>
                              <!-- // ===[20 mayo gabo operativa ]=== -->
                            <?php foreach ($vacantes as $vacant) : ?>
<option value="<?= $vacant['id'] ?>"><?= $vacant['customer'] . " / " . $vacant['vacancy'] . " / " . $vacant['city'] ?></option>
                                <!-- // ===[20 mayo gabo   operativa fin]=== -->
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Mover">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.querySelector('#mover-postulante-form').addEventListener('submit', e => {
        e.preventDefault();
        let vacancy = new Vacancy();
        vacancy.mover_postulante();
    });
</script>