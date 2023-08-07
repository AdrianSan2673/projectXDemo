<div class="modal fade" id="modal_authority">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Autoridad del puesto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="authority" class="col-form-label">Autoridad</label>
                        <textarea class="form-control" name="authority" rows="8" maxlength="4000" required><?= $position->authority ?></textarea>
                    </div>
                </div>

                <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>