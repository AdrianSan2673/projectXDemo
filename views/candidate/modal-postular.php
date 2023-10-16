<div class="modal fade" id="modal-postular">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="postular-form">
                <div class="modal-header">
                    <h4 class="modal-title">Postular</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_candidate" name="id_candidate" value="<?= $_GET['id'] ?>">
                    <div class="form-group" id="select_empresa">
                        <label for="customer" class="col-form-label">Postular en:</label>
                        <?php $vacantes = Utils::getVacantesEnProceso(); ?>
                        <select type="reset" name="id_vacancy" id="id_vacancy" class="form-control select2">
                            <option value="" hidden selected></option>
                            <?php foreach ($vacantes as $vacant) : ?>
                                <option value="<?= Encryption::encode($vacant['id']) ?>">
                                    <?= $vacant['customer'] . " / " . $vacant['vacancy'] . " / " . $vacant['city'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" id="submit" class="btn btn-orange" value="Postular">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('#postular-form').addEventListener('submit', e => {
        e.preventDefault();
        let candidate = new Candidate();
        candidate.postulate();
    });
</script>