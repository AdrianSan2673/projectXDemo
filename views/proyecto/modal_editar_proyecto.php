<div class="modal fade" id="modal_editar_proyecto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Proyecto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input  name="id" value = <?= $proyecto->id ?>>
                    <input type="hidden" name="id_cliente_create" value="<?= $_SESSION['id_cliente'] ?>">
                    <div class="form-group">
                        <label class="col-form-label" for="department">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="department" maxlength="100" value = <?= $proyecto->direccion ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Fase</label>
                        <input type="text" class="form-control" name="fase" id="department" maxlength="100" value = <?= $proyecto->status ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Telefono</label>
                        <input type="text" class="form-control" name="Telefono" id="department" maxlength="100" value = <?= $proyecto->Telefono ?> required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="department">Area Encargada</label>
                        <input type="text" class="form-control" name="id_tipo_usuario" id="department" maxlength="100" value = <?= $proyecto->id_tipo_usuario ?> required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-primary" value="Guardar" id="btn_update_project">
                </div>
            </form>
        </div>
    </div>
</div>