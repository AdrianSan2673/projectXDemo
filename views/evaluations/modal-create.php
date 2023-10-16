<div class="modal fade" id="modal_create_evaluation">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Evaluación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="evaluation">Nombre de la Evaluación</label>
                        <input type="text" class="form-control" name="name" id="evaluation" maxlength="100" required>
                    </div>

                    <div class="form-group">
                        <label for="level" class="col-form-label">Nivel organizacional</label>
                        <select name="level" class="form-control" required>
                            <option value="" hidden selected>Selecciona el nivel organizacional</option>
                            <option value="1">Operativo</option>
                            <option value="2">Administrativo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="type"   value="<?= Encryption::encode(1) ?>">
                        <label for="level" class="col-form-label">Retroalimentacion</label>
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