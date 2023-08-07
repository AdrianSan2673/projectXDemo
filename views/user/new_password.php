<p class="login-box-msg text-white">Escribe tu nueva contraseña.</p>
<?php if ($flag): ?>
<form id="recover" method="post">
    <input type="hidden" name="id" id="id" value="<?=isset($_GET['id']) ? $_GET['id'] : ''?>">
    <input type="hidden" name="token" id="token" value="<?=isset($_GET['token']) ? $_GET['token'] : ''?>">
    <div class="input-group mb-3">
        <input id="new_password" name="new_password" type="password" class="form-control" placeholder="Nueva contraseña">
    </div>
    <div class="input-group mb-3">
        <input id="confirm_new_password" name="confirm_new_password" type="password" class="form-control" placeholder="Confirme su nueva contraseña">
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" id="new_password_submit" class="btn btn-orange btn-block">Cambiar contraseña</button>
        </div>
        <div id="div_confirm_pass" hidden></div>
        <!-- /.col -->
    </div>
</form>

<script type="text/javascript">
    document.querySelector('#new_password').addEventListener('input', () =>{
        let recover = new Account();
        recover.confirmNewPassword();
    });

    document.querySelector('#confirm_new_password').addEventListener('input', e => {
        let recover = new Account();
        recover.confirmNewPassword();
    });

    document.querySelector('#new_password_submit').addEventListener('click', e => {
        e.preventDefault();
        let recover = new Account();
        recover.submitNewPassword();
    });

    document.querySelector('#new_password_submit').disabled = true;
</script>
<?php else: ?>
<div class='alert alert-danger'>
    <span>No se pudo verificar los datos.</span>
</div>
<?php endif ?>
<p class="mt-3 mb-1 text-center">
    <a href="<?=base_url?>usuario/index" class="bg-success">Iniciar Sesión</a>
</p>
<p class="mb-0 text-center">
    <a href="<?=base_url?>usuario/registrar" class="text-center bg-info">Registrarse</a>
</p>

