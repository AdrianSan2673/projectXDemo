<div class="modal fade" id="modal_create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo proyecto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="flag" id="flag" value="1">
                    <input type="hidden" name="id" value="0">
                    <div class="form-group">
                        <label class="col-form-label" for="createNewProject">Nombre del proyecto</label>
                        <input type="text" class="form-control" name="Nombre" id="createNewProject" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="createNewProject">Entidad</label>
                        <input type="text" class="form-control" name="Estado" id="createNewProject" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="createNewProject">Direccion</label>
                        <input type="text" class="form-control" name="direccion" id="createNewProject" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="createNewProject">Telefono del encargado</label>
                        <input type="text" class="form-control" name="Telefono" id="createNewProject" maxlength="100" required>
                    </div class="form-group">
                    <!-- Pendiente de implementar
                    <div>
                        <label class="col-form-label" for="createNewProject">Encargado del proyecto</label>
                        <select class="custom-select" id="userSelect" name="userSelect" multiple data-coreui-search="true" required>
                            <option disabled="">Selecciona al encargado</option>
                            <?php foreach ($users as $user) : ?>
                            <option><?= $user['usuario'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                            -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar" id="btn_create_project">
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
</script>