<div class="modal fade" id="modal_inmueble">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Inmueble</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Renglon">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <div class="form-group">
                        <label class="col-form-label" for="Tipo_Inmueble">Tipo de inmueble</label>
                        <input type="text" class="form-control" name="Tipo_Inmueble" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Ubicacion">Ubicación</label>
                        <input type="text" class="form-control" name="Ubicacion" maxlength="70">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Valor">Valor</label>
                        <input type="text" class="form-control" name="Valor" maxlength="40">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Pagado">¿Pagado?</label>
                        <select name="Pagado" class="form-control">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
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


<div class="modal fade" id="modal_delete_inmueble">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar inmueble</h4>
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