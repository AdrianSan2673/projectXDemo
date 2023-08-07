<div class="modal fade" id="modal-update-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <h4 class="modal-title">actualizar usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Usuario">
                    </div>
                    <div style="display: none"></div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="first_name" placeholder="Nombre(s)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="last_name" placeholder="Apellidos">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Dirección de correo electrónico">
                    </div>
                    <div style="display: none"></div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="password" placeholder="Contraseña">
                    </div>


                    <div style="display: none"></div>
                    <div class="form-group mb-3">
                        <label for="id_user_type">Tipo de usuario:</label>
                        <?php $roles = Utils::showRoles(); ?>
                        <select class="form-control" name="id_user_type">
                            <option disabled selected></option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['user_type'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group row ">
                        <div class="col-4">
                            <input type="checkbox" name="flag_username" value="0">
                            <label for="flag_username" class="col-form-label" >Cambiar usuario</label>
                        </div>

                        <div class="col-4">
                            <input type="checkbox" name="flag_email" value="0">
                            <label for="flag_email" class="col-form-label">Cambiar correo</label>
                        </div>
                    </div>
           
                        <div class="col-4">
                            <input type="checkbox" name="flag_desactivate" value="0" disabled>
                            <label for="flag_desactivate" class="col-form-label">Desactivar usuario</label>
                        </div>
					
                    <input type="hidden" name="id" value="">
                </div>
                
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-orange">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>