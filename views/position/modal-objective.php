<div class="modal fade" id="modal_objective">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Objetivo del puesto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
         
                    <div class="form-group">
                        <label for="objective" class="col-form-label">Objetivo</label>
                        <textarea class="form-control" name="objective" maxlength="4000" rows="8" required><?= $position->objective ?></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

            </form>
        </div>
    </div>              
</div>