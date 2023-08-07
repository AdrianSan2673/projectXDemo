<div class="modal fade" id="modal_responsability">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Responsabilidad Específica</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label" for="responsability">Responsabilidad</label>
                        <input type="text" name="responsability" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="activities" class="col-form-label">Actividad</label>
                        <textarea class="form-control" name="activities" rows="8" required></textarea>
                    </div>
                </div>
                <input type="hidden" name="id_responsabilidad">
                <input type="hidden" name="flag" value="1">
                <input type="hidden" name="id_position" value="<?= $_GET['id'] ?>">

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                    
                </div>
            </form>
        </div>
    </div>
</div>