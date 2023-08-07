<div class="modal fade" id="modal_bancaria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Cuentas bancarias y de inversión</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Institucion">Institución</label>
                        <input type="text" class="form-control" name="Institucion" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Cuenta">Tipo de cuenta</label>
                        <input type="text" class="form-control" name="Tipo_Cuenta" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Objetivo">Objetivo del ahorro</label>
                        <input type="text" class="form-control" name="Objetivo" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Deposito_Mensual">Depósito mensual</label>
                        <input type="text" class="form-control" name="Deposito_Mensual" maxlength="40">
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


<div class="modal fade" id="modal_delete_bancaria">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar bancaria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <p></p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input type="submit" name="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>              
</div>