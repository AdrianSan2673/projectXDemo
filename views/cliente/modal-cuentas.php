<div class="modal fade" id="modal_cuentas">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Cuentas por pagar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Cliente">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-group">
                        <label class="col-form-label" for="Cuentas_Contacto">Contacto</label>
                        <input type="text" name="Cuentas_Contacto" class="form-control" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Cuentas_Correo">Correo electrónico</label>
                        <input type="text" name="Cuentas_Correo" class="form-control" maxlength="50">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-8">
                            <label class="col-form-label" for="Cuentas_Telefono">Teléfono</label>
                            <input type="text" name="Cuentas_Telefono" class="form-control" maxlength="50">
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="col-form-label" for="Cuentas_Extension">Extensión</label>
                            <input type="text" name="Cuentas_Extension" class="form-control" maxlength="50">
                        </div>
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