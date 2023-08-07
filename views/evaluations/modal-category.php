<div class="modal fade" id="modal_category">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id_evaluation" value="<?= $_GET['id']; ?>">
                    <input type="hidden" name="id" value="">
                    
                    <div class="form-group">
                        <label class="col-form-label" for="category">Nombre de la Categoría</label>
                        <input type="text" class="form-control" name="category" id="category" maxlength="50" required>
                    </div>

                    <div class="form-group">
                        <label for="level" class="col-form-label">Descripción</label>
                        <textarea name="description" class="form-control" rows="5" maxlength="800"></textarea>
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