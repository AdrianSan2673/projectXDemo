<div class="modal fade" id="modal_credito">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Créditos al consumo o TDC</h4>
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
                        <label class="col-form-label" for="Limite_Credito">Límite de crédito</label>
                        <input type="text" class="form-control" name="Limite_Credito" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Saldo_Actual">Saldo actual aprox.</label>
                        <input type="text" class="form-control" name="Saldo_Actual" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Vencimiento">Vencimiento</label>
                        <input type="text" class="form-control" name="Vencimiento" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Abono_Mensual">Abono_Mensual</label>
                        <input type="text" class="form-control" name="Abono_Mensual" maxlength="40">
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


<div class="modal fade" id="modal_delete_credito">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar crédito</h4>
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

<div class="modal fade" id="modal_INFONAVIT">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Crédito INFONAVIT</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="INFONAVIT">¿El candidato cuenta con crédito INFONAVIT?</label>
                       <select name="INFONAVIT" class="form-control">
                            <option value="1">Sí</option>
                            <option value="2">No</option>
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