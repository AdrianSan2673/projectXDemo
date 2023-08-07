<div class="modal fade" id="modal-create-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="register-user-form">
                <div class="modal-header">
                    <h4 class="modal-title">Crear usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Usuario">
                    </div>
                    <div id="user_exists" style="display: none"></div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre(s)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellidos">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Dirección de correo electrónico">
                    </div>
                    <div id="email_exists" style="display: none"></div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirmar contraseña">
                    </div>
                    <div id="div_confirm_pass" style="display: none"></div>
                    <div class="form-group mb-3">
                        <label for="id_user_type">Tipo de usuario:</label>
                        <?php $roles = Utils::showRoles(); ?>
                        <select class="form-control" id="id_user_type" name="id_user_type">
                            <option disabled selected></option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['user_type'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-orange" id="registerSubmit">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    document.querySelector('#register-user-form #username').addEventListener('input', e => {
        let user = new User();
        user.checkUsername();
    });

    document.querySelector('#register-user-form #email').addEventListener('input', e => {
        let user = new User();
        user.checkEmail();
    });

    document.querySelector('#register-user-form #password').addEventListener('input', e => {
        let user = new User();
        user.confirmPassword();
    });

    document.querySelector('#register-user-form #password_confirm').addEventListener('input', e => {
        let user = new User();
        user.confirmPassword();
    });

    document.querySelector('#register-user-form #registerSubmit').addEventListener('click', e => {
        e.preventDefault();
        let user = new User();
        user.save();
    });
</script>