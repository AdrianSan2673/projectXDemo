<div class="modal fade" id="modal_contactos">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Contactos</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Empresa" value="<?=$_GET['controller'] == 'cliente_SA' ? $cliente->Empresa : Encryption::decode($_GET['id'])?>">
                    <input type="hidden" name="Cliente" value="<?=$_GET['controller'] == 'cliente_SA' ? $_GET['id'] : 0?>">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-group">
                        <label for="contactos">Selecciona los contactos que quieras añadir al cliente</label>
                        <select name="contactos[]" id="contactos" multiple="multiple" class="form-control select2bs4">
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