<div class="modal fade" id="modal_plan">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Descripción del puesto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Puesto</label>
                        <select name="puesto[]" id="puesto" multiple="multiple" class="form-control" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Revisado por</label>
                        <select class="form-control">
                            <option>Luis Miguel martinez</option>
                            <option>Pedro Hernandez</option>
                            <option>Fernando Fernandez</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="Nombre_Cliente" class="col-form-label">Puesto al que reporta</label>
                        <select class="form-control" name="Empresa">
                            <option>Ivan Lara</option>
                            <option>Juan Perez</option>
                            <option>Blanca Solis</option>
                        </select>
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