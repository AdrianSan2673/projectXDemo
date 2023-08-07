<div class="modal fade" id="modal_resultado_licencia">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Resultado Licencia Federal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Caracteristicas">Características</label>
                        <textarea class="form-control" rows="7" name="Caracteristicas"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Resultado">Resultado</label>
                        <textarea class="form-control" rows="5" name="Resultado"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>