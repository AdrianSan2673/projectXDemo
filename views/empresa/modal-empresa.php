<div class="modal fade" id="modal_empresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Empresa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="Empresa">
                    <input type="hidden" name="flag" value="1">
                    <div class="form-group">
                        <label class="col-form-label" for="Nombre_Empresa">Nombre</label>
                        <input type="text" class="form-control" name="Nombre_Empresa" maxlength="60" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Alias">Alias</label>
                        <input type="text" class="form-control" name="Alias" id="alias" maxlength="100" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="Especificaciones">Especificaciones</label>
                        <textarea class="form-control" name="Especificaciones" rows="5"></textarea>
                    </div>
                    <!-- //===[gabo 7 agosto creado por ]=== -->

                    <div class="form-group" <?= (Utils::isAdmin()) ? '' : 'hidden'; ?>>
                        <label class="col-form-label" for="Especificaciones">Creado por</label>
                        <?php $roles = Utils::showUsuariosByVentas(); ?>
                        <select class="form-control" name="creado_por" id="creado_por">
                            <option disabled selected></option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['username'] ?>"><?= $role['first_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- //===[gabo 7 agosto creado por fin=== -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="submit" class="btn btn-orange" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>