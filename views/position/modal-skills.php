<div class="modal fade" id="modal_skills">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Habilidades interpersonales requeridas</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="skill" class="col-form-label">Habilidades</label>
                        <textarea class="form-control" name="skill" rows="8" maxlength="400" require></textarea>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>

                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="id_skill" >
                <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

            </form>
        </div>
    </div>
</div>