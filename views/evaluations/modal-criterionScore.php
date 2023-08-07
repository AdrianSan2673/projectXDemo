<div class="modal fade" id="modal-criterionScore">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Ponderacion</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id_criterion" value="">
                    <input type="hidden" name="id" value="">
                    
                    <div class="form-group">
                        <label class="col-form-label" >Nombre de Ponderacion</label>
                        <input type="text" class="form-control" name="name"  maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="level" class="col-form-label">Valor</label>
                        <input type="number" min="0" class="form-control" name="value"  maxlength="50" required>
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