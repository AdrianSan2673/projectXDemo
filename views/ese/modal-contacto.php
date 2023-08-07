<div class="modal fade" id="modal_contacto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Datos de contacto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <div class="form-group" hidden>
                        <label class="col-form-label" for="Telefono_fijo">Teléfono fijo</label>
                        <input type="text" class="form-control" name="Telefono_fijo" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Celular">Número de celular</label>
                        <input type="text" class="form-control" name="Celular" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Otro_Contacto">Otro contacto</label>
                        <input type="text" class="form-control" name="Otro_Contacto" maxlength="70">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Correos">Dirección de correo electrónico</label>
                        <input type="text" class="form-control" name="Correos" maxlength="180">
                    </div>
                    <div class="form-group" hidden>
                        <label class="col-form-label" for="Linkedin">Linkedin</label>
                        <input type="text" class="form-control" name="Linkedin" maxlength="255">
                    </div>
                    <div class="form-group" hidden>
                        <label class="col-form-label" for="Facebook">Facebook</label>
                        <input type="text" class="form-control" name="Facebook" maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Domicilio">Domicilio completo</label>
                        <input type="text" class="form-control" name="Domicilio" maxlength="200">
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