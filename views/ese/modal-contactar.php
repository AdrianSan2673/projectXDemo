<div class="modal fade" id="modal_contactar">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Contactar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Folio">
                    <input type="hidden" name="flag">
                    <b></b>
                    <div class="form-group">
                        <label class="col-form-label" for="Correo">Correo del cliente</label>
                        <select name="Correos[]" multiple="multiple" class="form-control select2bs4">
                        </select>
                        <!-- <input type="email" name="Correo" class="form-control"> -->
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Mensaje">Mensaje</label>
                        <textarea name="Mensaje" rows="5" class="form-control"></textarea>
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