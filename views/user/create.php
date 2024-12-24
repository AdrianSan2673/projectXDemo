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
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                    </div>
                    <div id="user_exists" style="display: none"></div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Nombres" name="Nombres" placeholder="Nombre(s)">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="Apellidos" name="Apellidos" placeholder="Apellidos">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="Correo" name="Correo" placeholder="Dirección de correo electrónico">
                    </div>
                    <div id="email_exists" style="display: none"></div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                    </div>
                   
                    <div id="div_confirm_pass" style="display: none"></div>
                    <div class="form-group mb-3">
                        <label for="id_user_type">Tipo de usuario:</label>
                        <?php $roles = Utils::showRoles(); ?>
                        <select class="form-control" id="id_tipo_usuario" name="id_tipo_usuario">
                            <option disabled selected></option>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role['id'] ?>"><?= $role['tipo_usuario'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-orange" >Guardar</button>

                </div>
        </div>
        </form>
    </div>
</div>


<script type="text/javascript">
 
 console.log("entre")
    document.querySelector('#register-user-form').addEventListener('submit', e => {
        console.log("hola");
        e.preventDefault();
         let user = new User();
         user.save();
    });
</script>