<div class="modal fade" id="modal_razon">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Razón social</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ID">
                    <input type="hidden" name="flag">
                    <div class="form-group" hidden>
                        <label class="col-form-label" for="Nombre_Empresa">Empresa</label>
                        <input type="text" class="form-control" name="Nombre_Empresa" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Razon">Razón social</label>
                        <input type="text" class="form-control" name="Razon" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="RFC">RFC</label>
                        <input type="text" class="form-control" name="RFC" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Direccion_Fiscal">Dirección Fiscal</label>
                        <input type="text" class="form-control" name="Direccion_Fiscal" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Forma_Pago">Forma de Pago</label>
                        <select class="form-control" name="Forma_Pago" required>
                            <option value="03. Transferencia Electrónica de Fondos">03. Transferencia Electrónica de Fondos</option>
                            <option value="99. Por definir">99. Por definir</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Regimen_Fiscal">Régimen Fiscal</label>
                        <input type="text" name="Regimen_Fiscal" class="form-control" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Uso_CFDI">Uso de CFDI</label>
                        <select class="form-control" name="Uso_CFDI" required>
                            <option value="G03. Gastos en General">G03. Gastos en General</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Contacto">Contacto</label>
                        <input type="text" class="form-control" name="Contacto" maxlength="60">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Otro">Otro</label>
                        <input type="text" class="form-control" name="Otro" maxlength="300">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Situacion_Fiscal">Situación fiscal</label>
                        <input type="file" name="Situacion_Fiscal" class="form-control" accept="application/pdf">
                    </div>
                    <input type="hidden" name="Empresa" value="<?=$_GET['controller'] == 'cliente_SA' ? $cliente->Empresa : Encryption::decode($_GET['id'])?>">
                    <input type="hidden" name="ID_Cliente" value="<?=$_GET['controller'] == 'cliente_SA' ? $_GET['id'] : 0?>">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>              
</div>