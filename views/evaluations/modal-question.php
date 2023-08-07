<div class="modal fade" id="modal_question">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Pregunta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id_criterion" value="">
                    <input type="hidden" name="id" value="">
                    
                    <div class="form-group">
                        <label class="col-form-label" >Pregunta</label>
                        <input type="text" class="form-control" name="question"  maxlength="400" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="level" class="col-form-label">Definicion</label>
                        <textarea name="definition" class="form-control" rows="3" maxlength="400"></textarea>
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