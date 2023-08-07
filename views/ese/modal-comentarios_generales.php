<div class="modal fade" id="modal_comentarios_generales">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Comentarios generales</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Comentarios_Generales">Comentarios generales</label>
                        <textarea name="Comentarios_Generales" class="form-control" rows="35"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Califica_como">Análisis de Verificación</label>
                       <input type="hidden" name="Califica_como" class="form-control" maxlength="50">
                         <textarea name="Viabilidad" class="form-control" rows="10"></textarea>
                      <!--  <select name="Viabilidad" class="form-control">
                            <option value="4">Sin viabilidad</option>
                            <option value="0">Viable</option>
                            <option value="1">No viable</option>
                            <option value="2">Viable con reservas</option>
                            <option value="5">Viable con observaciones (RADEC)</option>
                        </select> -->
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